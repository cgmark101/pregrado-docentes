<?php //header( 'Content-type: text/html; charset=iso-8859-1' ); ?>
<html lang="es">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
		<link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen">
		<script type="text/javascript" src="js/funciones.js"></script>
		<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
		<script type="text/javascript" src="js/hoverIntent.js"></script>
		<script type="text/javascript" src="js/superfish.js"></script>
		<script type="text/javascript">

		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});

		</script>
	</head>
	<body>
		<ul class="sf-menu">
		<li>
				<a href="index_0.php">Principal</a> </li>
			<li class="current">
				<a href="#">Cargar Notas</a>
				<ul>
					
					<li class="current">
						<a href="cargar_pp.php">Práctica Profesional</a>
						
					</li>
				
				
			
				</ul>
			</li>
			
			<li>
				<a href="#">Visualizar Actas</a>
				<ul>
					<li>
												
						<li><a href="v_acta_fun.php">Actas Cargadas</a></li>
						<li><a href="v_acta_fun_pend.php">Actas Pendientes</a></li>

						
					</li>
					
					
					
				</ul>
			</li>
			<li>
				<a href="#">Ayuda</a>
				<ul>
							<li><a href="manuales/prac_prof.pdf" target="blank">Manual de Usuario de Práctica Profesional</a></li>
							
							
			  </ul>
			</li>
			<li>
				<a href="salir.php" onClick="salir(this)">Salir</a>
			</li>		
		</ul>
	</body>
</html>
<script type="text/javascript" src="js/funciones.js">

function salir(id) {
    if (window.confirm("Aviso:\n¿Está seguro que desea salir? ")) {
		window.location = "salir.php;

	}
	
}
</script>