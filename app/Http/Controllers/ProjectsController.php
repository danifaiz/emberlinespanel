<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Category;
use App\Gallery;
use DB;
use Storage;
use Session;
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects =  Project::with(array('categories'=>function($query){
            $query->select('id','name');
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
    public function test() {
        $files = Storage::disk('local')->allFiles();
        dd($files);
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
                'banner_image'=>'image|nullable|max:1999',
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
        
                    $projectImage = $filename . "_" . time() . "." . $fileExt;

                    Storage::disk('local')->put("public/storage/gallery", $projectImage);
                     
        
                    //$path = $request->file($key)->storeAs("public/gallery", $projectImage);
                    
                    if($key != "banner_image") {
                        array_push($projectImages,['image_name' => $projectImage,"image_type"=>$file["type"],"grid"=>12]);
                    } else {
                        $banner_image = $projectImage;
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
        DB::enableQueryLog(); // Enable query log
        $project = Project::with(['gallery','categories'])->find($id);
        //dd(DB::getQueryLog()); // Show results of log
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
        $data["project"] = Project::with(['gallery','categories'])->find($id)->toArray();
        $data["galleryExist"] = count($data["project"]["gallery"]);
        if($data["galleryExist"]) {
            foreach($data["project"]["gallery"] as $key => $image) {
                $mockFile = array(
                    "imageId"=>$image["id"],
                    "projectId"=>$image["project_id"],
                    "name"=>$image["image_name"],
                    "imageUrl" => url('/') . "/storage/gallery/" . $image["image_name"]
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
            Storage::delete('public/gallery/'.$project->banner_image);
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
    
}
