@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('permission.store') }}">
                @csrf
                <div class="form-group">
                    <label>Permission Name : </label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>Permission Guard : </label>
                    <input type="text" name="guard_name" class="form-control" value="{{ old('guard_name') }}" placeholder="Default Web">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
