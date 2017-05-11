<div class="row border-bottom">
    <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="{{trans('admin.searchForSomething')}}..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">{{trans('admin.welcomeToAdminPanel')}}.</span>
            </li>
            {{-- <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <img alt="image" class="img-circle" src="{{Auth::user()->photo ? Auth::user()->photo->sizes->last()->path : null}}">
                            </a>
                            <div class="media-body">
                                <small class="pull-right">46h ago</small>
                                <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <img alt="image" class="img-circle" src="{{Auth::user()->photo ? Auth::user()->photo->sizes->last()->path : null}}">
                            </a>
                            <div class="media-body ">
                                <small class="pull-right text-navy">5h ago</small>
                                <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="dropdown-messages-box">
                            <a href="profile.html" class="pull-left">
                                <img alt="image" class="img-circle" src="{{Auth::user()->photo ? Auth::user()->photo->sizes->last()->path : null}}">
                            </a>
                            <div class="media-body ">
                                <small class="pull-right">23h ago</small>
                                <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="mailbox.html">
                                <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                            </a>
                        </div>
                    </li>
                </ul>
            </li> --}}
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>  <span class="label label-primary">{{$countOfAllDisapprovedAlerts or 0}}</span>
                </a>
                @if (!empty($countOfAllDisapprovedAlerts))
                    <ul class="dropdown-menu dropdown-alerts">
                        @if (!empty($countOfAllDisapprovedPosts))
                            <li>
                                <a href="{{route('posts.index')}}">
                                    <div>
                                        <i class="fa fa-edit m-r-sm"></i> {{trans('admin.unauthorizedPosts')}}:&nbsp;{{$countOfAllDisapprovedPosts or 0}}
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if (!empty($countOfAllDisapprovedComments))
                            <li>
                                <a href="{{route('comments.index')}}">
                                    <div>
                                        <i class="fa fa-comments-o m-r-sm"></i> {{trans('admin.unauthorizedComments')}}:&nbsp;{{$countOfAllDisapprovedComments or 0}}
                                    </div>
                                </a>
                            </li>
                        @endif
                        @if (!empty($countOfAllDisapprovedUsers))
                            <li>
                                <a href="{{route('users.index')}}">
                                    <div>
                                        <i class="fa fa-users m-r-sm"></i> {{trans('admin.unauthorizedUsers')}}:&nbsp;{{$countOfAllDisapprovedUsers or 0}}
                                    </div>
                                </a>
                            </li>
                        @endif
                    </ul>
                @endif
            </li>


            <li>
                <a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> {{trans('admin.logOut')}}
                </a>
                <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                    {{csrf_field()}}
                </form>
            </li>
        </ul>

    </nav>
</div>
