<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Category;
use App\Gallery;
use DB;
use Storage;
use Session;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Mail;
use App\Mail\InquiryMail;
class ProjectsController extends Controller
{
    private $imageBasePath;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
       $this->imageBasePath = url("/") . "//images/";
    }
    public function index()
    {
        $projects =  Project::select(DB::raw("id,title,description,banner_image,CONCAT('$this->imageBasePath',projects.banner_image) AS imageUrl,image_url as cloudUrl, created_at,updated_at"))->with(
            array(
                'categories'=>function($query){
                    $query->select('categories.id','categories.name');
        }))->get();
        return $projects;
    }
    public function categories()
    {
        $categories = Category::all();
        return $categories;
    }
    public function listProjects() {
        $data["projects"] = Project::with('categories')->latest()->get();
        return view("ember.list_projects",$data);
    }
    public function addCategoryToProject() {
        $project = Project::find(18);
        $category = Category::find(8);

        if ($project->categories->contains($category))
        {
            return ['message'=> "Category $category->name could not be assigned. Duplicate entry!"];

        } else {

            $project->categories()->save($category);

            return ['message'=> "Category $category->name assigned Successfully!"];

        }
    }
    public function setCloudinarySecureLinks() {
        // $files = Storage::disk('local')->allFiles();
        // dd($files);
        DB::statement("UPDATE projects
        SET image_url = REPLACE(image_url, 'http', 'https')");
        DB::statement("UPDATE projects_gallery
        SET image_url = REPLACE(image_url, 'http', 'https')");
        return ["message"=>"success"];
    }

    /**
     * Show the form for creating a new Project.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data["categories"] = Category::all();
        return view("ember.add_project",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('project_id')) {
            //Update Validations
            $projectId = $request->input('project_id');
            $validatedData = $request->validate([
                'title' => "required|unique:projects,title,$projectId|max:255",
                'description' => 'required',
                'banner_image'=>'image|nullable|max:1999',
                'categories'=>'required'
            ]);
        } else {
            //Insert Validations
            $validatedData = $request->validate([
                'title' => "required|unique:projects|max:255",
                'description' => 'required',
                'banner_image'=>'image|nullable|mimes:jpeg,bmp,jpg,png|between:1, 6000',
                'categories'=>'required'
            ]);
        }
        

        $files = $_FILES;
        $projectImages = array();
        if(count($files) > 0) {
            foreach($files as $key=>$file) {
                if($request->hasFile($key)) {
                    
                    $fileNameWithExtension = $request->file($key)->getClientOriginalName();
        
                    $filename = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
        
                    $fileExt = $request->file($key)->getClientOriginalExtension();

                    $project_image_name = $request->file($key)->getRealPath();

                    Cloudder::upload($project_image_name, null);

                    list($width, $height) = getimagesize($project_image_name);

                    $project_image_url= Cloudder::secureShow(Cloudder::getPublicId(), ["width" => $width, "height"=>$height]);
        
                    $projectImage = $filename . "_" . time() . "." . $fileExt;

                    $request->$key->move(public_path('images'), $projectImage);
                    
                    if($key != "banner_image") {
                        array_push($projectImages,['image_name' => $projectImage,"image_type"=>$file["type"],"grid"=>12,"image_url"=>$project_image_url]);
                    } else {
                        $banner_image = $projectImage;
                        $banner_image_url = $project_image_url;
                    }
                }
            }
        }   
        if($request->input('project_id')) {
            //update already saved project
            $projectId = $request->input('project_id');
            $project = Project::with('categories')->find($projectId);
        } else {
            //create a new project
            $project = new Project;
            
        }
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        if($request->hasFile("banner_image")) {
            $project->banner_image = $banner_image;
            $project->image_url = $banner_image_url;
        }
        $project->save();

        // Save Project Gallery Images
        $projectGallery = array();
        foreach($projectImages as $galleryImage) {
            $galleryImage["project_id"] = $project->id;
            array_push($projectGallery,new Gallery($galleryImage));
        }
        $project->gallery()->saveMany($projectGallery);

        // Save Project Tags / Categories
        $existingTags = array();
        if(isset($project->categories)) {
            foreach($project->categories as $category) {
                $existingTags[] = $category->id;
            }
        }

        //First Remove all previous tags linked
        if($request->input('project_id')) {
            DB::table('category_project')
            ->whereIn('category_id', $existingTags)
            ->where('project_id', $projectId)
            ->delete();
        }

        foreach($request->input("categories") as $category_id) {
            $category = Category::find($category_id);
            $project->categories()->save($category);
            
        }

        //Save Grid & Order
        if($request->input("sortAndGrid")) {
            $sortAndGrid = json_decode($request->input("sortAndGrid"),true);
            if(!empty($sortAndGrid)) {
                foreach($sortAndGrid as $galleryImage) {
                    $gallery = Gallery::find($galleryImage['imageId']);
                    if($gallery) {
                        $gallery->grid = $galleryImage["grid"];
                        $gallery->sequence = $galleryImage["sequence"];
                        $gallery->save();
                    }
                }
            }
        }

        return array("status"=>"success","msg"=>"Project Added Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::select(DB::raw("id,title,description,banner_image,CONCAT('$this->imageBasePath',projects.banner_image) AS imageUrl,image_url as cloudUrl,created_at,updated_at"))->with(
            array(
                'gallery'=>function($query){
                    $query->select(DB::raw("id,image_name,image_type,sequence,CONCAT('$this->imageBasePath',image_name) AS imageUrl,image_url as cloudUrl,grid,project_id,created_at,updated_at"))->orderBy('sequence', 'asc');
                },
                'categories'=>function($query){
                    $query->select('categories.id','categories.name');
                }
                ),
        )->where('id', $id)->get();
        return $project;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["project"] = Project::with(
            array(
                'gallery'=>function($query){
                    $query->select(DB::raw("*"))->orderBy('sequence', 'asc');
                },
                'categories'
            ),
        )->find($id)->toArray();
        $data["galleryExist"] = count($data["project"]["gallery"]);
        if($data["galleryExist"]) {
            foreach($data["project"]["gallery"] as $key => $image) {
                $mockFile = array(
                    "imageId"=>$image["id"],
                    "projectId"=>$image["project_id"],
                    "name"=>$image["image_name"],
                    "cloudUrl"=>$image["image_url"],
                    "imageUrl" => url('/') . "/images//" . $image["image_name"]
                );
                $data["project"]["gallery"][$key] = $mockFile;
            }
        }
        $data["projectTags"] = array();
        foreach($data["project"]["categories"] as $tag) {
            $data["projectTags"][] =  $tag["name"];
        }
        $data["defaultCategories"] = Category::all();
        if(is_null($data["project"])) {
            return redirect('/admin/projects');
        }
        return view("ember.edit_project",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        if(is_null($project)) {
            return redirect('/admin/projects');
        }
        if($project->banner_image != "default.jpg") {
            Storage::disk('public')->delete('images/'.$project->banner_image);
        }
        $project->delete();
        Session::flash('message', 'Project Removed Successfully!'); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('/admin/projects');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyGalleryImage($id,Request $request)
    {
        
        $galleryImage = Gallery::find($request->input('imageId'));

        Storage::delete('public/gallery/'.$galleryImage->image_name);
        
        $galleryImage->delete();
        
        return array("status"=>"success","message"=>"Image removed successfully!");
    }
    
    //Contact form email
    public function mail(Request $request)
    {
        $inquiry = [
            'name' => $request->input('name'),
            'message' => $request->input('msg'),
            'contact'=> $request->input('contact'),
            'email'=> $request->input('email')
        ];
        $emails = ['abrar@emberlinestudios.com', 'asad@emberlinestudios.com','saad@emberlinestudios.com','hello@emberlinestudios.com'];
        // $emails = ['xmark030@gmail.com', 'danifaiz30@gmail.com'];
        $result = Mail::to($emails)->send(new InquiryMail($inquiry));
        return array("status"=>"Thank you","message"=>"We've received your request, our team will get in touch with you shortly.");
    }
    
}
