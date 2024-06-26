@extends('layouts.app')
@section('title', 'Invoice')
@section('breadcrumb')
    <div class="page-title">
        <h3>List Invoice</h3>
        {{ Breadcrumbs::render('create-customer') }}
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <div class="row" style="margin-top: 25px">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4 row justify-content-end mb-2">
                        <a href="{{ route ('customers.invoice.create', $customer->id) }}" class="btn btn-primary">New Invoice
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive hide-search-datatable custom-table">
                            <table id="invoice" class="table table-striped table-bordered dt-responsive" style="width:100%">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="font-weight: bold; width:5px;">No</th>
                                        <th style="font-weight: bold; width:5px;">Name</th>
                                        <th style="font-weight: bold; width:5px;">Total Price</th>
                                        <th style="font-weight: bold; width:5px;">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    var customerId = <?php echo json_encode($customer->id); ?>;
    $(document).ready(function () {
        var table = $('#invoice').DataTable({
            "dom": '<"top">rt<"bottom mt-3"<"row justify-content-between m-0"<"col-6"li><"col-6 row justify-content-end"p>>><"clear">',
            processing: true,
            deferRender: true,
            serverSide: true,
            ajax: {
                url: '/customers/' + customerId + '/invoice/getData',
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', className:'text-center align-middle'},
                {data: 'name', name: 'name', className: 'text-center align-middle mw-300',width: '20%', orderable: false},
                {data: 'total_price', name: 'total_price', className: 'text-center align-middle mw-300',width: '20%', orderable: false},
                {data: 'action', name: 'action', className: 'text-center align-middle minw-table', orderable: false, searchable: false, width: '30%'},
            ],
            "pageLength": 10,
        });
        
    })    

    $('body').on('click', '.btn-delete', function() {
        console.log(121)
        let url = $(this).data('url');
        console.log(url);
        let datatable = $('#customer');
        confirmDelete(url, datatable, "Customer");
    })

    $("p").mouseout(function(){
        $("p").css("background-color", "gray");
    });
</script>
    
@endsection




