<?php
include ('app/models/cuenta_model.php');

class Cuenta_controller
{

    public function listar($persona, $rol)
    {
        $ci = $persona['ci'];
        $cuentas = Cuenta::alta_ci($ci);
        // Lógica para mostrar la lista de cuentas
        include ('app/views/cuenta/alta_view.php');
    }

    public function alta()
    {
        if (
            isset($_POST['nro_cuenta']) &&
            isset($_POST['tipo']) &&
            isset($_POST['saldo']) &&
            isset($_POST['fecha_exp']) &&
            isset($_POST['ci']) &&
            isset($_POST['password']) &&
            isset($_POST['status'])
        ) {
            $nro_cuenta = $_POST['nro_cuenta'];
            $tipo = $_POST['tipo'];
            $saldo = $_POST['saldo'];
            $fecha_exp = $_POST['fecha_exp'];
            $ci = $_POST['ci'];
            $password = $_POST['password'];
            $status = $_POST['status'];

            $resultado = Cuenta::alta($nro_cuenta, $tipo, $saldo, $fecha_exp, $ci, $password, $status);

            if ($resultado) {
                echo "Los datos de la cuenta se insertaron correctamente.";
                // Redirigir a la página de listar cuentas
                session_start();
                $_SESSION['ci'] = $ci;
                header('Location: index.php?action=editarPersona');
                exit();
            } else {
                echo "Ocurrió un error al insertar los datos de la cuenta.";
            }
        } else {
            $nro_cuenta = $this->numero();
            // Mostrar el formulario de alta
            include ('app/views/cuenta/alta_form.php');
        }
    }


    public function cambio()
    {
        
        
        if (isset($_POST['nro_cuenta']) &&isset($_POST['tipo']) &&isset($_POST['saldo'])&&isset($_POST['fecha_exp'])&&isset($_POST['ci'])&&isset($_POST['status'])) {
            
            // Recuperar los datos del formulario
            $nro_cuenta = $_POST['nro_cuenta'];
            $tipo = $_POST['tipo'];
            $saldo = $_POST['saldo'];
            $fecha_exp = $_POST['fecha_exp'];
            $ci = $_POST['ci'];
            $password = '';
            $status = $_POST['status'];

            // Procesar la actualización de los datos de la persona en la base de datos
            $resultado = Cuenta::cambio($nro_cuenta, $tipo, $saldo, $fecha_exp, $ci, $password, $status);

            if ($resultado) {
                echo "Los datos de la persona se actualizaron correctamente.";

                header('Location: index.php?action=editarPersona');
                exit();
            } else {
                echo "Ocurrió un error al actualizar los datos de la persona.";
            }
        } else {
            // Mostrar formulario para editar persona
            if(isset($_POST['nro_cuenta'])) {
                setcookie("nro_cta_tmp", $_POST['nro_cuenta'], time() + 3600, "/");
                $nro_cuenta = $_POST['nro_cuenta'];
            } else {
                $nro_cuenta = $_COOKIE['nro_cta_tmp'];
            }

            $cuentas = Cuenta::alta_nro($nro_cuenta);
            if(isset($_COOKIE['permiso'])) {
                $rol = $_COOKIE['permiso'];
            } else {
                header('Location: index.php');
                exit;
            }


            if ($cuentas) {
                include ('app/views/cuenta/cambio_view.php');
            } else {
                echo "No se encontró la persona.";
            }

        }
    }
    public function baja()
    {

        if (isset($_POST['nro_cuenta']) && isset($_POST['ci'])) {
            $nro_cuenta = $_POST['nro_cuenta'];
            $ci = $_POST['ci'];

            // Procesar la eliminación de la persona en la base de datos
            $resultado = Cuenta::baja($nro_cuenta);
            if ($resultado) {
                echo "La cuenta se eliminó correctamente.";

                session_start();
                $_SESSION['ci'] = $ci;
                header('Location: index.php?action=editarPersona');
                exit();
            } else {
                echo "Ocurrió un error al eliminar la persona.";
            }
        } else {
            echo "Error: Falta el identificador de la  cuenta a eliminar.";
        }

    }
    public function numero($longitud = 10)
    {
        // Caracteres permitidos para el número de cuenta bancaria
        $caracteres = '0123456789';
        // Longitud del conjunto de caracteres
        $longitudCaracteres = strlen($caracteres);
        // Inicializar el número de cuenta como una cadena vacía
        $numeroCuenta = '';

        // El primer dígito no puede ser cero para evitar números de cuenta inválidos
        $numeroCuenta .= $caracteres[rand(1, $longitudCaracteres - 1)];

        // Generar el resto del número de cuenta con la longitud especificada
        for ($i = 1; $i < $longitud; $i++) {
            // Obtener un carácter aleatorio del conjunto de caracteres permitidos
            $numeroCuenta .= $caracteres[rand(0, $longitudCaracteres - 1)];
        }

        return $numeroCuenta;
    }


}
?>