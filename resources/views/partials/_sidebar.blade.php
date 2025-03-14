<div class="blog_right_sidebar">
    <aside class="single_sidebar_widget search_widget">
        <form action="{{ route('blog.post.search') }}" method="GET">
            <div class="form-group">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Поиск..." name="query"
                           value="{{ request('query') }}"
                           onfocus="this.placeholder = ''"
                           onblur="this.placeholder = 'Search Keyword'">
                    <div class="input-group-append">
                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                    type="submit">Search
            </button>
        </form>
    </aside>
    <aside class="single_sidebar_widget post_category_widget">
        <h4 class="widget_title">Category</h4>
        <ul class="list cat-list">
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('blog.categories.show', $category->slug) }}" class="d-flex">
                        <p>  {{ $category->title }}</p>
                        <p>({{ $category->posts_count ?? 0 }})</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </aside>
    <aside class="single_sidebar_widget popular_post_widget">
        <h3 class="widget_title">Random Post</h3>
        @foreach($latestPosts as $latestPost)
            <div class="media post_item">
                @if($latestPost->post_image)
                    <img src="{{$latestPost->post_image}}"  style="width: 70px; height: auto" alt="">
                @else
                    <img class="img-preview-container"  style="width: 70px; height: auto" src="/storage/test/imagenotfound.png"
                         alt="NOimage">
                @endif
                <div class="media-body">
                    <a href="single-blog.html">
                        <h3>{{$latestPost->title}}</h3>
                    </a>
                    <p>{{\Carbon\Carbon::create($latestPost->published_at)->format('d-M')}}</p>
                </div>
            </div>
        @endforeach
    </aside>
</div>
