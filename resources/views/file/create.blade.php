{{-- @extends('layouts.app')

@section('content') --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<div class="container">
    <h1>Upload Zip File</h1>
    <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row col-md-12" style="gap: 20px">
        <div class="col-md-7" style="background-color:#EDED">
            <div class="mb-3">
                <label for="sr_no" class="form-label">SR No</label>
                <input type="text" name="sr_no" id="sr_no" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
              <!-- File Upload -->
              <div class="mb-3">
                <label for="zip_file" class="form-label">GIF File</label>
                <input type="file" name="zip_file" id="zip_file" class="form-control" accept="image/gif/video" required>
                <small class="form-text text-muted">Only GIF files are allowed (Max: 20MB).</small>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
        <div class="col-md-4" style="background-color: #cdcd">
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <div id="meta_category_container">
                    <input type="text" name="category[]" class="form-control mb-2" placeholder="category" required>
                </div>
                <button type="button" class="btn btn-secondary" id="add_category">Add Category</button>
            </div>
            <div class="mb-3">
                <label for="meta_tags" class="form-label">Meta Tags</label>
                <div id="meta_tags_container">
                    <input type="text" name="meta_tags[]" class="form-control mb-2" placeholder="Meta Tag" required>
                </div>
                <button type="button" class="btn btn-secondary" id="add_meta_tag">Add Meta Tag</button>
            </div>
        </div>
    </div>

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
</script>
<script>
    document.getElementById('add_category').addEventListener('click', function() {
        const container = document.getElementById('meta_category_container');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'category[]';
        input.classList.add('form-control', 'mb-2');
        input.placeholder = 'category';
        container.appendChild(input);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- @endsection --}}
