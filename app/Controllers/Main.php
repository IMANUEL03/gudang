<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;

use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    public function index()
    {
        $adminModel = new AdminModel();
        $data['bio'] = $adminModel->getAdmin();

        return view('main/layout', $data);
    }

    public function dashboard()
    {
        return view('dashboard');
    }
}
