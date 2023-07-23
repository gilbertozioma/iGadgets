@extends('layouts.admin')

@section('title', 'Users List')

@section('content')

<div class="row">
    <div class="col-md-12">
      {{-- Display success message if available --}}
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Users
                    <a href="{{ url('admin/users/create') }}" class="btn btn-primary btn-sm text-white float-end">
                        Add User
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          {{-- Loop through the users and display their information --}}
                            @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                  {{-- Display user role as a badge --}}
                                    @if ($user->role_as == '0')
                                        <label class="badge btn-primary">user</label>
                                    @elseif ($user->role_as == '1')
                                        <label class="badge btn-success">Admin</label>
                                    @else
                                        <label class="badge btn-danger">none</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/users/'.$user->id.'/edit') }}" class="text-light me-1 btn-sm btn-primary">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ url('admin/users/'.$user->id.'/delete') }}" 
                                        onclick="return confirm('Are you sure, you want to delete this data?')" 
                                        class="text-light btn-sm btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Users Available</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                      {{-- Display pagination links for the users list --}}
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
