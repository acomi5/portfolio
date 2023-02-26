<div class="modal fade" id="addPostEditModal{{ $post->id }}" tabindex="-1"
    aria-labelledby="addPostEditModalLabel{{ $post->id }}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-5" id="modalLabel2">編集</h5>
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

            <div class="container">
                <div class="row">
                    <div class="col">
                        <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @if ($post->image)
                                <img src="{{ asset('storage/images/' . $post->image) }}" style="height:350px">
                            @endif
                            <input class="my-2" id="image" type="file" name="image">
                    </div>
                    <div class="col">
                        <label for="comment" class="mt-2">コメント</label>
                        <textarea name="comment" class="form-control" id="comment" cols="30" rows="10">{{ old('comment', $post->comment) }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">編集</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
