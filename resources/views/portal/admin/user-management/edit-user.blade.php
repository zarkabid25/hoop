@extends('portal.layout')
@section('title', 'Users')

@section('css')
    <style>
        table, th, td {
            /*border: 1px solid black;*/
            border-collapse: collapse;
        }
    </style>
@endsection

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
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" id="name" autocomplete="name" autofocus />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email: <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" id="email" autocomplete="email" />

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

                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            @if(!empty($placement))
                                <form action="{{ route('placement-price-update') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="placement_id" value="{{ $placement->id }}">

                                    <table style="width: 100%">
                                        <tr>
                                            <th colspan="4" style="padding: 20px; font-size: 15px">Placement</th>
                                            <th style="text-align: center; padding: 20px; font-size: 15px">Price</th>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Bags</strong></p></td>
                                            <td><input type="number" name="bags" value="{{ $placement->bags }}" class="form-control" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Cap</strong></p></td>
                                            <td><input type="number" name="cap" class="form-control" value="{{ $placement->cap }}" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Chest</strong></p></td>
                                            <td><input type="number" name="chest" class="form-control" value="{{ $placement->chest }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Gloves</strong></p></td>
                                            <td><input type="number" name="gloves" class="form-control" value="{{ $placement->gloves }}" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Cap Side</strong></p></td>
                                            <td><input type="number" name="cap_side" class="form-control" value="{{ $placement->cap_side }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Cap Back</strong></p></td>
                                            <td><input type="number" name="cap_back" value="{{ $placement->cap_back }}" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Towel</strong></p></td>
                                            <td><input type="number" name="towel" value="{{ $placement->towel }}" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>JacketBack</strong></p></td>
                                            <td><input type="number" name="jacketback" value="{{ $placement->jacketback }}" class="form-control" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Sleeve</strong></p></td>
                                            <td><input type="number" name="sleeve" class="form-control" value="{{ $placement->sleeve }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Patches</strong></p></td>
                                            <td><input type="number" name="patches" class="form-control" value="{{ $placement->patches }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Visor</strong></p></td>
                                            <td><input type="number" name="visor" class="form-control" value="{{ $placement->visor }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Table Cloth</strong></p></td>
                                            <td><input type="number" name="table_cloth" class="form-control" value="{{ $placement->table_cloth }}" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Beanic Caps</strong></p></td>
                                            <td><input type="number" name="beanie_caps" class="form-control" value="{{ $placement->beanie_caps }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Apron</strong></p></td>
                                            <td><input type="number" name="apron" class="form-control" value="{{ $placement->apron }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Other</strong></p></td>
                                            <td><input type="number" name="other" class="form-control" value="{{ $placement->other }}" /></td>
                                        </tr>
                                    </table>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn" style="background-color: #29babf; color: white">Update</button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('placement-price-update') }}" method="post">
                                    @csrf

                                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                                    <table style="width: 100%">
                                        <tr>
                                            <th colspan="4" style="padding: 20px; font-size: 15px">Placement</th>
                                            <th style="text-align: center; padding: 20px; font-size: 15px">Price</th>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Bags</strong></p></td>
                                            <td><input type="number" name="bags" value="{{ old('bags') }}" class="form-control" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Cap</strong></p></td>
                                            <td><input type="number" name="cap" class="form-control" value="{{ old('cap') }}" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Chest</strong></p></td>
                                            <td><input type="number" name="chest" class="form-control" value="{{ old('chest') }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Gloves</strong></p></td>
                                            <td><input type="number" name="gloves" class="form-control" value="{{ old('gloves') }}" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Cap Side</strong></p></td>
                                            <td><input type="number" name="cap_side" class="form-control" value="{{ old('cap_side') }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Cap Back</strong></p></td>
                                            <td><input type="number" name="cap_back" value="{{ old('cap_back') }}" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Towel</strong></p></td>
                                            <td><input type="number" name="towel" value="{{ old('towel') }}" class="form-control" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>JacketBack</strong></p></td>
                                            <td><input type="number" name="jacketback" value="{{ old('jacketback') }}" class="form-control" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Sleeve</strong></p></td>
                                            <td><input type="number" name="sleeve" class="form-control" value="{{ old('sleeve') }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Patches</strong></p></td>
                                            <td><input type="number" name="patches" class="form-control" value="{{ old('patches') }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Visor</strong></p></td>
                                            <td><input type="number" name="visor" class="form-control" value="{{ old('visor') }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Table Cloth</strong></p></td>
                                            <td><input type="number" name="table_cloth" class="form-control" value="{{ old('table_cloth') }}" /></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4"><p><strong>Beanic Caps</strong></p></td>
                                            <td><input type="number" name="beanie_caps" class="form-control" value="{{ old('beanie_caps') }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Apron</strong></p></td>
                                            <td><input type="number" name="apron" class="form-control" value="{{ old('apron') }}" /></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><p><strong>Other</strong></p></td>
                                            <td><input type="number" name="other" class="form-control" value="{{ old('other') }}" /></td>
                                        </tr>
                                    </table>

                                    <div class="d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn" style="background-color: #29babf; color: white">Update</button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>
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
