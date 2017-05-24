<?php
	$errorUserNameOrPassword = false;
	function logIn(){
		global $errorUserNameOrPassword;
		$username = $_POST['username'];
		$password = $_POST['password'];
		$customer = mysqli_fetch_assoc(dataBaseLogin($username,$password));
		if(sizeof($customer) > 0){
			if(substr($username, 0, 5 ) === "Admin"){
				$_SESSION['admin'] = 'loged';
			}else{
				$_SESSION['user'] = 'loged';
			}
			displaySearch();
		}else{
			$errorUserNameOrPassword = true;
			displayLoginForm();
		}
	}

	function displayCustomer($customer){
		echo "<h1>$customer</h1>";
	}	
	
	function displayLogin(){
		if(isset($_SESSION['admin']) || isset($_SESSION['user'])){
			displaySearch();
		}else{
			if(isset($_POST['username']) && isset($_POST['password'])){
				if(!empty($_POST['username']) && !empty($_POST['password'])){
					logIn();
				}else{
					displayLoginForm();
				}
			}else{
				displayLoginForm();
			}
		}
	}

	function displayLoginForm(){
		global $errorUserNameOrPassword;
		?>
		<div class="user-login-container">
			<fieldset class="user-login-fieldSet">
				<legend>Login</legend>
				<form onkeyup="validateLogin()" class="login-form" action="index.php?display=login" method="POST">
					<table>
						<tr>
							<span class="<?php echo $errorUserNameOrPassword?'showWrongInfo':'hideWrongInfo' ?>">
								Wrong username or password
							</span>
						</tr>
						<tr>
							<td>
								<label for="username">Username</label>
							</td>
							<td>
								<input onkeyup="validateUserNameLogInForm(this)" class="form-control" type="text" name="username" placeholder="username" required>
								<span class="errorMessage" id="errorMessage-userName-login">Message</span>
							</td>
							<td id="username_alert" class="alertMessage"></td>
						</tr>
						<tr>
							<td>
								<label for="password">Password</label>
							</td>
							<td>	
								<input onkeyup="validatePasswordLogIn(this)" class="form-control" type="password" name="password" placeholder="*****" required>
								<span class="errorMessage" id="errorMessage-password-login">Message</span>
							</td>
							<td id="password_alert" class="alertMessage"></td>
						</tr>
						<tr>
							<td>
								<input type="submit" id="login-button-form" name="submit" value="Login">
							</td>
							<td>
								<input type="reset" name="reset">
							</td>
						</tr>
					</table>
				</form>
			</fieldset>
		</div>
		<?php
	}
?>