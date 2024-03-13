@extends('user.layouts.master')

@section('content')
    <div class="">
        <h4 class="text-muted ms-5 my-3 fs-3">Help center</h4>
        <div class="row bg-info p-5">
            <div class="col-8 offset-3">
                <h3 class="text-white ms-3">Hi! How can I help you?</h3>
                <div class="">
                    <form action="" method="get">
                        @csrf
                        <div class=" col-8 d-flex">
                            <input type="text" name="key"
                                placeholder="Search for a question. Like: Where is my order?"
                                value="{{ request('key') }}"class="form-control text-secondary">
                            <button type="submit" class="btn text-white px-4 " style="background: rgb(4, 163, 231)">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="my-3">
            <div class="row">
                <div class="col-5 offset-5 my-2">Here are your services and categories</div>
            </div>
            <div class="row">
                <div class="m-auto" style="width: 2%; border:1px solid rgb(4, 163, 231);"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-2 rounded offset-2 bg-light py-5 shadow-sm  me-2 border">
                <a href="{{ route('user#history') }}" class="text-decoration-none text-black">
                    <div class="text-center fs-4 my-2"><i class="fa-solid fa-cart-shopping"></i></div>
                    <div class="text-center">Orders</div>
                </a>
            </div>
            <div class="col-2 rounded bg-light py-5 shadow-sm  me-2 border">
                <a href="{{ route('user#cartList') }}" class="text-decoration-none text-black">
                    <div class="text-center fs-4 my-2"><i class="fa-solid fa-cart-shopping"></i></div>
                    <div class="text-center">Carts</div>
                </a>
            </div>
            <div class="col-2 rounded bg-light py-5 shadow-sm  me-2 border">
                <a href="{{ route('user#passwordchangePage') }}" class="text-decoration-none text-black">
                    <div class="text-center fs-4 my-2"><i class="fa-solid fa-lock"></i></div>
                    <div class="text-center">Reset Password</div>
                </a>
            </div>
            <div class="col-2 rounded bg-light py-5 shadow-sm  me-2 border">
                <a href="{{ route('user#accountChangePage') }}" class="text-decoration-none text-black">
                    <div class="text-center fs-4 my-2"><i class="fa-regular fa-user"></i></div>
                    <div class="text-center">Account Management</div>
                </a>
            </div>
        </div>
        <a href="{{ route('user#chatPage', $message?->message) }}" class=" text-decoration-none text-black-50">
            <div class="row my-5">
                <div class="col-3 offset-5 p-3">
                    <div class="row mb-3 border p-3 shadow-lg">
                        <div class='col-2 '>
                            <button class="text-muted text-center btn btn-info"><i
                                    class="fa-regular fa-comment-dots fs-4 text-white"></i></button>
                        </div>
                        <div class="col-7 offset-1 ">
                            <div class="text-uppercase">Chat Now</div>
                            <div class="">8:00 AM to 9:00 PM</div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endsection

@section('scritSource')
@endsection
