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
        
        <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-4">

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
                <div class="mb-3 col-4" id="cover_image_preview">
                    <img src="" class="img-fluid" alt="">
                </div>
                <div class="mb-3 col-8">
                    <label for="cover_image" class="form-label @error('name') is-invalid @enderror">Cover Image</label>
                    <input type="file" name="cover_image" id="cover_image" value="{{ old('cover_image') }}" class="form-control">
                    @error('cover_image')
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
            <div class="row">
                <div class="col">

                
                <label class="form-label">Technologies</label>
                <div class="form-check @error('tags') is-invalid @enderror p-0">
                @foreach ($technologies as $technology)
                    <input
                    type="checkbox"
                    id="technology-{{ $technology->id }}"
                    value="{{ $technology->id }}"
                    name="technologies[]"
                    class="form-check-control"
                    @if (in_array($technology->id, old('technologies', $project_technology ?? []))) checked @endif
                    >
                    <label for="technology-{{ $technology->id }}">
                    {{ $technology->label }}
                    </label>
                    <br>
                @endforeach
                </div>

                @error('technologies')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            
            </div>
            <button type="submit" class="mt-4 btn btn-outline-primary ">Save and create</button>
                
        </form>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        const inputFileElement = document.getElementById('cover_image');
        const coverImagePreview = document.getElementById('cover_image_preview');

        if (!coverImagePreview.getAttribute('src') ||  coverImagePreview.getAttribute('src') == "http://127.0.0.1:8000/storage") {
            coverImagePreview.src = "https://placehold.co/400";
        }
        
        inputFileElement.addEventListener('change', function() {
            const [file] = this.files;
            coverImagePreview.src = URL.createObjectUrl(file);
        })
    </script>
@endsection