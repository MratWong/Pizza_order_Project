@extends('user.layouts.master')

@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">

                        <div class="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Your Password</h3>
                                    </div>

                                    @if (session('changeSuccess'))
                                        <div class="col-12">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <i
                                                    class="fa-regular fa-circle-check me-2"></i><strong>{{ session('changeSuccess') }}</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                    @if (session('notMatch'))
                                        <div class="col-12">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <i
                                                    class="fa-solid fa-triangle-exclamation me-3 fs-3"></i><strong>{{ session('notMatch') }}</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

                                    <hr>
                                    <form action="{{ route('user#passwordChange') }}" method="post" class=" "
                                        novalidate="novalidate">
                                        @csrf
                                        <div class="form-group my-3">
                                            <label class="control-label mb-1">Old Password</label>
                                            <input id="cc-payment" name="oldPassword" type="password"
                                                class="form-control  @error('oldPassword') is-invalid @enderror "aria-required="true"
                                                aria-invalid="false" placeholder="Enter Old Password">
                                            @error('oldPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group my-3">
                                            <label class="control-label mb-1">New Password</label>
                                            <input id="cc-payment" name="newPassword" type="password"
                                                class="form-control @error('newPassword') is-invalid @enderror "
                                                aria-required="true" aria-invalid="false" placeholder="Enter New Password">
                                            @error('newPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="form-group my-3">
                                            <label class="control-label mb-1">Confirm Passowrd</label>
                                            <input id="cc-payment" name="confirmPassword" type="password"
                                                class="form-control @error('confirmPassword') is-invalid @enderror "
                                                aria-required="true" aria-invalid="false"
                                                placeholder="Enter Confirm Password">
                                            @error('confirmPassword')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="d-flex justify-content-center">
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-info btn-block my-3  ">
                                                <i class="fa-solid fa-key me-2"></i> <span id="payment-button-amount">Change
                                                    Password</span>
                                                {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                                {{-- <i class="fa-solid fa-circle-right"></i> --}}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
        </div>
    </div>
@endsection
