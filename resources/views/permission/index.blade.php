@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-auto">
            @can('create_permission')
                <a class="btn btn-primary" href="{{ route('permission.create') }}">Create</a>
            @endcan
           <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Guard_name</th>
                        <th scope="col">Create Time</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>{{ $permission->created_at->diffForHumans() }}</td>
                            <td>
                                @can('delete_permission')
                                    <form method="post" action="{{ route('permission.destroy', compact('permission')) }}" class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                                    </form>
                                @endcan
                                @can('edit_permission')
                                    <a href="{{ route('permission.edit', compact('permission')) }}" class="btn btn-sm btn-primary">Edit</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
