<?php

namespace App\Http\Controllers;

use App\CommentReply;
use App\Http\Requests\CommentReplyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CommentReplyController extends Controller
{
    /**
     * Instantiate a new CommentRepliesController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin', ['except' => 'store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = CommentReply::latest()->paginate(15);
        return view('admin.pages.comments.replies.index', compact('comments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentReplyRequest $request)
    {
        CommentReply::create([
            'author'        =>  $request['author'],
            'email'         =>  $request['email'],
            'content'       =>  $request['content'],
            'comment_id'    =>  $request['comment_id']
        ]);

        if (App::isLocale('pl')) {
            return response()->json(['status' => 'Komentarz został wysłany do zatwierdzenia!']);
        } else {
            return response()->json(['status' => 'The comment has been sent to approve!']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        CommentReply::findOrFail($id)->update($input);

        if (App::isLocale('pl')) {
            return redirect()->back()->with('status', 'Komentarz został zaktualizowany!');
        } else {
            return redirect()->back()->with('status', 'The comment has been updated!');
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
        CommentReply::findOrFail($id)->delete();

        if (App::isLocale('pl')) {
            return redirect()->route('replies.index')->with('status', 'Komentarz został skasowany!');
        } else {
            return redirect()->route('replies.index')->with('status', 'The comment has been deleted!');
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
        $comment = CommentReply::findOrFail($id);
        $comment->update($input);

        if (App::isLocale('pl'))
        {
            return response()->json([
                'title'             => 'Wiadomość',
                'status'            => 'Komentarz użytkownika &#8222;'.$comment->author.'&#8221; został zaktualizowany!'
            ]);
        } else {
            return response()->json([
                'title'             => 'Message',
                'status'            => ucfirst($comment->author).'\'s comment has been updated!'
            ]);
        }
    }
}
