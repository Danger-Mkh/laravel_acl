@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('role.store') }}">
                @csrf
                <div class="form-group">
                    <label>Role Name : </label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label>Role Guard : </label>
                    <input type="text" name="guard_name" class="form-control">
                </div>
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="permissions[{{ $loop->index }}]" value="{{ $permission->id }}">
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