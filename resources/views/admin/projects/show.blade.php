@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{route('admin.projects.index')}}" class="btn btn-outline-primary mx-1">Return to the list</a>
        <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-outline-primary mx-1">Edit this project</a>
          <button type="button" class="btn btn-outline-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$project->id}}">
              Delete
            </button>
        <h1 class="mt-4 text-center"> {{ $project->name}}</h1>
        <div class="row g-5 mt-3">
            <div class="col-4">
                <img src="{{asset('/storage/'. $project->cover_image)}}" class="img-fluid" alt="">
            </div>
            <div class="col-8">
                <div class="row">

                
                    <div class="col-6">
                        <p>
                            <strong>Slug:</strong> <br>
                            {{$project->slug}}
                        </p>
            
            
                    </div>
                    
                    
                
                
                    <div class="col-6">
                        <p>
                            <strong>Repository link:</strong> <br>
                            {{$project->repository}}
                        </p>
            
            
                    </div>
                    <div class="col-6">
                        <p> 
                            <strong>Created at: </strong> <br>
                            {{$project->created_at}}
                        </p>
                        
                    </div>
                    <div class="col-6">
                        <p>
                            <strong>Updated at:</strong> <br>
                            {{$project->updated_at}}
                        </p>
            
            
                    </div>
                    
            
                
                    <div class="col-6">
                        <p> 
                            <strong>Type ID: </strong> <br>
                            {{$project->type?->id ?? "null" }}
                        </p>
                    </div>
                    <div class="col-6">
                        <p> 
                            <strong>Type Name: </strong> <br>
                            {{$project->type?->name ?? "null"}}
                        </p>
                    </div>
                    <div class="col-6">
                        <p> 
                            <strong>Type Description: </strong> <br>
                        {{$project->type?->description ?? "null"}}
                        </p>
                    </div>

                    <div class="col-6">
                        <p> 
                            <strong>Technologies:</strong>
                            
            
                            @forelse ($project->technologies as $technology)
                            <span class="badge rounded-pill" 
                            
                            style="background-color: {{ $technology->colour}} "
                            
                            >{{$technology->label ?? ""}} </span>
                            @empty
                            No technology associated
                            @endforelse
                            
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <p> 
                    <strong>Description: </strong> <br>
                     {{$project->description}}
                </p>
                
            </div>
        </div>
        
        
        

    </div>
@endsection

@section('modal')
    @include('partials.modals.projects._modalDelete')
@endsection