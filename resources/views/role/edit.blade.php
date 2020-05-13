@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('role.update', compact('role')) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Role Name : </label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}">
                    </div>
                    <div class="form-group">
                        <label>Role Guard : </label>
                        <input type="text" name="guard_name" class="form-control" value="{{ old('guard_name', $role->guard_name) }}" placeholder="Default Web">
                    </div>
                    @foreach($permissions as $permission)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="permissions[{{ $loop->index }}]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id) || in_array($permission->id, old('permissions', [])) ) checked @endif>
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
