<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;

class LoginController extends Controller
{
    public function index()
    {
        // Menampilkan form login
        return view('login');
    }

    public function login()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman login dengan pesan error
            return redirect()->to('/login')->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek keberadaan user dalam database
        $adminModel = new AdminModel();
        $user = $adminModel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            // Jika username atau password salah, kembalikan ke halaman login dengan pesan error
            return redirect()->to('/')->withInput()->with('message', 'Username atau password salah');
        }

        // Set session user
        $session = session();
        $session->set('user_id', $user['id']);
        $session->set('username', $user['username']);
        $session->set('nama', $user['nama']);
        $session->set('nip', $user['nip']);
        $session->set('bidang', $user['bidang']);
        $session->set('jabatan', $user['jabatan']);

        // Redirect ke halaman dashboard
        return redirect()->to('/Dashboard');
    }

    public function logout()
    {
        // Hapus session user
        $session = session();
        $session->destroy();

        // Redirect ke halaman login
        return redirect()->to('/');
    }
}
