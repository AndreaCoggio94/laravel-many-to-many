@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{route('admin.projects.index')}}" class="btn btn-outline-primary mx-1">Return to the list</a>
        <a href="{{ route('admin.projects.edit', $project)}}" class="btn btn-outline-primary mx-1">Edit this project</a>
          <button type="button" class="btn btn-outline-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$project->id}}">
              Delete
            </button>
        <h1> {{ $project->name}}</h1>
        <div class="row">
            <div class="col-2">
                <p>
                    <strong>Slug:</strong> <br>
                    {{$project->slug}}
                </p>


            </div>
            <div class="col">
                <p> 
                    <strong>Description: </strong> <br>
                     {{$project->description}}
                </p>
                
            </div>
            
        </div>
        <div class="row">
            <div class="col">
                <p>
                    <strong>Repository link:</strong> <br>
                    {{$project->repository}}
                </p>


            </div>
            <div class="col">
                <p> 
                    <strong>Created at: </strong> <br>
                     {{$project->created_at}}
                </p>
                
            </div>
            <div class="col">
                <p>
                    <strong>Updated at:</strong> <br>
                    {{$project->updated_at}}
                </p>


            </div>
            
        </div>
        <div class="row">
            <div class="col">
                <p> 
                    <strong>Type ID: </strong> <br>
                    {{$project->type?->id ?? "null" }}
                </p>
            </div>
            <div class="col">
                <p> 
                    <strong>Type Name: </strong> <br>
                    {{$project->type?->name ?? "null"}}
                </p>
            </div>
            <div class="col">
                <p> 
                    <strong>Type Description: </strong> <br>
                {{$project->type?->description ?? "null"}}
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p> 
                    <strong>Technologies:</strong>
                    @forelse ($project->technologies as $technology)
                      {{ $technology->label }} @unless($loop->last) , @else . @endunless
                    @empty
                    No technology associated
                    @endforelse
                    
                </p>
            </div>
            
        </div>

    </div>
@endsection

@section('modal')
    @include('partials.modals.projects._modalDelete')
@endsection