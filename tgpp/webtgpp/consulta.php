<?php
include_once('inc\config.php');
    if(isset($_POST["word"]))
    {
        $link=odbc_connect($DSN, $user, $pass, true, $laBitacora) or die ("Problemas en la conexión");
        if($_POST["word"]{0}=="*")
            $sql="SELECT * FROM dace002 WHERE CI_E LIKE '%".substr($_POST["word"],1)."%' ORDER BY CI_E LIMIT 10";
            $result=odbc_exec($link, $sql);
        else
            $sql1="SELECT * FROM dace002 WHERE CI_E LIKE '".$_POST["word"]."%' ORDER BY CI_E LIMIT 10";
            $result=odbc_exec($link, $sql1);
            while($row=odbc_fetch_array($result))
            {
                header("Content-type: text/xml");
                echo '<?xml version="1.0" encoding="iso-8859-15" ?>';
                echo "<content>";
                $label.="<labels>";
                if(strtoupper($_POST["word"])==strtoupper($row["CI_E"]))
                    echo "<id>".$row["NOMBRES"]." ".$row["APELLIDOS"]."</id>"; //unicamente enviamos el identificador si se tenemos la palabra exacta
                else
                    $label.="\n<label>".$row["CI_E"]."</label>";
            }
        $label.="</labels>";
        echo $label."</content>";
    }
?>