<?php

namespace App\Controllers;
use App\Models\UserModel;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('user/index', $data);
    }

    public function create()
    {
        return view('user/create');
    }

    public function store()
    {
        $this->userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'), // sebaiknya di-hash
            'role'     => $this->request->getPost('role')
        ]);
        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        return view('user/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $this->userModel->update($id, [
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
            'role'     => $this->request->getPost('role')
        ]);
        return redirect()->to('/user');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('/user');
    }
}
