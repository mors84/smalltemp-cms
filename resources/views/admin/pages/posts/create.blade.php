@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Create --}}
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">

                {{-- Create Post --}}
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{trans('admin.addPost')}}</h5>
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
                        <form action="{{action('PostController@store')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-lg-10 col-lg-offset-1">

                                    {{-- Title --}}
                                    <div class="form-group {{$errors->has('title') ? 'has-error' : null}}">
                                        <label for="title" class="col-sm-4 control-label">{{trans('tables.title')}}&nbsp;*</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="title" value="{{old('title')}}" autofocus required id="title" class="form-control">
                                            <span class="text-danger">{{$errors->has('title') ? $errors->first('title') : null}}</span>
                                        </div>
                                    </div>

                                    {{-- Change Slug --}}
                                    <div class="text-right m-b-lg">
                                        <a class="text-right" role="button" data-toggle="collapse" href="#showChangeSlugField" aria-expanded="false" aria-controls="showChangeSlugField">
                                            <i class="fa fa-pencil m-r-xs"></i>
                                            {{trans('admin.changeTheSlug')}}
                                        </a>
                                    </div>
                                    <div class="collapse {{$errors->has('slug') ? 'in' : null}}" id="showChangeSlugField">
                                        <div id="pwd-container" class="m-b-xl">

                                            {{-- Slug --}}
                                            <div class="form-group {{$errors->has('slug') ? 'has-error' : null}}">
                                                <label for="slug" class="col-sm-4 control-label">{{trans('tables.slug')}}</label>

                                                <div class="col-sm-8">
                                                    <input type="text" name="slug" value="{{old('slug')}}" id="slug" class="form-control">
                                                    <span class="text-danger">{{$errors->has('slug') ? $errors->first('slug') : null}}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- Category --}}
                                    <div class="form-group {{$errors->has('category_id') ? 'has-error' : null}}">
                                        <label for="category_id" class="col-sm-4 control-label">{{trans('tables.category')}}</label>

                                        <div class="col-sm-8">
                                            <select name="category_id" class="form-control chosen-select" tabindex="2">
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : null}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->has('category_id') ? $errors->first('category_id') : null}}</span>
                                        </div>
                                    </div>

                                    {{-- Tags --}}
                                    <div class="form-group {{$errors->has('tags') ? 'has-error' : null}}">
                                        <label for="tags" class="col-sm-4 control-label">{{trans('tables.tags')}}</label>

                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <select name="tags[]" data-placeholder="&nbsp;&nbsp;{{trans('admin.selectTags')}}..." id="select-list" class="form-control chosen-select" multiple tabindex="4">
                                                    @foreach ($tags as $i => $tag)
                                                        <option name="tags[]" value="{{$tag->id}}" {{old('tags.'.$i) ? 'selected' : null}}>{{$tag->name}}</option>
                                                    @endforeach
                                                </select>

                                                {{-- Create new --}}
                                                <span class="input-group-btn"><button type="button" name="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddTag">{{trans('admin.createNew')}}</button></span>

                                            </div>
                                            <span class="text-danger">{{$errors->has('tags') ? $errors->first('tags') : null}}</span>
                                        </div>
                                    </div>

                                    {{-- Is Active --}}
                                    <div class="form-group m-b-xl {{$errors->has('is_active') ? 'has-error' : null}}">
                                        <label for="is_active" class="col-sm-4 control-label">{{trans('tables.is_active')}}</label>

                                        <div class="col-sm-8">
                                            <div class="switch form-control-static">
                                                <div class="onoffswitch">
                                                    <input type="checkbox" name="is_active" value="1" {{old('is_active') ? 'checked' : null}} class="onoffswitch-checkbox" id="is_active">
                                                    <label class="onoffswitch-label" for="is_active">
                                                        <span class="onoffswitch-inner"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <span class="text-danger">{{$errors->has('is_active') ? $errors->first('is_active') : null}}</span>
                                        </div>
                                    </div>

                                    {{-- Extra fields --}}
                                    <div class="panel-group m-b-xl" id="accordion">

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
                                                                <input type="text" name="metadata_title" value="{{old('metadata_title')}}" class="form-control">
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
                                                                <input type="text" name="metadata_keywords" value="{{old('metadata_keywords')}}" class="form-control">
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
                                                                <textarea name="metadata_description" rows="5" cols="80" class="form-control">{{old('metadata_description')}}</textarea>
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
                                                                <input type="text" name="alt_attribute" value="{{old('alt_attribute')}}" class="form-control">
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
                                                                <input type="text" name="title_attribute" value="{{old('title_attribute')}}" class="form-control">
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

                                    {{-- Content field --}}
                                    <div class="well well-sm">
                                        <div class="form-group {{$errors->has('content') ? 'has-error' : null}}">
                                            <div class="col-lg-12 m-b-xl">
                                                <label for="content">{{trans('admin.content')}}</label>

                                                <textarea name="content" rows="8" cols="80" id="summernote" class="form-control">{{old('content')}}</textarea>
                                                <span class="text-danger">{{$errors->has('content') ? $errors->first('content') : null}}</span>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Add Button --}}
                                    <div class="form-group">
                                        <div class="pull-right m-md">
                                            <button class="btn btn-w-m btn-lg btn-primary" type="submit"><i class="fa fa-plus m-r-md"></i>{{trans('admin.addPost')}}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('admin.includes.modalAddTag')

@endsection
@section('scripts')

    <script type="text/javascript">
        var url = '{{route('tags.ajaxStore')}}';
    </script>

@endsection
