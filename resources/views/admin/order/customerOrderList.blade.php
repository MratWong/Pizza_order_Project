@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="table-responsive table-responsive-data2">

                        <div class="row">
                            <div class="card col-5 offset-1">
                                <div class="row col-6 offset-4 mt-2">
                                    <div class="card-title">
                                        <span class="text-success fs-4">Order Info</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row my-3 ">
                                        <div class="col">Name</div>
                                        <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col">Order Code</div>
                                        <div class="col">{{ $orderList[0]->order_code }}</div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col">Total</div>
                                        <div class="col text-success">{{ $order->total_price - 2500 }} MMK</div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col">Delivery Fee</div>
                                        <div class="col text-success">2500 MMK</div>
                                    </div>
                                    <hr>
                                    <div class="row my-3">
                                        <div class="col">Subtotal</div>
                                        <div class="col text-success">{{ $order->total_price }} MMK</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card bg-white col-5">
                                <div class="row col-6 offset-4 mt-2">
                                    <div class="card-title">
                                        <span class="text-success fs-4">User Info</span>
                                    </div>
                                </div>
                                <div class="card-body mt-3">
                                    <div class="row  ">
                                        <div class="col">Name</div>
                                        <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                    </div>
                                    <hr>
                                    <div class="row ">
                                        <div class="col">Phone</div>
                                        <div class="col">{{ $orderList[0]->user_phone }}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">email</div>
                                        <div class="col">{{ $orderList[0]->user_email }}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">Address</div>
                                        <div class="col">{{ $orderList[0]->user_address }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Qty</th>
                                    <th>Amount</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderList as $order)
                                    <tr class="tr-shadow">
                                        <td>{{ $order->id }}</td>
                                        <td class="col-2">
                                            <img src="{{ asset('storage/' . $order->product_image) }}" alt="">
                                        </td>
                                        <td>{{ $order->product_name }}</td>
                                        <td>{{ $order->created_at->format('F-j-Y') }}</td>
                                        <td>{{ $order->qty }}</td>
                                        <td class="text-success">{{ $order->total }} MMK</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
