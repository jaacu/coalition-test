@extends('master')

@section('content')
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
            </tr>
        </thead>
    </table>
@endsection

@section('scripts')
<script>

$(fillDataTable);
function fillDataTable() {
    
    $('#products-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('datatables.data') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'stock', name: 'stock' },
            { data: 'price', name: 'price' },
            { data: 'total_price', name: 'total_price' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
        ]
    });
}
</script>
    
@endsection