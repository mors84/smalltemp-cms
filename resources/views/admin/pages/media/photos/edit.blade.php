@extends('admin.layouts.media')
@section('mediaContent')

    {{-- Edit --}}
    <div class="row">

        {{-- Show Photo --}}
        <div class="col-lg-10 col-lg-offset-1">

            {{-- Photo --}}
            <div class="ibox">
                <div class="ibox-content">

                    {{-- Previous and Next Photo --}}
                    <div class="row m-t-sm m-b-md">
                        <div class="col-lg-12">
                            <div class="pull-right">
                                @if (isset($previous))
                                    <a href="{{route('photos.edit', $previous)}}" class="btn btn-primary">{{trans('pagination.previous')}}</a>
                                @endif
                                @if (isset($next))
                                    <a href="{{route('photos.edit', $next)}}" class="btn btn-primary">{{trans('pagination.next')}}</a>
                                @endif
                            </div>

                        </div>
                    </div>

                    {{-- Photo --}}
                    <div class="m-b-xl">
                        @if (isset($photo))
                            @if ($photo->sizes->count() > 3)
                                <img src="{{$photo->sizes[count($photo->sizes) - 3]->path}}" id="fullPhoto" class="img-responsive center-block">
                            @else
                                <img src="{{$photo->sizes[0]->path}}" id="fullPhoto" class="img-responsive center-block">
                            @endif
                        @else
                            <img src="/images/admin/post-default-768.jpg" class="img-responsive center-block">
                        @endif


                    </div>

                </div>
            </div>

            {{-- Photo Info --}}
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">

                        {{-- Attached Files --}}
                        <div class="col-sm-9">
                            <h3>{{trans('admin.attachedFiles')}}</h3>
                            <ul class="list-unstyled file-list">
                                @foreach ($photo->sizes as $size)
                                    <li><i class="fa fa-file-picture-o m-r-xs"></i> {{$size->path or null}}</li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Width of Picture --}}
                        <div class="col-sm-3">
                            <h3>{{trans('admin.widthOfPhotos')}}</h3>
                            <ul class="list-unstyled file-list">
                                @foreach ($photo->sizes as $size)
                                    <li><i class="fa fa-arrows-h m-r-xs"></i> {{$size->width or null}}&nbsp;px</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- Edit Photo --}}
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{trans('admin.editPhoto')}}</h5>
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
                    <form action="{{action('PhotoController@update', $photo->id)}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">

                                {{-- Info About addPhoto --}}
                                <p class="m-b-xl">{{trans('admin.addPhotoInfo')}}</p>

                                {{-- Add Photo ALT attribute --}}
                                <div class="form-group {{$errors->has('alt') ? 'has-error' : null}}">
                                    <label for="alt" class="col-sm-3 control-label">{{trans('tables.alt_attribute')}}</label>

                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="alt" value="{{old('alt', $photo->alt)}}" class="form-control">
                                            <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.altAttributeInputInfo')}}"><i class="fa fa-question-circle"></i></span>
                                        </div>
                                        <span class="text-danger">{{$errors->has('alt') ? $errors->first('alt') : null}}</span>
                                    </div>
                                </div>

                                {{-- Add Photo TITLE attribute --}}
                                <div class="form-group {{$errors->has('title') ? 'has-error' : null}}">
                                    <label for="title" class="col-sm-3 control-label">{{trans('tables.title_attribute')}}</label>

                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="title" value="{{old('title', $photo->title)}}" class="form-control">
                                            <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.titleAttributeInputInfo')}}"><i class="fa fa-question-circle"></i></span>
                                        </div>
                                        <span class="text-danger">{{$errors->has('title') ? $errors->first('title') : null}}</span>
                                    </div>
                                </div>

                                {{-- Tags --}}
                                <div class="form-group m-b-xl {{$errors->has('tags') ? 'has-error' : null}}">
                                    <label for="tags" class="col-sm-3 control-label">{{trans('tables.tags')}}</label>

                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select name="tags[]" data-placeholder="&nbsp;&nbsp;{{trans('admin.selectTags')}}..." id="select-list" class="form-control chosen-select" multiple tabindex="4">
                                                @foreach ($tags as $i => $tag)
                                                    <option name="tags[]" value="{{$tag->id}}"
                                                        @if (!old('tags.'.$i))
                                                            @foreach ($photo->tags as $tag_single)
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

                                {{-- Edit Button --}}
                                <div class="form-group">
                                    <div class="pull-right m-md">
                                        <button class="btn btn-w-m btn-lg btn-primary" type="submit"><i class="fa fa-pencil m-r-md"></i>{{trans('admin.editPhoto')}}</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    @include('admin.includes.modalAddTag')

    {{-- Delete Button --}}
    <div class="row m-t-xl m-b-md">
        <div class="pull-right">
            <form action="{{action('PhotoController@destroy', $photo->id)}}" method="POST" class="btn-group">
                {{csrf_field()}}
                {{method_field('DELETE')}}
                <button class="btn btn-danger dim btn-large-dim" type="submit"><i class="fa fa-trash-o m-r-xs"></i></button>
            </form>
        </div>
    </div>

@endsection
@section('scripts')

    <script type="text/javascript">
        var url = '{{route('tags.ajaxStore')}}';
    </script>

@endsection
