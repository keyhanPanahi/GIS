@extends('admin.layouts.master')

@section('title','مشاهده مکان')

@section('vendor-css')
    <!-- form-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.css') }}">
    <!-- tagify-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/tagify/tagify.css') }}">
    <!-- map-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/leaflet/leaflet.css') }}"/>

@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.place.index') }}">فهرست مکان
                    ها</a></li>
            <li class="breadcrumb-item active">مشاهده مکان</li>
        </ol>
    </nav>

    <div class="row mt-3">
        <div class="col-12 mb-4">
            <div class="bs-stepper wizard-numbered mt-2">
                <div class="bs-stepper-header">
                    <div class="step active" data-target="#account-details">
                        <button type="button" class="step-trigger" aria-selected="true">
                            <span class="bs-stepper-circle">1</span>
                            <span class="bs-stepper-label">
                        <span class="bs-stepper-title">اطلاعات مالک</span>
                        <span class="bs-stepper-subtitle">مشاهده اطلاعات مالک</span>
                      </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#personal-info">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">
                        <span class="bs-stepper-title">اطلاعات مکان</span>
                        <span class="bs-stepper-subtitle">مشاهده اطلاعات مکان</span>
                      </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#more-info">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label">
                        <span class="bs-stepper-title">اطلاعات بیشتر مکان</span>
                        <span class="bs-stepper-subtitle">مشاهده اطلاعات بیشتر مکان</span>
                      </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#avatar">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">4</span>
                            <span class="bs-stepper-label">
                        <span class="bs-stepper-title">اطلاعات نقشه</span>
                        <span class="bs-stepper-subtitle">مشاهده مکان برروی نقشه</span>
                      </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#roles">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">5</span>
                            <span class="bs-stepper-label">
                        <span class="bs-stepper-title">فایل</span>
                        <span class="bs-stepper-subtitle">مشاهده فایل</span>
                      </span>
                        </button>
                    </div>
                </div>

                <div class="bs-stepper-content">

                    <div id="account-details" class="content active dstepper-block">
                        <div class="content-header mb-3">
                            <h6 class="mb-1">اطلاعات مالک</h6>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label" for="owner_fname">نام مالک</label>
                                <input type="text" name="owner_fname" id="owner_fname"
                                       value="{{ $place->owner_fname }}" class="form-control text-start" dir="ltr" disabled>

                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="owner_lname">نام خانوادگی مالک</label>
                                <input type="text" name="owner_lname" id="owner_lname"
                                       value="{{ $place->owner_lname }}" class="form-control text-start" dir="ltr" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="owner_nationalcode">کدملی مالک</label>
                                <input type="text" name="owner_nationalcode" id="owner_nationalcode"
                                       value="{{ $place->owner_nationalcode }}" class="form-control text-start" dir="ltr" disabled>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-label-secondary btn-prev" disabled="">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="d-sm-inline-block d-none">قبلی</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-next">
                                    <span class="d-sm-inline-block d-none">بعدی</span>
                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Info -->
                    <div id="personal-info" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-1">اطلاعات مکان</h6>
                        </div>
                        <div class="row g-3">


                            <div class="col-sm-6">
                                <label for="state_id" class="form-label">استان</label>
                                <input type="text"  class="form-control text-start" value="{{ $place->postal_address[0] ?? '-' }}" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label for="city_id" class="form-label">شهرستان</label>
                                <input type="text" class="form-control text-start" value="{{ $place->postal_address[1] ?? '-' }}" disabled>

                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="address">خیابان اصلی</label>
                                <input type="text" class="form-control text-start" value="{{ $place->postal_address[2] ?? '-' }}" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="address">خیابان فرعی</label>
                                <input type="text" class="form-control text-start" value="{{ $place->postal_address[3] ?? '-' }}" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="address">کوچه</label>
                                <input type="text" class="form-control text-start" value="{{ $place->postal_address[4] ?? '-' }}" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="address">طبقه</label>
                                <input type="number" class="form-control text-start"  value="{{ $place->postal_address[5] ?? '-' }}" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="address">واحد</label>
                                <input type="number" class="form-control text-start" value="{{ $place->postal_address[6] ?? '-' }}" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="address">پلاک</label>
                                <input type="number" class="form-control text-start" value="{{ $place->postal_address[7] ?? '-' }}" disabled>
                            </div>


                            <div class="col-sm-6">
                                <label class="form-label" for="postal_code">کد پستی</label>
                                <input type="text" name="postal_code" id="postal_code"
                                       value="{{ $place->postal_code }}" class="form-control" disabled>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary btn-prev">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="d-sm-inline-block d-none">قبلی</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-next">
                                    <span class="d-sm-inline-block d-none">بعدی</span>
                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="more-info" class="content">

                        <div class="content-header mb-3">
                            <h6 class="mb-1">اطلاعات بیشتر مکان</h6>
                        </div>

                        <div class="row g-3">

                            <div class="col-sm-6">
                                <label class="form-label" for="water_counter_number">شماره کنتور آب</label>
                                <input type="text" name="water_counter_number" id="water_counter_number"
                                       value="{{ $place->water_counter_number ?? '-' }}" class="form-control" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="electric_counter_number">شماره کنتور برق</label>
                                <input type="text" name="electric_counter_number" id="electric_counter_number"
                                       value="{{ $place->electric_counter_number ?? '-' }}" class="form-control" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label" for="gas_counter_number">شماره کنتور گاز</label>
                                <input type="text" name="gas_counter_number" id="gas_counter_number"
                                       value="{{ $place->gas_counter_number ?? '-' }}" class="form-control" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label for="usage_type_id" class="form-label">نوع کاربری</label>
                                <input type="text" value="@if($place->usage_type_id == 1)مسکونی @elseif($place->usage_type_id == 2)تجاری @elseاداری @endif " class="form-control" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label for="TagifyBasic" class="form-label">شماره تلفن</label>
                                <input id="TagifyBasic" class="form-control" value="@foreach(json_decode($place->phone[0], true) as $phone){{ implode($phone).'  ' }}@endforeach" disabled>
                            </div>

                            <div class="col-sm-6">
                                <label for="property_type_id" class="form-label">نوع ملک</label>
                                <input type="text" value="@if($place->property_type_id == 1)زمین @elseif($place->property_type_id == 2)ساختمان @elseمجتمع @endif " class="form-control" disabled>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary btn-prev">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="d-sm-inline-block d-none">قبلی</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-next">
                                    <span class="d-sm-inline-block d-none">بعدی</span>
                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Organizatin and Avatar-->
                    <div id="avatar" class="content">

                        <div class="content-header mb-3">
                            <h6 class="mb-1">اطلاعات نقشه</h6>
                        </div>


                        <div class="row g-3">

                            <div class="col-md-12 mb-3" data-select2-id="45">
                                <div id="map" style="height: 400px; border-radius: 15px;"></div>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary btn-prev">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="d-sm-inline-block d-none">قبلی</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-next">
                                    <span class="d-sm-inline-block d-none">بعدی</span>
                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="roles" class="content">
                        <div class="content-header mb-3">
                            <h6 class="mb-1">فایل</h6>
                        </div>
                        <div class="row g-3">


                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary btn-prev">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="d-sm-inline-block d-none">قبلی</span>
                                </button>
                                <a href="{{ route('admin.place.index') }}" class="btn btn-secondary"> <i class="bx bx-exit bx-sm ms-sm-n2"></i> بازگشت</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    <!-- form-->
    <script src="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('admin-assets/js/form-wizard-numbered.js') }}"></script>
    <script src="{{ asset('admin-assets/js/forms-tagify.js') }}"></script>


    <script src="{{ asset('admin-assets/vendor/libs/leaflet/leaflet.js') }}"></script>
    <script>

        const map = L.map('map').setView([{{$place->point}}], 14);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);


    </script>


        <script>
            L.marker([{{$place->point}}]).addTo(map);

        </script>

@endsection
