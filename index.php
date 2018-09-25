<?php
$conectar=@mysqli_connect("localhost", "root","");
mysqli_select_db($conectar,"prueba");
$sentencia = "select * from datos order by nombre ASC";
$query = mysqli_query($conectar, $sentencia);
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Valor comercial estimado</title>
</head>
<body>
	<div align="center" class="general" name="principal" id="general">
	<div class="banner" name="banner" id="banner">
	</div>

	<fieldset class="formulario">
		<legend>Seleccione una colonia</legend>
		
		<select name="colonia" size="0">

			<option value="">
		</select>
	</fieldset>

	<br>
	<fieldset class="formulario">
		<legend>Información de propiedad</legend>
		<label>Metros construcción</label>
		<input type="text" name="Cantidad Metros Construcción" placeholder="Metros Construcción">
		<br>
		<br>
		<label>Metros cuadrados de terreno</label>
		<input type="text" name="Cantidad Metros terreno" placeholder="Metros terreno">
	</fieldset>

	<br>
	<fieldset class="formulario">
		<legend>Estado de la propiedad</legend>
		<label>Calidad de acabados</label>
		<select name="acabados" size="0"> </select>
		<br>
		<label>Conservación del inmueble</label>
		<select name="Conservación" size="0"> </select>
		
	</fieldset>

</body>
</html>