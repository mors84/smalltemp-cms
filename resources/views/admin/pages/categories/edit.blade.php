@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Edit --}}
    <div class="wrapper wrapper-content animated fadeInRight">

        {{-- Edit Category --}}
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{trans('admin.editCategory')}}</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form action="{{action('CategoryController@update', $category->id)}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">

                                    {{-- Category Name --}}
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : null}}">
                                        <label for="name" class="col-lg-4 control-label">{{trans('tables.name')}}&nbsp;*</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="name" value="{{$category->name}}" required class="form-control">
                                            <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : null}}</span>
                                        </div>
                                    </div>

                                    {{-- Extra fields --}}
                                    <div class="panel-group m-t-xl m-b-lg" id="accordion">

                                        {{-- Metadata --}}
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">{{trans('tables.metadata')}}</a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse {{$errors->has('metadata_title') || $errors->has('metadata_keywords') || $errors->has('metadata_description') ? 'in' : null}}">
                                                <div class="panel-body">
                                                    <p class="m-b-xl">{{trans('admin.metadataInfo')}}</p>

                                                    {{-- Metadata Title --}}
                                                    <div class="form-group {{$errors->has('metadata_title') ? 'has-error' : null}}">
                                                        <label for="metadata_title" class="col-sm-4 control-label">{{trans('tables.metaTagTitle')}}</label>

                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" name="metadata_title" value="{{$category->metadata ? old('metadata_title', $category->metadata->title) : old('metadata_title')}}" class="form-control">
                                                                <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.metaTagTitleInfo')}}"><i class="fa fa-question-circle"></i></span>
                                                            </div>
                                                            <span class="text-danger">{{$errors->has('metadata_title') ? $errors->first('metadata_title') : null}}</span>
                                                        </div>
                                                    </div>

                                                    {{-- Metadata Keywords --}}
                                                    <div class="form-group {{$errors->has('metadata_keywords') ? 'has-error' : null}}">
                                                        <label for="metadata_keywords" class="col-sm-4 control-label">{{trans('tables.metaTagKeywords')}}</label>

                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" name="metadata_keywords" value="{{$category->metadata ? old('metadata_keywords', $category->metadata->keywords) : old('metadata_keywords')}}" class="form-control">
                                                                <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.metaTagKeywordsInfo')}}"><i class="fa fa-question-circle"></i></span>
                                                            </div>
                                                            <span class="text-danger">{{$errors->has('metadata_keywords') ? $errors->first('metadata_keywords') : null}}</span>
                                                        </div>
                                                    </div>

                                                    {{-- Metadata Description --}}
                                                    <div class="form-group {{$errors->has('metadata_description') ? 'has-error' : null}}">
                                                        <label for="metadata_description" class="col-sm-4 control-label">{{trans('tables.metaTagDescription')}}</label>

                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <textarea name="metadata_description" rows="5" cols="80" class="form-control">{{$category->metadata ? old('metadata_description', $category->metadata->description) : old('metadata_description')}}</textarea>
                                                                <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.metaTagDescriptionInfo')}}"><i class="fa fa-question-circle"></i></span>
                                                            </div>
                                                            <span class="text-danger">{{$errors->has('metadata_description') ? $errors->first('metadata_description') : null}}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        {{-- Add Photo --}}
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">{{trans('admin.addPhoto')}}</a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse {{$errors->has('alt_attribute') || $errors->has('title_attribute') || $errors->has('photo_id') ? 'in' : null}}">
                                                <div class="panel-body">
                                                    <p class="m-b-xl">{{trans('admin.addPostPhotoInfo')}}</p>

                                                    {{-- Add Photo ALT attribute --}}
                                                    <div class="form-group {{$errors->has('alt_attribute') ? 'has-error' : null}}">
                                                        <label for="alt_attribute" class="col-sm-3 control-label">{{trans('tables.alt_attribute')}}</label>

                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input type="text" name="alt_attribute" value="{{$category->photo ? old('alt_attribute', $category->photo->alt) : old('alt_attribute')}}" class="form-control">
                                                                <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.altAttributeInputInfo')}}"><i class="fa fa-question-circle"></i></span>
                                                            </div>
                                                            <span class="text-danger">{{$errors->has('alt_attribute') ? $errors->first('alt_attribute') : null}}</span>
                                                        </div>
                                                    </div>

                                                    {{-- Add Photo TITLE attribute --}}
                                                    <div class="form-group {{$errors->has('title_attribute') ? 'has-error' : null}}">
                                                        <label for="title_attribute" class="col-sm-3 control-label">{{trans('tables.title_attribute')}}</label>

                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input type="text" name="title_attribute" value="{{$category->photo ? old('title_attribute', $category->photo->title) : old('title_attribute')}}" class="form-control">
                                                                <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.titleAttributeInputInfo')}}"><i class="fa fa-question-circle"></i></span>
                                                            </div>
                                                            <span class="text-danger">{{$errors->has('title_attribute') ? $errors->first('title_attribute') : null}}</span>
                                                        </div>
                                                    </div>

                                                    {{-- Select Photo --}}
                                                    <div class="form-group m-b-xl {{$errors->has('photo_id') ? 'has-error' : null}}">

                                                        <div class="col-sm-9 col-sm-offset-3">
                                                            <input type="file" name="photo_id" accept="image/*">
                                                            <span class="text-danger">{{$errors->has('photo_id') ? $errors->first('photo_id') : null}}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Edit Button --}}
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="pull-right">
                                                <button class="btn btn-w-m btn-primary" type="submit"><i class="fa fa-pencil m-r-sm"></i>{{trans('admin.edit')}}</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Delete Button --}}
        <div class="row m-t-xl m-b-md">
            <div class="pull-right">
                <form action="{{action('CategoryController@destroy', $category->id)}}" method="POST" class="btn-group">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger dim btn-large-dim" type="submit"><i class="fa fa-trash-o m-r-xs"></i></button>
                </form>
            </div>
        </div>

    </div>

@endsection
