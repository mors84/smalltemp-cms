<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{Auth::user()->photo ? Auth::user()->photo->sizes->last()->path : '/images/admin/user-default-50.jpg'}}" height="50px" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"><strong class="font-bold">
                                {{Auth::user()->name}}
                            </strong></span>
                            <span class="text-muted text-xs block text-capitalize">
                                {{Auth::user()->role->name}} <b class="caret"></b>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{route('users.edit', Auth::user()->id)}}">{{trans('admin.profile')}}</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{trans('admin.logOut')}}
                            </a>
                            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                {{csrf_field()}}
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    S.
                </div>
            </li>
            <li class="{{Route::is('admin') ? 'active' : null}}">
                <a href="{{route('admin')}}"><i class="fa fa-tachometer"></i> <span class="nav-label">{{trans('admin.dashboard')}}</span></a>
            </li>
            <li class="{{starts_with(Route::currentRouteName(), 'posts') ? 'active' : null}}">
                <a href="{{route('posts.index')}}"><i class="fa fa-edit"></i>
                    <span class="nav-label">{{trans('admin.posts')}}</span>
                    @if (!empty($countOfAllDisapprovedPosts))
                        <span class="label label-warning m-l-sm">{{$countOfAllDisapprovedPosts}}</span>
                    @endif
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{Route::is('posts.index') ? 'active' : null}}"><a href="{{route('posts.index')}}">{{trans('admin.allPosts')}}</a></li>
                    <li class="{{Route::is('posts.create') ? 'active' : null}}"><a href="{{route('posts.create')}}">{{trans('admin.addPost')}}</a></li>
                </ul>
            </li>
            <li class="{{starts_with(Route::currentRouteName(), 'comments') || starts_with(Route::currentRouteName(), 'replies') ? 'active' : null}}">
                <a href="{{route('comments.index')}}"><i class="fa fa-comments-o"></i>
                    <span class="nav-label">{{trans('admin.comments')}}</span>
                    @if (!empty($countOfAllDisapprovedComments))
                        <span class="label label-warning m-l-sm">{{$countOfAllDisapprovedComments}}</span>
                    @endif
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{Route::is('comments.index') ? 'active' : null}}"><a href="{{route('comments.index')}}">{{trans('admin.allComments')}}</a></li>
                    <li class="{{Route::is('replies.index') ? 'active' : null}}"><a href="{{route('replies.index')}}">{{trans('admin.allReplies')}}</a></li>
                </ul>
            </li>
            <li class="{{starts_with(Route::currentRouteName(), 'categories') ? 'active' : null}}">
                <a href="{{route('categories.index')}}"><i class="fa fa-folder"></i> <span class="nav-label">{{trans('admin.categories')}}</span></a>
            </li>
            <li class="{{starts_with(Route::currentRouteName(), 'tags') ? 'active' : null}}">
                <a href="{{route('tags.index')}}"><i class="fa fa-tags"></i> <span class="nav-label">{{trans('admin.tags')}}</span></a>
            </li>
            <li class="{{starts_with(Route::currentRouteName(), 'media') || starts_with(Route::currentRouteName(), 'photos') ? 'active' : null}}">
                <a href="{{route('media.index')}}"><i class="fa fa-picture-o"></i> <span class="nav-label">{{trans('admin.media')}}</span></a>
            </li>
            @if (Auth::user()->role->name == 'administrator')
                <li class="{{starts_with(Route::currentRouteName(), 'users') ? 'active' : null}}">
                    <a href="{{route('photos.index')}}"><i class="fa fa-users"></i>
                        <span class="nav-label">{{trans('admin.users')}}</span>
                        @if (!empty($countOfAllDisapprovedUsers))
                            <span class="label label-warning m-l-sm">{{$countOfAllDisapprovedUsers}}</span>
                        @endif
                        <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="{{Route::is('users.index') ? 'active' : null}}"><a href="{{route('users.index')}}">{{trans('admin.allUsers')}}</a></li>
                        <li class="{{Route::is('users.create') ? 'active' : null}}"><a href="{{route('users.create')}}">{{trans('admin.addUser')}}</a></li>
                        <li class="{{Request::url() == route('users.edit', Auth::user()->id) ? 'active' : null}}"><a href="{{route('users.edit', Auth::user()->id)}}">{{trans('admin.yourProfile')}}</a></li>
                    </ul>
                </li>
            @endif            
            <li>
                <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">{{trans('admin.settings')}}</span></a>
            </li>
        </ul>
    </div>
</nav>
