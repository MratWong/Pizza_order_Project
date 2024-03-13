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
                            <form action="{{ route('admin#updateAddress', Auth::user()->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col">
                                                @if (Auth::user()->image == null)
                                                    <img class="rounded" src="{{ asset('image/default_user.jpg') }}" />
                                                @else
                                                    <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}" />
                                                @endif
                                            </div>
                                            <div class="col ms-2">
                                                <h4 class='py-4'>Name</h4>
                                                <h4 class='py-4'>Email</h4>
                                                <h4 class='py-4'>Phone</h4>
                                                <h4 class='py-4'>Gender</h4>
                                                <h4 class='py-4'>Address</h4>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-6 ">
                                                <h4 class='py-4'> {{ Auth::user()->name }} </h4>
                                            </div>
                                            <div class="col-3 text-end offset-3">
                                                <a href=" {{ route('admin#editName') }} " class="py-4">
                                                    <i class="fa-solid fa-pen me-2"></i> <span>Edit</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 ">
                                                <h4 class='py-4'> {{ Auth::user()->email }} </h4>
                                            </div>
                                            <div class="col-3 text-end offset-3">
                                                <a href=" {{ route('admin#editEmail') }} " class="py-4">
                                                    <i class="fa-solid fa-pen me-2"></i> <span>Edit</span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 ">
                                                <h4 class='py-4'> {{ Auth::user()->phone }} </h4>
                                            </div>
                                            <div class="col-3 text-end offset-3">
                                                <a href=" {{ route('admin#editPhone') }} " class="py-4">
                                                    <i class="fa-solid fa-pen me-2"></i> <span>Edit</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6 ">
                                                <h4 class='py-4'> {{ Auth::user()->gender }} </h4>
                                            </div>
                                            <div class="col-3 text-end offset-3">
                                                <a href=" {{ route('admin#editGender') }} " class="py-4">
                                                    <i class="fa-solid fa-pen me-2"></i> <span>Edit</span>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="row ">
                                            <div class="col-7">
                                                <label for="">Address</label>
                                                <textarea name="address" class="mb-2 form-control @error('address') is-invalid @enderror"
                                                    placeholder="Enter Your Address" cols="30" rows="10">{{ old('address', Auth::user()->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 text-end offset-7 ">
                                                <div class="d-flex align-bottom">
                                                    <a href="">
                                                        <button type="submit" class="btn btn-primary ">Save</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
