@extends('portal.layout')

@section('title', 'Profile')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Profile Information</h4>
            </div>
            <div class="card-body p-5 shadow">
                <form action="{{ route('profile.update', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3" style="justify-content: center">
                        @php $img = (!empty($user->image) ? $user->image : 'user-avatar.png'); @endphp
                        <div class="col-md-2" id="image-container" style="width: 60px; height: 60px; border-radius: 50%; border: 2px solid darkgrey; overflow: hidden; position: relative;">
                            <img id="user-avatar" src="{{ asset('images'. "/". $img) }}" alt="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; position: absolute; top: 0; left: 0;" />
                        </div>

                        <label for="prof_img" style="text-decoration: underline; cursor: pointer; text-align: center">Change Image</label>
                        <input type="file" name="profile_img" id="prof_img" style="display: none" onchange="displayImage(this)" />
                    </div>

                    <div>
                        @if(auth()->user()->role !== 'customer')
                            <div class="row" style="justify-content: center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $user->name }}" required autocomplete />

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(auth()->user()->role == 'customer')
                            <div class="row" style="justify-content: center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">Customer Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $user->name }}" required autocomplete />

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" class="form-control @error('company_name') is-invalid @enderror" id="company_name" value="{{ $user->company_name }}" required autocomplete />

                                        @error('company_name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="justify-content: center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="company_type">Company Type</label>
                                        <input type="text" name="company_type" class="form-control @error('company_type') is-invalid @enderror" id="company_type" value="{{ $user->company_type }}" required autocomplete />

                                        @error('company_type')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="referred">Referred By</label>
                                        <input type="text" name="referred" class="form-control @error('referred') is-invalid @enderror" required value="{{ (!empty($user->referred) ? $user->referred : '') }}" id="referred" autocomplete />

                                        @error('referred')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif

                            @if(auth()->user()->role == 'admin')
                                <div class="row" style="justify-content: center">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="referred">Referred By</label>
                                            <input type="text" name="referred" class="form-control @error('referred') is-invalid @enderror" required value="{{ (!empty($user->referred) ? $user->referred : '') }}" id="referred" autocomplete />

                                            @error('referred')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            @endif

                        <div  class="row" style="justify-content: center">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" disabled id="email" />

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if(auth()->user()->role == 'customer')
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="alternate_email">Alternate Email</label>
                                        <input type="email" name="alternate_email" class="form-control" value="{{ $user->alternate_email }}" id="alternate_email" />

                                        @error('alternate_email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div  class="row" style="justify-content: center">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="phone">Phone Number</label>
                                    <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ (!empty($user->phone) ? $user->phone : '') }}" id="phone" autocomplete />

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if(auth()->user()->role == 'customer')
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="alternate_phone">Alternate Phone Number</label>
                                        <input type="number" name="alternate_phone" class="form-control @error('alternate_phone') is-invalid @enderror" value="{{ (!empty($user->alternate_phone) ? $user->alternate_phone : '') }}" id="alternate_phone" autocomplete />

                                        @error('alternate_phone')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if(auth()->user()->role == 'customer')
                            <div class="row" style="justify-content: center">
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ (!empty($user->address) ? $user->address : '') }}" id="address" autocomplete />

                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="justify-content: center">
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="comment">Comment</label>
                                        <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="comment">{{ (!empty($user->comment) ? $user->comment : '') }}</textarea>

                                        @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row" style="justify-content: right">
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('profile.change_passowrd', ['id' => $user->id]) }}">Change Password</a>
                        </div>
                    </div>

                    <div class="row" style="justify-content: right">
                        <div class="col-md-4 mb-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('JS')
    <script>
        function displayImage(input) {
            var imageContainer = document.getElementById('image-container');
            var userAvatar = document.getElementById('user-avatar');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    userAvatar.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);

                imageContainer.style.border = '2px solid darkgrey';
            }
        }
    </script>
@endsection
