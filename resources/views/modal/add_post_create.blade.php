<div class="modal fade" id="addPostModal" tabindex="-1" aria-labelledby="addPostModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPostModalLabel">新規投稿</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label for="comment">コメント</label>
                    <textarea name="comment" class="form-control" id="comment" cols="30" rows="10">{{ old('comment') }}</textarea>

                    <label for="image" class="mt-2">画像</label>
                    <div class="col-md-6">
                        <input id="image" type="file" name="image" value="{{ old('image') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">投稿</button>
                </div>
            </form>
        </div>
    </div>
</div>
