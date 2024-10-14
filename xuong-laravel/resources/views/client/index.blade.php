@extends('client.layouts.master')

@section('content')
    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-lg-4">
                                <div class="post-entry-1 lg">
                                    <a href="{{ route('single.post', $post->id) }}">
                                        <img src="{{ Storage::url($post->img_thumbnail) }}" alt=""
                                            class="img-fluid">
                                    </a>
                                    <div class="post-meta">
                                        <span class="date">{{ $post->category->name }}</span>
                                        <span class="mx-1">&bullet;</span>
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <h2>
                                        <a href="{{ route('single.post', $post->id) }}">{{ $post->title }}</a>
                                    </h2>
                                    <p class="mb-4 d-block">{{ $post->excerpt }}</p>

                                    <div class="d-flex align-items-center author">
                                        <div class="photo">
                                            <img src="{{ Storage::url($post->author->avatar) }}" alt=""
                                                class="img-fluid">
                                        </div>
                                        <div class="name">
                                            <h3 class="m-0 p-0">{{ $post->author->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div> <!-- End inner row for posts -->
                </div>

                <!-- Trending Section -->
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
                <!-- End Trending Section -->
            </div>
        </div>
    </section> 
    <!-- End Post Grid Section -->
@endsection
