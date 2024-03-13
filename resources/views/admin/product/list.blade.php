@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Pizza List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href=" {{ route('product#createPage') }} ">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="fa-solid fa-plus"></i>Add Pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <h4>Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('product#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" placeholder="Search..."
                                        value="{{ request('key') }}"class="form-control text-secondary">
                                    <button type="submit" class="btn bg-success ">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2 text-center offset-10 my-4 bg-light btn ">
                            <h4>Total - {{ $pizza->total() }}</h4>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark mx-2"></i><strong>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (count($pizza) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 text-center">
                                <thead>
                                    <tr>

                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pizza as $p)
                                        <tr class="tr-shadow text-center">
                                            <td class="col-2"><img src="{{ asset('storage/' . $p->image) }}"
                                                    class="rounded shadow-sm">
                                            </td>
                                            <td class="col-3 ">{{ $p->name }}</td>
                                            <td class="col-1">{{ $p->price }}</td>
                                            <td class="col-1">{{ $p->category_name }}</td>
                                            <td class="col-2"><i class="fa-regular fa-eye me-2"></i> {{ $p->view_count }}
                                            </td>



                                            <td class="col-3">
                                                <div class="fs-4">
                                                    <a href="{{ route('product#viewPage', $p->id) }}">
                                                        <button class="item btn btn-success me-2 rounded-pill"
                                                            data-toggle="tooltip" data-placement="top" title="send">
                                                            View
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#editPage', $p->id) }}">
                                                        <button class="item me-2 " data-toggle="tooltip"
                                                            data-placement="top" title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete', $p->id) }}">
                                                        <button class="item me-2 " data-toggle="tooltip"
                                                            data-placement="top" title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>


                            <div class="mt-3 ">
                                {{ $pizza->links() }}

                            </div>
                        </div>
                    @else
                        <h3 class="text-center my-4 text-danger">There is No Category Here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
