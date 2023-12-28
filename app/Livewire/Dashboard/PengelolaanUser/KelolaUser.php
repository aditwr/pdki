<?php

namespace App\Livewire\Dashboard\PengelolaanUser;

use App\Models\User;
use Livewire\Component;

class KelolaUser extends Component
{
    public function mount()
    {
        if (!auth()->user()->hasPermissionTo('akses-admin')) {
            abort(403);
        }
    }

    public function jadikanPemohon($id)
    {
        $user = User::find($id);
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole('pemohon');

        $message = 'Berhasil menjadikan user ' . $user->email . ' sebagai pemohon';
        $this->dispatch('showSuccess', ['message' => $message]);
    }
    public function cabutMember($id)
    {
        $user = User::find($id);
        $user->email_verified_at = null;
        $user->save();

        $user->removeRole('pemohon');

        $message = 'Hak member user  ' . $user->email . ' telah dicabut';
        $this->dispatch('showSuccess', ['message' => $message]);
    }
    public function jadikanAdmin($id)
    {
        $user = User::find($id);
        $user->is_admin = true;
        $user->save();

        $user->assignRole('admin');

        $message = 'Berhasil menjadikan user ' . $user->email . ' sebagai admin';
        $this->dispatch('showSuccess', ['message' => $message]);
    }
    public function cabutAdmin($id)
    {
        $user = User::find($id);
        $user->is_admin = null;
        $user->save();

        $user->removeRole('admin');

        $message = 'Hak admin user  ' . $user->email . ' telah dicabut';
        $this->dispatch('showSuccess', ['message' => $message]);
    }
    public function render()
    {
        $users_need_verification = User::where('email_verified_at', null)->paginate(5, pageName: 'users_need_verification');
        $users_member = User::where('email_verified_at', '!=', null)->where('is_admin', null)->paginate(10, pageName: 'users_verified');
        $users_admin = User::where('email_verified_at', '!=', null)->where('is_admin', true)->paginate(10, pageName: 'users_admin');
        return view('livewire.dashboard.pengelolaan-user.kelola-user', compact('users_need_verification', 'users_member', 'users_admin'));
    }
}
