@extends('admin.layouts.media')
@section('mediaContent')

    {{-- Media --}}
    <div class="row">
        <div class="col-lg-12">
            @foreach ($media as $file)
                <div class="file-box" style="min-height: 215px;">
                    <div class="file">
                        <a href="{{route('photos.edit', $file->id)}}">
                            <span class="corner"></span>
                            @if ($file->sizes)
                                <div class="image">
                                    <img class="img-responsive" src="{{$file->sizes->last()->path or null}}">
                                </div>
                            @else
                                <div class="icon">
                                    <i class="fa fa-file-image-o"></i>
                                </div>
                            @endif
                            <div class="file-name">
                                {{$file->alt or null}}
                                <br/>
                                <small>{{trans('admin.added')}}: {{$file->created_at->diffForHumans()}}</small>
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
