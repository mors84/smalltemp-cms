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
                        <h5>{{trans('admin.employees')}} ({{$employees->total()}})</h5>
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
                                        <th>{{trans('tables.first_name')}}</th>
                                        <th>{{trans('tables.last_name')}}</th>
                                        <th>{{trans('tables.email')}}</th>
                                        <th>{{trans('tables.phone')}}</th>
                                        <th>{{trans('tables.mobilePhone')}}</th>
                                        <th>{{trans('tables.company')}}</th>
                                        <th>{{trans('tables.created_at')}}</th>
                                        <th>{{trans('tables.updated_at')}}</th>
                                        <th class="text-right">{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>

                                                {{-- ID --}}
                                                {{$employee->id or null}}

                                            </td>
                                            <td>

                                                {{-- First Name --}}
                                                {{$employee->first_name or null}}

                                            </td>
                                            <td>

                                                {{-- Last Name --}}
                                                {{$employee->last_name or null}}

                                            </td>
                                            <td>

                                                {{-- Email --}}
                                                {{$employee->email or null}}

                                            </td>
                                            <td>

                                                {{-- Phone --}}
                                                {{$employee->phone or null}}

                                            </td>
                                            <td>

                                                {{-- Cell Phone --}}
                                                {{$employee->cell_phone or null}}

                                            </td>
                                            <td>

                                                {{-- Company --}}
                                                {{$employee->company->name or null}}

                                            </td>
                                            <td>

                                                {{-- Created at --}}
                                                {{$employee->created_at->diffForHumans()}}

                                            </td>
                                            <td>

                                                {{-- Updated at --}}
                                                {{$employee->updated_at->diffForHumans()}}

                                            </td>
                                            <td class="text-right">

                                                {{-- Active --}}
                                                <div class="btn-group">

                                                    {{-- Edit button --}}
                                                    <a href="{{route('employees.edit', $employee->id)}}" class="btn-white btn btn-xs">{{trans('admin.edit')}}</a>

                                                    {{-- Delete button --}}
                                                    <form action="{{action('EmployeeController@destroy', $employee->id)}}" method="POST" class="btn-group">
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
                                            {{$employees->links('admin.includes.pagination')}}

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
