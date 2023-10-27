@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{route('admin.technologies.index')}}" class="btn btn-outline-primary mx-1">Return to the list</a>
        <a href="{{ route('admin.technologies.edit', $technology)}}" class="btn btn-outline-primary mx-1">Edit this technology</a>
          <button type="button" class="btn btn-outline-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$technology->id}}">
              Delete
            </button>
        <h1> {{ $technology->label}}</h1>
        <div class="row">
            <div class="col">
                <p> 
                    <strong>Colour: </strong> <br>
                     {{$technology->colour}}
                </p>
                
            </div>
            
        </div>
        
    </div>
@endsection

@section('modal')
    @include('partials.modals.technologies._modalDelete')
@endsection