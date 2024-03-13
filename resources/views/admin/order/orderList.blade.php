@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <form action="{{ route('admin#changeStatus') }}" method="get">
                        @csrf
                        <div class="d-flex mb-4 col-5">
                            <div class="input-group mb-3 ">
                                <label class="input-group-text " for="inputGroupSelect02">
                                    <span>Orders - {{ count($order) }}</span>
                                </label>
                                <select class="form-select" name="orderStatus" id="inputGroupSelect02">
                                    <option value="">All</option>
                                    <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                    </option>
                                    <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                    <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                                </select>
                                <label class="input-group-text bg-success" for="inputGroupSelect02">
                                    <button type="submit" class="btn btn-success">Search</button>
                                </label>

                            </div>
                        </div>
                    </form>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody id='orderList'>
                                @foreach ($order as $o)
                                    <tr class="tr-shadow">
                                        <input type="hidden" name="orderId" class="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td>
                                            <a href="{{ route('admin#customerOrder', $o->order_code) }}"
                                                class=" text-decoration-none">
                                                {{ $o->order_code }}
                                            </a>
                                        </td>
                                        <td class=" text-success">{{ $o->total_price }} MMK</td>
                                        <td>
                                            <select name="status" class="form-control changeStatus">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1"@if ($o->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2"@if ($o->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
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

@section('scriptSection')
    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();

            //     $.ajax({
            //         type: 'get',
            //         url: '/order/ajaxOrder',
            //         data: {
            //             'status': $status
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             $list = "";
            //             for ($i = 0; $i < response.length; $i++) {


            //                 $months = ['January', 'February', 'March', 'April', 'May', 'June',
            //                     'July', 'August', 'September', 'October', 'November',
            //                     'December'
            //                 ];

            //                 $dbDate = new Date(response[$i].created_at);

            //                 $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
            //                     "-" +
            //                     $dbDate
            //                     .getFullYear();

            //                 if (response[$i].status == 0) {
            //                     $statusMessage = `
        //                         <select name="status" class="form-control">
        //                             <option value="0" selected >Pending</option>
        //                             <option value="1"  >Accept</option>
        //                             <option value="2"  >Reject</option>
        //                         </select>
        //                     `;
            //                 } else if (response[$i].status == 1) {
            //                     $statusMessage = `
        //                         <select name="status" class="form-control">
        //                             <option value="0"  >Pending</option>
        //                             <option value="1" selected >Accept</option>
        //                             <option value="2"  >Reject</option>
        //                         </select>
        //                     `;
            //                 } else if (response[$i].status == 2) {
            //                     $statusMessage = `
        //                         <select name="status" class="form-control">
        //                             <option value="0"  >Pending</option>
        //                             <option value="1"  >Accept</option>
        //                             <option value="2" selected >Reject</option>
        //                         </select>
        //                     `;
            //                 }

            //                 $list += `
        //             <tr class="tr-shadow">
        //                         <td>${response[$i].user_id}</td>
        //                         <td>${response[$i].user_name}</td>
        //                         <td>${$finalDate}</td>
        //                         <td>${response[$i].order_code}</td>
        //                         <td>${response[$i].total_price} MMK</td>
        //                         <td>${$statusMessage}</td>
        //                     </tr>
        //             `;
            //             }
            //             $('#orderList').html($list);
            //         }
            //     })
            // })

            $('.changeStatus').change(function() {
                $currentStatus = $(this).val();
                $parentNote = $(this).parents('tr');
                $orderId = $parentNote.find('.orderId').val();

                $data = {
                    'orderId': $orderId,
                    'currentStatus': $currentStatus
                };

                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: $data,
                    dataType: 'json'
                })

            })
        })
    </script>
@endsection
