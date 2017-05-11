@extends('admin.layouts.media')
@section('mediaContent')

    {{-- Photos --}}
    <div class="row">
        <div class="col-lg-12">
            @foreach ($media as $photo)
                <div class="file-box" style="min-height: 215px;">
                    <div class="file">
                        <a href="{{route('photos.edit', $photo->id)}}">
                            <span class="corner"></span>
                            @if ($photo->sizes)
                                <div class="image">
                                    <img class="img-responsive" src="{{$photo->sizes->last()->path or null}}">
                                </div>
                            @else
                                <div class="icon">
                                    <i class="fa fa-file-image-o"></i>
                                </div>
                            @endif
                            <div class="file-name">
                                {{$photo->alt or null}}
                                <br/>
                                <small>{{trans('admin.added')}}: {{$photo->created_at->diffForHumans()}}</small>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Pagination --}}
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            {{$media->links('admin.includes.pagination')}}
        </div>
    </div>

@endsection
@section('scripts')

    {{-- Notification status --}}
    @include('admin.includes.notificationStatus');

@endsection
