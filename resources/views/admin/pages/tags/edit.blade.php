@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Edit --}}
    <div class="wrapper wrapper-content animated fadeInRight">

        {{-- Edit Tag --}}
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{trans('admin.editTag')}}</h5>
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
                        <form action="{{action('TagController@update', $tag->id)}}" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">

                                    {{-- Category Name --}}
                                    <div class="form-group {{$errors->has('name') ? 'has-error' : null}}">
                                        <label for="name" class="col-sm-4 control-label">{{trans('tables.name')}}&nbsp;*</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="name" value="{{$tag->name}}" required class="form-control">
                                            <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : null}}</span>
                                        </div>
                                    </div>

                                    {{-- Metadata --}}
                                    <fieldset class="m-t-xl m-b-xl">
                                        <legend>{{trans('tables.metadata')}}</legend>
                                        <p class="m-b-xl">{{trans('admin.metadataInfo')}}</p>

                                        {{-- Metadata Title --}}
                                        <div class="form-group {{$errors->has('metadata_title') ? 'has-error' : null}}">
                                            <label for="metadata_title" class="col-sm-4 control-label">{{trans('tables.metaTagTitle')}}&nbsp;*</label>

                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="text" name="metadata_title" value="{{$tag->metadata->title}}" required class="form-control">
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
                                                    <input type="text" name="metadata_keywords" value="{{$tag->metadata->keywords}}" class="form-control">
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
                                                    <textarea name="metadata_description" rows="5" cols="80" class="form-control">{{$tag->metadata->description}}</textarea>
                                                    <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.metaTagDescriptionInfo')}}"><i class="fa fa-question-circle"></i></span>
                                                </div>
                                                <span class="text-danger">{{$errors->has('metadata_description') ? $errors->first('metadata_description') : null}}</span>
                                            </div>
                                        </div>
                                    </fieldset>

                                    {{-- Edit Button --}}
                                    <div class="form-group">
                                        <div class="col-sm-offset-4 col-sm-8">
                                            <button class="btn btn-w-m btn-primary" type="submit"><i class="fa fa-pencil m-r-sm"></i>{{trans('admin.edit')}}</button>
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
                <form action="{{action('TagController@destroy', $tag->id)}}" method="POST" class="btn-group">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger dim btn-large-dim" type="submit"><i class="fa fa-trash-o m-r-xs"></i></button>
                </form>
            </div>
        </div>

    </div>

@endsection
