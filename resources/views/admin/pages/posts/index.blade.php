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
                        <h5>{{trans('admin.posts')}} ({{$posts->total()}})</h5>
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
                                        <th>{{trans('tables.photo')}}</th>
                                        <th>{{trans('tables.title')}}</th>
                                        <th>{{trans('tables.user')}}</th>
                                        <th>{{trans('tables.category')}}</th>
                                        <th>{{trans('tables.created_at')}}</th>
                                        <th>{{trans('tables.updated_at')}}</th>
                                        <th>{{trans('tables.is_active')}}</th>
                                        <th class="text-right">{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>

                                                {{-- ID --}}
                                                {{$post->id or null}}

                                            </td>
                                            <td>

                                                {{-- Photo --}}
                                                <a href="{{isset($post->photo->id) ? route('photos.edit', $post->photo->id) : null}}">
                                                    <img src="{{isset($post->photo) ? $post->photo->sizes->last()->path : '/images/admin/post-default-75.jpg'}}" height="50px">
                                                </a>

                                            </td>
                                            <td>

                                                {{-- Title --}}
                                                <a href="{{route('posts.edit', $post->id)}}">{{$post->title or null}}</a>

                                            </td>
                                            <td>

                                                {{-- User --}}
                                                @if (Auth::user()->role->name == 'administrator')
                                                    <a href="{{isset($post->user->id) ? route('users.edit', $post->user->id) : null}}">{{$post->user->name or null}}</a>
                                                @else
                                                    {{$post->user->name or null}}
                                                @endif

                                            </td>
                                            <td>

                                                {{-- Category --}}
                                                <a href="{{isset($post->category->id) ? route('categories.edit', $post->category->id) : null}}">{{$post->category->name or null}}</a>

                                            </td>
                                            <td>

                                                {{-- Created at --}}
                                                {{$post->created_at->diffForHumans()}}

                                            </td>
                                            <td>

                                                {{-- Updated at --}}
                                                {{$post->updated_at->diffForHumans()}}

                                            </td>
                                            <td>

                                                {{-- Is active --}}
                                                <div class="switch form-control-static">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" value="{{$post->is_active == 1 ? 0 : 1}}" {{$post->is_active == 1 ? 'checked' : null}} data-id="{{$post->id}}" data-url="{{route('posts.ajaxChangeActive', $post->id)}}" class="onoffswitch-checkbox buttonChangeActive" id="is_active_{{$post->id}}">
                                                        <label class="onoffswitch-label" for="is_active_{{$post->id}}">
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
                                                    <a href="{{route('posts.show', $post->id)}}" class="btn-white btn btn-xs">{{trans('admin.show')}}</a>

                                                    {{-- Edit button --}}
                                                    <a href="{{route('posts.edit', $post->id)}}" class="btn-white btn btn-xs">{{trans('admin.edit')}}</a>

                                                    {{-- Delete button --}}
                                                    <form action="{{action('PostController@destroy', $post->id)}}" method="POST" class="btn-group">
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
                                        <td colspan="9">

                                            {{-- Pagination --}}
                                            {{$posts->links('admin.includes.pagination')}}

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
    @include('admin.includes.notificationStatus')

    <script type="text/javascript">
        var token = '{{Session::token()}}';
    </script>

@endsection
