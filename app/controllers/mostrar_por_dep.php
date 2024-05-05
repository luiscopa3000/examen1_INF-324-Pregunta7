<?php
require_once ('app/models/cuenta_model.php');

class Mostrar_dep
{
    public function mostrar()
    {
        $total['La Paz'] = 0;
        $total['Oruro'] = 0;
        $total['Potosí'] = 0;
        $total['Chuquisaca'] = 0;
        $total['Tarija'] = 0;
        $total['Santa Cruz'] = 0;
        $total['Beni'] = 0;
        $total['Pando'] = 0;

        $dato = Cuenta::mostrar_dep();
        foreach ($dato as $value) {
            foreach ($value as $key => $value2) {
                if($key != "nro_cuenta") {
                    $total[$key] += $value2;
                } else {
                }

            }
        }
        
        include ('app/views/mostrar_dep.view.php');
    }
}
?>