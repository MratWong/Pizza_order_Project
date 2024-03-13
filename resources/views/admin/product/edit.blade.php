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
                            <form action="{{ route('product#update') }} " method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                        <img src="{{ asset('storage/' . $pizza->image) }}"
                                            class=" shadow-sm rounded w-100" />

                                        <div class="my-2">
                                            <input type="file" name="pizzaImage"
                                                class="form-control  @error('pizzaImage') is-invalid @enderror"
                                                id="">
                                            @error('pizzaImage')
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
                                            <input type="text" name="pizzaName"
                                                value="{{ old('pizzaName', $pizza->name) }}"
                                                placeholder="Enter Your pizzaName"
                                                class="mb-2 form-control  @error('pizzaName') is-invalid @enderror">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <label for="">Description</label>
                                            <textarea name="pizzaDescription" class="mb-2 form-control  @error('pizzaDescription') is-invalid @enderror"
                                                placeholder="Enter Your pizzaDescription" cols="30" rows="10">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('pizzaDescription')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <label for="">Pizza Category</label>
                                            <select name="pizzaCategory"
                                                class="form-control  @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose Pizza Category...</option>
                                                @foreach ($category as $c)
                                                    <option value="{{ $c->id }}"
                                                        @if ($pizza->category_id == $c->id) selected @endif>
                                                        {{ $c->name }} </option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <label for="">Price</label>
                                            <input type="number" name="pizzaPrice"
                                                value="{{ old('pizzaPrice', $pizza->price) }}"
                                                placeholder="Enter Your pizzaPrice"
                                                class="mb-2 form-control  @error('pizzaPrice') is-invalid @enderror">
                                            @error('pizzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="">
                                            <label for="">Waiting Time</label>
                                            <input type="number" name="pizzaWaitingTime"
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}"
                                                placeholder="Enter Your pizzaWaitingTime"
                                                class="mb-2 form-control  @error('pizzaWaitingTime') is-invalid @enderror">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="">
                                            <label for="">View Count</label>
                                            <input type="text" class="mb-2 form-control"
                                                value="{{ old('viewCount', $pizza->view_count) }}" name="viewCount"
                                                disabled>
                                        </div>

                                        <div class="">
                                            <label for="">Created Date</label>
                                            <input type="text" class="mb-2 form-control"
                                                value="{{ $pizza->created_at->format('j-F-Y') }}" name="createdAt"
                                                disabled>
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
