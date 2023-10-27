@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <a href="{{route('admin.projects.index')}}" class="btn btn-outline-primary">Return to projects list</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">ID of Type</th>
            <th scope="col">Name of Type</th>
            <th scope="col">Slug</th>
            <th scope="col">Deleted at</th>
            
            <th scope="col">Actions</th>
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
                
                {{-- <a href="{{ route('admin.projects.trash.restore' , $project)}}" class="btn btn-outline-primary">Restore</a> --}}
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#restoreModal-{{$project->id}}">
                    Restore
                  </button>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$project->id}}">
                    Delete
                  </button>
              </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                <i>No trashed projects present</i>    
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
        @include('partials.modals.projects._modalForceDelete')


        @include('partials.modals.projects._modalRestore')
    @endforeach
@endsection