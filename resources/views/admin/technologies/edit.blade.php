@extends('layouts.app')


@section('content')
    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <h4>Fix the errors to continue:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{route('admin.technologies.update', $technology)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-2">

                <h1>Updating {{$technology->label}}</h1>
                
            </div>
            <div class="row">
                
                <div class="mb-3 col">
                    <label for="label" class="form-label @error('label') is-invalid @enderror">Label</label>
                    <input type="text" name="label" id="label" value="{{ old('label') ?? $technology->label }}" class="form-control">
                    @error('label')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                
                <div class="mb-3 col">
                    <label for="colour" class="form-label @error('colour') is-invalid @enderror">Colour</label>
                    <input type="text" name="colour" id="colour" value="{{ old('colour') ?? $technology->colour }}" class="form-control">
                    @error('colour')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        
            <button type="submit" class="btn btn-outline-primary ">Edit</button>
                
        </form>
    </div>
@endsection