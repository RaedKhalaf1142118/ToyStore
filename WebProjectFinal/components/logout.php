<?php
	function logout(){
		session_unset();
		session_destroy();
		header("Refresh:0; url=index.php?display=search");
	}
?>