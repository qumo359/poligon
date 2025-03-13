<div class="col-md-3">
    <aside class="sidebar">
        <div class="sidebar-start">
            <div class="sidebar-head">
                <a href="{{ route('admin.posts.index') }}" class="logo-wrapper" title="Home">
                    <span class="sr-only">Главная</span>
                </a>
                <div class="col-lg-4">
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Admin</h4>
                        <ul class="list cat-list">
                            <li>
                                <a href="{{ route('admin.posts.index') }}"
                                   class="{{ request()->routeIs('admin.posts.index') ? 'active' : '' }} d-flex">
                                    <p>Посты</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.categories.index') }}"
                                   class="{{ request()->routeIs('admin.categories.index') ? 'active' : '' }} d-flex">
                                    <p>Категории</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.index') }}"
                                   class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }} d-flex">
                                    <p>Пользователи</p>
                                </a>
                            </li>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </aside>
</div>
