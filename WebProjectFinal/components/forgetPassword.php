<?php
	function displayForgetPassword(){
		if( isset($_SESSION['admin']) || isset($_SESSION['user'])){
			header("Refresh:0; url=index.php?display=search");
		}else{
			displayForgetPasswordForm();
		}
	}

	function displayForgetPasswordForm(){	
		?>
			<div class="forgetPasswordHeader">
				<form action="index.php?display=search">
					
				</form>
			</div>
		<?php
	}
?>