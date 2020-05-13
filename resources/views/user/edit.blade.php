@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="post" action="{{ route('user.update', compact('user')) }}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Name : </label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    </div>
                    <div class="form-group">
                        <label>Email : </label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                    </div>
                    @foreach($roles as $role)
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="roles[{{ $loop->index }}]" value="{{ $role->id }}" @if($user->roles->contains($role->id) || in_array($role->id, old('roles', [])) ) checked @endif>
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
