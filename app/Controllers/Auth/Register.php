<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\LoginModel;

class Register extends BaseController
{
    public function index()
    {
        return view('auth/register');
    }

    public function save()
    {
        $rules = [
            'username' => [
                'rules' => 'required|min_length[3]|is_unique[login.username]',
                'errors' => [
                    'required' => 'Username wajib diisi',
                    'is_unique' => 'Username sudah digunakan'
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password wajib diisi'
                ]
            ],
            'confirm_password' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sama'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $model = new LoginModel();

        $model->save([
            'username' => $this->request->getPost('username'),

            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            )
        ]);

        return redirect()->to('/login')
            ->with('success', 'Registrasi berhasil. Silakan login menggunakan akun Anda.');
    }
}
