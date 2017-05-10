<?php

namespace App\Http\Controllers;

use App\Category;
use App\Metadata;
use App\Photo;
use App\PhotoSize;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
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
                'alt'       =>  $request['alt_attribute'],
                'title'     =>  $request['title_attribute'],
            ]);

            // Add inputs to database - table: photo_sizes.
            for ($i=0; $i < count($fileSaveWidth); $i++) {

                if ($fileInputWidth >= $fileSaveWidth[$i]) {

                    $fileFullName = $fileName . '-' . $fileSaveWidth[$i] . '.' . $fileExtension;
                    $path = $file->storeAs('upload', $fileFullName);

                    $img->widen($fileSaveWidth[$i])->save('images/' . $path, 60);

                    $photo_size = PhotoSize::create([
                        'photo_id'  =>  $photo->id,
                        'path'      =>  $path,
                        'width'     =>  $fileSaveWidth[$i],
                    ]);
                }
            }

            $photo_id = $photo->id;
        }
        else
        {
            $photo_id = NULL;
        }

        empty(!$request['metadata_title']) ? $request['metadata_title'] : $request['metadata_title'] = $request['name'];
        $metadata = Metadata::create([
            'title'         =>  $request['metadata_title'],
            'description'   =>  $request['metadata_description'],
            'keywords'      =>  $request['metadata_keywords'],
        ]);

        $category = Category::create([
            'name'          =>  $request['name'],
            'metadata_id'   =>  $metadata['id'],
            'photo_id'      =>  $photo_id,
        ]);

        if (App::isLocale('pl')) {
            return redirect()->route('categories.index')->with('status', 'Kategoria &#8222;'.$category->name.'&#8221; została wprowadzona do bazy!');
        } else {
            return redirect()->route('categories.index')->with('status', 'The category &#8222;'.$category->name.'&#8221; has been added!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $metadata = $category->metadata;

        $metadata->update([
            'title'         =>  $request['metadata_title'],
            'description'   =>  $request['metadata_description'],
            'keywords'      =>  $request['metadata_keywords'],
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
                'alt'       =>  $request['alt_attribute'],
                'title'     =>  $request['title_attribute'],
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

            $category->update(['photo_id' => $photo->id]);
        }
        else {
            if (isset($category->photo)) {
                $category->photo->update([
                    'alt'       =>  $request['alt_attribute'],
                    'title'     =>  $request['title_attribute'],
                ]);
            }
        }

        $category->update([
            'name'          =>  $request['name'],
            'metadata_id'   =>  $metadata['id'],
        ]);

        if (App::isLocale('pl')) {
            return redirect()->route('categories.index')->with('status', 'Kategoria &#8222;'.$category->name.'&#8221; została zaktualizowana!');
        } else {
            return redirect()->route('categories.index')->with('status', 'The category &#8222;'.$category->name.'&#8221; has been updated!');
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
        $category = Category::findOrFail($id);
        $category->metadata->delete();
        $category->delete();

        if (App::isLocale('pl')) {
            return redirect()->route('categories.index')->with('status', 'Kategoria &#8222;'.$category->name.'&#8221; została wskasowana!');
        } else {
            return redirect()->route('categories.index')->with('status', 'The category &#8222;'.$category->name.'&#8221; has been deleted!');
        }
    }
}
