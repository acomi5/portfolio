@extends('layouts.app')
@include('layouts.sidebar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <div class="text-center">
                            <label for="avatar">
                                @if ($user->avatar === null)
                                    <img class="rounded-circle" src="{{ Storage::disk('s3')->url('default.jpg') }}"
                                        alt="プロフィール画像" width="150" height="150">
                                    {{-- <img class="rounded-circle" src="{{ asset('storage/profiles/default.jpg') }}"
                                        alt="プロフィール画像" width="150" height="150"> --}}
                                @else
                                    <img class="rounded-circle" src="{{ Storage::disk('s3')->url($user->avatar) }}"
                                        alt="プロフィール画像" width="150" height="150">
                                    {{-- <img class="rounded-circle" src="{{ asset('storage/profiles/' . $user->avatar) }}"
                                        alt="プロフィール画像" width="150" height="150"> --}}
                                @endif
                                <input id="avatar" name="avatar" type="file"
                                    class="form-control @error('avatar') is-invalid @enderror" style="display:none;"
                                    value="" accept="image/png, image/jpeg, image/jpg">
                                <div class="text-primary small mt-2">プロフィール写真の変更
                                </div>
                            </label>
                            @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="d-flex justify-content-between">
                            <label for="name" class="text-md-left">名前</label>
                        </div>
                        <div class="collapse show editUserName">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                                autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="d-flex justify-content-between">
                            <label for="email" class="text-md-left">メールアドレス</label>
                        </div>
                        <div class="collapse show editUserMail">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email', $user->email) }}" required autocomplete="email"
                                autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" style="width: 100px;">
                        保存
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
