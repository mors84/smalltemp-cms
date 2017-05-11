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
                        <h5>{{trans('admin.companies')}} ({{$companies->total()}})</h5>
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
                                        <th>{{trans('tables.nip')}}</th>
                                        <th>{{trans('tables.name')}}</th>
                                        <th>{{trans('tables.address')}}</th>
                                        <th>{{trans('tables.post_code')}}</th>
                                        <th>{{trans('tables.city')}}</th>
                                        <th>{{trans('tables.country')}}</th>
                                        <th>{{trans('tables.email')}}</th>
                                        <th>{{trans('tables.created_at')}}</th>
                                        <th>{{trans('tables.updated_at')}}</th>
                                        <th class="text-right">{{trans('admin.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($companies as $company)
                                        <tr>
                                            <td>

                                                {{-- ID --}}
                                                {{$company->id or null}}

                                            </td>
                                            <td>

                                                {{-- NIP --}}
                                                {{$company->nip or null}}

                                            </td>
                                            <td>

                                                {{-- Name --}}
                                                {{$company->name or null}}

                                            </td>
                                            <td>

                                                {{-- Address --}}
                                                {{$company->address or null}}

                                            </td>
                                            <td>

                                                {{-- Post Code --}}
                                                {{$company->post_code or null}}

                                            </td>
                                            <td>

                                                {{-- City --}}
                                                {{$company->city or null}}

                                            </td>
                                            <td>

                                                {{-- Country --}}
                                                {{$company->country or null}}

                                            </td>
                                            <td>

                                                {{-- Email --}}
                                                {{$company->email or null}}

                                            </td>
                                            <td>

                                                {{-- Created at --}}
                                                {{$company->created_at->diffForHumans()}}

                                            </td>
                                            <td>

                                                {{-- Updated at --}}
                                                {{$company->updated_at->diffForHumans()}}

                                            </td>
                                            <td class="text-right">

                                                {{-- Active --}}
                                                <div class="btn-group">

                                                    {{-- Edit button --}}
                                                    <a href="{{route('companies.edit', $company->id)}}" class="btn-white btn btn-xs">{{trans('admin.edit')}}</a>

                                                    {{-- Delete button --}}
                                                    <form action="{{action('CompanyController@destroy', $company->id)}}" method="POST" class="btn-group">
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
                                            {{$companies->links('admin.includes.pagination')}}

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
