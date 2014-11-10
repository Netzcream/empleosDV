<?php


?>
<!-- 
<link rel="stylesheet" href="css/responsivemobilemenu.css" type="text/css"/>
	<script type="text/javascript" src="js/responsivemobilemenu.js"></script>


        <div class="rmm sapphire">
            <ul>
                <li><a href='#' onclick="GoTo(1);">Registro</a></li>
                <li><a href='#' onclick="GoTo(2);">Login</a></li>
                <li><a href='#' onclick="GoTo(3);">Listado</a></li>
                <li><a href='#' onclick="GoTo(4);">Buscador</a></li>
                <li><a href='#'>Opcion 4</a></li>
                <li><a href='#'>Opcion 5</a></li>
            </ul>
        </div>
        
        

 -->
 
 <div id="menuDa">
 	<div class="menuDaInd" onclick="GoTo(2);">Login</div>
	<div class="menuDaInd" onclick="GoTo(1);">Registro</div>
	<div class="menuDaInd" onclick="GoTo(3);">Listado</div>
	<div class="menuDaInd" onclick="GoTo(4);">Buscador</div>
</div>

<script>
	function GoTo(a) {
		if (a == 1) $('#cuerpo').load('php/registro.php');
		else if (a == 2) $('#cuerpo').load('php/login.php');
		else if (a == 3) $('#cuerpo').load('php/listado.php');
		else if (a == 4) $('#cuerpo').load('php/buscar.php');
	}

        </script>