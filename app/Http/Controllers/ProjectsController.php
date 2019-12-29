<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Category;
use App\Gallery;
use DB;
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

        // $categories = [
        // new Category(['name' => 'Vacation']),
        // new Category(['name' => 'Tropical']),
        // new Category(['name' => 'Leisure']),
        // ];

        // $project->categories()->saveMany($categories);
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
        $validatedData = $request->validate([
            'title' => 'required|unique:Projects|max:255',
            'description' => 'required',
            'banner_image'=>'image|nullable|max:1999',
            'categories'=>'required'
        ]);

        $files = $_FILES;
        $projectImages = array();
        if(count($files) > 0) {
            foreach($files as $key=>$file) {
                if($request->hasFile($key)) {
                    
                    $fileNameWithExtension = $request->file($key)->getClientOriginalName();
        
                    $filename = pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
        
                    $fileExt = $request->file($key)->getClientOriginalExtension();
        
                    $projectImage = $filename . "_" . time() . "." . $fileExt;
        
                    $path = $request->file($key)->storeAs("public/gallery", $projectImage);
                    
                    if($key != "banner_image") {
                        array_push($projectImages,['image_name' => $projectImage,"image_type"=>$file["type"],"grid"=>12]);
                    } else {
                        $banner_image = $projectImage;
                    }
                }
            }
        }

        $project = new Project;
        $project->title = $request->input('title');
        $project->description = $request->input('description');
        $project->banner_image = $banner_image;
        $project->save();

        // Save Project Gallery Images
        $projectGallery = array();
        foreach($projectImages as $galleryImage) {
            $galleryImage["project_id"] = $project->id;
            array_push($projectGallery,new Gallery($galleryImage));
        }
        $project->gallery()->saveMany($projectGallery);

        // Save Project Tags / Categories
        $categories = array();
        foreach($request->input("categories") as $category) {
            array_push($categories,new Category(['name' => $category]));
        }
        $project->categories()->saveMany($categories);


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
        //
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
        //
    }
}
