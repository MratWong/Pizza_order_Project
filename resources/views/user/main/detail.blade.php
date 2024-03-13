@extends('user.layouts.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <a href="{{ route('user#home') }}" class=" text-success fs-4">
                    <i class="fa-solid fa-circle-left"></i>
                </a>
                <div id="product-carousel" class="carousel slide mt-3" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('storage/' . $pizza->image) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30 mt-3">
                <div class="h-100 bg-light p-30">
                    <h3> {{ $pizza->name }} </h3>
                    <input
                        type="hidden"class="form-control border-0 text-center"value="{{ Auth::user()->id }}"id="userId">
                    <input type="hidden"class="form-control border-0 text-center"value="{{ $pizza->id }}"id="pizzaId">

                    <div class="d-flex mb-3">
                        <small class="pt-1">{{ $pizza->view_count + 1 }} Views </small>
                    </div>
                    <div class="text-success bold fs-4 mb-4">{{ $pizza->price }} MMK</div>
                    <input type="hidden" id="pizzaPrice" value="{{ $pizza->price }}">
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="align-items-center mb-4 pt-2">
                        <div class="d-flex align-items-center">
                            <div class="text-secondary me-4">Quantity</div>
                            <div class="input-group quantity text-center " style="width: 130px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-minus">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control border-0 text-center" value="1"
                                    id="orderCount">
                                <div class="input-group-btn">
                                    <button class="btn btn-success btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="addToCart" class="btn btn-success px-3 my-3"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To Cart
                        </button>

                        <button type="button" id="buyBtn" class="btn btn-success px-3 my-3">
                            Buy Now
                        </button>
                        {{-- <input type="hidden" name="" id="productId" value="{{ $cartList->product_id }}">
                        <input type="hidden" name="" id="userId" value="{{ $cartList->user_id }}">
                        <input type="hidden" name="" id="qty" value="{{ $cartList->qty }}"> --}}
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also
                Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $p)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}"
                                    style="height: 200px">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('user#pizzadetails', $p->id) }}"><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <div class="text-success fs-5">{{ $p->price }} MMK</div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small class="fa fa-star text-warning mr-1"></small>
                                    <small>(23)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scritSource')
    <script>
        $(document).ready(function() {

            // increase count view
            $.ajax({
                type: 'get',
                url: 'user/ajax/view/count',
                data: {
                    'pizzaId': $('#pizzaId').val()
                },
                dataType: 'json',

            })

            // click add to cart btn
            $('#addToCart').click(function() {

                $source = {
                    'userId': $('#userId').val(),
                    'pizzaId': $('#pizzaId').val(),
                    'count': $('#orderCount').val()

                };

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/atToCart',
                    data: $source,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "http://localhost:8000/user/cart/cartList";
                        }
                    }
                })

            })
        })

        // direct buy btn
        $('#buyBtn').click(function() {
            $random = Math.floor(Math.random() * 10000000001);
            $source = {
                'userId': $('#userId').val(),
                'pizzaId': $('#pizzaId').val(),
                'count': $('#orderCount').val(),
                'total': $('#pizzaPrice').val() * $('#orderCount').val(),
                'orderCode': 'POS' + $random
            };

            $.ajax({
                type: 'get',
                url: '/user/ajax/direct/buy',
                data: $source,
                dataType: 'json',
                success: function(response) {
                    window.location.href = "/user/history";
                }
            })

        })
    </script>
@endsection
