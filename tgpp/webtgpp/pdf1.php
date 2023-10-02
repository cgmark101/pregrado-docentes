<?php
//se incluye la libreria de dompdf
require_once("dompdf/dompdf_config.inc.php");
$code = '<html><head><title>Hola</title></head>
<body><h1>Hola Mundo</h1></body></html>';    
//se crea una nueva instancia al DOMPDF
$dompdf = new DOMPDF();
//se carga el codigo html
$dompdf->load_html($code);
//aumentamos memoria del servidor si es necesario
ini_set("memory_limit","32M"); 
//lanzamos a render
$dompdf->render();
//guardamos a PDF
$dompdf->stream("mipdf.pdf");
?>