<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;



class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view("admin.projects.index", compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $project = new Project();
        $types = Type::all();
        $technologies = Technology::orderBy("label","asc")->get();

        return view('admin.projects.create', compact('types','technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $project = new Project();
        $project->fill($data);
        $project->slug = Str::slug($project->name);
        
        // in case I want to use project id for the uploads
        // $project->save();
        // $cover_image_path = Storage::put("uploads/projects/{$project->id}/cover_image", $data['cover_image']);
        
        if(Arr::exists($data, 'cover_image')) {
        $cover_image_path = Storage::put("uploads/projects/cover_image", $data['cover_image']);
        $project->cover_image_path = $cover_image_path;
        }
        $project->save();


        if(Arr::exists($data, "technologies")){
            $project->technologies()->attach($data["technologies"]);
        }

        return redirect()->route('admin.projects.show', $project)
        ->with('message_type','success')
        ->with('message','project created with success');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::orderBy("label","asc")->get();
        $project_technology = $project->technologies->pluck("id")->toArray();
        return view("admin.projects.edit", compact("project","types","technologies","project_technology"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data = $request->validated();
        // $data = $this->validation($request->all(), $project->id);
        // $project->update($data);

        $project->fill($data);

        $project->slug = Str::slug($project->name);

        $project->save();

        if(Arr::exists($data, "technologies")) {
            $project->technologies()->sync($data["technologies"]);
        } else {
            $project->technologies()->detach();
        }

        return redirect()->route("admin.projects.show", $project)
        ->with("message_type","success")
        ->with("message","project updated with success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        // $project->technologies()->detach();
        $project->delete();

        return redirect()->route("admin.projects.index")
        ->with("message_type","success")
        ->with("message","project eliminated with success");
    }

    /**
     * Display a listing of the trashed resources.
     *
     * * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $projects = Project::orderBy('id')->onlyTrashed()->paginate(10);
        return view("admin.projects.trash.index", compact("projects"));
    }


    /**
     * Remove permanently the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * * @return \Illuminate\Http\Response
     */
    public function forceDestroy(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->technologies()->detach();
        if($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->forceDelete();

        return redirect()->route("admin.projects.trash.index")
        ->with("message_type","success")
        ->with("message","project permanently eliminated with success");
    }


    /**
     * Restore the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * * @return \Illuminate\Http\Response
     */
    public function restore(int $id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route("admin.projects.trash.index", $project)
        ->with("message_type","success")
        ->with("message","project restored with success");
    }

    // # validator
    // private function validation($data) {
    //     $validator = Validator::make(
    //         $data, 
    //         [
    //         'name' => 'required|string',
    //         'description' => 'nullable|string',
    //         'repository' => 'nullable|string',
    //         'type_id'=> 'nullable', 'exists:types,id',
    //         'technologies' => 'nullable','exists:technologies,id',
    //         'cover_image'=> 'nullable', 'image',
    //       ],
    //       [
    //         'name.required' => 'The name is required',
    //         'name.string' => 'The name must be a string',

    //         'description.string' => 'The description must be a string',
            
    //         'repository.string' => 'The thumb must be a url',

    //         'type_id.exists'=> 'The inserted Type is not valid',

    //         'technologies.exist' => 'The inserted Technologies are not valid'
    //       ]
    //     )->validate();
      
    //     return $validator;
    // }
}