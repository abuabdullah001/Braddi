<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Zip Files</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Uploaded Zip Files</h1>
            <a href="{{ route('file.create') }}" class="btn btn-primary">Upload New Zip File</a>
        </div>

        <!-- Table Section -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">SR No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Meta Tags</th>
                        <th scope="col">File URL</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($zipFiles as $zipFile)
                        <tr>
                            <td>{{ $zipFile->sr_no }}</td>
                            <td>{{ $zipFile->name }}</td>
                            <td>
                                {{ implode(', ', is_array($zipFile->category) ? $zipFile->category : json_decode($zipFile->category, true) ?? []) }}
                            </td>
                            <td>
                                {{ implode(', ', is_array($zipFile->meta_tags) ? $zipFile->meta_tags : json_decode($zipFile->meta_tags, true) ?? []) }}
                            </td>
                            <td>
                                <button class="btn btn-primary"><a href="{{ $zipFile->file_url }}" target="_blank" class="text-decoration-none"> <span style="color: white">File url</span> </a></button>
                            </td>
                            <td>
                                <a href="{{ route('file.show', $zipFile->id) }}" class="btn btn-info btn-sm">View</a>
                                <a href="{{ route('file.edit', $zipFile->id) }}" class="btn btn-info btn-sm">Edit</a>
                                <!-- Uncomment if delete functionality is needed -->

                               <form action="{{ route('file.delete', $zipFile->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- No Records Message -->
        @if ($zipFiles->isEmpty())
            <div class="alert alert-warning text-center">No Zip Files Uploaded Yet.</div>
        @endif
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
