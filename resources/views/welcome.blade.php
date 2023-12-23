<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

    <ul>
        @foreach ($jsonData as $item)
            <li>{{ $item->title }}</li>
        @endforeach
    </ul>





    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h6>File Upload</h6>
                    </div>
                    <div class="card-body">
                        <div id="loadingIndicator" style="display: none; text-align: center;">
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                        <form >
                            <div class="form-group">
                                <label for=""> Name</label>
                                <input type="text"class="form-control" id="name"  name="name">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Image</label>
                                <input type="file"class="form-control" id="file" name="file">
                            </div>
                            <div class="form-group">
                                <button id="submitBtn" type="button" class="btn btn-primary upload-image">Upload Button</button>
                            </div>
                        </form>
                        <!-- Display the uploaded image -->
                        <div id="uploadedImageContainer" style="margin-top: 20px;">
                            <img id="uploadedImage" class="img-fluid" height="150px" width="150px" alt="Uploaded Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
           $("#submitBtn").click(function(){
                var name=$("#name").val();
                var imageData = $("#file").prop('files')[0];

                var form_data = new FormData();
                form_data.append('file', imageData);
                form_data.append('name', name);

                //console.log(form_data);
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrf_token
                    }
                });
                $("#loadingIndicator").show();
                $.ajax({
                    type: 'POST',
                    url: "{{route('store')}}",
                    data: form_data,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $("#uploadedImage").prop("src", response.image_path);
                            $("#uploadedImageContainer").show();
                        }
                        $("#loadingIndicator").hide();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        $("#loadingIndicator").hide();
                    }
                });
           });
        });
    </script>
  </body>
</html>