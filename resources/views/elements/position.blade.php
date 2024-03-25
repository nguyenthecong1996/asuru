@if($lastItem->id == $model->id)
<button class="btn move-up-hidden" disabled><i class="mdi mdi-arrow-down-bold"></i></button>
@else
<button class="btn btn-position move-down" data-id="{{ $model->id }}" data-href="#"><i class="mdi mdi-arrow-down-bold"></i></button>
@endif

@if($firstItem->id == $model->id)
<button class="btn move-up-hidden" disabled><i class="mdi mdi-arrow-up-bold "></i></button>
@else
<button class="btn btn-position move-up " data-id="{{ $model->id }}" data-href="#"><i class="mdi mdi-arrow-up-bold "></i></button>
@endif