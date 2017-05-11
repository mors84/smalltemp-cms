@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Show Comment --}}
    <div class="wrapper wrapper-content animated fadeInRight article">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">

                {{-- Post Header --}}
                <div class="ibox">
                    <div class="ibox-content">

                        {{-- Action Buttons --}}
                        <div class="pull-right">

                            {{-- Show button --}}
                            <a href="{{route('posts.show', $comment->post_id)}}" class="btn-white btn btn-xs">{{trans('admin.show')}}</a>

                            {{-- Edit button --}}
                            <a href="{{route('posts.edit', $comment->post_id)}}" class="btn-white btn btn-xs">{{trans('admin.edit')}}</a>

                        </div>

                        {{-- Post Header --}}
                        <div class="text-center article-title">
                            <span class="text-muted"><i class="fa fa-clock-o"></i> {{$comment->post->created_at->diffForHumans()}} ({{trans('tables.updated_at')}} {{$comment->post->updated_at->diffForHumans()}})</span>
                            <h1>{{$comment->post->title or null}}</h1>
                        </div>

                        {{-- Post Content --}}
                        {!! str_limit($comment->post->content, 255) !!}
                        &nbsp;
                        <small><a href="{{route('posts.show', $comment->post_id)}}" class="text-navy">{{trans('admin.readMore')}}<i class="fa fa-long-arrow-right m-l-xs"></i></a></small>

                    </div>
                </div>

                {{-- All Comments --}}
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="row m-t-xl">
                        <div class="col-lg-12">
                            <h2><a href="{{route('comments.index')}}">{{trans('admin.comments')}}</a>:</h2>

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
                                        <img src="/images/user-default-50.jpg" height="50">
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
                                    <p>{{$comment->content or 'unknown'}}</p>
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
                                                    <img src="/images/user-default-50.jpg" height="50">
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

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script type="text/javascript">
        var token = '{{Session::token()}}';
    </script>

@endsection
