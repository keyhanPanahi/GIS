@extends('admin.layouts.master')

@section('title','ایجاد مکان')

@section('vendor-css')
    <!-- form-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.css') }}">

    <!-- select2-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/select2/select2.css') }}">

    <!-- tagify-->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/tagify/tagify.css') }}">

    <!--map -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/leaflet/leaflet.css') }}"/>

@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.dashboard') }}">داشبورد</a></li>
            <li class="breadcrumb-item"><a class="text-primary" href="{{ route('admin.place.index') }}">فهرست مکان
                    ها</a></li>
            <li class="breadcrumb-item active">ایجاد مکان</li>
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
                        <span class="bs-stepper-subtitle">افزودن اطلاعات مالک</span>
                      </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#personal-info">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">2</span>
                            <span class="bs-stepper-label">
                        <span class="bs-stepper-title">اطلاعات مکان</span>
                        <span class="bs-stepper-subtitle">افزودن اطلاعات مکان</span>
                      </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#more-info">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">3</span>
                            <span class="bs-stepper-label">
                        <span class="bs-stepper-title">اطلاعات بیشتر مکان</span>
                        <span class="bs-stepper-subtitle">افزودن اطلاعات بیشتر مکان</span>
                      </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#avatar">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">4</span>
                            <span class="bs-stepper-label">
                        <span class="bs-stepper-title">اطلاعات نقشه</span>
                        <span class="bs-stepper-subtitle">افزودن مکان برروی نقشه</span>
                      </span>
                        </button>
                    </div>
                    <div class="line"></div>
                    <div class="step" data-target="#roles">
                        <button type="button" class="step-trigger" aria-selected="false">
                            <span class="bs-stepper-circle">5</span>
                            <span class="bs-stepper-label">
                        <span class="bs-stepper-title">فایل</span>
                        <span class="bs-stepper-subtitle">افزودن فایل</span>
                      </span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <form action="{{ route('admin.place.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Account Details -->
                        <div id="account-details" class="content active dstepper-block">
                            <div class="content-header mb-3">
                                <h6 class="mb-1">اطلاعات مالک</h6>
                                <small> اطلاعات مالک وارد کنید.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="owner_fname">نام مالک</label>
                                    <input type="text" name="owner_fname" id="owner_fname"
                                           value="{{ old('owner_fname') }}" class="form-control text-start" dir="ltr"
                                           placeholder="رضا">
                                    <div class="mt-1">
                                        @error('owner_fname')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="owner_lname">نام خانوادگی مالک</label>
                                    <input type="text" name="owner_lname" id="owner_lname"
                                           value="{{ old('owner_lname') }}" class="form-control text-start" dir="ltr"
                                           placeholder="رضایی">
                                    <div class="mt-1">
                                        @error('owner_lname')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="owner_nationalcode">کدملی مالک</label>
                                    <input type="text" name="owner_nationalcode" id="owner_nationalcode"
                                           value="{{ old('owner_nationalcode') }}" class="form-control text-start"
                                           dir="ltr" placeholder="0640832145">
                                    <div class="mt-1">
                                        @error('owner_nationalcode')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
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
                                <small>اطلاعات مکان را وارد کنید.</small>
                            </div>
                            <div class="row g-3">


                                <div class="col-sm-6">
                                    <label for="state_id" class="form-label">استان</label>
                                    <select id="state_id" name="state_id" class="form-select select2">
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}"
                                                    @if(old('state_id') == $state->id) selected @endif>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="mt-1">
                                        @error('state_id')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="city_id" class="form-label">شهرستان</label>
                                    <select id="city_id" name="city_id" class="form-select select2"></select>
                                    <div class="mt-1">
                                        @error('city_id')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="address">خیابان اصلی</label>
                                    <input type="text" name="address[0]" id="address" value="{{ old('address[0]') }}"
                                           class="form-control" placeholder=" خیابان مدرس">
                                    <div class="mt-1">
                                        @error('address')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="address">خیابان فرعی</label>
                                    <input type="text" name="address[1]" id="address" value="{{ old('address[1]') }}"
                                           class="form-control" placeholder=" خیابان مرتضوی">
                                    <div class="mt-1">
                                        @error('address')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="address">کوچه</label>
                                    <input type="text" name="address[2]" id="address" value="{{ old('address[2]') }}"
                                           class="form-control" placeholder="مرتضوی 5">
                                    <div class="mt-1">
                                        @error('address')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="address">طبقه</label>
                                    <input type="number" name="address[3]" id="address" value="{{ old('address[3]') }}"
                                           class="form-control" placeholder="2">
                                    <div class="mt-1">
                                        @error('address')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="address">واحد</label>
                                    <input type="number" name="address[4]" id="address" value="{{ old('address[4]') }}"
                                           class="form-control" placeholder="2">
                                    <div class="mt-1">
                                        @error('address')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="address">پلاک</label>
                                    <input type="number" name="address[5]" id="address" value="{{ old('address[5]') }}"
                                           class="form-control" placeholder="13">
                                    <div class="mt-1">
                                        @error('address')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <label class="form-label" for="postal_code">کد پستی</label>
                                    <input type="text" name="postal_code" id="postal_code"
                                           value="{{ old('postal_code') }}" class="form-control"
                                           placeholder="9719852635">
                                    <div class="mt-1">
                                        @error('postal_code')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
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
                                <small>اطلاعات بیشتر مکان را وارد کنید.</small>
                            </div>

                            <div class="row g-3">

                                <div class="col-sm-6">
                                    <label class="form-label" for="water_counter_number">شماره کنتور آب</label>
                                    <input type="text" name="water_counter_number" id="water_counter_number"
                                           value="{{ old('water_counter_number') }}" class="form-control"
                                           placeholder="0123456789123">
                                    <div class="mt-1">
                                        @error('water_counter_number')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="electric_counter_number">شماره کنتور برق</label>
                                    <input type="text" name="electric_counter_number" id="electric_counter_number"
                                           value="{{ old('electric_counter_number') }}" class="form-control"
                                           placeholder="0123456789123">
                                    <div class="mt-1">
                                        @error('electric_counter_number')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-label" for="gas_counter_number">شماره کنتور گاز</label>
                                    <input type="text" name="gas_counter_number" id="gas_counter_number"
                                           value="{{ old('gas_counter_number') }}" class="form-control"
                                           placeholder="0123456789123">
                                    <div class="mt-1">
                                        @error('gas_counter_number')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="usage_type_id" class="form-label">نوع کاربری</label>
                                    <select id="usage_type_id" name="usage_type_id" class="form-select">
                                        @foreach ($UsageTypes as $UsageType) --}}
                                        <option value="{{ $UsageType->id }}">{{ $UsageType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label for="TagifyBasic" class="form-label">شماره تلفن</label>
                                    <input id="TagifyBasic" class="form-control" name="phone[]"
                                           placeholder="09151515015">
                                    <div class="mt-1">
                                        @error('phone[]')
                                        <span class="text-danger">* {{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="property_type_id" class="form-label">نوع ملک</label>
                                    <select id="property_type_id" name="property_type_id" class="form-select">
                                        @foreach ($PropertyTypes as $PropertyType)
                                            <option value="{{ $PropertyType->id }}">{{ $PropertyType->name }}</option>
                                        @endforeach
                                    </select>
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
                                <small>مکان را برروی نقشه انتخاب کنید.</small>
                            </div>

                            <div class="row g-3">
                                <div class="col-6 d-flex justify-content-between">
                                    <input type="text" name="point" id="point" value=""
                                           class="form-control">
                                </div>

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
                                <small>فایل های مربوط به مکان را وارد کنید.</small>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-6 mb-3">

                                    <label for="formFileMultiple" class="form-label">فایل های مربوط به مکان</label>
                                    <input class="form-control" type="file" name="file[]" id="formFileMultiple"
                                           multiple>
                                </div>

                                <div class="col-12 d-flex justify-content-between" style="margin-top: 40px">
                                    <button type="button" class="btn btn-primary btn-prev">
                                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                        <span class="d-sm-inline-block d-none">قبلی</span>
                                    </button>
                                    <button type="submit" class="btn btn-success">ثبت</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-js')
    <!-- form-->
    <script src="{{ asset('admin-assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('admin-assets/js/form-wizard-numbered.js') }}"></script>

    <!-- select2-->
    <script src="{{ asset('admin-assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/select2/i18n/fa.js') }}"></script>
    <!-- tagify-->
    <script src="{{ asset('admin-assets/vendor/libs/tagify/tagify.js') }}"></script>

@endsection

@section('page-js')
    <!-- select2 -->
    <script src="{{ asset('admin-assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('admin-assets/js/forms-tagify.js') }}"></script>

    <!--map -->
    <script src="{{ asset('admin-assets/vendor/libs/leaflet/leaflet.js') }}"></script>
    <script>

        const map = L.map('map').setView([32.844799, 59.217939], 17);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        const popup = L.popup();


        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent(` شما این نقطه را انتخاب کردید`)
                .openOn(map);
            let selectPoint = `${e.latlng.toString()}`;
            document.getElementById("point").setAttribute('value', selectPoint);
        }

        map.on('click', onMapClick);

    </script>



    <script>

        // Get Cities Ajax
        const state = $('#state_id');
        const city = $('#city_id');
        const GetCity = function () {
            $.ajax({
                url: '{{ route('admin.select.selectCities') }}',
                method: 'get',
                data: {
                    state_id: state.val(),
                },
                success: function (response) {
                    city.empty();
                    const html = response.map(res => `<option value="${res.id}" ${res.is_center == 1 ? 'selected' : ''}>${res.name}</option>`);
                    city.append(html);
                }
            });
        };
        GetCity();
        state.change(GetCity);
    </script>


@endsection
