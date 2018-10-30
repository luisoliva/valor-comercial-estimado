<?php
$conectar=@mysqli_connect("localhost", "root","");
mysqli_select_db($conectar,"prueba");
$sentencia = "select * from datos order by nombre ASC";
$query = mysqli_query($conectar, $sentencia);
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Valor comercial estimado</title>
</head>
<body>
	<div align="center" class="general" name="principal" id="general">
	<div class="banner" name="banner" id="banner">
	</div>

	<fieldset class="formulario">
		<legend>Seleccione una colonia</legend>
		
		<select name="colonia" size="0">
			<?php while ($arreglo = mysqli_fetch_array($query)) { ?>

			<option value="<?php echo $arreglo['id']?>"><?php echo $arreglo['nombre']?></option>
			<?php } ?>
		</select>
	</fieldset>

	<br>
	<fieldset class="formulario">
		<legend>Información de propiedad</legend>
		<label>Metros construcción</label>
		<input type="number" name="Cantidad Metros Construcción" placeholder="Metros Construcción" required>
		<br>
		<br>
		<label>Metros cuadrados de terreno</label>
		<input type="number" name="Cantidad Metros terreno" placeholder="Metros terreno" requiered>
	</fieldset>

	<br>
	<fieldset class="formulario">
		<legend>Estado de la propiedad</legend>
		<label>Calidad de acabados</label>
		<select name="selCom" size="1"> 
			<option value="1" >Pésima</option>
			<option value="2" >Mala</option>
			<option value="3" >Media</option>
			<option value="4" >Buena</option>
			<option value="5" >Excelente</option>
		</select>
		<br>
		<br>
		<label>Conservación del inmueble</label>
		<select name="Conservación" size="0"> 
			<option value="1" >Muy mala</option>
			<option value="2" >Falta de mantenimiento</option>
			<option value="3" >Aceptable</option>
			<option value="4" >Buena</option>
			<option value="5" >Nuevo</option>
		</select>
	</fieldset>

</body>
</html>