<!DOCTYPE html>

<html>

<head>

    <title>laravel File Uploading with Amazon S3</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        a:hover {
            text-decoration: none;
            color: white;
        }

        a {
            color: white;
        }

        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
        
        td, th {
          border: 1px solid #dddddd;
          text-align: left;
          padding: 8px;
        }
        
        tr:nth-child(even) {
          background-color: #dddddd;
        }
    </style>
</head>

    

<body>

<div class="container">

     
    
    <div class="panel panel-primary">

      <div class="panel-heading"><h2>laravel File Uploading with MiniIO</h2></div>

      <div class="panel-body">

        @if (count($errors) > 0)

            <div class="alert alert-danger">

                <strong>Whoops!</strong> There were some problems with your input.

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="row">

    

                <div class="col-md-6">

                    <input type="file" name="images[]" class="form-control" multiple>

                </div>

     

                <div class="col-md-6">

                    <button type="submit" class="btn btn-success">Upload</button>

                </div>

     

            </div>

        </form>

        @if ($message = Session::get('success'))

            <div class="alert alert-success alert-block">

                <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ $message . ' : ' . Session::get('time') }}</strong>

            </div>
            <h2>Upload Table</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Path</th>
                    {{-- <th>Url</th> --}}
                    <th>Option</th>
                </tr>
                @foreach(Session::get('files') as $file)
                    <tr>
                        <th>{{ $file->name }}</th>
                        <th>{{ $file->type }}</th>
                        <th>{{ $file->path }}</th>
                        {{-- <th>
                            <button onclick="window.location='{{ $file->url }}'" class="btn btn-success">
                                Get image
                            </button>
                        </th> --}}
                        <th>
                            <button class="btn btn-warning"> 
                                <a href="/upload/{{ $file->path }}"> Get pre-signed </a> 
                            </button>
                        </th>
                    </tr>
                @endforeach
            </table>
        @endif

      </div>

    </div>

</div>

</body>

  

</html>