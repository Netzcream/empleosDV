<?php 
if (!class_exists('MySQL')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/conex.php";
}
if (!class_exists('Persona')) {
	require_once $_SERVER["DOCUMENT_ROOT"]."/php/clases/Persona.php";
}


if (!isset($_SESSION)) {
	session_start();
}

if (isset($_SESSION["usr"])) {
	$_SESSION["usr"] = unserialize (serialize ($_SESSION['usr']));
	$Persona = $_SESSION["usr"];
}
else {
	//LOGERROR
}

if (isset($_POST['action'])) {
	if ($_POST['action'] == "add") {
		if (isset($_POST['tag'])) {
			$Persona->getTags()->addTag($_POST['tag']);
			//var_dump($Persona->getTags()->getTags());
			$tempTags = $Persona->getTags()->getTags();
			natcasesort($tempTags);
			foreach ($tempTags as $a) {
				echo "<div class='tag' onclick='delTags(".'"'.$a.'"'.");'>".$a."</div>";
			}
			
		}
		else {
			//LOGERROR
		}		
	}	
	else if ($_POST['action'] == "remove") {
		if (isset($_POST['tag'])) {
			$Persona->getTags()->deleteTag($_POST['tag']);
			//var_dump($Persona->getTags()->getTags());
			$tempTags = $Persona->getTags()->getTags();
			natcasesort($tempTags);
			foreach ($tempTags as $a) {
				echo "<div class='tag' onclick='delTags(".'"'.$a.'"'.");'>".$a."</div>";
			}
		}
		else {
			//LOGERROR
		}
		
		
	}
	else if ($_POST['action'] == "save") {
			$Persona->getTags()->saveTags($Persona->getId());
			$tempTags = $Persona->getTags()->getTags();
			natcasesort($tempTags);
			foreach ($tempTags as $a) {
				echo "<div class='tag' onclick='delTags(".'"'.$a.'"'.");'>".$a."</div>";
			}
			$_SESSION["usr"] = $Persona;
	}
	else {
		//LOGERROR
	}
}
else {
	//LOGERROR
}
?>