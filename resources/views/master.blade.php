<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
        <title>Laravel</title>

        <!-- Fonts -->

        <!-- Styles -->
        <style>
        </style>
    </head>
    <body>
        <div id="app" class="container mt-5">

    <form id="new-product">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Product Name" required>
        </div>
        <div class="form-group">
            <label for="Stock">Product Stock</label>
            <input type="number" min="0" class="form-control" id="Stock" placeholder="Product Stock" required>
        </div>
        <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" min="0" class="form-control" id="price" placeholder="Product Price" required>
            </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
        @yield('content')
        
        </div>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    @yield('scripts')
    <script>
    $( document ).ready(function() {
     
        $('#new-product').on('submit',function(event){
            event.preventDefault();
            var name = $('#name').val();
            var price = $('#price').val();
            var stock = $('#stock').val();
            event
            axios.post('{{route('products.store')}}', {
                name,
                price,
                stock,
            })
            .then(function (response) {
                emptyForm();
            })
            .catch(function (error) {
                console.log(error);
            });
        })

        function emptyForm(){
            $('#name').val('');
            $('#price').val('');
            $('#stock').val('');
        }
    });
    </script>
    </body>
</html>
