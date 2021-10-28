
<!DOCTYPE html>
<html>

<head>
    <title>PDO - Read Records - PHP CRUD Tutorial</title>

    <!-- Latest compiled and minified Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <!-- custom css -->
    <style>
        .m-r-1em {
            margin-right: 1em;
        }
        .m-b-1em {
            margin-bottom: 1em;
        }
        .m-l-1em {
            margin-left: 1em;
        }
        .mt0 {
            margin-top: 0;
        }
    </style>

</head>

<body>

    <!-- container -->
    <div class="container">


        <div class="page-header">
            <h1>Read Tasks </h1>
            <br>





        </div>

        <!-- PHP code to read records will be here -->



        <table class='table table-hover table-responsive table-bordered'>
            <!-- creating our table heading -->
            <tr>
                <th>id</th>
                <th>title</th>
                <th>description</th>
                <th>start date</th>
                <th>end date</th>
                <th>image</th>
                <th>action</th>
            </tr>

       
   
        @foreach ($data as  $value)
         
            <tr> 
                <td>{{ $value->id }}</td>
                <td>{{ $value->title }}</td>
                <td>{{ $value->description }}</td>
                <td>{{ $value->start_date }}</td>
                <td>{{ $value->end_date }}</td>
                <td><img src="{{'/images/'.$value->image}}" width ="100px" alt="img"></td>
                <td>
                    <a href='{{ url('/Remove/'.$value->id) }}' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='{{ url('/Edit/'.$value->id) }}' class='btn btn-primary m-r-1em'>Edit</a>
                </td>

            </tr>

      @endforeach

            <!-- end table -->
        </table>

    </div>
    <!-- end .container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Latest compiled and minified Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- confirm delete record will be here -->

</body>

</html>