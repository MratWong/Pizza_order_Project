@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>

                            <hr>
                            <div class="row">
                                <div class="col-3">
                                    @if (Auth::user()->image == null)
                                        @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/profile_male.png') }}" class="rounded shadow-sm" />
                                        @else
                                            <img src="{{ asset('image/profile_female.png') }}" class="rounded shadow-sm" />
                                        @endif
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="rounded shadow-sm" />
                                    @endif

                                </div>
                                <div class="col-2 ">
                                    <h4 class='mb-5'>Name</h4>
                                    <h4 class='mb-5'>Email</h4>
                                    <h4 class='mb-5'>Phone</h4>
                                    <h4 class='mb-5'>Address</h4>
                                    <h4 class='mb-5'>Gender</h4>


                                </div>
                                <div class="col-5 ">
                                    <h4 class='mb-5'> {{ Auth::user()->name }} </h4>
                                    <h4 class='mb-5'> {{ Auth::user()->email }} </h4>
                                    <h4 class='mb-5'> {{ Auth::user()->phone }} </h4>
                                    <h4 class='mb-5'> {{ Auth::user()->address }} </h4>
                                    <h4 class='mb-5'> {{ Auth::user()->gender }} </h4>
                                </div>
                                <div class="col-2  text-end ">
                                    <div class="mb-5">
                                        <a href=" {{ route('admin#editName') }} ">
                                            <i class="fa-solid fa-pen me-2"></i> <span>Edit</span>
                                        </a>
                                    </div>
                                    <div class="mb-5">
                                        <a href=" {{ route('admin#editEmail') }} ">
                                            <i class="fa-solid fa-pen me-2"></i> <span>Edit</span>
                                        </a>
                                    </div>
                                    <div class="mb-5">
                                        <a href="{{ route('admin#editPhone') }}">
                                            <i class="fa-solid fa-pen me-2"></i> <span>Edit</span>
                                        </a>
                                    </div>
                                    <div class="mb-5">
                                        <a href="{{ route('admin#editAddress') }}">
                                            <i class="fa-solid fa-pen me-2"></i> <span>Edit</span>
                                        </a>
                                    </div>
                                    <div class="mb-5">
                                        <a href="{{ route('admin#editGender') }}">
                                            <i class="fa-solid fa-pen me-2"></i> <span>Edit</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <a href=" {{ route('admin#editProfile') }} ">
                                    <div class="col-3 offset-4 btn text-center bg-primary text-white my-3">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
