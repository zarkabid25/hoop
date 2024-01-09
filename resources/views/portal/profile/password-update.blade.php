@extends('portal.layout')

@section('title', 'Change Password')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h6>Password Update</h6>
            </div>

            <div class="card-body p-5 shadow">
                <form action="{{ route('profile.password-update', ['id' => $id]) }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="old_password">Current Password</label>
                                <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" required autocomplete />

                                @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div  class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="password">New Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required autocomplete />
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div  class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" required autocomplete />

                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Change</button>
                </form>
            </div>
        </div>
    </div>
@endsection
