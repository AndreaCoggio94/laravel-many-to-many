<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

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
    public function store(Request $request)
    {
        $data = $this->validation($request->all());

        $project = new Project();
        $project->fill($data);
        $project->slug = Str::slug($project->name);
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
        return view("admin.projects.edit", compact("project","types"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $this->validation($request->all(), $project->id);
        $project->update($data);

        $project->slug = Str::slug($project->name);

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
        $project->delete();

        return redirect()->route("admin.projects.index")
        ->with("message_type","success")
        ->with("message","project eliminated with success");
    }



    private function validation($data) {
        $validator = Validator::make(
            $data, 
            [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'repository' => 'nullable|string',
            'type_id'=> 'nullable', 'exists:types,id',
            'technologies' => 'nullable','exists:technologies,id'
          ],
          [
            'name.required' => 'The name is required',
            'name.string' => 'The name must be a string',

            'description.string' => 'The description must be a string',
            
            'repository.string' => 'The thumb must be a url',

            'type_id.exists'=> 'The inserted Type is not valid',

            'technologies.exist' => 'The inserted Technologies are not valid'
          ]
        )->validate();
      
        return $validator;
    }
}