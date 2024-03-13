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

                    <div class="row">
                        <div class="col-2 text-center  my-4 bg-light btn ">
                            <span>Total - {{ $users->total() }}</span>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($user->image == null)
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/profile_male.png') }}"
                                                        class="rounded shadow-sm" />
                                                @else
                                                    <img src="{{ asset('image/profile_female.png') }}"
                                                        class="rounded shadow-sm" />
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $user->image) }}"
                                                    class="rounded shadow-sm" />
                                            @endif
                                        </td>
                                        <input type="hidden" name="userId" class="userId" value="{{ $user->id }}">
                                        <td> {{ $user->name }} </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td id="address">{{ $user->address }}</td>
                                        <td class="">
                                            @if (Auth::user()->id == $user->id)
                                            @else
                                                <select name="role"class="form-select roleOption">
                                                    <option value="admin"@if ($user->role == 'admin') selected @endif>
                                                        Admin</option>
                                                    <option value="user"
                                                        @if ($user->role == 'user') selected @endif>User</option>
                                                </select>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('admin#userEdit', $user->id) }}">
                                                    <button class="item me-3" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('admin#userDelete', $user->id) }}">
                                                    <button class="item me-3" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $users->links() }}
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
                    url: '/admin/ajax/user/change',
                    data: $data,
                    dataType: 'json'
                })
                location.reload();
            })
        })
    </script>
@endsection
