@extends('portal.layout')
@section('title', 'Users')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>All Users</h3>
            </div>

            <div class="card-body">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ ucwords($user->name) }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? '--' }}</td>
                                <td>{{ ucwords(str_replace('_', ' ', $user->role)) }}</td>
                                <td>
                                    <div>
                                        <div style="display: inline-block">
                                            <a href="{{ route('user_management.edit', ['user_management' => $user->id]) }}" class="btn btn-info">Edit</a>
                                        </div>

                                        <div style="display: inline-block">
                                            <form action="{{ route('user_management.destroy', ['user_management' => $user->id]) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <script>
        new DataTable('#example');
    </script>
@endsection
