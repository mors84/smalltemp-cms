@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Tags --}}
    <div class="wrapper wrapper-content">
        <div class="row">

            {{-- Add Tag and Statistics --}}
            <div class="col-lg-5 animated fadeInLeft">

                {{-- Statistics --}}
                <div class="col-sm-7 col-sm-offset-5 m-b-md">
                    <div class="widget style1">
                        <div class="row">
                            <div class="col-xs-5 text-center">
                                <i class="fa fa-tags fa-5x"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                                <span>{{trans('admin.allTags')}}</span>
                                <h2 class="font-bold">{{$tags->total()}}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Add Tag --}}
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{trans('admin.addTag')}}</h5>
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
                        <form action="{{action('TagController@store')}}" method="POST" accept-charset="UTF-8" class="form-horizontal">
                            {{csrf_field()}}

                            {{-- Tag Name --}}
                            <div class="form-group {{$errors->has('name') ? 'has-error' : null}}">
                                <label for="name" class="col-sm-4 control-label">{{trans('tables.name')}}&nbsp;*</label>

                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input type="text" name="name" value="{{old('name')}}" autofocus required class="form-control">
                                        <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.tagInfo')}}"><i class="fa fa-question-circle"></i></span>
                                    </div>
                                    <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : null}}</span>
                                </div>
                            </div>

                            {{-- Metadata --}}
                            <fieldset>
                                <legend>{{trans('tables.metadata')}}</legend>
                                <p class="m-b-lg">{{trans('admin.metadataInfo')}}</p>

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

                            </fieldset>

                            {{-- Add Button --}}
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                    <button class="btn btn-w-m btn-primary" type="submit"><i class="fa fa-plus m-r-xs"></i>{{trans('admin.add')}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>

            {{-- Table --}}
            <div class="col-lg-7 animated fadeInRight">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{trans('admin.tags')}}</h5>
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
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{trans('tables.id')}}</th>
                                        <th class="col-xs-3">{{trans('tables.name')}}</th>
                                        <th>{{trans('tables.description')}}</th>
                                        <th>{{trans('tables.keywords')}}</th>
                                        <th class="text-right">{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td>

                                                {{-- ID --}}
                                                {{$tag->id or null}}

                                            </td>
                                            <td>

                                                {{-- Name --}}
                                                <a href="{{route('tags.edit', $tag->id)}}">{{$tag->name or null}}</a>

                                            </td>
                                            <td>

                                                {{-- Metadata Description --}}
                                                {{isset($tag->metadata->description) ? str_limit($tag->metadata->description, 50) : null}}

                                            </td>
                                            <td>

                                                {{-- Metadata Keywords --}}
                                                {{isset($tag->metadata->keywords) ? str_limit($tag->metadata->keywords, 20) : null}}

                                            </td>
                                            <td class="text-right">

                                                {{-- Action --}}
                                                <div class="btn-group">

                                                    {{-- Edit button --}}
                                                    <a href="{{route('tags.edit', $tag->id)}}" class="btn-white btn btn-xs">{{trans('admin.edit')}}</a>

                                                    {{-- Delete button --}}
                                                    <form action="{{action('TagController@destroy', $tag->id)}}" method="POST" class="btn-group">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <input type="submit" name="submit" value="{{trans('admin.delete')}}" class="btn-white btn btn-xs">
                                                    </form>

                                                </div>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">

                                            {{-- Pagination --}}
                                            {{$tags->links('admin.includes.pagination')}}

                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@section('scripts')

    {{-- Notification status --}}
    @include('admin.includes.notificationStatus');

@endsection
