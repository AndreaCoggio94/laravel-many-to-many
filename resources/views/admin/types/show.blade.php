@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <a href="{{route('admin.types.index')}}" class="btn btn-outline-primary mx-1">Return to the list</a>
        <a href="{{ route('admin.types.edit', $type)}}" class="btn btn-outline-primary mx-1">Edit this type</a>
          <button type="button" class="btn btn-outline-danger mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$type->id}}">
              Delete
            </button>
        <h1> {{ $type->name}}</h1>
        <div class="row">
            <div class="col-2">
                <p> 
                    <strong>Colour: </strong> <br>
                     {{$type->colour}}
                </p>
                
            </div>
            <div class="col">
                <p> 
                    <strong>Description: </strong> <br>
                     {{$type->description}}
                </p>
                
            </div>
            
        </div>
        
    </div>
@endsection

@section('modal')
    @include('partials.modals.types._modalDelete')
@endsection