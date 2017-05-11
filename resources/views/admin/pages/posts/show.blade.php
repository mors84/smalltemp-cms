@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Show Post --}}
    <div class="wrapper wrapper-content animated fadeInRight article">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">

                {{-- Post --}}
                <div class="ibox">
                    <div class="ibox-content">

                        {{-- Action Buttons --}}
                        <div>
                            <div class="pull-left">

                                {{-- Is active --}}
                                <div class="switch form-control-static">
                                    <div class="onoffswitch">
                                        <input type="checkbox" value="{{$post->is_active == 1 ? 0 : 1}}" {{$post->is_active == 1 ? 'checked' : null}} data-id="{{$post->id}}" data-url="{{route('posts.ajaxChangeActive', $post->id)}}" class="onoffswitch-checkbox buttonChangeActive" id="is_active_post_{{$post->id}}">
                                        <label class="onoffswitch-label" for="is_active_post_{{$post->id}}">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="pull-right">

                                {{-- Edit button --}}
                                <a href="{{route('posts.edit', $post->id)}}" class="btn-white btn btn-xs">{{trans('admin.edit')}}</a>

                                {{-- Delete button --}}
                                <form action="{{action('PostController@destroy', $post->id)}}" method="POST" class="btn-group">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <input type="submit" name="submit" value="{{trans('admin.delete')}}" class="btn-white btn btn-xs">
                                </form>

                            </div>
                        </div>

                        {{-- Post Header --}}
                        <div class="text-center article-title">
                            <span class="text-muted"><i class="fa fa-clock-o"></i> {{$post->created_at->diffForHumans()}} ({{trans('tables.updated_at')}} {{$post->updated_at->diffForHumans()}})</span>
                            <h1>
                                {{$post->title or null}}
                            </h1>
                        </div>

                        {{-- Post Photo --}}
                        <div class="m-b-xl">
                            @if (isset($post->photo))
                                @if ($post->photo->sizes->count() > 4)
                                    <a href="{{route('photos.edit', $post->photo->id)}}">
                                        <img src="{{$post->photo->sizes[count($post->photo->sizes) - 4]->path}}" title="{{$post->photo->alt or null}} ({{$post->photo->title or null}})" id="fullPhoto" class="img-responsive center-block" data-toggle="tooltip" data-placement="top">
                                    </a>
                                @else
                                    <a href="{{route('photos.edit', $post->photo->id)}}">
                                        <img src="{{$post->photo->sizes[0]->path}}" title="{{$post->photo->alt or null}} ({{$post->photo->title or null}})" id="fullPhoto" class="img-responsive center-block" data-toggle="tooltip" data-placement="top">
                                    </a>
                                @endif
                            @else
                                <img src="/images/admin/post-default-768.jpg" class="img-responsive center-block">
                            @endif
                        </div>

                        {{-- Post Content --}}
                        {!! $post->content or null !!}

                        <hr>

                        {{-- Post Footer --}}
                        <div class="row">
                            <div class="col-md-6">
                                <h5><a href="{{route('tags.index')}}">{{trans('admin.tags')}}</a>:</h5>
                                @foreach ($post->tags as $tag)
                                    <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-primary btn-xs">{{$tag->name}}</a>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <div class="small text-right">
                                    <h5>{{trans('admin.stats')}}:</h5>
                                    <div> <i class="fa fa-comments-o"> </i> {{trans('admin.comments')}}: {{$countOfAllComments or 0}} </div>
                                    <i class="fa fa-star-o"> </i> {{trans('admin.rating')}}: {{isset($post->ratings) ? round($post->ratings->avg('number'), 1) : null}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- All Comments --}}
                @if ($post->comments->count())
                    <div class="col-lg-10 col-lg-offset-1 m-t-xl">
                        <div class="row">
                            <div class="col-lg-12">
                                <h2><a href="{{route('comments.index')}}">{{trans('admin.comments')}}</a>:</h2>
                                @foreach ($post->comments as $comment)

                                    {{-- Single Comment --}}
                                    <div class="social-feed-box">

                                        {{-- Action Buttons --}}
                                        <div class="pull-right">
                                            <div class="btn-group m-md">

                                                {{-- Is active --}}
                                                <div class="switch form-control-static">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" value="{{$comment->is_active == 1 ? 0 : 1}}" {{$comment->is_active == 1 ? 'checked' : null}} data-id="{{$comment->id}}" data-url="{{route('comments.ajaxChangeActive', $comment->id)}}" class="onoffswitch-checkbox buttonChangeActive" id="is_active_comment_{{$comment->id}}">
                                                        <label class="onoffswitch-label" for="is_active_comment_{{$comment->id}}">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                                {{-- Delete button --}}
                                                <form action="{{action('CommentController@destroy', $comment->id)}}" method="POST" class="btn-group">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <input type="submit" name="submit" value="{{trans('admin.delete')}}" class="btn-white btn btn-xs">
                                                </form>

                                            </div>
                                        </div>

                                        {{-- About Author --}}
                                        <div class="social-avatar">
                                            <div class="pull-left">
                                                <img src="/images/admin/user-default-50.jpg" height="50">
                                            </div>
                                            <div class="media-body">
                                                <a href="{{route('comments.show', $comment->id)}}">
                                                    {{$comment->author or 'unknown'}}
                                                </a>
                                                <a href="mailto:{{$comment->email or 'unknown'}}">{{$comment->email or null}}</a>
                                                <small class="text-muted">{{$comment->created_at->diffForHumans()}}</small>
                                            </div>
                                        </div>

                                        {{-- Content --}}
                                        <div class="social-body">
                                            <p>
                                                {{$comment->content or 'unknown'}}
                                            </p>
                                        </div>

                                    </div>

                                    {{-- All Replies --}}
                                    <div class="row m-b-xl">
                                        <div class="col-xs-11 col-xs-offset-1">
                                            @foreach ($comment->replies as $reply)

                                                {{-- Single Reply --}}
                                                <div class="social-feed-box">

                                                    {{-- Action Buttons --}}
                                                    <div class="pull-right">
                                                        <div class="btn-group m-md">

                                                            {{-- Is active --}}
                                                            <div class="switch form-control-static">
                                                                <div class="onoffswitch">
                                                                    <input type="checkbox" value="{{$reply->is_active == 1 ? 0 : 1}}" {{$reply->is_active == 1 ? 'checked' : null}} data-id="{{$reply->id}}" data-url="{{route('replies.ajaxChangeActive', $reply->id)}}" class="onoffswitch-checkbox buttonChangeActive" id="is_active_reply_{{$reply->id}}">
                                                                    <label class="onoffswitch-label" for="is_active_reply_{{$reply->id}}">
                                                                        <span class="onoffswitch-inner"></span>
                                                                        <span class="onoffswitch-switch"></span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            {{-- Delete button --}}
                                                            <form action="{{action('CommentReplyController@destroy', $reply->id)}}" method="POST" class="btn-group">
                                                                {{csrf_field()}}
                                                                {{method_field('DELETE')}}
                                                                <input type="submit" name="submit" value="{{trans('admin.delete')}}" class="btn-white btn btn-xs">
                                                            </form>

                                                        </div>
                                                    </div>

                                                    {{-- About Author --}}
                                                    <div class="social-avatar">
                                                        <div class="pull-left">
                                                            <img src="/images/admin/user-default-50.jpg" height="50">
                                                        </div>
                                                        <div class="media-body">
                                                            {{$reply->author or 'unknown'}}
                                                            <a href="mailto:{{$reply->email or 'unknown'}}">{{$reply->email or null}}</a>
                                                            <small class="text-muted">{{$reply->created_at->diffForHumans()}}</small>
                                                        </div>
                                                    </div>

                                                    {{-- Content --}}
                                                    <div class="social-body">
                                                        <p>{{$reply->content or 'unknown'}}</p>
                                                    </div>

                                                </div>

                                            @endforeach
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script type="text/javascript">
        var token = '{{Session::token()}}';
    </script>

@endsection
