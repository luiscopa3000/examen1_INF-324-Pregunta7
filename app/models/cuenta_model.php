<?php
require_once ('config/database.php');

class Cuenta
{
    public static function alta($nro_cuenta, $tipo, $saldo, $fecha_exp, $ci, $password, $status)
    {
        global $conn_id;

        // Consulta SQL para insertar una nueva cuenta
        $sql = "INSERT INTO cuenta (nro_cuenta, tipo, saldo, fecha_exp, ci, password, status)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        // Parámetros para la consulta preparada
        $params = array($nro_cuenta, $tipo, $saldo, $fecha_exp, $ci, $password, $status);

        // Ejecutar la consulta preparada
        $stmt = sqlsrv_query($conn_id, $sql, $params);

        // Verificar si la consulta fue exitosa
        if ($stmt === false) {
            // Manejar el error si la consulta falla
            echo "Error al agregar cuenta: " . print_r(sqlsrv_errors(), true);

        } else {
            // La cuenta se agregó correctamente
            echo "Cuenta agregada correctamente";
            return true;
        }
    }
    public static function alta_ci($ci)
    {
        global $conn_id;

        $sql = "SELECT * FROM cuenta WHERE ci = ?";

        $params = array($ci);

        $stmt = sqlsrv_query($conn_id, $sql, $params);

        if ($stmt === false) {
            echo "Error al obtener personas: " . print_r(sqlsrv_errors(), true);
            return [];
        } else {
            $cuentas = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $cuentas[] = $row;
            }
            return $cuentas;
        }
    }
    public static function alta_nro($nro_cuenta)
    {
        global $conn_id;

        $sql = "SELECT * FROM cuenta WHERE nro_cuenta = ?";

        $params = array($nro_cuenta);

        $stmt = sqlsrv_query($conn_id, $sql, $params);

        if ($stmt === false) {
            echo "Error al obtener personas: " . print_r(sqlsrv_errors(), true);
            return [];
        } else {
            $cuentas = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $cuentas[] = $row;
            }
            return $cuentas;
        }
    }

    public static function cambio($nro_cuenta, $tipo, $saldo, $fecha_exp, $ci, $password, $status)
    {
        global $conn_id;

        $sql = "UPDATE cuenta SET tipo = ?, saldo = ?, fecha_exp = ?, status = ? 
                WHERE nro_cuenta = ?";

        $params = array($tipo, $saldo, $fecha_exp, $status, $nro_cuenta);

        $stmt = sqlsrv_query($conn_id, $sql, $params);

        if ($stmt === false) {
            echo "Error al actualizar cuenta: " . print_r(sqlsrv_errors(), true);
            return false;
        } else {
            return true;
        }
    }



    public static function baja($nro_cuenta)
    {
        global $conn_id;
        $sql = "DELETE FROM cuenta WHERE nro_cuenta = ?";
        $params = array($nro_cuenta);
        $stmt = sqlsrv_query($conn_id, $sql, $params);
        if ($stmt === false) {
            echo "Error al eliminar la cuenta: " . print_r(sqlsrv_errors(), true);
            return false;
        } else {
            return true;
        }
    }

    public static function mostrar_dep()
    {
        global $conn_id;

        $sql = "SELECT 
        nro_cuenta,
        SUM(CASE WHEN p.departamento = 'La Paz' THEN c.saldo ELSE 0 END) AS 'La Paz',
        SUM(CASE WHEN p.departamento = 'Oruro' THEN c.saldo ELSE 0 END) AS 'Oruro',
        SUM(CASE WHEN p.departamento = 'Potosí' THEN c.saldo ELSE 0 END) AS 'Potosí',
        SUM(CASE WHEN p.departamento = 'Chuquisaca' THEN c.saldo ELSE 0 END) AS 'Chuquisaca',
        SUM(CASE WHEN p.departamento = 'Tarija' THEN c.saldo ELSE 0 END) AS 'Tarija',
        SUM(CASE WHEN p.departamento = 'Santa Cruz' THEN c.saldo ELSE 0 END) AS 'Santa Cruz',
        SUM(CASE WHEN p.departamento = 'Beni' THEN c.saldo ELSE 0 END) AS 'Beni',
        SUM(CASE WHEN p.departamento = 'Pando' THEN c.saldo ELSE 0 END) AS 'Pando'
        FROM 
            persona p
        JOIN 
            cuenta c ON p.ci = c.ci
        GROUP BY 
            nro_cuenta;";

        $stmt = sqlsrv_query($conn_id, $sql);

        if ($stmt === false) {
            echo "Error al obtener la lista: " . print_r(sqlsrv_errors(), true);
            return [];
        } else {
            $cuentas = [];
            while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                $cuentas[] = $row;
            }
            return $cuentas;
        }
    }
}
?>