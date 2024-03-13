@extends('admin.layouts.master')

@section('title', 'Category List')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="row">
                        <div class="col-3">
                            <h4>Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" placeholder="Search..."
                                        value="{{ request('key') }}"class="form-control text-secondary">
                                    <button type="submit" class="btn bg-primary ">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
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

                    <div class="row">
                        <div class="col-2 text-center  my-4 bg-light btn ">
                            <span>Total - {{ $admin->total() }}</span>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th> Name</th>
                                    <th>Email </th>
                                    <th>Phone</th>
                                    <th> Gender</th>
                                    <th>Address </th>
                                    <th>Role</th>
                                    <th>Delete</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($a->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/profile_male.png') }}"
                                                        class="rounded shadow-sm" />
                                                @else
                                                    <img src="{{ asset('image/profile_female.png') }}"
                                                        class="rounded shadow-sm" />
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}" class="rounded shadow-sm" />
                                            @endif
                                        </td>
                                        <input type="hidden" name="userId" class="userId" value="{{ $a->id }}">
                                        <td> {{ $a->name }} </td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td id="address">{{ $a->address }}</td>
                                        <td class="col-2">
                                            @if (Auth::user()->id == $a->id)
                                            @else
                                                <select name="role"class="form-select roleOption">
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">

                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    {{-- <a href="{{ route('admin#changeRole', $a->id) }}">
                                                        <button class="item me-2" data-toggle="tooltip" data-placement="top"
                                                            title="Change Admin Role">
                                                            <i class="fa-solid fa-person-circle-minus"></i>
                                                        </button>
                                                    </a> --}}
                                                    <a href="{{ route('admin#edit', $a->id) }}">
                                                        <button class="item me-3" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('admin#delete', $a->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $admin->links() }}
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>
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
            $('.roleOption').change(function() {
                $currentStatus = $(this).val();
                $parentNote = $(this).parents('tr');
                $userId = $parentNote.find('.userId').val();

                $data = {
                    'userId': $userId,
                    'currentStatus': $currentStatus
                };

                $.ajax({
                    type: 'get',
                    url: '/admin/ajax/change',
                    data: $data,
                    dataType: 'json'
                })
                location.reload();
            })
        })
    </script>
@endsection
