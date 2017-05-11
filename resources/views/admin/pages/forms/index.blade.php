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
                        <h5>{{trans('admin.forms')}} ({{$forms->total()}})</h5>
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
                                        <th>{{trans('tables.content')}}</th>
                                        <th>{{trans('tables.employee')}}</th>
                                        <th>{{trans('tables.company')}}</th>
                                        <th>{{trans('tables.created_at')}}</th>
                                        <th class="text-right">{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($forms as $form)
                                        <tr>
                                            <td>

                                                {{-- ID --}}
                                                {{$form->id or null}}

                                            </td>
                                            <td>

                                                {{-- Content --}}
                                                <a href="{{route('forms.show', $form->id)}}">{{$form->content or null}}</a>

                                            </td>
                                            <td>

                                                {{-- Employee --}}
                                                <a href="{{route('employees.show', $form->employee->id)}}">{{$form->employee->first_name or null}} {{$form->employee->last_name or null}}</a>

                                            </td>
                                            <td>

                                                {{-- Company --}}
                                                {{$form->company->name or null}}

                                            </td>
                                            <td>

                                                {{-- Created at --}}
                                                {{$form->created_at->diffForHumans()}}

                                            </td>
                                            <td class="text-right">

                                                {{-- Active --}}
                                                <div class="btn-group">

                                                    {{-- Show button --}}
                                                    <a href="{{route('forms.show', $form->id)}}" class="btn-white btn btn-xs">{{trans('admin.show')}}</a>

                                                    {{-- Delete button --}}
                                                    <form action="{{action('FormController@destroy', $form->id)}}" method="POST" class="btn-group">
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
                                        <td colspan="11">

                                            {{-- Pagination --}}
                                            {{$forms->links('admin.includes.pagination')}}

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
    @include('admin.includes.notificationStatus');

@endsection
