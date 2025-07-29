<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User as Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	protected string $viewPath = 'users';
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$model = Model::all();
		confirmDelete('Hapus data', 'Apakah anda yakin ingin menghapus data user ini?', 'Hapus', 'Batal');
		return view($this->viewPath . '.index', compact('model'));
	}

	public function store(StoreOrUpdateUserRequest $request)
	{
		$id = $request->id;
		$newRequest = $request->validated();

		if (!$id) {
			$newRequest['password'] = Hash::make('password');
		} else {
			unset($newRequest['password']);
		}

		User::updateOrCreate(['id' => $id], $newRequest);

		toast()->success('User berhasil disimpan');
		return redirect()->route('users.index');
	}

	public function changePassword(Request $request)
	{
		$request->validate([
			'old_password' => 'required',
			'password' => 'required|min:8|confirmed',
			// 'password' => [Password::min(8)->letters()->numbers()->symbols(), 'confirmed'],
		], [
			'old_password.required' => 'Password lama harus diisi.',
			'password.required' => 'Password baru harus diisi.',
			'password.min' => 'Password baru harus memiliki minimal 8 karakter.',
			'password.confirmed' => 'Konfirmasi password tidak cocok.',
		]);

		$user = Auth::user();
		if (!Hash::check($request->old_password, $user->password)) {
			toast()->error('Password lama tidak cocok.', 'Gagal');
			return back();
		}
		$user->password = Hash::make($request->password);
		$user->save();

		toast()->success('Password berhasil diubah.', 'Sukses');
		return back();
	}

	public function resetPassword(Request $request)
	{
		$request->validate([
			'id' => 'required'
		]);

		$user = User::find($request->id);
		$user->update([
			'password' => Hash::make('12345678'),
		]);

		toast()->success('Password berhasil direset');
		return redirect()->route('users.index');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id)
	{
		$user = Model::findOrFail($id);
		if ($user->id === Auth::user()->id) {
			toast()->warning('Anda tidak dapat menghapus akun Anda sendiri.', 'Peringatan');
			return back();
		}

		$user->delete();
		toast()->success('Data berhasil dihapus', 'Sukses');
		return back();
	}
}
