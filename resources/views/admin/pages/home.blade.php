@extends('admin.layouts.admin')
@section('content')

    {{-- Breadcrumbs --}}
    @include('admin.includes.breadcrumbs')

    {{-- Back to previous page --}}
    @include('admin.includes.backToPreviousPage')

    {{-- Home Page --}}
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">

            {{-- Right column - about admin panel. --}}
            <div class="col-md-3 col-md-offset-9">

                {{-- Update info --}}
                <div class="widget style1 lazur-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-wrench fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> {{trans('admin.lastUpdate')}} </span>

                            <h2 class="font-bold">09.02.2017</h2>
                        </div>
                    </div>
                </div>

                {{-- About Admin Panel --}}
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Sealan. <small class="m-l-sm">{{trans('admin.adminPanel')}}</small></h5>
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
                        <h2>{{trans('admin.aboutAuthor')}}</h2>
                        <p>{{trans('admin.aboutAuthorInfo')}}</p>
                    </div>
                    <div class="ibox-footer">
                        <span class="pull-right">
                            <a href="mailto:kontakt@sealan.pl">kontakt@sealan.pl</a>
                        </span>
                        <a href="http://www.sealan.pl">www.sealan.pl</a>
                    </div>
                </div>

                {{-- Support --}}
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>{{trans('admin.support')}}</h5>
                    </div>
                    <div class="ibox-content text-center">

                        <h3><i class="fa fa-phone"></i> +48 793 488 321</h3>
                        <span class="small">
                            {{trans('admin.supportInfo')}}
                        </span>


                    </div>
                </div>

                {{-- Contact Us --}}
                <div class="ibox">
                    <div class="ibox-content">
                        <h3>{{trans('admin.sendToUs')}}</h3>

                        <p class="small">
                            {{trans('admin.sendToSupportInfo')}}
                        </p>

                        <div class="form-group">
                            <label>{{trans('admin.subject')}}</label>
                            <input type="email" class="form-control" placeholder="{{trans('admin.messageSubject')}}">
                        </div>
                        <div class="form-group">
                            <label>{{trans('admin.message')}}</label>
                            <textarea class="form-control" placeholder="{{trans('admin.yourMessage')}}" rows="3"></textarea>
                        </div>
                        <button class="btn btn-info btn-block">{{trans('admin.send')}}</button>

                    </div>
                </div>

            </div>

        </div>
    </div>

@endsection
