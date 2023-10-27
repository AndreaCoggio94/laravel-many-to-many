@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <a href="{{route('admin.types.create')}}" class="btn btn-outline-primary">Add Type</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($types as $type)
                
            <tr>
              <th scope="row">{{$type->id}}</th>
              <td>{{$type->label}}</td>
              <td>{{$type->description}}</td>
              <td>{{$type->created_at}}</td>
              <td>{{$type->updated_at}}</td>
              <td>
                <a href="{{ route('admin.types.show' , $type) }}" class="btn btn-outline-primary">More</a>
                <a href="{{ route('admin.types.edit' , $type)}}" class="btn btn-outline-primary">Edit</a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$type->id}}">
                    Delete
                  </button>
              </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                <i>No types present</i>    
                </td>    
            </tr>    
            @endforelse
        </tbody>
      </table>

    {{ $types->links('pagination::bootstrap-5')}}
</div>
@endsection

@section('modal')
  @foreach ($types as $type)
    @include('partials.modals.types._modalDelete')
      
  @endforeach
@endsection