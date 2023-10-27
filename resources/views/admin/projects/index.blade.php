@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <a href="{{route('admin.projects.create')}}" class="btn btn-outline-primary">Add project</a>
    <a href="{{route('admin.projects.trash.index')}}" class="btn btn-outline-primary">Show trashed</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">ID of Type</th>
            <th scope="col">Name of Type</th>
            <th scope="col">Slug</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                
            <tr>
              <th scope="row">{{$project->id}}</th>
              <td>{{$project->name}}</td>
              <td>{{$project->type->id ?? ""}}</td>
              
              
              <td><span class="badge" @isset($project->type)
                  
               style="background-color: {{ $project->type->colour}} "
               @endisset
               >{{$project->type->name ?? ""}} </span></td>

              <td>{{$project->slug}}</td>
              <td>{{$project->created_at}}</td>
              <td>{{$project->updated_at}}</td>
              <td>
                <a href="{{ route('admin.projects.show' , $project) }}" class="btn btn-outline-primary">More</a>
                <a href="{{ route('admin.projects.edit' , $project)}}" class="btn btn-outline-primary">Edit</a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$project->id}}">
                    Delete
                  </button>
              </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                <i>No projects present</i>    
                </td>    
            </tr>    
            @endforelse
        </tbody>
      </table>

    {{ $projects->links('pagination::bootstrap-5')}}
</div>
@endsection

@section('modal')
  @foreach ($projects as $project)
    @include('partials.modals.projects._modalDelete')
      
  @endforeach
@endsection