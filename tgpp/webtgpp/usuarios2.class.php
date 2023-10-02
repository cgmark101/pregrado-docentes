<?php
class Usuarios
{
    public function buscarUsuario ($nombreUsuario)
    {
        $datos = array();
        include_once('conexion.php');
        $sql1= "SELECT NOMBRES, APELLIDOS, CI_E FROM dace002
            WHERE   NOMBRES     LIKE '$nombreUsuario%'
            OR      APELLIDOS   LIKE '$nombreUsuario%'";
        $conex -> ExecSQL($sql1);
        $fila = $conex->filas;
        $j=0;
	while ($j<$fila)
        {
        $row1 = $conex->result_h;
	    $row2 = $conex->result[$j];
	    $row = array_combine($row1,$row2);
              $datos[] = array("value"  =>   $row['NOMBRES'].' '.
                                             $row['APELLIDOS'],
                               "cedula" =>   $row['CI_E']);
        $j++;
        }
        return $datos;
    }
}