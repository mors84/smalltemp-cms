@if (Auth::user()->role->name == 'administrator')
    @extends('admin.layouts.admin')
    @section('content')

        {{-- Breadcrumbs --}}
        @include('admin.includes.breadcrumbs')

        {{-- Back to previous page --}}
        @include('admin.includes.backToPreviousPage')

        {{-- Edit --}}
        <div class="wrapper wrapper-content animated fadeInRight">

            {{-- Edit User --}}
            <div class="row">

                {{-- Show photo and info --}}
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{$user->name or null}}</h5>
                        </div>
                        <div>

                            {{-- Photo User --}}
                            <div class="ibox-content no-padding border-left-right">
                                @if (isset($user->photo))
                                    @if ($user->photo->sizes->count() > 2)
                                        <a href="{{route('photos.edit', $user->photo->id)}}">
                                            <img src="{{$user->photo->sizes[count($user->photo->sizes) - 2]->path}}" title="{{$user->photo->alt or null}} ({{$user->photo->title or null}})" id="fullPhoto" class="img-responsive" data-toggle="tooltip" data-placement="bottom">
                                        </a>
                                    @else
                                        <a href="{{route('photos.edit', $user->photo->id)}}">
                                            <img src="{{$user->photo->sizes[0]->path}}" title="{{$user->photo->alt or null}} ({{$user->photo->title or null}})" id="fullPhoto" class="img-responsive" data-toggle="tooltip" data-placement="bottom">
                                        </a>
                                    @endif
                                @else
                                    <img src="/images/admin/user-default-768.jpg" class="img-responsive">
                                @endif
                            </div>

                            {{-- Info User --}}
                            <div class="ibox-content profile-content">
                                <h4><strong>{{$user->first_name or null}} {{$user->last_name or null}}</strong></h4>
                                <p><i class="fa fa-user-o m-r-xs"></i> {{$user->role->name or null}}</p>
                                <h5>{{trans('admin.aboutMe')}}</h5>
                                <p>{{$user->description or null}}</p>
                                <div class="user-button m-t-lg">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            @foreach ($user->socialMediaLinks as $network)
                                                <a href="{{snake_case($network->name) == 'twitter' ? 'https://twitter.com/'.$network->pivot->profile_link : $network->pivot->profile_link}}" data-toggle="tooltip" title="{{$network->title or null}}" class="btn btn-danger btn-circle btn-outline" target="_blank"><i class="fa fa-{{str_slug($network->name)}}"></i></a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-sm">
                                    <div class="col-xs-6 text-capitalize">
                                        <h5><i class="fa fa-edit"></i> {{trans('admin.posts')}}: <strong>{{$user->posts->count()}}</strong></h5>
                                    </div>
                                    <div class="col-xs-6 text-right text-capitalize">
                                        <h5>{{trans('admin.postsAvgRating')}}: <strong>{{$avgRatingOfPostsByUser or 0}}</strong></h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Edit User --}}
                <div class="col-md-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{trans('admin.editUser')}}</h5>
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
                            <form action="{{action('UserController@update', $user->id)}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data" class="form-horizontal">
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <div class="row">
                                    <div class="col-lg-10 col-lg-offset-1">

                                        {{-- Name --}}
                                        <div class="form-group {{$errors->has('name') ? 'has-error' : null}}">
                                            <label for="name" class="col-sm-4 control-label">{{trans('tables.name')}}&nbsp;*</label>

                                            <div class="col-sm-8">
                                                <input type="text" name="name" value="{{old('name', $user->name)}}" spellcheck="false" required id="name" class="form-control">
                                                <span class="text-danger">{{$errors->has('name') ? $errors->first('name') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Email --}}
                                        <div class="form-group {{$errors->has('email') ? 'has-error' : null}}">
                                            <label for="email" class="col-sm-4 control-label">{{trans('tables.email')}}&nbsp;*</label>

                                            <div class="col-sm-8">
                                                <input type="email" name="email" value="{{$user->email or null}}" spellcheck="false" required id="email" class="form-control">
                                                <span class="text-danger">{{$errors->has('email') ? $errors->first('email') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- First Name --}}
                                        <div class="form-group {{$errors->has('first_name') ? 'has-error' : null}}">
                                            <label for="first_name" class="col-sm-4 control-label">{{trans('tables.first_name')}}</label>

                                            <div class="col-sm-8">
                                                <input type="text" name="first_name" value="{{old('first_name', $user->first_name)}}" id="first_name" class="form-control">
                                                <span class="text-danger">{{$errors->has('first_name') ? $errors->first('first_name') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Last Name --}}
                                        <div class="form-group {{$errors->has('last_name') ? 'has-error' : null}}">
                                            <label for="last_name" class="col-sm-4 control-label">{{trans('tables.last_name')}}</label>

                                            <div class="col-sm-8">
                                                <input type="text" name="last_name" value="{{old('last_name', $user->last_name)}}" spellcheck="false" id="last_name" class="form-control">
                                                <span class="text-danger">{{$errors->has('last_name') ? $errors->first('last_name') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Role --}}
                                        <div class="form-group {{$errors->has('role_id') ? 'has-error' : null}}">
                                            <label for="role_id" class="col-sm-4 control-label">{{trans('tables.role')}}</label>

                                            <div class="col-sm-8">
                                                <select name="role_id" class="form-control">
                                                    @foreach ($roles->reverse() as $role)
                                                        <option value="{{$role->id}}" {{old('role_id') == $role->id ? 'selected' : $user->role_id == $role->id ? 'selected' : null}}>{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{$errors->has('role_id') ? $errors->first('role_id') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- URL --}}
                                        <div class="form-group {{$errors->has('url') ? 'has-error' : null}}">
                                            <label for="url" class="col-sm-4 control-label">{{trans('tables.url')}}</label>

                                            <div class="col-sm-8">
                                                <input type="url" name="url" value="{{old('url', $user->url)}}" spellcheck="false" class="form-control">
                                                <span class="text-danger">{{$errors->has('url') ? $errors->first('url') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Is Active --}}
                                        <div class="form-group {{$errors->has('is_active') ? 'has-error' : null}}">
                                            <label for="is_active" class="col-sm-4 control-label">{{trans('tables.is_active')}}</label>

                                            <div class="col-sm-8">
                                                <div class="switch form-control-static">
                                                    <div class="onoffswitch">
                                                        <input type="checkbox" {{old('is_active') ? 'checked' : $user->is_active == 1 ? 'checked' : null}} name="is_active" value="{{$user->is_active == 1 ? 1 : 0}}" class="onoffswitch-checkbox" id="is_active">
                                                        <label class="onoffswitch-label" for="is_active">
                                                            <span class="onoffswitch-inner"></span>
                                                            <span class="onoffswitch-switch"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <span class="text-danger">{{$errors->has('is_active') ? $errors->first('is_active') : null}}</span>
                                            </div>
                                        </div>

                                        {{-- Change the Password --}}
                                        <div class="text-right m-b-lg">
                                            <a class="text-right" role="button" data-toggle="collapse" href="#showChangePasswordField" aria-expanded="false" aria-controls="showChangePasswordField">
                                                <i class="fa fa-key m-r-xs"></i>
                                                {{trans('admin.changeThePassword')}}
                                            </a>
                                        </div>
                                        <div class="collapse {{$errors->has('password') ? 'in' : null}}" id="showChangePasswordField">

                                            {{-- Password --}}
                                            <div id="pwd-container" class="m-b-xl">

                                                {{-- Password field --}}
                                                <div class="form-group {{$errors->has('password') ? 'has-error' : null}}">
                                                    <label for="password" class="col-sm-4 control-label">{{trans('tables.password')}}&nbsp;*</label>

                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="password" name="password" class="form-control passwordMeter">
                                                            <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.passwordInputInfo')}}"><i class="fa fa-question-circle"></i></span>
                                                        </div>
                                                        <span class="text-danger">{{$errors->has('password') ? $errors->first('password') : null}}</span>
                                                    </div>
                                                </div>

                                                {{-- Password field Confirm --}}
                                                <div class="form-group">
                                                    <label for="password_confirmation" class="col-sm-4 control-label">{{trans('admin.passwordConfirm')}}&nbsp;*</label>

                                                    <div class="col-sm-8">
                                                        <input type="password" name="password_confirmation" class="form-control">
                                                    </div>
                                                </div>

                                                {{-- Password meter --}}
                                                <div class="form-group">
                                                    <div class="col-sm-8 col-sm-offset-4">
                                                        <div class="pwstrength_viewport_progress"></div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        {{-- Extra fields --}}
                                        <div class="panel-group m-b-xl" id="accordion">

                                            {{-- Social media --}}
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
                                                                            <input type="text" name="profile_links[]"  value="{{$user->socialMediaLinks->where('id', $network->id)->first() ? old('profile_links.'.$i, $user->socialMediaLinks->where('id', $network->id)->first()->pivot->profile_link) : old('profile_links.'.$i)}}" spellcheck="false" class="form-control">
                                                                            <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.'.snake_case($network->name).'InputInfo')}}"><i class="fa fa-question-circle"></i></span>

                                                                        @else

                                                                            <input type="url" name="profile_links[]" value="{{$user->socialMediaLinks->where('id', $network->id)->first() ? old('profile_links.'.$i, $user->socialMediaLinks->where('id', $network->id)->first()->pivot->profile_link) : old('profile_links.'.$i)}}" placeholder="https://" spellcheck="false" class="form-control">
                                                                            <span class="input-group-addon" data-toggle="tooltip" data-placement="left" title="{{trans('admin.socialMediaInputInfo')}}"><i class="fa fa-question-circle"></i></span>

                                                                        @endif

                                                                    </div>
                                                                </div>

                                                            </div>

                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Change Photo --}}
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">{{trans('admin.changePhoto')}}</a>
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
                                                                    <input type="text" name="alt_attribute" value="{{$user->photo ? old('alt_attribute', $user->photo->alt) : old('alt_attribute')}}" class="form-control">
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
                                                                    <input type="text" name="title_attribute" value="{{$user->photo ? old('title_attribute', $user->photo->title) : old('title_attribute')}}" class="form-control">
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

                                                                <textarea name="description" rows="5" cols="80" class="form-control">{{old('description', $user->description)}}</textarea>
                                                                <span class="text-danger">{{$errors->has('description') ? $errors->first('description') : null}}</span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        {{-- Edit Button --}}
                                        <div class="form-group">
                                            <div class="pull-right m-md">
                                                <button class="btn btn-w-m btn-lg btn-primary" type="submit"><i class="fa fa-pencil m-r-md"></i>{{trans('admin.editUser')}}</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Delete User --}}
            <div class="row m-t-xl m-b-md">
                <div class="pull-right">
                    <form action="{{action('UserController@destroy', $user->id)}}" method="POST" class="btn-group">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger dim btn-large-dim" type="submit"><i class="fa fa-trash-o m-r-xs"></i></button>
                    </form>
                </div>
            </div>

        </div>

    @endsection
@endif
