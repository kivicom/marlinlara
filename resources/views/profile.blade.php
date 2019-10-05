@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h3>Профиль пользователя</h3></div>

                <div class="card-body">
                    @if (session('profile'))
                        <div class="alert alert-success" role="alert">
                            {{ session('profile') }}
                        </div>
                    @endif

                    <form action="/edit" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="exampleFormControlInput1" value="{{$user->name}}">

                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="exampleFormControlInput1" value="{{$user->email}}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Аватар</label>
                                    <input type="file" class="form-control" name="image" id="exampleFormControlInput1">
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if(!empty($user->image))
                                    <img src="{{$user->image}}" alt="" class="img-fluid">
                                @else
                                    <img src="img/no-user.jpg" alt="" class="img-fluid">
                                @endif
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-warning">Edit profile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12" style="margin-top: 20px;">
            <div class="card">
                <div class="card-header"><h3>Безопасность</h3></div>

                <div class="card-body">
                    @if (session('profile_pass'))
                        <div class="alert alert-success" role="alert">
                            {{ session('profile_pass') }}
                        </div>
                    @endif

                    <form action="{{ route('change.password') }}" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Current password</label>
                                    <input type="password" name="current" class="form-control @error('current') is-invalid @enderror" id="exampleFormControlInput1">
                                    @error('current')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">New password</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleFormControlInput1">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Password confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="exampleFormControlInput1">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection