<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Golden House</title>
    <!-- <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <link href="{{url('css/offcanvas.css')}}" rel="stylesheet">
</head>

<body> 

    @section('navigation')

    @show

    <div class="container">

        <div class="row row-offcanvas row-offcanvas-right">

            <div class="col-xs-12 col-sm-9">

                <div class="jumbotron">
                    @section('maincontent')

                    @show
                </div>

            </div>

        </div>
        <footer>
        </footer>

    </div>

</body>

</html>