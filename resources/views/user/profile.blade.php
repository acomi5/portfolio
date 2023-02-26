@extends('layouts.app')
@include('layouts.sidebar')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 ms-sm-auto d-flex justify-content-center my-3">
                @if ($user->avatar === null)
                    <img class="rounded-circle" src="{{ asset('storage/profiles/default.jpg') }}" alt="プロフィール画像" width="150"
                        height="150">
                @else
                    <img class="rounded-circle" src="{{ asset('storage/profiles/' . $user->avatar) }}" alt="プロフィール画像"
                        width="150" height="150">
                @endif
                <div class="mt-3 ms-5">
                    {{ $user->name }}
                    <a href="{{ route('profile.edit', $user->id) }}"><button type="button"
                            class="btn btn-outline-secondary ms-3">プロフィール編集</button></a>
                    <div class="mt-3">
                        @if ($user->posts->count())
                            <span>投稿 {{ $user->posts->count() }} 件</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 ms-sm-auto d-flex flex-wrap justify-content-strat mb-3">
                @foreach ($posts as $post)
                    <div class="d-flex justify-content-between align-items-center img-wrap mt-3 me-3">
                        @if ($post->user_id == Auth::id())
                            @include('modal.add_post_show')
                            @include('modal.add_post_edit')
                            <a href="#" class="nav-link active pt-1" data-bs-toggle="modal"
                                data-bs-target="#addPostShowModal{{ $post->id }}">
                                <img src="{{ asset('storage/images/' . $post->image) }}">
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <footer>
        <div class="d-flex justify-content-center align-items-center my-3">
            <p class="text-muted small mb-0">&copy; 2023 {{ config('app.name', 'Laravel') }} All rights reserved.</span>
        </div>
    </footer>
@endsection
