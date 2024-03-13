@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Your Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#create') }}" method="post" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-payment" name="pizzaName" type="text"
                                        value="{{ old('pizzaName') }}"class="form-control @error('pizzaName') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Pizza Name...">
                                    @error('pizzaName')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="pizzaCategory"
                                        class="form-control @error('pizzaCategory') is-invalid @enderror">
                                        <option value="">Choose Your Pizza Category</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pizzaCategory')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30"
                                        rows="10" placeholder="Enter Description...">{{ old('pizzaDescription') }}</textarea>
                                    @error('pizzaDescription')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-2">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input type="file" name="pizzaImage"
                                        class="form-control @error('pizzaImage') is-invalid @enderror">
                                    @error('pizzaImage')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-payment" name="pizzaWaitingTime" type="number"
                                        value="{{ old('pizzaWaitingTime') }}"
                                        class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Enter Pizza Price...">
                                    @error('pizzaWaitingTime')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-payment" name="pizzaPrice" type="number" value="{{ old('pizzaPrice') }}"
                                        class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true"
                                        aria-invalid="false" placeholder="Enter Pizza Price...">
                                    @error('pizzaPrice')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <button id="payment-button" type="submit"
                                        class="btn btn-lg btn-success btn-block my-3 col-10 offset-1 ">
                                        <span id="payment-button-amount">Create</span>
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
@endsection
