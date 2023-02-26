@include('modal.add_post_create')
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column border-end">
            <li class="nav-item"><a href="{{ route('home') }}" class="nav-link active text-dark bg-light my-3">
                <i class="bi bi-house me-1" style="font-size: 32px;"></i><span> ホーム</span>
                </a></li>
            <li class="nav-item"><a href="#" class="nav-link active text-dark bg-light mb-3"
                    data-bs-toggle="modal" data-bs-target="#addPostModal">
                    <i class="bi bi-plus-square me-1" style="font-size: 32px;"></i><span> 新規投稿</span>
                </a></li>
            <li class="nav-item"><a href="{{ route('profile') }}" class="nav-link active text-dark bg-light mb-3">
                <i class="bi bi-person-circle me-1" style="font-size: 32px;"></i><span> プロフィール</span>
                </a></li>
            <li class="nav-item mx-1">
                <form action="{{ route('post.index') }}" method="get" class="form-inline">
                    <div class="form-group mb-2">
                        <input type="text" name="keyword" class="form-control" placeholder="キーワードを入力">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="検索" class="btn btn-info ml-5 color:white">
                    </div>
                </form>
            </li>
        </ul>
    </div>
</nav>
