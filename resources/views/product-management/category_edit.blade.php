@extends('../layouts/backend_layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Edit Category
            <a href="{{ route('categories.index') }}" class="btn btn-primary float-right">
                Go Back
            </a>
        </h3>     
    </div>
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="post">
            @csrf 
            @method('put')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}">
            </div>
            <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                <label for="photo">Photo</label>
                <div class="needsclick dropzone" id="photo-dropzone">

                </div>
                @if($errors->has('photo'))
                    <em class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </em>
                @endif
            </div>
            <div class="form-group">
                <label for="parent">Parent</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Default --</option>
                    @foreach($categories as $id => $categoryName)
                        <option {{ $category->category_id  === $id  ? 'selected' : null }} value="{{ $id }}">{{ $categoryName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection

@push('style-alt')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@push('script-alt')   
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
