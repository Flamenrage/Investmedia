<div class="sidebar">
    <div class="widget">
        <h2 class="widget-title">Рейтинг публикаций</h2>
        <div class="blog-list-widget">
            <div class="list-group">
                @foreach($popular_posts as $post)
                <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="w-100 last-item justify-content-between">
                        <img src="{{ $post->getImage() }}" style="height: 40px" alt="" class="img-fluid float-left">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-1">{{ $post->title }}</h5>
                        </div>
                        <small>{{ $post->getPostDate() }}</small>
                        <small>| <i class="fa fa-eye mr-1"></i> {{$post->views}}</small>
                    </div>
                </a>
                @endforeach
            </div>
        </div><!-- end blog-list -->
    </div><!-- end widget -->

    <div class="widget">
        <h2 class="widget-title">Категории</h2>
        <div class="link-widget">
            <ul>
                @foreach($cats as $cat)
                <li><a href="{{ route('categories.single', ['slug' => $cat->slug]) }}">{{$cat->title}}<span>({{$cat->posts_count}})</span></a></li>
                @endforeach
            </ul>
        </div><!-- end link-widget -->
    </div><!-- end widget -->
</div><!-- end sidebar -->
