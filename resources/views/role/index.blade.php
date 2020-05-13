@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto">
            <a class="btn btn-primary" href="{{ route('role.create') }}">Create</a>
           <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Guard_name</th>
                        <th scope="col">Create Time</th>
                        <th scope="col">Permissions</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->guard_name }}</td>
                            <td>{{ $role->created_at->diffForHumans() }}</td>
                            <td>{{ $role->getAllPermissions()->implode('name', ', ') }}</td>
                            <td>
                                <form method="post" action="{{ route('role.destroy', compact('role')) }}" class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                                </form>
                                <a href="{{ route('role.edit', compact('role')) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
