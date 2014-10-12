<?php
define('SITE_ROOT', dirname(__FILE__));

?>
<link rel="stylesheet" href="css/responsivemobilemenu.css" type="text/css"/>
	<script type="text/javascript" src="js/responsivemobilemenu.js"></script>


        <div class="rmm sapphire">
            <ul>
                <li><a href='#' onclick="GoTo(1);">Registro</a></li>
                <li><a href='#' onclick="GoTo(2);">Login</a></li>
                <li><a href='#' onclick="GoTo(3);">Listado</a></li>
                <li><a href='#'>Opcion 3</a></li>
                <li><a href='#'>Opcion 4</a></li>
                <li><a href='#'>Opcion 5</a></li>
            </ul>
        </div>
        
        
        <script>
			function GoTo(a) {
			
				if (a == 1) $('#body').load('php/registro.php');
				else if (a == 2) $('#body').load('php/login.php');
				else if (a == 3) $('#body').load('php/listado.php');
				
			}

        </script>