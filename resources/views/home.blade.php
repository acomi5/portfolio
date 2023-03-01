@extends('layouts.app')
@include('layouts.sidebar')
@section('content')
    @foreach ($posts as $post)
        @include('modal.add_post_show')
        @include('modal.add_post_edit')
        <div class="container">
            <div class="row mt-3">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card mx-auto p-0" style="width: 450px;">
                    <div class="card-header text-muted small d-flex justify-content-between">
                        <div class="col d-flex justify-content-start align-items-center">
                            @if ($post->user->avatar === null)
                                <img class="rounded-circle" src="{{ Storage::disk('s3')->url('default.jpg') }}" alt="プロフィール画像"
                                    width="32" height="32">
                                {{-- <img class="rounded-circle" src="{{ asset('storage/profiles/default.jpg') }}" alt="プロフィール画像"
                                    width="32" height="32"> --}}
                            @else
                                <img class="rounded-circle" src="{{ Storage::disk('s3')->url($post->user->avatar) }}"
                                    alt="プロフィール画像" width="32" height="32">
                                {{-- <img class="rounded-circle" src="{{ asset('storage/profiles/' . $post->user->avatar) }}"
                                    alt="プロフィール画像" width="32" height="32"> --}}
                            @endif
                            <div class="ms-2">{{ $post->user->name }}
                            </div>
                        </div>
                        @if ($post->user_id == Auth::id())
                            <a href="#" class="nav-link active pt-1" data-bs-toggle="modal"
                                data-bs-target="#addPostShowModal{{ $post->id }}">
                                <i class="bi bi-three-dots"></i>
                            </a>
                        @endif
                    </div>
                    <div class="card-body p-0">
                        <img src="{{ Storage::disk('s3')->url($post->image) }}">
                        {{-- <img src="{{ asset('storage/images/' . $post->image) }}"> --}}
                        <div class="card-text py-2 px-3">
                            @if ($post->likes()->where('user_id', Auth::user()->id)->count() == 1)
                                <a href="{{ route('unlike', $post) }}">
                                    <i class="bi bi-heart-fill" style="font-size: 22px; color: red;"></i></a>
                                <span class="badge text-dark">いいね！{{ $post->likes->count() }}</span>
                            @else
                                <a href="{{ route('like', $post) }}">
                                    <i class="bi bi-heart" style="font-size: 22px; color: black;"></i></a>
                                <span class="badge text-dark">いいね！{{ $post->likes->count() }}</span>
                            @endif

                            <p class="card-text text-muted small pt-1">投稿日
                                <strong> {{ $post->created_at->diffForHumans() }}</strong>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer text-muted small">コメント<br>
                        <strong>{{ $post->comment }}</strong>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
