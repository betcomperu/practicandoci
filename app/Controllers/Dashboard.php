<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class Dashboard extends BaseController
{

    protected $usuarioModel;


    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
     
    }
    public function index()
    {
      
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $this->usuarioModel->find($loggedUserID);
        $data = [
            'title'=>"Dashboard",
            'userInfo'=>$userInfo
        ];
     //  dd($_SESSION);
        return view('dashboard/index', $data);
    }
}
