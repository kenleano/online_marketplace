{{-- resources/views/products/create.blade.php --}}
@extends('layouts.app')

@section('content')
<link href="{{ asset('css/create.css') }}" rel="stylesheet">
<div class="container">
    <h2>Post a New Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Product Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea name="description" required></textarea>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" required>
        </div>
        <div>
            <label for="image">Product Image:</label>
            <div>
                <button type="button" id="upload_widget" class="btn btn-success">Upload Image</button>
                <input type="hidden" name="image_url" id="image_url">
                <div class="thumbnail"></div> <!-- Optional: For displaying the uploaded image thumbnail -->
            </div>

        </div>
        <button type="submit">Post Product</button>
    </form>
</div>
@endsection

{{-- resources/views/layouts/app.blade.php --}}
@section('scripts')
<script src="https://upload-widget.cloudinary.com/global/all.js" type="text/javascript"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var myWidget = cloudinary.createUploadWidget({
            cloudName: "dx4yz4grz",
        uploadPreset: "oqqyky8l",
            sources: ['local', 'url', 'camera'],
            fieldName: 'image_url',
            thumbnails: '.thumbnail',
            multiple: false,
            cropping: true, // Add cropping
            defaultSource: 'local',
            styles: {
                palette: {
                    window: "#FFFFFF",
                    windowBorder: "#90A0B3",
                    tabIcon: "#0078FF",
                    menuIcons: "#5A616A",
                    textDark: "#000000",
                    textLight: "#FFFFFF",
                    link: "#0078FF",
                    action: "#FF620C",
                    inactiveTabIcon: "#0E2F5A",
                    error: "#F44235",
                    inProgress: "#0078FF",
                    complete: "#20B832",
                    sourceBg: "#E4EBF1"
                },
                fonts: {
                    default: null,
                    "'Fira Sans', sans-serif": {
                        url: "https://fonts.googleapis.com/css?family=Fira+Sans",
                        active: true
                    }
                }
            }
        }, (error, result) => {
            if (!error && result && result.event === "success") {
                console.log('Done! Here is the image info: ', result.info);
                document.getElementById('image_url').value = result.info.secure_url;
            }
        });

        document.getElementById("upload_widget").addEventListener("click", function() {
            myWidget.open();
        }, false);
    });
</script>
@endsection

@push('scripts')
@yield('scripts')
@endpush