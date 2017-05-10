<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Photo::latest()->paginate(15);

        // Show Tags
        $tags = [];
        foreach ($media as $singleMedia) {
            foreach ($singleMedia->tags as $tag) {
                array_push($tags, $tag->name);
            }
        }
        $showTags = array_unique($tags);
        asort($showTags);

        return view('admin.pages.media.index', compact('media', 'showTags'));
    }
}
