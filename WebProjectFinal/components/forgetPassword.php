<?php
	$password = "";
	$isValid = false;
	function displayForgetPassword(){
		global $password , $isValid;
		if(isset($_POST['id'])){
			if(strlen($_POST['id']) == 10){
				$customer = getCustomerById($_POST['id']);
				if(isset($customer)){
					$password = $customer['userPassword'];
					$isValid = true;
				}else{
					header("Refresh:0; url=index.php?display=search");
				}
			}else{
				header("Refresh:0; url=index.php?display=search");
			}
		}else{
			if( isset($_SESSION['admin']) || isset($_SESSION['user'])){
				header("Refresh:0; url=index.php?display=search");
			}
		}
		displayForgetPasswordForm();
	}

	function displayForgetPasswordForm(){	
		global $password , $isValid;
		?>
			<div class="e-account-container">
				<div class="e-account-form-container forget-password-container">
					<form onkeyup="validateForgetPasswordForm()" clsas="e-account-form" action="index.php?display=forgetPassword" method="POST">
						<?php
							if($isValid){
								echo "<label> Your Password : ".$password."</label><br>";
							}
							else{
								echo "<label>Forget Password</label><br>";	
							}
						?>
						<hr>
						<label>Enter ID:</label>
						<input id="forgetPasswordId" type="number" class="e-account-input" name="id" required><br>
						<input class="submit-btn btn green-btn forget-password-btn" type="submit" name="submit" value="showPassword" id="forgetPasswordSubmit" >
					</form>
				</div>
			</div>
		<?php
	}
?>