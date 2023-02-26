<div class="modal fade" id="addPostShowModal{{ $post->id }}" aria-hidden="true" aria-labelledby="modalLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <nav class="nav flex-column text-center small">
                <form action="{{ route('post.destroy', $post) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn text-danger fw-bold border-0 pt-3 btn-sm"
                        onclick="return confirm('本当に削除しますか？');">削除</button>
                </form>
                <span class="border-bottom"></span>
                <button type="button" class="btn border-0 py-3 btn-sm" data-bs-toggle="modal"
                    data-bs-target="#addPostEditModal{{ $post->id }}">編集</button>
                <span class="border-bottom"></span>
                <a class="nav-link active text-secondary py-3" href="{{ route('home') }}">キャンセル</a>
            </nav>
        </div>
    </div>
</div>
