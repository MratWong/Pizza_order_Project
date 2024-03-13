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
                            <form action=" {{ route('admin#updateProfile', Auth::user()->id) }} " method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1 ">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                                <img src="{{ asset('image/profile_male.png') }}"
                                                    class="rounded shadow-sm w-100" />
                                            @else
                                                <img src="{{ asset('image/profile_female.png') }}"
                                                    class="rounded shadow-sm w-100" />
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class=" shadow-sm rounded w-100" />
                                        @endif

                                        <div class="my-2">
                                            <input type="file" name="image"
                                                class="form-control  @error('image') is-invalid @enderror" id="">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <button type="submit" class="btn bg-dark col-12 text-white">Update</button>
                                        </div>
                                    </div>

                                    <div class="col-6 ">
                                        <div class="">
                                            <label for="">Name</label>
                                            <input type="text" name="name"
                                                value="{{ old('name', Auth::user()->name) }}" placeholder="Enter Your Name"
                                                class="mb-2 form-control  @error('name') is-invalid @enderror">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="">Email</label>
                                            <input type="text" name="email"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                placeholder="Enter Your Email"
                                                class="mb-2 form-control  @error('email') is-invalid @enderror">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="">Phone</label>
                                            <input type="number" name="phone"
                                                value="{{ old('phone', Auth::user()->phone) }}"
                                                placeholder="Enter Your Phone"
                                                class="mb-2 form-control  @error('phone') is-invalid @enderror">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="">Gender</label>
                                            <select name="gender"
                                                class="form-control  @error('gender') is-invalid @enderror">
                                                <option value="">Choose Gender...</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="">Address</label>
                                            <textarea name="address" class="mb-2 form-control  @error('address') is-invalid @enderror"
                                                placeholder="Enter Your Address" cols="30" rows="10">{{ old('address', Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="">Role</label>
                                            <input type="text" class="mb-2 form-control"
                                                value="{{ old('role', Auth::user()->role) }}" name="role" disabled>
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
