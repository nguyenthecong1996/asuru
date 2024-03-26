@extends('layouts.app')
@section('title', 'Update Customer')
@section('breadcrumb')
    <div class="page-title">
        <h3>Update Customer</h3>
        {{ Breadcrumbs::render('edit-customer', $customer->id) }}
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <form action="{{ route('customers.update', [$customer->id]) }}" method="post" id="insert_data" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                Company Name <span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="Company Name" name="company_name"  value="{{old('company_name', $customer->company_name)}}">
                                <p class="help text-danger">{{ $errors->first('company_name') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                 Company Phone<span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="Company Phone" name="company_phone" value="{{old('company_phone', $customer->company_phone)}}">
                                <p class="help text-danger">{{ $errors->first('company_phone') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                Customer Name <span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="Customer Name" name="customer_name" value="{{old('customer_name', $customer->customer_name)}}">
                                <p class="help text-danger">{{ $errors->first('customer_name') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                 Customer Phone<span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="Customer Phone" name="customer_phone" value="{{old('customer_phone', $customer->customer_phone)}}">
                                <p class="help text-danger">{{ $errors->first('customer_phone') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                Email <span class="text-danger">*</span>
                                </h6>
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email', $customer->email)}}">
                                <p class="help text-danger">{{ $errors->first('email') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                Post Code<span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="Post Code" name="post_code" value="{{old('post_code', $customer->post_code)}}">
                                <p class="help text-danger">{{ $errors->first('post_code') }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h6>
                                Address<span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="Address" name="address" value="{{old('address', $customer->address)}}">
                                <p class="help text-danger">{{ $errors->first('address') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="mt-3 mr-4"><a class="btn btn-secondary w-100 btn-cancel" href="{{ route('customers.index') }}">Cancel</a></div>
                            <div class="mt-3"><button type="submit" class="btn btn-success">Update</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
    </script>
@endsection
