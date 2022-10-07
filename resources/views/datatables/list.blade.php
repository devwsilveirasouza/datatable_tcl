<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Scripts DataTable CDN --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">

    <script src="http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

    <title>Datatable with filter</title>
</head>

<body>

    <div class="container">
        <h2 class="text-center">Laravel DataTable</h2>
        <div class="table-responsive">
            <table id="posts-table" class="table table-bordered">
                <thead></thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script>
        $( function() {
            $('#posts-table').DataTable({
                "oLanguage" : {
                    "sProcessing" : "<span>Please wait...</span>"
                },
                "pagingType" : "simple_numbers",
                "paging" : true,
                "lengthMenu" : [
                    [ 10, 25, 50 ],
                    [ 10, 25, 50 ]
                ],
                "processing" : true,
                "serverSide" : true,
                "ordering" : false,
                "ajax" : {
                    "type" : "GET",
                    "url" : "{{ url('datatables/posts') }}",
                    "data" : function(d){

                    },
                    "dataFilter" : function( data ){
                        var json = jQuery.parseJSON( data );
                        json.draw =  json.draw;
                        json.recordsFiltered = json.total;
                        json.recordsTotal = json.total;
                        json.data = json.data;

                        return JSON.stringify( json );
                    }
                },
                /* Colunas do datatable */
                "columns" : [
                    /* Header -      DB data -         Visible config */
                    { "title" : "#", "data" : "sl_no", "name" : "sl_no", "visible" : true, "searchable" : true },
                    { "title" : "Title", "data" : "title", "name" : "title", "visible" : true, "searchable" : true },
                    { "title" : "Slug", "data" : "slug", "name" : "slug", "visible" : true, "searchable" : true },
                    { "title" : "Description", "data" : "description", "name" : "description", "visible" : true, "searchable" : true },
                ]
            });
        });
    </script>

</body>

</html>
