<?php

namespace App\Http\Controllers;

use App\Photo;
use App\PhotoSize;
use App\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Photo::with('tags')->latest()->paginate(15);

        // Show Tags
        $tags = [];
        foreach ($media as $singleMedia) {
            foreach ($singleMedia->tags as $tag) {
                array_push($tags, $tag->name);
            }
        }
        $showTags = array_unique($tags);
        asort($showTags);

        return view('admin.pages.media.photos.index', compact('media', 'showTags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::orderBy('name')->get();
        return view('admin.pages.media.photos.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoRequest $request)
    {
        // ADD PHOTO
        if ($file = $request->file('path'))
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
                'alt'       =>  $request['alt'],
                'title'     =>  $request['title'],
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
        }

        // Add TAGS
        if (isset($request['tags']))
        {
            $tags = $request['tags'];
            $photo->tags()->attach($tags);
        }

        if (App::isLocale('pl')) {
            return redirect()->route('photos.index')->with('status', 'Zdjęcie zostało wprowadzone do bazy!');
        } else {
            return redirect()->route('photos.index')->with('status', 'The photo has been added!');
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
        $photo = Photo::findOrFail($id);
        $tags = Tag::orderBy('name')->get();

        $itemPhoto = $photo->id / $photo->count();

        $previous = Photo::where('id', '>', $photo->id)->min('id');
        $next = Photo::where('id', '<', $photo->id)->max('id');

        return view('admin.pages.media.photos.edit', compact('photo', 'tags', 'itemPhoto', 'previous', 'next'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoRequest $request, $id)
    {
        $photo = Photo::findOrFail($id);
        $photo->update([
            'alt'       =>  $request['alt'],
            'title'     =>  $request['title'],
        ]);

        // EDIT TAGS
        if (isset($request['tags'])) {
            $tags = $request['tags'];
            $photo->tags()->sync($tags);
        } else {
            $photo->tags()->detach();
        }

        if (App::isLocale('pl')) {
            return redirect()->route('photos.index')->with('status', 'Zdjęcie zostało zaktualizowane!');
        } else {
            return redirect()->route('photos.index')->with('status', 'The photo has been updated!');
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
        $photo = Photo::findOrFail($id);

        foreach ($photo->sizes as $size) {
            $path = public_path() . $size->path;
            if (File::exists($path)) {
                unlink($path);
            }
        }

        $photo->tags()->detach();
        $photo->delete();

        if (App::isLocale('pl')) {
            return redirect()->route('photos.index')->with('status', 'Zdjęcie zostało skasowane!');
        } else {
            return redirect()->route('photos.index')->with('status', 'The photo has been deleted!');
        }
    }
}
