@extends('layouts.app')

@section('content')
<div class="container mt-5">

    {{-- <a href="{{route('admin.projects.create')}}" class="btn btn-outline-primary">Add project</a> --}}

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">ID of Type</th>
            <th scope="col">Name of Type</th>
            <th scope="col">Slug</th>
            <th scope="col">Deleted at</th>
            
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                
            <tr>
              <th scope="row">{{$project->id}}</th>
              <td>{{$project->name}}</td>
              <td>{{$project->type->id ?? "null"}}</td>
              <td>{{$project->type->name ?? "null"}}</td>
              <td>{{$project->slug}}</td>
              <td>{{$project->deleted_at}}</td>
              
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
    @include('partials._modalDelete')
@endsection