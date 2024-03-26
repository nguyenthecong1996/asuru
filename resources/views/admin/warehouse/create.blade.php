@extends('layouts.app')
@section('title', trans('common.news.add_new'))
@section('breadcrumb')
    <div class="page-title">
        <h3>Add Customer</h3>
        {{ Breadcrumbs::render('create-customer') }}
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <form action="{{ route('customers.warehouse.store', $customerId) }}" class="base-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h6>
                                Product Name <span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="product name" name="name" value="{{ old('name') }}">
                                <p class="help text-danger">{{ $errors->first('name') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                 Quantity<span class="text-danger">*</span>
                                </h6>
                                <input type="number" class="form-control" placeholder="Quantity" name="quantity" value="{{ old('quantity') }}" min="0">
                                <p class="help text-danger">{{ $errors->first('quantity') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                Price <span class="text-danger">*</span>
                                </h6>
                                <input type="number" class="form-control" placeholder="Price" name="price" value="{{ old('price') }}" min="0">
                                <p class="help text-danger">{{ $errors->first('price') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="mt-3 mr-4"><a class="btn btn-secondary w-100 btn-cancel" href="{{ route('customers.index') }}">Cancel</a></div>
                            <div class="mt-3"><button type="submit" class="btn btn-success">Save</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection




