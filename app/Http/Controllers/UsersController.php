<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateUserImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * show the user's image and name,and user can change his profile picture
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();

        return view('users.profile',compact('user'));
    }

    /**
     * validate the image and change it
     * @param ValidateUserImageRequest $request
     * @return $this
     */

    public function update_image(ValidateUserImageRequest $request)
    {
        $user = Auth::user();

        $imageName = $user->id . '_image' . time() . '.' . $request->image->getClientOriginalExtension();

        $request->image->storeAs("public/images" , $imageName);

        $user->image = $imageName;

        $user->save();

        return redirect(route('posts.index'))->with('success' , 'Your Profile Image Is Uploaded');
    }
}





