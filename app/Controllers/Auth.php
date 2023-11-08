<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;


class Auth extends BaseController
{
  
    public function index()
    {
        return view('auth/login');
    }
   
    public function __construct()
    {
     
        helper(['url', 'form']);
      
     }

    public function registro()
    {
        return view('auth/registro');
    }
    public function grabar()
    {
             
          //Validamos los campos
          $validation=$this->validate([
          
          'nombre' => [
            'label' => 'Nombre',
            'rules' => 'required',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.'
            ]
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[usuario.email]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'valid_email' => 'Por favor ingrese un {field} válido.',
                'is_unique' => 'El {field} ya existe.'
            ]
        ],
        'password' => [
            'label' => 'Contraseña',
            'rules' => 'required|min_length[5]|max_length[12]',
            'errors' => [
                'required' => 'La {field} es obligatoria.',
                'min_length' => 'La {field} debe tener al menos {param} caracteres.',
                'max_length' => 'La {field} no debe tener más de {param} caracteres.'
            ]
        ],
        'cpassword' => [
            'label' => 'Confirmación de contraseña',
            'rules' => 'required|min_length[5]|max_length[12]|matches[password]',
            'errors' => [
                'required' => 'La {field} es obligatoria.',
                'matches' => 'La {field} debe coincidir con la contraseña.',
                'min_length' => 'La {field} debe tener al menos {param} caracteres.',
                'max_length' => 'La {field} no debe tener más de {param} caracteres.'
            ]
        ]
    ]);
            
       // Condicionamos para mostrar resultados en la vista
     
       if (!$validation) {
        return view('auth/registro', ['validation' => $this->validator]);
    } else {
        // Recopilar datos validados
        $nombre = $this->request->getPost('nombre');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Crear un array con los datos
        $data = [
            'nombre' => $nombre,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        // Insertar en la base de datos
        $usuarioModel = new UsuarioModel(); // Reemplaza 'UsuarioModel()' por tu modelo de usuario
        $query= $usuarioModel->insert($data);

         // Luego del insert redirecciones
        if(!$query){
            return redirect()->back()->with('fail', 'Hay un error');

        }else{
            return redirect()->to('/registrar')->with('success', 'Registro exitoso');
        }
    }
    }
    public function logearse()
    {
        // Reglas de validación para email y password
        $validation = $this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_not_unique[usuario.email]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'valid_email' => 'Por favor ingrese un {field} válido.',
                    'is_not_unique'=> 'Este email no esta registrado'
                    ],
                ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                    ]
                ],
            ]);
            if (!$validation) {
                return view('auth/login', ['validation' => $this->validator]);
            } else {
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $usuarioModel = new UsuarioModel();
                $user_info = $usuarioModel->where('email', $email)->first();
                
                $check_password = password_verify($password, $user_info['password']);
               // dd($check_password);
                if (!$check_password) {
                    
                    session()->setFlashdata('fail', "Password Incorrecto");
                    return redirect()->to(site_url('/entrar'));
                }else{
                    $data=[
                        'id' => $user_info['idUsuario'],
                        'nombre' => $user_info['nombre'],
                        'email' => $user_info['email'],
                        'isLoggedIn' => true
                        ];
                    $session = session();
                    $session->set($data);
         //           dd($data);
                    return redirect()->to(site_url('dashboard'));
                }
               
       
            }
        }

            public function salir()
            {
        
                $session = session();
                $session->destroy();
                return redirect()->to(base_url() . '/entrar');
            }
            
                
            
        
    }


