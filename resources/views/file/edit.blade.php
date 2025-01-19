{{-- @extends('layouts.app')

@section('content') --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container">
    <h1>Edit Zip File</h1>
    <form action="{{ route('file.update', $file->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="sr_no" class="form-label">SR No</label>
            <input type="text" name="sr_no" id="sr_no" class="form-control" value="{{ old('sr_no', $file->sr_no) }}" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $file->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <div id="meta_category_container">
                @foreach($file->category as $category)
                    <input type="text" name="category[]" class="form-control mb-2" value="{{ $category }}" placeholder="Category" required>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary" id="add_category">Add Category</button>
        </div>
        <div class="mb-3">
            <label for="meta_tags" class="form-label">Meta Tags</label>
            <div id="meta_tags_container">
                @foreach($file->meta_tags as $tag)
                    <input type="text" name="meta_tags[]" class="form-control mb-2" value="{{ $tag }}" placeholder="Meta Tag" required>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary" id="add_meta_tag">Add Meta Tag</button>
        </div>
        <!-- File Upload -->
        <div class="mb-3">
            <label for="zip_file" class="form-label">GIF File</label>
            <input type="file" name="zip_file" id="zip_file" class="form-control" accept="image/gif">
            <small class="form-text text-muted">Only GIF files are allowed (Max: 20MB). Leave empty if not replacing the file.</small>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    document.getElementById('add_meta_tag').addEventListener('click', function() {
        const container = document.getElementById('meta_tags_container');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'meta_tags[]';
        input.classList.add('form-control', 'mb-2');
        input.placeholder = 'Meta Tag';
        container.appendChild(input);
    });

    document.getElementById('add_category').addEventListener('click', function() {
        const container = document.getElementById('meta_category_container');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'category[]';
        input.classList.add('form-control', 'mb-2');
        input.placeholder = 'Category';
        container.appendChild(input);
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- @endsection --}}
