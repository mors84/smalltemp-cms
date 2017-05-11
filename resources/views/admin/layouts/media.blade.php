@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- All Media --}}
    <div class="wrapper wrapper-content">
        <div class="row">

            {{-- Extra Menu --}}
            <div class="col-lg-3">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="file-manager">
                            <h5>{{trans('admin.media')}}</h5>
                            <ul class="folder-list nav" style="padding: 0">
                                <li class="{{starts_with(Route::currentRouteName(), 'media') ? 'active' : null}}">
                                    <a href="{{route('media.index')}}"><i class="fa fa-folder-o"></i> {{trans('admin.allMedia')}}</a>
                                </li>
                                <li class="{{starts_with(Route::currentRouteName(), 'photos') ? 'active' : null}}">
                                    <a href="{{route('photos.index')}}"><i class="fa fa-file-image-o"></i> {{trans('admin.photos')}}</a>
                                </li>
                                <li class="disabled"><a href=""><i class="fa fa-film"></i> {{trans('admin.films')}}</a></li>
                                <li class="disabled"><a href=""><i class="fa fa-music"></i> {{trans('admin.music')}}</a></li>
                                <li class="disabled"><a href=""><i class="fa fa-file-text-o"></i> {{trans('admin.documents')}}</a></li>
                            </ul>
                            @if (starts_with(Route::currentRouteName(), 'photos'))
                                <div class="hr-line-dashed"></div>
                                <a href="{{route('photos.create')}}" class="btn btn-primary btn-block">{{trans('admin.addPhoto')}}</a>
                                <div class="hr-line-dashed"></div>
                            @endif
                            @if (isset($showTags))
                                <h5 class="tag-title">{{trans('admin.tags')}}</h5>
                                <ul class="tag-list" style="padding: 0">
                                    @foreach ($showTags as $tag)
                                        <li><a href="#">{{$tag}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Media Content --}}
            <div class="col-lg-9 animated fadeInRight">

                @yield('mediaContent')

            </div>

        </div>
    </div>

@endsection
