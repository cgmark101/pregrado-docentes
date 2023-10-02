<?php
class Usuarios
{
    public function buscarUsuario ($nombreUsuario)
    {
        $datos = array();
        include_once('conexion.php');
        $sql1= "SELECT APELLIDO, NOMBRE, CI FROM tblaca007
            WHERE   APELLIDO LIKE  '$nombreUsuario%'
            OR      NOMBRE LIKE  '$nombreUsuario%'";
        $conex -> ExecSQL($sql1);
        $fila = $conex->filas;
        $j=0;
	while ($j<$fila)
        {
        $row1 = $conex->result_h;
	    $row2 = $conex->result[$j];
	    $row = array_combine($row1,$row2);
			  $datos[] = array("value"  =>   $row['NOMBRE'].' '.
                                             $row['APELLIDO'],
                               "cedula" =>   $row['CI']);
        $j++;
        }
        return $datos;
    }
}