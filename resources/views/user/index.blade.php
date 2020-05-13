@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Create Time</th>
                        <th scope="col">Roles</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->diffForHumans() }}</td>
                            <td>{{ $user->roles->implode('name', ', ') }}</td>
                            <td>
                                <form method="post" action="{{ route('user.destroy', compact('user')) }}" class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                                </form>
                                <a href="{{ route('user.edit', compact('user')) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
