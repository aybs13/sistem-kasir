<?php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where([
            'username' => $username,
            'password' => $password
        ])->first();

        if ($user) {
            session()->set([
                'user_id'   => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'], 
                'logged_in' => true
            ]);

            // Arahkan berdasarkan role
            if ($user['role'] === 'admin') {
                return redirect()->to('/dashboard');
            } elseif ($user['role'] === 'kasir') {
                return redirect()->to('/transaksi'); // arahkan kasir ke /kasir
            } else {
                return redirect()->to('/'); // fallback untuk role tidak dikenali
            }
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
