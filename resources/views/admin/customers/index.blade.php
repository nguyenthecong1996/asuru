@extends('layouts.app')
@section('title', 'Customer')

@section('breadcrumb')
    <div class="page-title">
        <h3>Customers</h3>
    </div>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <div class="row" style="margin-top: 25px">
                    <div class="col-md-4">
                        <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="email" class="form-control search-box" id="Filter_search" aria-describedby="emailHelp"
                            placeholder="Search by title" name="search" >
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route ('customers.create') }}" class="btn btn-primary float-right">Create New
                        </a>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive hide-search-datatable custom-table">
                            <table id="customer" class="table table-striped table-bordered dt-responsive" style="width:100%">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="font-weight: bold; width:5px;">No</th>
                                        <th style="font-weight: bold; width:5px;">Company Name</th>
                                        <th style="font-weight: bold; width:5px;">Address</th>
                                        <th style="font-weight: bold; width:5px;">Company phone</th>
                                        <th style="font-weight: bold; width:5px;">Email</th>
                                        <th style="font-weight: bold; width:5px;">Warehouse</th>
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
    $(document).ready(function () {
        var table = $('#customer').DataTable({
            "dom": '<"top">rt<"bottom mt-3"<"row justify-content-between m-0"<"col-6"li><"col-6 row justify-content-end"p>>><"clear">',
            processing: true,
            deferRender: true,
            serverSide: true,
            ajax: {
                url: "{{ route('customers.getData') }}",
                data: function (d) {
                    d.title = $('#Filter_search').val();
                }

            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', className:'text-center align-middle'},
                {data: 'company_name', name: 'company_name', className: 'text-center align-middle mw-300',width: '15%', orderable: false},
                {data: 'address', name: 'address', className: 'text-center align-middle mw-300',width: '20%', orderable: false},
                {data: 'company_phone', name: 'company_phone', className: 'text-center align-middle mw-300',width: '10%', orderable: false},
                {data: 'email', name: 'email', className: 'text-center align-middle mw-300',width: '20%', orderable: false},
                {data: 'warehouse', name: 'warehouse', className: 'text-center align-middle mw-300',width: '10%', orderable: false},
                {data: 'action', name: 'action', className: 'text-center align-middle minw-table', orderable: false, searchable: false, width: '30%'},
            ],
            "pageLength": 10,
        });
        
        $('body').on('keyup', '#Filter_search', function() {
            table.draw();
        })
        
    })    

    $('body').on('click', '.btn-delete', function() {
        console.log(121)
        let url = $(this).data('url');
        console.log(url);
        let datatable = $('#customer');
        confirmDelete(url, datatable, "Customer");
    })
</script>
    
@endsection

