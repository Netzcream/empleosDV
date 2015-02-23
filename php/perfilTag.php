<?php 

if (!isset($_SESSION)) {
	session_start();
}
if (!class_exists('MySQL')) { require_once $_SERVER["DOCUMENT_ROOT"].'/php/conex.php'; }
if (!class_exists('Rol')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Rol.php"); }
if (!class_exists('EstadoCivil')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/EstadoCivil.php"); }
if (!class_exists('EstadoUsuario')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/EstadoUsuario.php"); }
if (!class_exists('Documento')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Documento.php"); }
if (!class_exists('NivelEstudios')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/NivelEstudios.php"); }
if (!class_exists('Pais')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Pais.php"); }
if (!class_exists('Fecha')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Fecha.php"); }
if (!class_exists('FotoPerfil')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/FotoPerfil.php"); }
if (!class_exists('Direccion')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Direccion.php"); }
if (!class_exists('Tag')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Tag.php"); }
if (!class_exists('Estudios')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Estudios.php"); }
if (!class_exists('Trabajo')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Trabajo.php"); }
if (!class_exists('Persona')) { include_once($_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php"); }

if (isset($_SESSION["usr"])) {
	$_SESSION["usr"] = unserialize (serialize ($_SESSION['usr']));
	$Persona = $_SESSION["usr"];
	if (!empty($Persona->getApellido()) && !empty($Persona->getNombre())) {
		$mostrarUsuario = $Persona->getApellido().", ".$Persona->getNombre();
		$_SESSION['MostrarNombre'] = $mostrarUsuario;
	}
}
else {
	//LOGERROR
}
?>

	<div class="titleSelRol">Mis Tags</div>
		
			<div id="misTags" class="thingsConteiner">
			
			<?php 
			foreach ($Persona->getTags()->getTags() as $a) {
					echo "<div class='tag' onclick='delTags(".'"'.$a.'"'.");'>".$a."</div>";
				}
			?>
			</div>
			
		<div class="groupTagAdd">
		<input id="tag" maxlength="50" type="text" value="" class="inputFillDP inputTag" placeholder="Ingresar Tag">
		<input type="button" class="perfilBtnSeeMyCV" value="A&ntilde;adir Tag" onclick="addTags();">
		</div>
		
		<div class="notationLabel">
		Los cambios impactar&aacute;n en la base de datos &uacute;nicamente al guardarlos.
		</div>
			<div class="finRecuadroPerfil">
				<input type="button" class="perfilBtnSeeMyCV" value="Cancelar" onclick="goBacktoPerfil(4);">
				<input type="button" class="perfilBtnSeeMyCV" value="Guardar" onclick="goBacktoAndSavePerfil(4);">
			</div>	
			
			<script>
				function validateTag() {
				$('#misTags').load('php/addOrRemoveTag.php',{ action:'save'});
				return true;
			}

				function addTags() {
					$('#tag').removeClass('notSelected');
					var tag = $('#tag').val();
					if (tag == "" || tag == null || tag.length < 3 || tag.length > 50) {
						$('#tag').addClass('notSelected');
						errorToas('Debe ingresar un tag.');
						
					}
					else {
						$('#misTags').load('php/addOrRemoveTag.php',{ action:'add',tag : $('#tag').val()});
						$('#tag').val("");
					}
				}
				function delTags(tag) {
					$('#misTags').load('php/addOrRemoveTag.php',{ action:'remove',tag : tag});
				}

				$("#tag").keyup(function (e) {
				    if (e.keyCode == 13) {
				    	addTags();
				    }
				});
			</script>
			