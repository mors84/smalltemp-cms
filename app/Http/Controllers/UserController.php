<?php

namespace App\Http\Controllers;

use App\Photo;
use App\PhotoSize;
use App\Rating;
use App\Role;
use App\SocialMedia;
use App\SocialMediaLink;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $socialMedia = SocialMedia::all();
        return view('admin.pages.users.create', compact('roles', 'socialMedia'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        isset($input['is_active']) ? $input['is_active'] = 1 : $input['is_active'] = 0;
        $input['password'] = bcrypt($request->password);

        // ADD PHOTO
        if ($file = $request->file('photo_id'))
        {
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = str_slug( basename($file->getClientOriginalName(), '.'.$fileExtension) );
            $img = Image::make($file);
            $fileInputWidth = $img->width();
            $fileSaveWidth = [5120, 4096, 2880, 1920, 1440, 1024, 768, 360];

            // Create folder if not exists.
            if (!file_exists('images/users')) {
                mkdir('images/users', 0777, true);
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
                    $path = $file->storeAs('users', $fileFullName);

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

        $user = User::create($input);

        // Social Media
        $social_media = [];

        foreach ($input['profile_links'] as $i => $link) {
            if ($link) {
                $social_media[++$i] = ['profile_link' => $link];
            }
        }

        $user->socialMediaLinks()->attach($social_media);

        if (App::isLocale('pl')) {
            return redirect()->route('users.index')->with('status', 'Użytkownik &#8222;'.$user->name.'&#8221; został wprowadzony do bazy!');
        } else {
            return redirect()->route('users.index')->with('status', 'The user &#8222;'.$user->name.'&#8221; has been added!');
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
        $user = User::findOrFail($id);

        $ratingsAvgOfSinglePostByUser = [];
        foreach ($user->posts as $key => $post) {
            $ratingsAvgOfSinglePostByUser[$key] = $post->ratings->avg('number');
        }
        if (count(array_filter($ratingsAvgOfSinglePostByUser)) > 0) {
            $avgRatingOfPostsByUser = round(array_sum($ratingsAvgOfSinglePostByUser)/count(array_filter($ratingsAvgOfSinglePostByUser)), 1);
        }

        $roles = Role::all();
        $socialMedia = SocialMedia::all();
        return view('admin.pages.users.edit', compact('user', 'avgRatingOfPostsByUser', 'roles', 'socialMedia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request['password']) {

            $this->validate($request, [
                'password' => 'between:6,20|confirmed'
            ]);
        }

        $input = $request->all();
        isset($input['is_active']) ? $input['is_active'] = 1 : $input['is_active'] = 0;
        $input['password'] = bcrypt($request->password);

        // ADD PHOTO
        if ($file = $request->file('photo_id'))
        {
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = str_slug( basename($file->getClientOriginalName(), '.'.$fileExtension) );
            $img = Image::make($file);
            $fileInputWidth = $img->width();
            $fileSaveWidth = [5120, 4096, 2880, 1920, 1440, 1024, 768, 360];

            // Create folder if not exists.
            if (!file_exists('images/users')) {
                mkdir('images/users', 0777, true);
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
                    $path = $file->storeAs('users', $fileFullName);

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
        else {
            if (isset($user->photo)) {
                $user->photo->update([
                    'alt'       =>  $request['alt_attribute'],
                    'title'     =>  $request['title_attribute'],
                ]);
            }
        }

        $user->update($input);

        // Social Media
        $social_media = [];

        foreach ($input['profile_links'] as $i => $link) {
            if ($link) {
                $social_media[++$i] = ['profile_link' => $link];
            }
        }

        $user->socialMediaLinks()->sync($social_media);

        if (App::isLocale('pl')) {
            return redirect()->route('users.index')->with('status', 'Użytkownik &#8222;'.$user->name.'&#8221; został zaktualizowany!');
        } else {
            return redirect()->route('users.index')->with('status', 'The user &#8222;'.$user->name.'&#8221; has been updated!');
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
        $user = User::findOrFail($id);
        $user->socialMediaLinks()->detach();
        $user->delete();

        if (App::isLocale('pl')) {
            return redirect()->route('users.index')->with('status', 'Użytkownik &#8222;'.$user->name.'&#8221; został skasowany!');
        } else {
            return redirect()->route('users.index')->with('status', 'The user &#8222;'.$user->name.'&#8221; has been deleted!');
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
        $user = User::findOrFail($id);
        $user->update($input);

        if (App::isLocale('pl'))
        {
            return response()->json([
                'title'             => 'Wiadomość',
                'status'            => 'Użytkownik &#8222;'.$user->name.'&#8221; został zaktualizowany!'
            ]);
        } else {
            return response()->json([
                'title'             => 'Message',
                'status'            => 'The user &#8222;'.$user->name.'&#8221; has been updated!'
            ]);
        }
    }
}
