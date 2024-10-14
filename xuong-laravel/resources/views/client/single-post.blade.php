@extends('client.layouts.master')

@section('content')
    <section class="single-post-content">
        <div class="container">
            <div class="row">
                <div class="col-md-9 post-content" data-aos="fade-up">

                    <!-- ======= Single Post Content ======= -->

                    <div class="single-post">
                        <div class="post-meta">
                            <span class="date">{{ $post->category->name }}</span>
                            <span class="mx-1">&bullet;</span>
                            <span>{{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        <h1 class="mb-5">{{ $post->title }}</h1>
                        <p><span
                                class="firstcharacter">{{ substr($post->content, 0, 1) }}</span>{{ substr($post->content, 1) }}
                        </p>

                        <figure class="my-4">
                            <img src="{{ Storage::url($post->img_cover) }}" alt="" class="img-fluid">
                            <figcaption>Ảnh chính của bài viết</figcaption>
                        </figure>

                        <p>{{ $post->content }}</p>
                    </div>


                    <!-- End Single Post Content -->




                    <!-- Phần bình luận -->
                    <div class="comments">
                        <h5 class="comment-title py-4">{{ $post->comments->count() }} Bình luận</h5>

                        @foreach ($post->comments as $comment)
                            <div class="comment d-flex mb-4">
                                <div class="flex-grow-1 ms-2 ms-sm-3">
                                    <div class="comment-meta d-flex align-items-baseline">
                                        <h6 class="me-2">{{ $comment->name }}</h6>
                                        <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="comment-body">
                                        {{ $comment->body }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Form thêm bình luận -->
                    <div class="mb-4">
                        <h5 class="comment-title">Thêm bình luận</h5>
                        <form action="{{ route('comments.store', $post->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên của bạn</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="body" class="form-label">Nội dung</label>
                                <textarea name="body" class="form-control" id="body" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </form>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="trending">
                        <h3>Trending</h3>
                        <ul class="trending-post">
                            @foreach ($trendingPosts as $key => $post)
                                <!-- Duyệt qua các bài viết trending -->
                                <li>
                                    <a href="{{ route('single.post', $post->id) }}">
                                        <span class="number">{{ $key + 1 }}</span>
                                        <h3>{{ $post->title }}</h3>
                                        <span class="author">{{ $post->author->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div> 
            </div>
        </div>
    </section>
@endsection
