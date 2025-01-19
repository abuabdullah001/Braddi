

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container">
    <h1>File Details</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Name: {{ $zipFile->name }}</h5>
            <p><strong>SR No:</strong> {{ $zipFile->sr_no }}</p>
            <p><strong>Category:</strong> {{ $zipFile->category }}</p>
            <p><strong>Meta Tags:</strong>
                @if (is_array($zipFile->meta_tags))
                    {{ implode(', ', $zipFile->meta_tags) }}
                @else
                    No Meta Tags
                @endif
            </p>
            <p><strong>File URL:</strong>
                <a href="{{ $zipFile->file_url }}" target="_blank">{{ $zipFile->file_url }}</a>
            </p>
            <p><strong>Uploaded At:</strong> {{ $zipFile->created_at->format('d M Y, h:i A') }}</p>

            <!-- Display the GIF -->
            <div class="mt-3">
                <strong>Preview:</strong>
                <img src="{{ $zipFile->file_url }}" alt="Uploaded GIF" class="img-fluid border rounded" style="width: 500px; height:300px;">
            </div>
        </div>
    </div>
    <a href="{{ route('file.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
