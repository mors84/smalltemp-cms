<?php

namespace App\Http\Controllers;

use App\Metadata;
use App\Tag;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')->paginate(10);
        return view('admin.pages.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request)
    {
        $input = $request->all();

        empty(!$input['metadata_title']) ? $input['metadata_title'] : $input['metadata_title'] = $input['name'];

        $metadata = Metadata::create([
            'title'         =>  $input['metadata_title'],
            'description'   =>  $input['metadata_description'],
            'keywords'      =>  $input['metadata_keywords'],
        ]);

        $tag = Tag::create([
            'name'          =>  $input['name'],
            'slug'          =>  str_slug($input['name']),
            'metadata_id'   =>  $metadata['id'],
        ]);

        if (App::isLocale('pl')) {
            return redirect()->route('tags.index')->with('status', 'Tag &#8222;'.$tag->name.'&#8221; został wprowadzony do bazy!');
        } else {
            return redirect()->route('tags.index')->with('status', 'The tag &#8222;'.$tag->name.'&#8221; has been added!');
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
        $tag = Tag::findOrFail($id);
        return view('admin.pages.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id)
    {
        $input = $request->all();
        $tag = Tag::findOrFail($id);
        $metadata = $tag->metadata;

        $metadata->update([
            'title'         =>  $input['metadata_title'],
            'description'   =>  $input['metadata_description'],
            'keywords'      =>  $input['metadata_keywords'],
        ]);

        $tag->update([
            'name'          =>  $input['name'],
            'slug'          =>  str_slug($input['name']),
            'metadata_id'   =>  $metadata['id'],
        ]);

        if (App::isLocale('pl')) {
            return redirect()->route('tags.index')->with('status', 'Tag &#8222;'.$tag->name.'&#8221; został zaktualizowany!');
        } else {
            return redirect()->route('tags.index')->with('status', 'The tag &#8222;'.$tag->name.'&#8221; has been updated!');
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
        $tag = Tag::findOrFail($id);
        $tag->metadata->delete();
        $tag->delete();

        if (App::isLocale('pl')) {
            return redirect()->route('tags.index')->with('status', 'Tag &#8222;'.$tag->name.'&#8221; został skasowany!');
        } else {
            return redirect()->route('tags.index')->with('status', 'The tag &#8222;'.$tag->name.'&#8221; has been deleted!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxStore(TagRequest $request)
    {
        $input = $request->all();

        empty(!$input['metadata_title']) ? $input['metadata_title'] : $input['metadata_title'] = $input['name'];

        $metadata = Metadata::create([
            'title'         =>  $input['metadata_title'],
            'description'   =>  $input['metadata_description'],
            'keywords'      =>  $input['metadata_keywords'],
        ]);

        $tag = Tag::create([
            'name'          =>  $input['name'],
            'slug'          =>  str_slug($input['name']),
            'metadata_id'   =>  $metadata['id'],
        ]);

        $newTags = Tag::orderBy('name')->get();

        if (App::isLocale('pl'))
        {
            return response()->json([
                'title'             => 'Wiadomość',
                'status'            => 'Tag &#8222;'.$tag->name.'&#8221; został wprowadzony do bazy!',
                'newTags'           =>  $newTags
            ]);
        } else {
            return response()->json([
                'title'             => 'Message',
                'status'            => 'The tag &#8222;'.$tag->name.'&#8221; has been added!',
                'newTags'           =>  $newTags
            ]);
        }
    }
}
