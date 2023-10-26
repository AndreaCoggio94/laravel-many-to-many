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
        
        <form action="{{route('admin.projects.store')}}" method="POST">
            @csrf
            
            <div class="row mb-2">

                <h1>Creating new project</h1>
                
            </div>

            <div class="row">
                
                <div class="mb-3 col">
                    <label for="name" class="form-label @error('name') is-invalid @enderror">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                
                
                <div class="mb-3 col">
                    <label for="repository" class="form-label @error('repository') is-invalid @enderror">Repository link</label>
                    <input type="url" name="repository" id="repository" value="{{ old('repository')  }}" class="form-control">
                    @error('repository')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label for="description" class="form-label @error('description') is-invalid @enderror">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description')  }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col">
                    <label for="type_id" class="form-label">Type</label>
                    <select name="type_id" id="type_id" class="form-select @error('type_id') is-invalid @enderror">
                    <option value="">Null</option>
                    @foreach ($types as $type)
                        
                        <option value="{{ $type->id }}" @if (old('type_id') == $type->id) selected @endif>{{ $type->name }}
                        </option>
                    @endforeach
                    </select>
                    @error('type_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-outline-primary ">Submit</button>
                
        </form>
    </div>
@endsection