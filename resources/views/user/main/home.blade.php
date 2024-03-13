@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filter
                        by Categories</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="row">
                            <div
                                class="rounded bg-success text-white d-flex px-3 py-2 align-items-center justify-content-between mb-3">
                                <label class="" for="price-all">Categories</label>
                                <span class="badge border font-weight-normal">{{ count($categories) }}</span>
                            </div>
                        </div>

                        <div class="  d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#home') }}">
                                <label class="" for="price-1">All </label>
                            </a>
                        </div>

                        @foreach ($categories as $c)
                            <div class="  d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter', $c->id) }}">
                                    <label class="" for="price-1">{{ $c->name }} </label>
                                </a>
                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                @if (count($cart) == 0)
                                    <a class="btn text-center" href="{{ route('user#cartList') }}">
                                        <button type="button" class="btn btn-success position-relative">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </a>
                                @else
                                    <a class="btn text-center" href="{{ route('user#cartList') }}">
                                        <button type="button" class="btn btn-success position-relative">
                                            <i class="fa fa-shopping-cart"></i>

                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ count($cart) }}
                                            </span>
                                        </button>
                                    </a>
                                @endif

                                @if (count($history) == 0)
                                    <a class="btn text-center" href="{{ route('user#history') }}">
                                        <button type="button" class="btn btn-success position-relative">
                                            History
                                        </button>
                                    </a>
                                @else
                                    <a class="btn text-center" href="{{ route('user#history') }}">
                                        <button type="button" class="btn btn-success position-relative">
                                            History
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                {{ count($history) }}
                                            </span>
                                        </button>
                                    </a>
                                @endif
                            </div>

                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" class="form-control" id="sortingOption">
                                        <option value="">Choose One Option...</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>

                                </div>

                            </div>
                        </div>
                    </div>

                    @if (count($pizza) != null)
                        <span class="row" class="dataList">
                            @foreach ($pizza as $p)
                                <section class="col-lg-4 col-md-6 col-sm-6 pb-1 ">
                                    <div class="product-item bg-light mb-4 rounded" id="myForm">
                                        <div class="product-img position-relative rounded overflow-hidden">
                                            <img class="img-fluid w-100 " style=" height: 210px"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a type="button" class="btn btn-outline-dark btn-square addCart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>

                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzadetails', $p->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="">
                                            <input type="hidden" id="productId" value="{{ $p->id }}">
                                            <input type="hidden" class="userId" value="{{ Auth::user()->id }}">
                                            <div class="d-flex align-items-center">
                                                <input type="hidden" class="form-control border-0 text-center"
                                                    value="1" id="orderCount">
                                            </div>
                                        </div>

                                        <div class="text-center py-4 ">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}
                                            </a>
                                            <div class="d-flex align-items-center justify-content-center mt-2 text-center">
                                                <div class="fs-4 text-success ">{{ $p->price }}</div>
                                                <div class="fs-5 text-success ms-2 ">MMK</div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            @endforeach
                        </span>
                    @else
                        <span
                            class="shadow-sm text-center fs-5 text-uppercase bg-success text-white p-3 col-6 offset-3 mt-5 rounded">
                            This are no items in this category!
                        </span>
                    @endif
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
        <!-- Shop End -->
    @endsection

    @section('scritSource')
        <script>
            $('#sortingOption').change(function() {
                $sorting = $('#sortingOption').val();
                if ($sorting == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizzaList',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = "";
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100 " style=" height: 210px"
                                            src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa-solid fa-circle-info"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2 text-center">
                                            <div class="fs-4 fw-semibold ">${response[$i].price}</div>
                                            <div class="fs-5 ms-2 ">MMK</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                            }
                            $('#dataList').html($list);
                        }
                    })
                } else if ($sorting == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/pizzaList',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                            $list = "";
                            for ($i = 0; $i < response.length; $i++) {
                                $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4" id="myForm">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100 " style=" height: 210px"
                                            src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" href=""><i
                                                    class="far fa-heart"></i></a>

                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">${response[$i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2 text-center">
                                            <div class="fs-4 fw-semibold ">${response[$i].price}</div>
                                            <div class="fs-5 ms-2 ">MMK</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                            }
                            $('#dataList').html($list);
                        }
                    })
                }
            })

            $('.addCart').click(function() {
                $parentNote = $(this).parents('section');
                $productId = $parentNote.find('#productId').val();
                $userId = $('.userId').val();
                $count = $('#orderCount').val();

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/direct/cart',
                    data: {
                        'userId': $userId,
                        'pizzaId': $productId,
                        'count': $count
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "/user/home";
                        }

                    }
                })


            })
        </script>
    @endsection
