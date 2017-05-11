@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Edit --}}
    <div class="wrapper wrapper-content animated fadeInRight">

        {{-- Edit Post --}}
        <div class="row">

            {{-- Show Photo and Info --}}
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5><a href="{{route('posts.show', $post->id)}}">{{$post->metadata->title or null}}</a></h5>
                    </div>
                    <div>

                        {{-- Photo Post --}}
                        <div class="ibox-content no-padding border-left-right">
                            @if (isset($post->photo))
                                @if ($post->photo->sizes->count() > 2)
                                    <a href="{{route('photos.edit', $post->photo->id)}}">
                                        <img src="{{$post->photo->sizes[count($post->photo->sizes) - 2]->path}}" title="{{$post->photo->alt or null}} ({{$post->photo->title or null}})" id="fullPhoto" class="img-responsive" data-toggle="tooltip" data-placement="bottom">
                                    </a>
                                @else
                                    <a href="{{route('photos.edit', $post->photo->id)}}">
                                        <img src="{{$post->photo->sizes[0]->path}}" title="{{$post->photo->alt or null}} ({{$post->photo->title or null}})" id="fullPhoto" class="img-responsive" data-toggle="tooltip" data-placement="bottom">
                                    </a>
                                @endif
                            @else
                                <img src="/images/admin/post-default-768.jpg" class="img-responsive">
                            @endif
                        </div>

                        {{-- Info Post --}}
                        <div class="ibox-content profile-content">
                            <h4><strong><a href="{{isset($post->category->id) ? route('categories.edit', $post->category_id) : null}}">{{$post->category->name or null}}</a></strong></h4>
                            <p><i class="fa fa-tags m-r-xs"></i>
                                @foreach ($post->tags as $tag)
                                    <a href="{{route('tags.edit', $tag->id)}}">{{$tag->name or null}}</a>{{!$loop->last ? ', ' : null}}
                                @endforeach
                            </p>
                            <h5>{{trans('admin.content')}}</h5>
                            <p>
                                {!! isset($post->content) ? str_limit($post->content, 200) : null !!}
                                <small><a href="{{route('posts.show', $post->id)}}" class="text-navy">{{trans('admin.readMore')}}<i class="fa fa-long-arrow-right m-l-xs"></i></a></small>
                            </p>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Edit post --}}
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{trans('admin.editPost')}}</h5>
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
                        <form action="{{action('PostController@update', $post->id)}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="row">
                                <div class="col-lg-10 col-lg-offset-1">

                                    {{-- Title --}}
                                    <div class="form-group {{$errors->has('title') ? 'has-error' : null}}">
                                        <label for="title" class="col-sm-4 control-label">{{trans('tables.title')}}&nbsp;*</label>

                                        <div class="col-sm-8">
                                            <input type="text" name="title" value="{{old('title', $post->title)}}" spellcheck="false" required id="title" class="form-control">
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
                                                    <input type="text" name="slug" value="{{old('slug', $post->slug)}}" id="slug" class="form-control">
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
                                                @foreach ($categories as $i => $category)
                                                    <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : $category->id == $post->category_id ? 'selected' : null}}>{{$category->name}}</option>
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
                                                        <option name="tags[]" value="{{$tag->id}}"
                                                            @if (!old('tags.'.$i))
                                                                @foreach ($post->tags as $tag_single)
                                                                    {{$tag_single->id == $tag->id ? 'selected' : null}}
                                                                @endforeach
                                                            @else
                                                                selected
                                                            @endif
                                                        >{{$tag->name}}</option>
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
                                                    <input type="checkbox" name="is_active" value="1" {{old('is_active') ? 'checked' : $post->is_active == 1 ? 'checked' : null}} class="onoffswitch-checkbox" id="is_active">
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
                                                                <input type="text" name="metadata_title" value="{{$post->metadata ? old('metadata_title', $post->metadata->title) : old('metadata_title')}}" class="form-control">
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
                                                                <input type="text" name="metadata_keywords" value="{{$post->metadata ? old('metadata_keywords', $post->metadata->keywords) : old('metadata_keywords')}}" class="form-control">
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
                                                                <textarea name="metadata_description" rows="5" cols="80" class="form-control">{{$post->metadata ? old('metadata_description', $post->metadata->description) : old('metadata_description')}}</textarea>
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
                                                                <input type="text" name="alt_attribute" value="{{$post->photo ? old('alt_attribute', $post->photo->alt) : old('alt_attribute')}}" class="form-control">
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
                                                                <input type="text" name="title_attribute" value="{{$post->photo ? old('title_attribute', $post->photo->title) : old('title_attribute')}}" class="form-control">
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

                                                <textarea name="content" rows="8" cols="80" id="summernote" class="form-control">{{old('content', $post->content)}}</textarea>
                                                <span class="text-danger">{{$errors->has('content') ? $errors->first('content') : null}}</span>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- Edit Button --}}
                                    <div class="form-group">
                                        <div class="pull-right m-md">
                                            <button class="btn btn-w-m btn-lg btn-primary" type="submit"><i class="fa fa-pencil m-r-md"></i>{{trans('admin.editPost')}}</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        {{-- Delete Post --}}
        <div class="row m-t-xl m-b-md">
            <div class="pull-right">
                <form action="{{action('PostController@destroy', $post->id)}}" method="POST" class="btn-group">
                    {{csrf_field()}}
                    {{method_field('DELETE')}}
                    <button class="btn btn-danger dim btn-large-dim" type="submit"><i class="fa fa-trash-o m-r-xs"></i></button>
                </form>
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
