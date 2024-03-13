@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body bg-success mb-2 ">
                            <div class="card-title text-center">
                                <h3 class="text-center title-2  text-white">{{ $pizza->category_name }}</h3>
                            </div>


                        </div>
                        <div class="row mt-3">
                            <div class="col-4 offset-1">
                                <img src="{{ asset('storage/' . $pizza->image) }}" class=" shadow-sm rounded">
                            </div>


                            <div class="col-3 offset-1">
                                <div class="text-muted mb-2 text-uppercase">Foodies</div>
                                <div class='mb-1 font-weight-bold fs-4'> {{ $pizza->name }} </div>
                                <div class="text-muted text-uppercase fs-5 mb-3">Ingredients :</div>
                                <div class='mb-3 border p-3 shadow-sm'>
                                    <span class="text-muted text-uppercase">Price : </span> <span
                                        class="text-success ms-1">{{ $pizza->price }} MMK</span>
                                </div>

                            </div>

                            <div class="col-10 offset-1 mt-3">
                                <div class="font-weight-bold fs-4">Description</div>
                                <div class="border p-4 shadow-sm mt-2">
                                    {{ $pizza->description }}
                                </div>
                            </div>

                            <div class="offset-1 mt-3">
                                <i class="fa-solid fa-circle-left fs-4 text-success" onclick="history.back()"></i>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
