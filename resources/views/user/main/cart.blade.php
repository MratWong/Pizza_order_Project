@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    @if (count($cartList) != 0)
        <div class="container-fluid">
            <div class="row px-xl-5">
                <div class="col-lg-8 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0" id="tableId">
                        <thead class="thead-dark">
                            <tr>
                                <th></th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($cartList as $c)
                                <tr>
                                    <td>
                                        <img class=" shadow-sm rounded" src="{{ asset('storage/' . $c->pizza_image) }}"
                                            style="width: 100px;">
                                    </td>
                                    <td class="align-middle">{{ $c->pizza_name }}
                                        <input type="hidden" class="userId" value="{{ $c->user_id }}">
                                        <input type="hidden" class="productId" id="" value="{{ $c->product_id }}">
                                        <input type="hidden" class="cartId" value="{{ $c->id }}">
                                    </td>
                                    <td class="align-middle text-success">{{ $c->pizza_price }} MMK</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-success btn-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" id="qty"
                                                class="form-control form-control-sm border-0 text-center"
                                                value="{{ $c->qty }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-success btn-plus">
                                                    <i class="fa fa-plus"></i>

                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-success" id="total">
                                        {{ $c->pizza_price * $c->qty }} MMK
                                    </td>
                                    <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove"
                                            id="btnRemove"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Cart
                            Summary</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom pb-2">
                            <div class="d-flex justify-content-between mb-3">
                                <span>Subtotal</span>
                                <span class="" id="subTotalPrice">{{ $totalPrice }} MMK</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="">Delivery</span>
                                <span class="deli">2500 MMK</span>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between mt-2">
                                <span>Total</span>
                                <span class="text-success" id="finalTotalPrice">{{ $totalPrice + 2500 }} MMK</span>
                            </div>
                            <button class="btn btn-block btn-success font-weight-bold my-3 py-3" id="orderBtn">Proceed To
                                Checkout
                            </button>
                            <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearCartBtn">
                                <span>Clear Cart</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row ">
            <div class="col-6 offset-3 text-center my-5 ">
                <div class="text-secondary my-5 ">There are no items in this cart</div>
                <a href=" {{ route('user#home') }} " class=" text-decoration-none ">
                    <span class="border border-warning text-warning px-5 py-3 text-uppercase  ">Continue
                        Shopping</span>
                </a>
            </div>
        </div>
    @endif
    <!-- Cart End -->
@endsection

@section('scritSource')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        $('#orderBtn').click(function() {

            $orderList = [];
            $random = Math.floor(Math.random() * 10000000001);

            $('#tableId tbody tr').each(function(index, row) {
                $orderList.push({
                    'userId': $(row).find('.userId').val(),
                    'productId': $(row).find('.productId').val(),
                    'qty': $(row).find('#qty').val(),
                    'total': $(row).find('#total').text().replace('MMK', '') * 1,
                    'orderCode': 'POS' + $random
                });
            });

            $.ajax({
                type: 'get',
                url: '/user/ajax/order',
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    window.location.href = "/user/home";
                }
            })
        })

        $('#clearCartBtn').click(function() {
            $('#tableId tbody tr').remove();
            $('#subTotalPrice').html('0 MMK');
            $('.deli').html('0 MMK');
            $('#finalTotalPrice').html('0 MMK');
            $.ajax({
                type: 'get',
                url: '/user/ajax/clear/cart',
                dataType: 'json',
            })
            location.reload();
        })

        $('.btnRemove').click(function() {
            $parentNote = $(this).parents('tr');
            $productId = $parentNote.find('.productId').val();
            $cartId = $parentNote.find('.cartId').val();
            $userId = $('.userId').val();
            $orderId = $('.orderId').val();
            $.ajax({
                type: 'get',
                url: '/user/ajax/clear/cartItem',
                data: {
                    'productId': $productId,
                    'cartId': $cartId
                },
                dataType: 'json'
            })

            $parentNode.remove();

            $subTotal = 0;
            $('#tableId tr').each(function(index, row) {
                $subTotal += Number($(row).find('#total').text().replace('MMK', ''));
            })


            $('#subTotalPrice').html(`${$subTotal} MMK`);
            // $('#finalTotalPrice').html(`${$subTotal+ 2500} MMK`)
            if ($subTotal == 0) {
                $('#finalTotalPrice').html('0 MMK')
            } else {
                $('#finalTotalPrice').html(`${$subTotal+ 2500} MMK`)
            }

            if ($subTotal == 0) {
                $('.deli').html('0 MMK');
            }


        })
    </script>
@endsection
