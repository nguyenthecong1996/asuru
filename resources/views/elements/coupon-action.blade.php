@if(isset( $url_edit ))
    <a href="{{ $url_edit }}" class="btn btn-info waves-effect waves-light btn-sm btn-edit js-edit mr-xl-1" data-id = {{@$id}} data-target="#editCategory" style="{{isset($disable) && $disable != '' ? 'pointer-events: none' : ''}}"><i class="fas fa-edit"></i></a>
@endif
@if(isset( $url_destroy ))
    <a href="javascript:void(1)" class="btn btn-danger waves-effect waves-light btn-sm btn-delete js-delete" data-url="{{ $url_destroy }}" style="{{isset($disable) && $disable != '' ? 'pointer-events: none' : ''}}"><i class="fas fa-trash-alt btn-delete"></i></a>
@endif

@if(isset( $url_detail ))
    <a href="{{$url_detail}}" class="btn btn-primary waves-effect waves-light btn-sm btn-detail js-detail" data-url="{{ $url_detail }}" style="{{isset($disable) && $disable != '' ? 'pointer-events: none' : ''}}"><i class="fas fa-eye"></i></a>
@endif