<?php

namespace App\Http\Controllers;

use App\Category;
use App\Metadata;
use App\Photo;
use App\PhotoSize;
use App\Post;
use App\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.pages.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $photos = Photo::all();
        $tags = Tag::orderBy('name')->get();
        return view('admin.pages.posts.create', compact('categories', 'photos', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $input = $request->all();
        isset($input['is_active']) ? $input['is_active'] = 1 : $input['is_active'] = 0;

        // ADD PHOTO
        if ($file = $request->file('photo_id'))
        {
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = str_slug( basename($file->getClientOriginalName(), '.'.$fileExtension) );
            $img = Image::make($file);
            $fileInputWidth = $img->width();
            $fileSaveWidth = [5120, 4096, 2880, 1920, 1440, 1024, 768, 360];

            // Create folder if not exists.
            if (!file_exists('images/upload')) {
                mkdir('images/upload', 0777, true);
            }

            // Add inputs to database - table: photos.
            $photo = Photo::create([
                'alt'       =>  $input['alt_attribute'],
                'title'     =>  $input['title_attribute'],
            ]);

            // Add inputs to database - table: photo_sizes.
            for ($i=0; $i < count($fileSaveWidth); $i++) {

                if ($fileInputWidth >= $fileSaveWidth[$i]) {

                    $fileFullName = $fileName . '-' . $fileSaveWidth[$i] . '.' . $fileExtension;
                    $path = $file->storeAs('upload', $fileFullName);

                    $img->widen($fileSaveWidth[$i])->save('images/' . $path, 100);

                    $photo_size = PhotoSize::create([
                        'photo_id'  =>  $photo->id,
                        'path'      =>  $path,
                        'width'     =>  $fileSaveWidth[$i],
                    ]);
                }
            }

            $input['photo_id'] = $photo->id;
        }
        else
        {
            $input['photo_id'] = NULL;
        }

        // Add inputs to database - table: metadatas.
        empty(!$input['metadata_title']) ? $input['metadata_title'] : $input['metadata_title'] = $input['title'];

        $metadata = Metadata::create([
            'title'         =>  $input['metadata_title'],
            'description'   =>  $input['metadata_description'],
            'keywords'      =>  $input['metadata_keywords'],
        ]);

        // Add inputs to database - table: posts.
        $user = Auth::user();
        $post = $user->posts()->create([
            'title'         =>  $input['title'],
            'content'       =>  $input['content'],
            'slug'          =>  $input['slug'],
            'is_active'     =>  $input['is_active'],
            'category_id'   =>  $input['category_id'],
            'metadata_id'   =>  $metadata['id'],
            'photo_id'      =>  $input['photo_id'],
        ]);

        // Add inputs to database - table: taggleables.
        if (isset($input['tags']))
        {
            $tags = $input['tags'];
            $post->tags()->attach($tags);
        }

        if (App::isLocale('pl')) {
            return redirect()->route('posts.index')->with('status', 'Post &#8222;'.$post->title.'&#8221; został wprowadzony do bazy!');
        } else {
            return redirect()->route('posts.index')->with('status', 'The post &#8222;'.$post->title.'&#8221; has been added!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        return view('admin.pages.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $comments = $post->comments()->where('is_active', 1)->get();
        $countOfComments = $comments->count();
        $countOfReplies = 0;

        foreach ($post->comments->where('is_active', 1) as $comment) {
            $countOfReplies += $comment->replies->where('is_active', 1)->count();
        }

        $countOfAllComments = $countOfReplies + $countOfComments;

        return view('admin.pages.posts.show', compact('post', 'countOfAllComments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $input = $request->all();
        $post = Post::findOrFail($id);
        $metadata = $post->metadata;
        isset($input['is_active']) ? $input['is_active'] = 1 : $input['is_active'] = 0;

        // Update metadatas table.
        empty(!$input['metadata_title']) ? $input['metadata_title'] : $input['metadata_title'] = $input['title'];

        $metadata->update([
            'title'         =>  $input['metadata_title'],
            'description'   =>  $input['metadata_description'],
            'keywords'      =>  $input['metadata_keywords'],
        ]);

        // ADD PHOTO
        if ($file = $request->file('photo_id'))
        {
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = str_slug( basename($file->getClientOriginalName(), '.'.$fileExtension) );
            $img = Image::make($file);
            $fileInputWidth = $img->width();
            $fileSaveWidth = [5120, 4096, 2880, 1920, 1440, 1024, 768, 360];

            // Create folder if not exists.
            if (!file_exists('images/upload')) {
                mkdir('images/upload', 0777, true);
            }

            // Add inputs to database - table: photos.
            $photo = Photo::create([
                'alt'       =>  $input['alt_attribute'],
                'title'     =>  $input['title_attribute'],
            ]);

            // Add inputs to database - table: photo_sizes.
            for ($i=0; $i < count($fileSaveWidth); $i++) {

                if ($fileInputWidth >= $fileSaveWidth[$i]) {

                    $fileFullName = $fileName . '-' . $fileSaveWidth[$i] . '.' . $fileExtension;
                    $path = $file->storeAs('upload', $fileFullName);

                    $img->widen($fileSaveWidth[$i])->save('images/' . $path, 100);

                    $photo_size = PhotoSize::create([
                        'photo_id'  =>  $photo->id,
                        'path'      =>  $path,
                        'width'     =>  $fileSaveWidth[$i],
                    ]);
                }
            }

            $post->update(['photo_id' => $photo->id]);
        }
        else {
            if (isset($post->photo)) {
                $post->photo->update([
                    'alt'       =>  $request['alt_attribute'],
                    'title'     =>  $request['title_attribute'],
                ]);
            }
        }

        // Update posts table.
        $post->update([
            'title'         =>  $input['title'],
            'content'       =>  $input['content'],
            'slug'          =>  $input['slug'],
            'is_active'     =>  $input['is_active'],
            'category_id'   =>  $input['category_id'],
            'metadata_id'   =>  $metadata['id'],
        ]);

        // Update taggable table.
        if (isset($input['tags'])) {
            $tags = $input['tags'];
            $post->tags()->sync($tags);
        } else {
            $post->tags()->detach();
        }

        if (App::isLocale('pl')) {
            return redirect()->route('posts.index')->with('status', 'Post &#8222;'.$post->title.'&#8221; został zaktualizowany!');
        } else {
            return redirect()->route('posts.index')->with('status', 'The post &#8222;'.$post->title.'&#8221; has been updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->metadata->delete();
        $post->tags()->detach();
        $post->delete();

        if (App::isLocale('pl')) {
            return redirect()->route('posts.index')->with('status', 'Post &#8222;'.$post->title.'&#8221; został skasowany!');
        } else {
            return redirect()->route('posts.index')->with('status', 'The post &#8222;'.$post->title.'&#8221; has been deleted!');
        }
    }

    /**
     * Update the is_active in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ajaxChangeActive(Request $request, $id)
    {
        $this->validate($request, [
            'is_active' => 'required|boolean'
        ]);

        $input = $request->only(['is_active']);
        $post = Post::findOrFail($id);
        $post->update($input);

        if (App::isLocale('pl'))
        {
            return response()->json([
                'title'             => 'Wiadomość',
                'status'            => 'Post &#8222;'.$post->title.'&#8221; został zaktualizowany!'
            ]);
        } else {
            return response()->json([
                'title'             => 'Message',
                'status'            => 'The post &#8222;'.$post->title.'&#8221; has been updated!'
            ]);
        }
    }
}
