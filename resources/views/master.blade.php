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

        <div class="alert alert-success hide" role="alert" id="notify">
        </div>
    <form id="new-product">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Product Name" required>
        </div>
        <div class="form-group">
            <label for="stock">Product Stock</label>
            <input type="number" min="0" class="form-control" id="stock" placeholder="Product Stock" required>
        </div>
        <div class="form-group">
                <label for="price">Product Price</label>
                <input type="text" min="0" class="form-control" id="price" placeholder="Product Price" required>
            </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <table class="table table-bordered" id="products-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
        
        </div>

    <div class="modal" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="edit-form">
            <div class="modal-body">
                <div class="form-group">
                    <label for="name-edit">Product Name</label>
                    <input type="text" class="form-control" id="name-edit" placeholder="Enter Product Name" required>
                    <input type="hidden" class="form-control" id="id-edit">
                </div>
                <div class="form-group">
                    <label for="stock-edit">Product Stock</label>
                    <input type="number" min="0" class="form-control" id="stock-edit" placeholder="Product Stock" required>
                    <label for="price-edit">Product Price</label>
                    <input type="text" min="0" class="form-control" id="price-edit" placeholder="Product Price" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    @yield('scripts')

    <script>
    $( document ).ready(function() {
        
    var table =  $('#products-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('datatables.data') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'stock', name: 'stock' },
                { data: 'price', name: 'price' },
                { data: 'total_price', name: 'total_price', searchable: false },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
        $('#new-product').on('submit',function(event){
            event.preventDefault();
            var name = $('#name').val();
            var price = $('#price').val();
            var stock = $('#stock').val();
            axios.post('{{route('products.store')}}', {
                name,
                price,
                stock,
            })
            .then(function (response) {
                emptyForm();
                updateTable(response.data);
                var msg = response.data.name + ' Added!.';
                notify(msg)
            })
            .catch(function (error) {
                console.log(error);
            });
        })

        function emptyForm(){
            $('#name').val('');
            $('#price').val('');
            $('#stock').val(1);
        }

        $('#edit-form').on('submit',function(event){
            event.preventDefault();
            var name = $('#name-edit').val();
            var price = $('#price-edit').val();
            var stock = $('#stock-edit').val();
            var id = $('#id-edit').val();

            axios.put('/products/' + id, {
                name,
                price,
                stock,
            })
            .then(function (response) {
                updateTable(response.data);
                var msg = response.data.name + ' edited!.';
                notify(msg)
            })
            .catch(function (error) {
                console.log(error);
            });
            $('#edit-modal').modal('toggle');

        })
        function updateTable(data){
            $(table).text(data);
            table.draw(false);
        }

        $('#products-table').click(function(event){
            let element = $(event.target);
            if( !element.hasClass('edit-modal-link') ) return
            var name = element.data('name');
            var price = element.data('price');
            var stock = element.data('stock');
            var id = element.data('id')

            $('#id-edit').val(id);
            $('#name-edit').val(name);
            $('#price-edit').val(price);
            $('#stock-edit').val(stock);
            $('#edit-modal').modal()
         });

         function notify(msg){
            $('#notify').text(msg).slideToggle(100).delay(1000).slideToggle(100);
         }

    });
    </script>
    </body>
</html>
