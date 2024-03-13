@extends('user.layouts.master')

@section('content')
    <!-- Cart Start -->
    @if (count($order) != 0)
        <div class="container-fluid" style="height: 400px">
            <div class="row px-xl-5">
                <div class="col-lg-8 offset-2 table-responsive mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0" id="tableId">
                        <thead class="thead-dark">
                            <tr>
                                <th>Date</th>
                                <th>Order Code</th>
                                <th>Total Price</th>
                                <th>Status</th>

                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            @foreach ($order as $o)
                                <tr>
                                    <td class="align-middle">{{ $o->created_at->format('F-j-Y') }}</td>
                                    <td class="align-middle">{{ $o->order_code }}</td>
                                    <td class="align-middle">{{ $o->total_price }} MMK</td>
                                    <td class="align-middle">
                                        @if ($o->status == 0)
                                            <span class="text-warning"><i
                                                    class="fa-regular fa-clock me-2"></i>Pending</span>
                                        @elseif($o->status == 1)
                                            <span class="text-success"><i
                                                    class="fa-regular fa-circle-check me-2"></i>Success</span>
                                        @elseif ($o->status == 2)
                                            <span class="text-danger"> <i class="fa-solid fa-triangle-exclamation me-2"></i>
                                                Reject</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class=" mt-3">
                        {{ $order->links() }}

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row ">
            <div class="col-6 offset-3 text-center my-5 ">
                <div class="text-secondary my-5 ">There are no orders history!</div>
                <a href=" {{ route('user#home') }} " class=" text-decoration-none ">
                    <span class="border border-success text-success px-5 py-3 text-uppercase  ">Please Order Now!</span>
                </a>
            </div>
        </div>
    @endif
    <!-- Cart End -->
@endsection

@section('scritSource')
@endsection
