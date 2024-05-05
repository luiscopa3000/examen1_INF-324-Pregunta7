<?php
require_once ('app/models/persona_model.php');
require_once ('app/models/cuenta_model.php');

class Login_controller
{
    public function mostrar()
    {
        include ('app/views/login.php');
    }
    public function verificar()
    {
        global $personaControlador;
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $rol = $_POST['rol'];
        $personas = Persona::login_ver($correo, $password, $rol);
        if (count($personas) == 0) {
            $_POST['error'] = "Datos incorrectos";
            $_POST['correo'] = $correo;
            $_POST['password'] = $password;
            $this->mostrar();
        } else {
            $_POST = [];
            $_POST['ci'] = $personas[0]['ci'];
            $_POST['permiso'] = $personas[0]['rol'];
            setcookie("permiso", $personas[0]['rol'], time() + 3600, "/");
            
            if ($personas[0]['rol'] == 'cliente') {
                $personaControlador->editar();

            } else if($personas[0]['rol'] == 'Director') {
                global $mostDepControlador;
                $mostDepControlador->mostrar();
                
            } else {
                $personaControlador->listar();

            }

        }

    }

}
?>