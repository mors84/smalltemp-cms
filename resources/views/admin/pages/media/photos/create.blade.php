@extends('admin.layouts.media')
@section('mediaContent')

    {{-- Add Photo --}}
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{trans('admin.addPhoto')}}</h5>
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
                    <form action="{{action('PhotoController@store')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1">

                                {{-- Info About addPhoto --}}
                                <p class="m-b-xl">{{trans('admin.addPhotoInfo')}}</p>

                                {{-- Add Photo ALT attribute --}}
                                <div class="form-group {{$errors->has('alt') ? 'has-error' : null}}">
                                    <label for="alt" class="col-sm-3 control-label">{{trans('tables.alt_attribute')}}</label>

                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" name="alt" value="{{old('alt')}}" class="form-control">
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
                                            <input type="text" name="title" value="{{old('title')}}" class="form-control">
                                            <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.titleAttributeInputInfo')}}"><i class="fa fa-question-circle"></i></span>
                                        </div>
                                        <span class="text-danger">{{$errors->has('title') ? $errors->first('title') : null}}</span>
                                    </div>
                                </div>

                                {{-- Tags --}}
                                <div class="form-group {{$errors->has('tags') ? 'has-error' : null}}">
                                    <label for="tags" class="col-sm-3 control-label">{{trans('tables.tags')}}</label>

                                    <div class="col-sm-9">
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

                                {{-- Select Photo --}}
                                <div class="form-group m-t-xl m-b-xl {{$errors->has('path') ? 'has-error' : null}}">

                                    <div class="col-sm-9 col-sm-offset-3">
                                        <input type="file" name="path" accept="image/*">
                                        <span class="text-danger">{{$errors->has('path') ? $errors->first('path') : null}}</span>
                                    </div>
                                </div>

                                {{-- Add Button --}}
                                <div class="form-group">
                                    <div class="pull-right m-md">
                                        <button class="btn btn-w-m btn-lg btn-primary" type="submit"><i class="fa fa-plus m-r-md"></i>{{trans('admin.addPhoto')}}</button>
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

@endsection
@section('scripts')

    <script type="text/javascript">
        var url = '{{route('tags.ajaxStore')}}';
    </script>

@endsection
