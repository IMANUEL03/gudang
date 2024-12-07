<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;

class RegisterController extends Controller
{
    public function index()
    {
        // Menampilkan form registrasi
        return view('register');
    }

    public function register()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required',
            'nama' => 'required',
            'nip' => 'required',
            'bidang' => 'required',
            'jabatan' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembalikan ke halaman registrasi dengan pesan error
            return redirect()->to('/register')->withInput()->with('errors', $validation->getErrors());
        }

        // Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nama = $this->request->getPost('nama');
        $nip = $this->request->getPost('nip');
        $bidang = $this->request->getPost('bidang');
        $jabatan = $this->request->getPost('jabatan');

        // Enkripsi password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data ke database
        $adminModel = new AdminModel();
        $adminModel->insertAdmin([
            'username' => $username,
            'password' => $passwordHash,
            'nama' => $nama,
            'nip' => $nip,
            'bidang' => $bidang,
            'jabatan' => $jabatan
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->to('/')->with('message', 'Registrasi berhasil, silahkan login');
    }
}
