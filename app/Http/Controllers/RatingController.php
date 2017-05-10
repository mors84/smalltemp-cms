<?php

namespace App\Http\Controllers;

use App\Post;
use App\Rating;
use App\Http\Requests\RatingRequest;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(RatingRequest $request)
    {
        $post = Post::findOrFail($request['post_id']);

        $addressesIpUsedInTable = Rating::where('rating_id', $post->id)->pluck('address_ip');
        $addressIp = $request->ip();

        if ($addressesIpUsedInTable->contains($addressIp))
        {
            $post->ratings()->where('address_ip', $addressIp)->update(['star_id' => $request['rating']]);

            $avgOfRatings = round($post->ratings->avg('number'), 1);
            $countOfRatings = $post->ratings->count('number');

            return response()->json([
                'avgOfRatings' => $avgOfRatings,
                'countOfRatings' => $countOfRatings
            ]);
        }
        else
        {
            $post->ratings()->attach($request['rating'], ['address_ip' => $addressIp]);

            $avgOfRatings = round($post->ratings->avg('number'), 1);
            $countOfRatings = $post->ratings->count('number');

            return response()->json([
                'avgOfRatings' => $avgOfRatings,
                'countOfRatings' => $countOfRatings
            ]);
        }

    }
}
