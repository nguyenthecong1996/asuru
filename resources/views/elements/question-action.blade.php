@if(isset( $url_edit ))
    <a href="{{ $url_edit }}" class="btn btn-info waves-effect waves-light btn-sm btn-edit js-edit mr-xl-1" data-id = {{@$id}} data-target="#editCategory" style="{{isset($disable) && $disable != '' ? 'pointer-events: none' : ''}}"><i class="fas fa-edit"></i></a>
@endif
@if(isset( $url_toggle ))
    <a href="javascript:void(1)" class="btn btn-success waves-effect waves-light btn-sm js-toggle" data-toggle ={{$data['is_toggle']}} data-url="{{ $url_toggle }}" style="{{isset($disable) && $disable != '' ? 'pointer-events: none' : ''}}"><i class="fas {{$data['is_toggle'] == 1 ? 'fa-eye' : 'fa-eye-slash' }} btn-toggle"></i></a>
@endif
@if(isset( $url_destroy ))
    <a href="javascript:void(1)" class="btn btn-danger waves-effect waves-light btn-sm btn-delete js-delete" data-url="{{ $url_destroy }}" style="{{isset($disable) && $disable != '' ? 'pointer-events: none' : ''}}"><i class="fas fa-trash-alt btn-delete"></i></a>
@endif
