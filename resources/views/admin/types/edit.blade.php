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
        
        <form action="{{route('admin.types.store')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-2">

                <h1>Creating new type</h1>
                
            </div>

            <div class="row">
                
                <div class="mb-3 col">
                    <label for="name" class="form-label @error('name') is-invalid @enderror">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') ?? $type->name }}" class="form-control">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3 col">
                    <label for="colour" class="form-label @error('colour') is-invalid @enderror">Colour</label>
                    <input type="color" name="colour" id="colour" value="{{ old('colour') ?? $type->colour }}" class="form-control">
                    @error('colour')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label for="description" class="form-label @error('description') is-invalid @enderror">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') ?? $type->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <button type="submit" class="btn btn-outline-primary ">Submit</button>
                
        </form>
    </div>
@endsection