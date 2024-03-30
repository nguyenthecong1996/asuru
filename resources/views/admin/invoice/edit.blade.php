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
                <form action="{{ route('customers.invoice.update', [$customer->id, $invoice->id]) }}" class="base-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row add_select_product">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h6>
                                Name <span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="name" name="name" value="{{old('name', $invoice->name)}}">
                                <p class="help text-danger">{{ $errors->first('name') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                Car Number <span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="car_number" name="car_number" value="{{old('car_number', $invoice->car_number)}}">
                                <p class="help text-danger">{{ $errors->first('car_number') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h6>
                                Date <span class="text-danger">*</span>
                                </h6>
                                <input type="date" class="form-control" min={{now()}} placeholder="date" name="date" value="{{old('date', $invoice->date)}}">
                                <p class="help text-danger">{{ $errors->first('date') }}</p>
                            </div>
                        </div>
                        <div class="col-md-12" id="import_or_export_id">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status"  value="0" {{ $invoice->status == 0 ? 'checked' : '' }}>Export
                                </label>
                            </div>  
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="1" {{ $invoice->status == 1 ? 'checked' : '' }}>Import
                                </label>
                            </div>
                        </div>
    
                        <div class="col-md-6 mt-3" id="button_product">
                            <Button type="button" id="add_product" class="btn btn-warning">Add Product</Button>
                        </div>

                        @foreach($invoice->stores as $key => $item)
                            <div class="col-md-12 mt-3 row row_${counter}">
                                <input type="hidden" name="weight_different_hidden[]" value="{{ $item->pivot->weight_different }}">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="sel1">Select list:</label>
                                        <select class="form-control add_select_product_select" name="array_product[]" id="sel{{$key}}">
                                            @foreach($listStores as $item1)
                                                @if( $item->id == $item1['id'])
                                                    <option value="{{$item['id']}}"  data-id="{{$item['id']}}" selected>{{$item['name']}}</option>
                                                @else
                                                    <option value="{{$item1['id']}}" data-id="{{$item1['id']}}">{{$item1['name']}}</option>
                                                @endif
                                            @endforeach                   
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h6 style="margin-bottom: 0.75rem;">
                                        Before weight <span class="text-danger">*</span>
                                        </h6>
                                        <input type="number" id="before_weight{{$key}}" class="form-control before_weight" min=0 placeholder="before weight" name="before_weight" value="{{old('weight', $item->weight)}}"  step=any disabled>
                                        <p class="help text-danger">{{ $errors->first('quantity') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h6 style="margin-bottom: 0.75rem;">
                                        After weight <span class="text-danger">*</span>
                                        </h6>
                                        <input type="number" id="after_weight{{$key}}" class="form-control after_weight" min=0 placeholder="after weight" name="after_weight" value="{{old('weight', $item->weight -  $item->pivot->weight_different)}}" step=any>
                                        <p class="help text-danger">{{ $errors->first('quantity') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h6 style="margin-bottom: 0.75rem;">
                                        Quantity <span class="text-danger">*</span>
                                        </h6>
                                        <input type="number" id="quantity_input{{$key}}" class="form-control quantity_input" min=0 placeholder="Quantity" name="quantity[]" value="{{ old('quantity', $item->pivot->quantity) }}">
                                        <p class="help text-danger">{{ $errors->first('quantity') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <h6 style="margin-bottom: 0.75rem;">
                                        Price <span class="text-danger">*</span>
                                        </h6>
                                        <input type="number" name="price" class="form-control" placeholder="0" disabled value="{{ old('price',  $item->price*$item->pivot->quantity) }}">
                                        <p class="help text-danger">{{ $errors->first('price') }}</p>
                                    </div>
                                </div>
                                    <div style="margin-top:30px; margin-inline: auto;"> 
                                        <button type="button" class="btn btn-danger remove_product">Delete</button>
                                    </div>
                            </div>
                        @endforeach

                        <div class="col-md-12 row mt-2" id="button_submit">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="mt-3 mr-4"><a class="btn btn-secondary w-100 btn-cancel"  href="{{ route('customers.show', $customer->id) }}">Cancel</a></div>
                                <div class="mt-3"><button type="submit" class="btn btn-success">Save</button></div>
                            </div>
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
    var customer = <?php echo json_encode($customer); ?>;
    $(document).ready(function () {
        var counter = 0;
        var arrayProductSelected = [];
        $('body').on('click', '#add_product', function() {
            counter++;
            var selectOptions = `<div class="col-md-12 mt-3 row row_${counter}">
                            <input type="hidden" name="weight_different_hidden[]">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="sel1">Select list:</label>
                                    <select class="form-control add_select_product_select" name="array_product[]" id="sel${counter}">
                                        <option value="0">--Select--</option>`;
                                        for (var i in customer.stores) {
                                            console.log(arrayProductSelected, customer.stores[i].id)
                                            if(arrayProductSelected.includes(customer.stores[i].id)) {
                                                selectOptions += '<option value="' + customer.stores[i].id + '" disabled data-id="'+ customer.stores[i].id +'">' + customer.stores[i].name + '</option>';                            
                                            } else {
                                                selectOptions += '<option value="' + customer.stores[i].id + '">' + customer.stores[i].name + '</option>';     
                                            }
                                        }
                                        selectOptions += `</select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6 style="margin-bottom: 0.75rem;">
                                    Before weight <span class="text-danger">*</span>
                                    </h6>
                                    <input type="number" id="before_weight${counter}"" class="form-control before_weight" min=0 placeholder="before weight" name="before_weight" value="{{ old('before_weight') }}"  step=any disabled>
                                    <p class="help text-danger">{{ $errors->first('quantity') }}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6 style="margin-bottom: 0.75rem;">
                                    After weight <span class="text-danger">*</span>
                                    </h6>
                                    <input type="number" id="after_weight${counter}"" class="form-control after_weight" min=0 placeholder="after weight" name="after_weight" value="{{ old('after_weight') }}" step=any>
                                    <p class="help text-danger">{{ $errors->first('quantity') }}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6 style="margin-bottom: 0.75rem;">
                                    Quantity <span class="text-danger">*</span>
                                    </h6>
                                    <input type="number" id="quantity_input${counter}"" class="form-control quantity_input" min=0 placeholder="Quantity" name="quantity[]" value="{{ old('quantity') }}">
                                    <p class="help text-danger">{{ $errors->first('quantity') }}</p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <h6 style="margin-bottom: 0.75rem;">
                                    Price <span class="text-danger">*</span>
                                    </h6>
                                    <input type="number" name="price" class="form-control" placeholder="0" disabled>
                                    <p class="help text-danger">{{ $errors->first('price') }}</p>
                                </div>
                            </div>
                                <div style="margin-top:30px; margin-inline: auto;"> 
                                    <button type="button" class="btn btn-danger remove_product">Delete</button>
                                </div>
                        </div>`
            $("#button_submit").before(selectOptions);
        })  

        $('body').on('change', '.add_select_product_select', function() {
            var id = $(this).val();
            var price = 0;
            var beforeWeight = 0;
            customer.stores.forEach(function(item) {
                if(item.id == id) {
                    price = item.price
                    beforeWeight = item.weight
                }
            });

            arrayProductSelected.push(parseInt(id))
            $(this).closest('.row').find('input[name="price"]').val(price);
            $(this).closest('.row').find('input[name="before_weight"]').val(beforeWeight);
            $(this).closest('.row').find('input[name="quantity[]"]').val(1);
        });

         // Event listener for quantity change
         $('body').on('input', '.quantity_input', function() {
            var price = 0;

            var id =  $(this).closest('.row').find('.add_select_product_select').val();
            customer.stores.forEach(function(item) {
                if(id == item.id) {
                    price = item.price
                }
            });

            var quantity = $(this).val();
            var totalPrice = quantity * price;
            $(this).closest('.row').find('input[name="price"]').val(totalPrice);
        });

        $('body').on('input', '.after_weight', function() {
            var weightDifferent = 0;
            var afterWeight = $(this).val();
            var id =  $(this).closest('.row').find('.add_select_product_select').val();
            customer.stores.forEach(function(item) {
                if(id == item.id) {
                    weightDifferent = item.weight - afterWeight
                }
            });
            $(this).closest('.row').find('input[name="weight_different_hidden[]"]').val(weightDifferent);
        });

        $('body').on('click', '.remove_product', function() {
            var elementSelected =  $(this).closest('.row')
            var id = elementSelected.find('.add_select_product_select').val();

            arrayProductSelected = arrayProductSelected.filter(number => number == parseInt(id));
            elementSelected.remove();
         });
    })
</script>
@endsection
