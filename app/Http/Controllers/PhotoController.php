<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class PhotoController extends Controller
{
    public function index($photo_id)
    {
        $data = Photo::with('user')
            ->with('comments')
            ->withCount('likes')
            ->withExists('likedByUser', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->find($photo_id);

        return view('pages.photo', compact('data'));
    }

    public function home()
    {
        $photos = Photo::with('user')->orderBy('created_at', 'desc')->get();
        return view('pages.home', compact('photos'));
    }

    public function deletePhoto($photo_id)
    {
        $photo = Photo::find($photo_id);

        if (!$photo) {
            Alert::error('Foto tidak ditemukan');
            return redirect()->back();
        }

        if ($photo->user_id != auth()->user()->id) {
            Alert::error('Anda tidak memiliki izin untuk menghapus foto ini!');
            return redirect()->back();
        }

        Storage::delete($photo->lokasi_file);

        $photo->comments()->delete();
        $photo->likes()->delete();
        $photo->delete();

        Alert::success('Foto berhasil dihapus');
        return redirect()->route('home');
    }

    public function postPhoto()
    {
        return view('pages.post_photo');
    }

    public function postPhotoProcess(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:100000'],
            'judul_foto' => ['required', 'max:255'],
            'deskripsi_foto' => ['required', 'min:3'],
        ]);

        $photo = $request->file('photo');
        $photo_path = $photo->store('photos', ['disk' => 'public']);

        if ($photo_path == null) {
            Alert::error('Foto gagal di-upload!');
            return redirect()->back();
        }

        $photo_post = Photo::create([
            ...$request->only(['judul_foto', 'deskripsi_foto']),
            'user_id' => auth()->user()->id,
            'lokasi_file' => $photo_path
        ]);
        if ($photo_post) {
            Alert::success('Foto berhasil di-upload!');
            return redirect()->route('home');
        } else {
            Alert::error('Foto gagal di-upload!');
            Storage::delete($photo_path);
            return redirect()->back();
        }
    }

    //hapus foto postingan
    public function deletePost($id)
    {
        $photo = Photo::where('id', $id);
        $photo->delete();
        Alert::success('Foto berhasil dihapus');
        return redirect(route('home'));
    }
}
