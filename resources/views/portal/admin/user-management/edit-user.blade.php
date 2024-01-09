@extends('portal.layout')
@section('title', 'Users')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Edit User</h3>
            </div>

            <div class="card-body">
                <div class="text-right">
                    <button class="btn btn-danger" id="change_password">Change Password</button>
                </div>
                <form action="{{ route('user_management.update', ['user_management' => $user->id]) }}" method="post">
                    @method('put')
                    @csrf

                    <div class="form-group">
                        <label for="name">Name: <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" id="name" required autocomplete="name" autofocus />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email: <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" id="email" required autocomplete="email" />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style="display: none" id="pass_section">
                        <label for="password">New Password:</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" autocomplete="password" />
                        <a style="text-decoration: underline" href="javascript:void(0)" onclick="generatePassword('#password');">Generate Password</a>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role: <span class="text-danger">*</span></label>
                        <select class="form-control @error('role') is-invalid @enderror" name="role" id="role" required autocomplete="role">
                            <option selected disabled>Select</option>
                            <option value="sale_person" {{ ($user->role == 'sale_person') ? 'selected' : '' }}>Sales Person</option>
                            <option value="developer" {{ ($user->role == 'developer') ? 'selected' : '' }}>Developer</option>
                        </select>

                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <script>
        $('#change_password').on('click', function (){
            $('#pass_section').show();
        })

        function generatePassword(selctor){
            const newPassword = generateRandomPassword(12);
            $(selctor).val(newPassword);
            console.log("Generated Password: " + newPassword);
        }

        function generateRandomPassword(length) {
            const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
            let password = '';
            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * charset.length);
                password += charset.charAt(randomIndex);
            }
            return password;
        }
    </script>
@endsection
