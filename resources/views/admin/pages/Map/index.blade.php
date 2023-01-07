@extends('admin.layouts.master')

@section('title','مکان ها - فهرست مکان ها')

@section('vendor-css')
    <!-- data table -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
@endsection

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
        <li class="breadcrumb-item active">فهرست مکان ها</li>
    </ol>

    <form action="{{ route('admin.place.destroy') }}" method="POST">
        @csrf

        <div class="d-flex justify-content-between">
            <div class="pt-2">
                <a href="{{ route('admin.place.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> ایجاد مکان</a>
                <a href="{{ route('admin.place.showMap') }}" class="btn btn-warning"><i class="bx bxs-map-alt"></i> دیدن رو نقشه</a>
            </div>

            <div class="p-2">
                <button type="button" class="btn btn-label-danger float-end delete-confirm" data-route="{{ route('admin.place.destroy') }}" data-word="حذف"
                        data-bs-toggle="tooltip"  data-bs-placement="top" data-color="danger" title="حذف"><i class="bx bx-trash"></i></button>

                <button type="button" class="btn btn-label-secondary float-end me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" title="تغییر وضعیت">
                    <i class="bx bx-toggle-right"></i>
                </button>

                <ul class="dropdown-menu">
                    <li><button type="button" class="dropdown-item" id="active" data-route="{{ route('admin.place.status') }}" data-word="تغییر وضعیت">اصلاحی</button></li>
                    <li><button type="button" class="dropdown-item" id="deactive" data-route="{{ route('admin.place.status') }}" data-word="تغییر وضعیت">تایید شده</button></li>
                </ul>
            </div>

        </div>

        <div class="card mt-3">
            <div class="card-body">
                <table class="table table-hover table-striped text-center" id="myTable">
                    <thead>
                    <tr>
                        <th>نام مالک</th>
                        <th>نام خانوادگی مالک</th>
                        <th>آدرس پستی</th>
                        <th>وضعیت</th>
                        <th>نوع ملک</th>
                        <th>نوع کاربری</th>
                        <th>عملیات</th>
                        <th>
                            <label class="form-check-label m-1" for="checkAll">
                                <input class="form-check-input" type="checkbox" id="checkAll" data-bs-toggle="tooltip"  data-bs-placement="top" data-color="primary" title="انتخاب همه">
                            </label>
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </form>
@endsection

@section('vendor-js')
    <!-- data table-->
    <script src="{{ asset('admin-assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables/i18n/fa.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
@endsection

@section('page-js')
    <!-- DataTable-->
    <script>
        $(function () {
            var table = $('#myTable').DataTable({
                "aoColumnDefs": [
                    { "bSortable": false, "aTargets": [ 2,6,7 ] },
                    { "bSearchable": false, "aTargets": [ 4,5,6,7 ] }
                ],
                pageLength: 10,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('admin.place.getPlace') }}',
                columns: [
                    { data: 'owner_fname', name: 'owner_fname'},
                    { data: 'owner_lname', name: 'owner_lname'},
                    { data: 'postal_address', name: 'postal_address'},
                    { data: 'place_status_id', name: 'place_status_id'},
                    { data: 'property_type_id', name: 'property_type_id'},
                    { data: 'usage_type_id', name: 'usage_type_id'},
                    { data: 'action', name: 'action'},
                    { data: 'select', name: 'select'},
                ],
            });
        });
    </script>

    @include('components.index-scripts')
@endsection
