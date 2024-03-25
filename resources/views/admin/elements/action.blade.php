
@if (!empty($url_show))
<a href="{{ $url_show }}" class="btn btn-primary waves-effect waves-light btn-sm" title="Chi tiết"><i
    class="fas fa-eye"></i></a>

@endif

@if (!empty($url_edit))
<a href="{{ $url_edit }}" class="btn btn-info waves-effect wave-light btn-sm modeal-show" id="edit_data"
title="Edit {{ $title }}" data-title="{{ $model->title }}" data-id="{{ $model->id }}"
data-slug="{{ $model->slug }}" data-status="{{ $model->status }}" data-image="{{ $model->image }}">
<i class="fas fa-edit"></i>
</a>
@endif

@if(isset( $url_destroy ))
    <a href="javascript:void(1)" class="btn btn-danger waves-effect waves-light btn-sm btn-delete js-delete" data-url="{{ $url_destroy }}" style="{{isset($disable) && $disable != '' ? 'pointer-events: none' : ''}}"><i class="fas fa-trash-alt btn-delete"></i></a>
@endif




