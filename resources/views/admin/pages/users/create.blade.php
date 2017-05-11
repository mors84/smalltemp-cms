@if (Auth::user()->role->name == 'administrator')
    @extends('admin.layouts.admin')
    @section('content')

        {{-- Breadcrumbs --}}
        @include('admin.includes.breadcrumbs')

        {{-- Back to previous page --}}
        @include('admin.includes.backToPreviousPage')

        {{-- Create --}}
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">

                    {{-- Create User --}}
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{trans('admin.addUser')}}</h5>
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
                            <form action="{{action('UserController@store')}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-10 col-lg-offset-1">

                                        {{-- Name --}}
                                        <div class="form-group {{$errors->has('name') ? 'has-error' : null}}">
                                            <label for="name" class="col-sm-4 control-label">{{trans('tables.name')}}&nbsp;*</label>

                                            <div class="col-sm-8">
                                                <input type="text" name="name" value="{{old('name')}}" spellcheck="false" autofocus required id="name" class="form-control">
                                                <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="form-group {{$errors->has('email') ? 'has-error' : null}}">
                                            <label for="email" class="col-sm-4 control-label">{{trans('tables.email')}}&nbsp;*</label>

                                            <div class="col-sm-8">
                                                <input type="email" name="email" value="{{old('email')}}" spellcheck="false" required id="email" class="form-control">
                                                <span class="text-danger">{{$errors->has('email') ? $errors->first('email') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- First Name --}}
                                        <div class="form-group {{$errors->has('first_name') ? 'has-error' : null}}">
                                            <label for="first_name" class="col-sm-4 control-label">{{trans('tables.first_name')}}</label>

                                            <div class="col-sm-8">
                                                <input type="text" name="first_name" value="{{old('first_name')}}" id="first_name" class="form-control">
                                                <span class="text-danger">{{$errors->has('first_name') ? $errors->first('first_name') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Last Name --}}
                                        <div class="form-group {{$errors->has('last_name') ? 'has-error' : null}}">
                                            <label for="last_name" class="col-sm-4 control-label">{{trans('tables.last_name')}}</label>

                                            <div class="col-sm-8">
                                                <input type="text" name="last_name" value="{{old('last_name')}}" spellcheck="false" id="last_name" class="form-control">
                                                <span class="text-danger">{{$errors->has('last_name') ? $errors->first('last_name') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Role --}}
                                        <div class="form-group {{$errors->has('role_id') ? 'has-error' : null}}">
                                            <label for="role_id" class="col-sm-4 control-label">{{trans('tables.role')}}</label>

                                            <div class="col-sm-8">
                                                <select name="role_id" class="form-control">
                                                    @foreach ($roles->reverse() as $role)
                                                        <option value="{{$role->id}}" {{old('role_id') == $role->id ? 'selected' : null}}>{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{$errors->has('role_id') ? $errors->first('role_id') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- URL --}}
                                        <div class="form-group {{$errors->has('url') ? 'has-error' : null}}">
                                            <label for="url" class="col-sm-4 control-label">{{trans('tables.url')}}</label>

                                            <div class="col-sm-8">
                                                <input type="url" name="url" value="{{old('url')}}" spellcheck="false" class="form-control">
                                                <span class="text-danger">{{$errors->has('url') ? $errors->first('url') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Is Active --}}
                                        <div class="form-group m-b-xl {{$errors->has('is_active') ? 'has-error' : null}}">
                                            <label for="is_active" class="col-sm-4 control-label">{{trans('tables.is_active')}}</label>

                                            <div class="col-sm-8">
                                                <div class="switch form-control-static">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" name="is_active" value="1" {{old('is_active') ? 'checked' : null}} class="onoffswitch-checkbox" id="is_active">
                                                        <label class="onoffswitch-label" for="is_active">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <span class="text-danger">{{$errors->has('is_active') ? $errors->first('is_active') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Password --}}
                                        <div id="pwd-container" class="m-b-xl">

                                            {{-- Password field --}}
                                            <div class="form-group {{$errors->has('password') ? 'has-error' : null}}">
                                                <label for="password" class="col-sm-4 control-label">{{trans('tables.password')}}&nbsp;*</label>

                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="password" name="password" required class="form-control passwordMeter">
                                                        <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.passwordInputInfo')}}"><i class="fa fa-question-circle"></i></span>
                                                    </div>
                                                    <span class="text-danger">{{$errors->has('password') ? $errors->first('password') : null}}</span>
                                                </div>
                                            </div>

                                            {{-- Password field Confirm --}}
                                            <div class="form-group">
                                                <label for="password_confirmation" class="col-sm-4 control-label">{{trans('admin.passwordConfirm')}}&nbsp;*</label>

                                                <div class="col-sm-8">
                                                    <input type="password" name="password_confirmation" required class="form-control">
                                                </div>
                                            </div>

                                            {{-- Password meter --}}
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-4">
                                                    <div class="pwstrength_viewport_progress"></div>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- Extra fields --}}
                                        <div class="panel-group m-b-xl" id="accordion">

                                            {{-- Social Media --}}
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">{{trans('admin.socialMedia')}}</a>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne" class="panel-collapse collapse {{$errors->has('profile_links[]') ? 'in' : null}}">
                                                    <div class="panel-body">
                                                        <p class="m-b-xl">{{trans('admin.addSocialMediaInfo')}}</p>

                                                        {{-- Social Media item --}}
                                                        @foreach ($socialMedia as $i => $network)

                                                            <div class="form-group {{$errors->has('profile_links[]') ? 'has-error' : null}}">
                                                                <label for="profile_links[]" class="col-sm-3 control-label">{{$network->name or null}} ID</label>

                                                                <div class="col-sm-9">
                                                                    <div class="input-group">

                                                                        @if ($network->name == 'Twitter' || $network->name == 'twitter')

                                                                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                                                            <input type="text" name="profile_links[]" value="{{old('profile_links.'.$i)}}" spellcheck="false" class="form-control">
                                                                            <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.'.snake_case($network->name).'InputInfo')}}"><i class="fa fa-question-circle"></i></span>

                                                                        @else

                                                                            <input type="url" name="profile_links[]" value="{{old('profile_links.'.$i)}}" placeholder="https://" spellcheck="false" class="form-control">
                                                                            <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.socialMediaInputInfo')}}"><i class="fa fa-question-circle"></i></span>

                                                                        @endif

                                                                    </div>
                                                                </div>

                                                            </div>

                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Add Photo --}}
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">{{trans('admin.addPhoto')}}</a>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="panel-collapse collapse {{$errors->has('alt_attribute') || $errors->has('title_attribute') || $errors->has('photo_id') ? 'in' : null}}">
                                                    <div class="panel-body">
                                                        <p class="m-b-xl">{{trans('admin.addUserPhotoInfo')}}</p>

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

                                            {{-- Description --}}
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">{{trans('admin.aboutMe')}}</a>
                                                    </h5>
                                                </div>
                                                <div id="collapseThree" class="panel-collapse collapse {{$errors->has('description') ? 'in' : null}}">
                                                    <div class="panel-body">
                                                        <p class="m-b-xl">{{trans('admin.addUserDescriptionInfo')}}</p>

                                                        {{-- Description textarea --}}
                                                        <div class="form-group {{$errors->has('description') ? 'has-error' : null}}">
                                                            <div class="col-lg-10 col-lg-offset-1 m-b-xl">
                                                                <label for="description">{{trans('admin.description')}}</label>

                                                                <textarea name="description" rows="5" cols="80" class="form-control">{{old('description')}}</textarea>
                                                                <span class="text-danger">{{$errors->has('description') ? $errors->first('description') : null}}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- Add Button --}}
                                        <div class="form-group">
                                            <div class="pull-right m-md">
                                                <button class="btn btn-w-m btn-lg btn-primary" type="submit"><i class="fa fa-plus m-r-md"></i>{{trans('admin.addUser')}}</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    @endsection
@endif
