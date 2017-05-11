@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Table --}}
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>{{trans('admin.comments')}} ({{$comments->total()}})</h5>
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
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{trans('tables.id')}}</th>
                                        <th>{{trans('tables.author')}}</th>
                                        <th>{{trans('tables.email')}}</th>
                                        <th>{{trans('tables.content')}}</th>
                                        <th>{{trans('tables.post')}}</th>
                                        <th>{{trans('tables.created_at')}}</th>
                                        <th>{{trans('tables.is_active')}}</th>
                                        <th class="text-right">{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>
                                                {{-- ID --}}
                                                {{$comment->id or null}}

                                            </td>
                                            <td>

                                                {{-- Author --}}
                                                <a href="{{route('comments.show', $comment->id)}}">{{$comment->author or null}}</a>

                                            </td>
                                            <td>

                                                {{-- Email --}}
                                                {{$comment->email or null}}

                                            </td>
                                            <td>

                                                {{-- Content --}}
                                                <a href="{{route('comments.show', $comment->id)}}">{{isset($comment->content) ? str_limit($comment->content, 80) : null}}</a>

                                            </td>
                                            <td>

                                                {{-- Post Title --}}
                                                <a href="{{route('posts.show', $comment->post_id)}}">{{isset($comment->post->title) ? str_limit($comment->post->title, 40) : null}}</a>

                                            </td>
                                            <td>

                                                {{-- Created ad --}}
                                                {{$comment->created_at->diffForHumans()}}

                                            </td>
                                            <td>

                                                {{-- Is active --}}
                                                <div class="switch form-control-static">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" value="{{$comment->is_active == 1 ? 0 : 1}}" {{$comment->is_active == 1 ? 'checked' : null}} data-id="{{$comment->id}}" data-url="{{route('comments.ajaxChangeActive', $comment->id)}}" class="onoffswitch-checkbox buttonChangeActive" id="is_active_{{$comment->id}}">
                                                        <label class="onoffswitch-label" for="is_active_{{$comment->id}}">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>

                                            </td>
                                            <td class="text-right">

                                                {{-- Action --}}
                                                <div class="btn-group">

                                                    {{-- Show button --}}
                                                    <a href="{{route('comments.show', $comment->id)}}" class="btn-white btn btn-xs">{{trans('admin.show')}}</a>

                                                    {{-- Delete button --}}
                                                    <form action="{{action('CommentController@destroy', $comment->id)}}" method="POST" class="btn-group">
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
                                        <td colspan="8">

                                            {{-- Pagination --}}
                                            {{$comments->links('admin.includes.pagination')}}

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

    <script type="text/javascript">
        var token = '{{Session::token()}}';
    </script>

@endsection
