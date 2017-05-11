@if (Auth::user()->role->name == 'administrator')
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
                            <h5>{{trans('admin.users')}} ({{$users->total()}})</h5>
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
                                            <th>{{trans('tables.name')}}</th>
                                            <th>{{trans('tables.first_name')}}</th>
                                            <th>{{trans('tables.last_name')}}</th>
                                            <th>{{trans('tables.email')}}</th>
                                            <th>{{trans('tables.description')}}</th>
                                            <th>{{trans('tables.role')}}</th>
                                            <th>{{trans('tables.created_at')}}</th>
                                            <th>{{trans('tables.updated_at')}}</th>
                                            <th>{{trans('tables.is_active')}}</th>
                                            <th class="text-right">{{trans('admin.action')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>

                                                    {{-- ID --}}
                                                    {{$user->id or null}}

                                                </td>
                                                <td>

                                                    {{-- Photo --}}
                                                    <a href="{{isset($user->photo) ? route('photos.edit', $user->photo->id) : null}}"><img src="{{isset($user->photo) ? $user->photo->sizes->last()->path : '/images/admin/user-default-50.jpg'}}" height="50px"></a>

                                                </td>
                                                <td>

                                                    {{-- Name --}}
                                                    <a href="{{route('users.edit', $user->id)}}">{{$user->name or null}}</a>

                                                </td>
                                                <td>

                                                    {{-- First Name --}}
                                                    {{$user->first_name or null}}

                                                </td>
                                                <td>

                                                    {{-- Last Name --}}
                                                    {{$user->last_name or null}}

                                                </td>
                                                <td>

                                                    {{-- Email --}}
                                                    {{$user->email or null}}

                                                </td>
                                                <td>

                                                    {{-- Description --}}
                                                    {{isset($user->description) ? str_limit($user->description, 50) : null}}

                                                </td>
                                                <td>

                                                    {{-- Role --}}
                                                    {{$user->role->name or null}}

                                                </td>
                                                <td>

                                                    {{-- Created at --}}
                                                    {{$user->created_at->diffForHumans()}}

                                                </td>
                                                <td>

                                                    {{-- Updated at --}}
                                                    {{$user->updated_at->diffForHumans()}}

                                                </td>
                                                <td>

                                                    {{-- Is active --}}
                                                    <div class="switch form-control-static">
                                                        <div class="onoffswitch">
                                                            <input type="checkbox" value="{{$user->is_active == 1 ? 0 : 1}}" {{$user->is_active == 1 ? 'checked' : null}} data-id="{{$user->id}}" data-url="{{route('users.ajaxChangeActive', $user->id)}}" class="onoffswitch-checkbox buttonChangeActive" id="is_active_{{$user->id}}">
                                                            <label class="onoffswitch-label" for="is_active_{{$user->id}}">
                                                                <span class="onoffswitch-inner"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td class="text-right">

                                                    {{-- Active --}}
                                                    <div class="btn-group">

                                                        {{-- Edit button --}}
                                                        <a href="{{route('users.edit', $user->id)}}" class="btn-white btn btn-xs">{{trans('admin.edit')}}</a>

                                                        {{-- Delete button --}}
                                                        <form action="{{action('UserController@destroy', $user->id)}}" method="POST" class="btn-group">
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
                                            <td colspan="12">

                                                {{-- Pagination --}}
                                                {{$users->links('admin.includes.pagination')}}

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

@endif
@section('scripts')

    {{-- Notification status --}}
    @include('admin.includes.notificationStatus');

    <script type="text/javascript">
        var token = '{{Session::token()}}';
    </script>

@endsection
