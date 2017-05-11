@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Categories --}}
    <div class="wrapper wrapper-content">
        <div class="row">

            {{-- Add Category and Statistics --}}
            <div class="col-lg-5 animated fadeInLeft">

                {{-- Statistics --}}
                <div class="col-sm-7 col-sm-offset-5 m-b-md">
                    <div class="widget style1">
                        <div class="row">
                            <div class="col-xs-5 text-center">
                                <i class="fa fa-folder fa-5x"></i>
                            </div>
                            <div class="col-xs-7 text-right">
                                <span>{{trans('admin.allCategories')}}</span>

                                <h2 class="font-bold">{{$categories->total()}}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Add Category --}}
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{trans('admin.addCategory')}}</h5>
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
                        <form action="{{action('CategoryController@store')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                            {{csrf_field()}}

                            {{-- Category Name --}}
                            <div class="form-group {{$errors->has('name') ? 'has-error' : null}}"><label for="name" class="col-lg-4 control-label">{{trans('tables.name')}}&nbsp;*</label>

                                <div class="col-sm-8">
                                    <input type="text" name="name" value="{{old('name')}}" autofocus required class="form-control">
                                    <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : null}}</span>
                                </div>
                            </div>

                            {{-- Metadata --}}
                            <div class="panel panel-default m-t-lg m-b-xs">
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
                            <div class="panel panel-default m-b-lg">
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

                            {{-- Add Button --}}
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="pull-right">
                                        <button class="btn btn-w-m btn-primary" type="submit"><i class="fa fa-plus m-r-xs"></i>{{trans('admin.add')}}</button>
                                    </div>
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
                        <h5>{{trans('admin.categories')}}</h5>
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
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>

                                                {{-- ID --}}
                                                {{$category->id or null}}

                                            </td>
                                            <td>

                                                {{-- Name --}}
                                                <a href="{{route('categories.edit', $category->id)}}">{{$category->name or null}}</a>

                                            </td>
                                            <td>

                                                {{-- Metadata Description --}}
                                                {{isset($category->metadata->description) ? str_limit($category->metadata->description, 50) : null}}

                                            </td>
                                            <td>

                                                {{-- Metadata keywords --}}
                                                {{isset($category->metadata->keywords) ? str_limit($category->metadata->keywords, 20) : null}}

                                            </td>
                                            <td class="text-right">

                                                {{-- Action --}}
                                                <div class="btn-group">

                                                    {{-- Edit button --}}
                                                    <a href="{{route('categories.edit', $category->id)}}" class="btn-white btn btn-xs">{{trans('admin.edit')}}</a>

                                                    {{-- Delete button --}}
                                                    <form action="{{action('CategoryController@destroy', $category->id)}}" method="POST" class="btn-group">
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
                                            {{$categories->links('admin.includes.pagination')}}

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
