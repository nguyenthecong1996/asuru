@extends('layouts.app')
@section('title', trans('common.news.edit_new'))
@section('breadcrumb')
    <div class="page-title">
        <h3>{{trans('common.news.title')}}</h3>
        {{ Breadcrumbs::render('edit-new', $new->id) }}
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-top">
                <form action="{{ route('news.update', [$new->id]) }}" method="post" id="insert_data" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h6>
                                {{trans('common.news.save.title')}} <span class="text-danger">*</span>
                                </h6>
                                <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title', $new->title)}}">
                                <p class="help text-danger">{{ $errors->first('title') }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h6>
                                {{trans('common.news.save.content')}} <span class="text-danger">*</span>
                                </h6>
                                <textarea name="content" id="content" class="form-group" cols="137.5" rows="5">{{old('content', $new->content)}}</textarea>
                                <p class="help text-danger">{{ $errors->first('Content') }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('common.news.save.image')}} <strong  class="text-danger">*</strong> (An image< 5MB)</label>
                                <div class="preview-img">
                                    <img src="{{ asset('storage/' . $new->image_url) }}" alt="">
                                        
                                </div>
                                <button type="button" class="btn btn-upload btn-light d-block">Choose image</button>
                                <input type="file" name="image_url" id="image_url" class="form-control d-none">
                                @error('image_url')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="mt-3 mr-4"><a class="btn btn-secondary w-100 btn-cancel" href="{{ route('news.index') }}">{{trans('common.events.save.cancel')}}</a></div>
                            <div class="mt-3"><button type="submit" class="btn btn-success">{{trans('common.events.save.button')}}</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('ckeditor/ckeditor.js') }}">
    </script>
    <script>
        CKEDITOR.replace('content');

        $('body').on('click', '.btn-upload', function() {
            previewImage($('#image_url'))
        })
    </script>
@endsection
