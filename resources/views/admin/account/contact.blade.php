@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    @if (count($data) != 0)
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="col-md-12">

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Message</th>

                                    </tr>
                                </thead>
                                <tbody id='orderList'>
                                    @foreach ($data as $d)
                                        <tr class="tr-shadow">
                                            {{-- <input type="hidden" name="orderId" class="orderId" value="{{ $o->id }}"> --}}
                                            <td>{{ $d->senderUser?->name }}</td>
                                            <td>{{ $d->senderUser?->email }}</td>
                                            <td>
                                                <a href="{{ route('admin#userMessageView', $d->sender_id) }}"
                                                    class=" text-decoration-none">
                                                    <div class="bg-light text-primary btn">
                                                        {{ $d->message }}
                                                    </div>
                                                </a>
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
    @else
        <div class="row my-5 text-center align-items-center bg-light" style="height: 400px">
            <div class="text-center my-4 text-secondary my-5 fs-5">No message yet!</div>
        </div>
    @endif


    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')

@endsection
