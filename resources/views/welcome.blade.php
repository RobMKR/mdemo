<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mentor Demo</title>

        <!-- bootstrap 4.x is supported. You can also use the bootstrap css 3.3.x versions -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
        <!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
        <!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
        <!-- the font awesome icon library if using with `fas` theme (or Bootstrap 4.x). Note that default icons used in the plugin are glyphicons that are bundled only with Bootstrap 3.x. -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
        <!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
            wish to resize images before upload. This must be loaded before fileinput.min.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/piexif.min.js" type="text/javascript"></script>
        <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
            This must be loaded before fileinput.min.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/sortable.min.js" type="text/javascript"></script>
        <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for
            HTML files. This must be loaded before fileinput.min.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/plugins/purify.min.js" type="text/javascript"></script>
        <!-- popper.min.js below is needed if you use bootstrap 4.x (for popover and tooltips). You can also use the bootstrap js
           3.3.x versions without popper.min.js. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
            dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <!-- the main fileinput plugin file -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/js/fileinput.min.js"></script>
        <!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.9/themes/fas/theme.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <form action="/upload" method="POST" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="title m-b-md">
                        Load your CSV File for employees
                    </div>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ implode('. ', $errors->all()) }}
                        </div>
                    @endif
                    <div class="csv-import">
                        <input id="input-csv" name="csv" type="file" class="file" data-browse-on-zone-click="true">
                    </div>
                </form>
            </div>
        </div>

        <script>
            $("#input-csv").fileinput({
                theme: "fas",
            });
        </script>
    </body>
</html>
