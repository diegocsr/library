<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Support\Facades\File;
use App\User;
use Image;

class SettingsController extends Controller
{
	public function profile()
	{
	    return redirect('/home');
	}

	public function _construct()
	{
		$this->middleware('auth');
	}

	public function editProfile()
	{
		return view('settings.edit-profile');
	}

	public function update(Request $request)
	{
		$user = Auth::user();
		$this->validate($request, [
			'name' 	=> 'required',
			'email'	=> 'required|unique:users,email,' .$user->id,
			'clase_id' => 'required|exists:clases,id',
            'avatar' => 'image|max:2048'
			]);

		$user->clase_id = $request->get('clase_id');
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		        if ($request->hasFile('avatar')) {
            $filename = null;
            $uploaded_avatar = $request->file('avatar');
            $extension = $uploaded_avatar->getClientOriginalExtension();

            // membuat nama file random dengan extension
            $filename = md5(time()) . '.' . $extension;
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';

            // memindahkan file ke folder public/img
            $uploaded_avatar->move($destinationPath, $filename);

            // hapus avatar lama, jika ada
            if ($user->avatar) {
                $old_avatar = $user->avatar;
                $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
                    . DIRECTORY_SEPARATOR . $user->avatar;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                    // File sudah dihapus/tidak ada
                }
            }
        $user->avatar = $filename;
        }
		$user->save();

		Session::flash("flash_notification", [
			"level" => "success",
			"message" => "Profil berhasil diubah"
			]);

		return redirect('/home');
	}


	public function editPassword()
	{
		return view('settings.edit-password');
	}


	public function updatePassword(Request $request)
	{
		$member = Auth::user();
		$this->validate($request, [
			'password' 	=> 'required|passcheck:' . $member->password,
			'new_password'	=> 'required|confirmed|min:6',
			],
			[
			'password.passcheck' => 'Password lama tidak sesuai'
			]);

		$member->password = bcrypt($request->get('new_password'));
		$member->save();

		Session::flash("flash_notification", [
			"level" => "success",
			"message" => "Password berhasil diubah"
			]);

		return redirect('/home');
	}
}
