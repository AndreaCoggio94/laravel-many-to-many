@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <a href="{{route('admin.technologies.create')}}" class="btn btn-outline-primary">Add Technology</a>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Label</th>
            <th scope="col">Colour</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
            @forelse ($technologies as $technology)
                
            <tr>
              <th scope="row">{{$technology->id}}</th>
              <td>{{$technology->label}}</td>
              <td>{{$technology->colour}}</td>
              <td>{{$technology->created_at}}</td>
              <td>{{$technology->updated_at}}</td>
              <td>
                <a href="{{ route('admin.technologies.show' , $technology) }}" class="btn btn-outline-primary">More</a>
                <a href="{{ route('admin.technologies.edit' , $technology)}}" class="btn btn-outline-primary">Edit</a>
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$technology->id}}">
                    Delete
                  </button>
              </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">
                <i>No technologies present</i>    
                </td>    
            </tr>    
            @endforelse
        </tbody>
      </table>

    {{ $technologies->links('pagination::bootstrap-5')}}
</div>
@endsection

@section('modal')
    @include('partials._modalDeleteTechnology')
@endsection