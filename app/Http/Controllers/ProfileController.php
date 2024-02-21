<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;

class ProfileController extends Controller
{
    public function index() {
        $user = auth()->user();
        $photos = Photo::where('user_id',
        auth()->user()->id)->orderBy('created_at', 'desc')->get();
        return view('pages.profile', compact('photos', 'user'));
    }

    public function people($user_id) {
        if(!User::find($user_id)) {
            return redirect()->route('home');
        }
        $user = User::find($user_id)->select('id', 'nama', 'avatar', 'avatar', 'created_at')->first();
    }
}
