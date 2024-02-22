@extends('portal.layout')
@section('title', 'Create User')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Create User</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('user_management.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name: <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" required autocomplete="name" autofocus />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email: <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required autocomplete="email" />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password: <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required autocomplete="password" />
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
                            <option value="sale_person">Sales Person</option>
                            <option value="developer">Developer</option>
                            <option value="customer">Customer</option>
                        </select>

                        @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <script>
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
