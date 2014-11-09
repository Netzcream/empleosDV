/**
 * Scripts EmpleosDV
 */

function goTo(go) {
	if (go == -1) { 
		$('#cuerpo').load("php/login.php");
	}
	if (go == 0) { 
		$('#cuerpo').load("php/login.php");
	}
	if (go == 1) { 
		$('#cuerpo').load("php/registro.php");
	}
	$("html, body").animate({ scrollTop: 0 }, "slow");
}