@extends('layouts.app')
@section('title', 'Invoice Details')
@section('breadcrumb')
    <div class="page-title">
        <h3>Invoice Details</h3>
        {{ Breadcrumbs::render('create-customer') }}
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <h6>
                            Company Name</span>
                            </h6>
                            <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{ $customer->company_name }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h6>
                            Address
                            </h6>
                            <input type="text" class="form-control" placeholder="Address" name="address" value="{{ $customer->address }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h6>
                            Car Number<span class="text-danger">*</span>
                            </h6>
                            <input type="text" class="form-control ajax_update invoice" placeholder="Car number" name="car_number" value="{{ $invoice->car_number }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h6>
                                Company Phone
                            </h6>
                            <input type="text" class="form-control" placeholder="Company Phone" name="company_phone" value="{{ $customer->company_phone }}" disabled>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <h6>
                            Date <span class="text-danger">*</span>
                            </h6>
                            <input type="date" class="form-control" placeholder="here..." name="date" value="{{ $invoice->date }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 25px">
                    <p class="col-md-4 row ml-1 mb-2 text-info  btn-lg">
                        List Products
                    </p>
                    <div class="col-md-12">
                        <div class="table-responsive hide-search-datatable custom-table">
                            <table id="invoice" class="table table-striped table-bordered dt-responsive" style="width:100%">
                                <thead>
                                    <tr style="text-align: center">
                                        <th style="font-weight: bold; width:5px;">No</th>
                                        <th style="font-weight: bold; width:5px;">Name</th>
                                        <th style="font-weight: bold; width:5px;">Before Weight</th>
                                        <th style="font-weight: bold; width:5px;">After Weight</th>
                                        <th style="font-weight: bold; width:5px;">Diff Weight</th>
                                        <th style="font-weight: bold; width:5px;">Price</th>
                                        <th style="font-weight: bold; width:5px;">Total Price</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="mt-3 mr-4"><a class="btn btn-secondary w-100 btn-cancel" href="{{ route('customers.show', $customer->id) }}">Back</a></div>
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
    var invoiceId = <?php echo json_encode($invoice->id); ?>;
    $(document).ready(function () {
        var table = $('#invoice').DataTable({
            "dom": '<"top">rt<"bottom mt-3"<"row justify-content-between m-0"<"col-6"li><"col-6 row justify-content-end"p>>><"clear">',
            processing: true,
            deferRender: true,
            serverSide: true,
            ajax: {
                url: '/customers/' + customerId + '/invoice/getDataDetailInvoice/' +invoiceId
            },
            "columns": [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, width: '5%', className:'text-center align-middle'},
                {data: 'name', name: 'name', className: 'text-center align-middle mw-300',width: '30%', orderable: false},
                {data: 'before_weight', name: 'before_weight', className: 'text-center align-middle mw-300',width: '15%', orderable: false},
                {data: 'after_weight', name: 'after_weight', className: 'text-center align-middle mw-300',width: '15%', orderable: false},
                {data: 'weight_different', name: 'weight_different', className: 'text-center align-middle mw-300',width: '15%', orderable: false},
                {data: 'price', name: 'price', className: 'text-center align-middle mw-300',width: '15%', orderable: false},
                {data: 'total_price', name: 'total_price', className: 'text-center align-middle mw-300',width: '15%', orderable: false},
            ],
            "pageLength": 10,
        });
        
    })    
</script>
    
@endsection




