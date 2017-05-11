<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">

        {{-- Home --}}
        @if (Route::is('admin'))
            <h2>{{trans('admin.homePage')}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.dashboard')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.homePage')}}</strong>
                </li>
            </ol>

        {{-- All Posts --}}
        @elseif (Route::is('posts.index'))
            <h2>{{trans('admin.allPosts')}}&nbsp;({{$posts->total()}})</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('posts.index')}}">{{trans('admin.posts')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.allPosts')}}</strong>
                </li>
            </ol>

        {{-- Add Post --}}
        @elseif (Route::is('posts.create'))
            <h2>{{trans('admin.addPost')}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('posts.index')}}">{{trans('admin.posts')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.addPost')}}</strong>
                </li>
            </ol>

        {{-- Edit Post --}}
        @elseif (Route::is('posts.edit'))
            <h2>{{$post->metadata->title}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('posts.index')}}">{{trans('admin.posts')}}</a>
                </li>
                <li class="active">
                    <strong>{{$post->metadata->title}}</strong>
                </li>
            </ol>

        {{-- Show Post --}}
        @elseif (Route::is('posts.show'))
            <h2>{{$post->metadata->title}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('posts.index')}}">{{trans('admin.posts')}}</a>
                </li>
                <li class="active">
                    <strong>{{$post->metadata->title}}</strong>
                </li>
            </ol>

        {{-- All Comments --}}
        @elseif (Route::is('comments.index'))
            <h2>{{trans('admin.allComments')}}&nbsp;({{$comments->total()}})</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('comments.index')}}">{{trans('admin.comments')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.allComments')}}</strong>
                </li>
            </ol>

        {{-- Show Comment --}}
        @elseif (Route::is('comments.show'))
            <h2>{{$comment->author}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('comments.index')}}">{{trans('admin.comments')}}</a>
                </li>
                <li class="active">
                    <strong>{{$comment->post->metadata->title}}</strong>
                </li>
            </ol>

        {{-- All Replies --}}
        @elseif (Route::is('replies.index'))
            <h2>{{trans('admin.allReplies')}}&nbsp;({{$comments->total()}})</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('comments.index')}}">{{trans('admin.comments')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.allReplies')}}</strong>
                </li>
            </ol>

        {{-- All Categories --}}
        @elseif (Route::is('categories.index'))
            <h2>{{trans('admin.categories')}}&nbsp;({{$categories->total()}})</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.categories')}}</strong>
                </li>
            </ol>

        {{-- Edit Category --}}
        @elseif (Route::is('categories.edit'))
            <h2>{{$category->name}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('categories.index')}}">{{trans('admin.categories')}}</a>
                </li>
                <li class="active">
                    <strong>{{$category->name}}</strong>
                </li>
            </ol>

        {{-- All Tags --}}
        @elseif (Route::is('tags.index'))
            <h2>{{trans('admin.tags')}}&nbsp;({{$tags->total()}})</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.tags')}}</strong>
                </li>
            </ol>

        {{-- Edit Tag --}}
        @elseif (Route::is('tags.edit'))
            <h2>{{$tag->name}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('tags.index')}}">{{trans('admin.tags')}}</a>
                </li>
                <li class="active">
                    <strong>{{$tag->name}}</strong>
                </li>
            </ol>

        {{-- All Media --}}
        @elseif (Route::is('media.index'))
            <h2>{{trans('admin.allMedia')}}&nbsp;({{$media->total()}})</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('media.index')}}">{{trans('admin.media')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.allMedia')}}</strong>
                </li>
            </ol>

        {{-- All Photos --}}
        @elseif (Route::is('photos.index'))
            <h2>{{trans('admin.allPhotos')}}&nbsp;({{$media->total()}})</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('media.index')}}">{{trans('admin.media')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.allPhotos')}}</strong>
                </li>
            </ol>

        {{-- Add Photos --}}
        @elseif (Route::is('photos.create'))
            <h2>{{trans('admin.addPhoto')}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('media.index')}}">{{trans('admin.media')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.addPhoto')}}</strong>
                </li>
            </ol>

        {{-- Edit Photos --}}
        @elseif (Route::is('photos.edit'))
            <h2>{{trans('admin.editPhoto')}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('media.index')}}">{{trans('admin.media')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.editPhoto')}}</strong>
                </li>
            </ol>

        {{-- All Users --}}
        @elseif (Route::is('users.index'))
            <h2>{{trans('admin.allUsers')}}&nbsp;({{$users->total()}})</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">{{trans('admin.users')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.allUsers')}}</strong>
                </li>
            </ol>

        {{-- Add User --}}
        @elseif (Route::is('users.create'))
            <h2>{{trans('admin.addUser')}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">{{trans('admin.users')}}</a>
                </li>
                <li class="active">
                    <strong>{{trans('admin.addUser')}}</strong>
                </li>
            </ol>

        {{-- Edit User --}}
        @elseif (Route::is('users.edit'))
            <h2>{{$user->name}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('admin')}}">{{trans('admin.home')}}</a>
                </li>
                <li>
                    <a href="{{route('users.index')}}">{{trans('admin.users')}}</a>
                </li>
                <li class="active">
                    <strong>{{$user->name}}</strong>
                </li>
            </ol>        

        @endif

    </div>
</div>
