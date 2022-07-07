<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        //

        if (session()->has('_ci_user_login')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Pergudangan',
        ];


        if ($this->request->getMethod() == 'post') {
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ]
            ]);

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            if (!$valid) {
                return redirect()->back()->with('message', pesan('Opps..|Username atau Password tidak boleh kosong!', 'danger'));
            }

            $user = (new UserModel())->where('username', $username)->get()->getRowArray();

            if (!$user) {
                return redirect()->back()->with('message', pesan('Oppss..|Akun tidak ditemukan!', 'danger'));
            }

            if (!password_verify($password, $user['password'])) {
                return redirect()->back()->with('message', pesan('Opps..|Username atau Password salah!', 'danger'));
            }


            $sess = [
                'id_user' => $user['id_user'],
                'nama' => $user['nama'],
            ];
            session()->set('_ci_user_login', $sess);
            (new UserModel())->update($user['id_user'], ['login_at' => current_timestamp()]);
            return redirect()->to('/');
        }


        return view('v_auth_index', $data);
    }


    public function register()
    {
        if (session()->has('_ci_user_login')) {
            return redirect()->to('/');
        }


        if ($this->request->getMethod() == 'post') {
            $valid = $this->validate([
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Lengkap tidak boleh kosong',
                    ]
                ],
                'username' => [
                    'rules' => "required|is_unique[user.username]",
                    'errors' => [
                        'required' => 'Nama Pengguna (Username) tidak boleh kosong',
                        'is_unique' => 'Nama Pengguna (Username) sudah terdaftar.'
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[user.email]',
                    'errors' => [
                        'required' => 'Email tidak boleh kosong',
                        'is_unique' => 'Email sudah terdaftar.',
                        'valid_email' => 'Email tidak valid'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'password2' => [
                    'label' => 'Konfirmasi Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'matches' => '{field} tidak cocok dengan {param}'
                    ]
                ],
            ]);



            if (!$valid) {
                return redirect()->back()->with('message', pesan('Opps..|' . implode('<br/>', $this->validator->getErrors()), 'danger'));
            }

            $ins = [
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];

            (new UserModel())->insert($ins);


            return redirect()->to('login')->with('message', pesan('Sukses..|Akun berhasil dibuat, silahkan login!', 'success'));
        }

        $data = [
            'title' => 'Daftar Akun',
        ];

        return view('v_auth_register', $data);
    }

    public function logout()
    {
        session()->remove('_ci_user_login');
        return redirect()->to('login');
    }
}
