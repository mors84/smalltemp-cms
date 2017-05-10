<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use App\Post;
use App\Vote;
use App\Http\Requests\VoteRequest;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(VoteRequest $request)
    {
        switch ($request['type']) {
            case 'comment':
            $model = Comment::findOrFail($request['id']);
            break;

            case 'reply':
            $model = CommentReply::findOrFail($request['id']);
            break;

            case 'post':
            $model = Post::findOrFail($request['id']);
            break;

            default:
            $model = null;
            break;
        }

        $votes = $model->votes();
        $addressesIpUsedInTable = $votes->where('votetable_id', $request['id'])->pluck('address_ip');
        $addressIp = $request->ip();

        if ($addressesIpUsedInTable->contains($addressIp))
        {
            $votes->where('address_ip', $addressIp)->update([
                'value' => $request['value']
            ]);

            $newVoteCount = $votes->where('value', $request['value'])->count();
            return response()->json(['newVoteCount' => $newVoteCount]);
        }
        else
        {
            $votes->create([
                'value' => $request['value'],
                'address_ip' => $addressIp
            ]);

            $newVoteCount = $votes->where('value', $request['value'])->count();
            return response()->json(['newVoteCount' => $newVoteCount]);
        }
    }
}
