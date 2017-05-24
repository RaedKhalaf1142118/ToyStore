<?php
	
	function displayRegister(){
		if(isset($_POST['name'])){
			$name =$_POST['name'];
			setcookie('name',$name);
			$address = $_POST['address'];
			setcookie('address',$address);
			$birthDate = $_POST['birthDate'];
			setcookie('birthDate',$birthDate);
			$email = $_POST['email'];
			setcookie('email',$email);
			$telephone = $_POST['telephone'];
			setcookie('telephone',$telephone);
			$fax = $_POST['fax'];
			setcookie('fax',$fax);
			$creditCardNumber = $_POST['creditCardNumber'];
			setcookie('creditCardNumber',$creditCardNumber);
			$isValid = false;

			if($name == '' || $address == '' || $birthDate == '' || $email == '' || $telephone == '' || $fax == '' || $creditCardNumber == ''){
				$isValid = false;
			}else{
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$isValid = false;
				}else{
					$isValid = isCreditCardExist($creditCardNumber);
				}
			}

			if($isValid){
				displayEAccount();
			}else{
				displayRegisterForm();
			}
		}else if(isset($_POST['username'])){
			registerCustomerForm();
		}else{
			displayRegisterForm();
		}
	}

	function registerCustomerForm(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirmPassword'];

		$isValid = false;
		if(strlen($username) < 6 || strlen($username) > 13){
			$isValid = false;
		}else{
			if(strlen($password) > 12 || strlen($password) < 8){
				echo strlen($password);
				$isValid = false;
			}else{
				if(strcmp($password,$confirmPassword) == 0){
					$isValid = true;
				}else{
					$isValid = false;
				}
			}
		}
		if($isValid){
			registerCustomer($_COOKIE['name'],$_COOKIE['address'],$_COOKIE['birthDate'],$_COOKIE['email'],$_COOKIE['telephone'],$_COOKIE['fax'],$username,$password,$_SESSION['id'],$_COOKIE['creditCardNumber']);
			unset($_COOKIE['name']);
			unset($_COOKIE['address']);
			unset($_COOKIE['birthDate']);
			unset($_COOKIE['email']);
			unset($_COOKIE['telephone']);
			unset($_COOKIE['fax']);
			unset($_SESSION['id']);
			unset($_COOKIE['creditCardNumber']);
			displaySearch();
		}else{
			displayEAccount();
		}
	}

	function isCreditCardExist($creditCardNumber){
		$creditCard = getCreditCardByNumber($creditCardNumber);
		if($creditCard){
			return true;
		}else{
			return false;
		}
	}

	function displayRegisterForm(){
		?>
		<div class="customer-registeration-container">
			<div class='register-form-container'>
				<form class='customer-registeration-form' action="index.php?display=register" method="POST" onkeyup="validateRegisterForm()">
					<h3>Register</h3>
					<table>
						<tr>
							<td>
								<label>Name</label>
								<input id="name" placeholder="Full-Name" type="text" name="name" required>
							</td>
						</tr>
						<tr>
							<td>
								<label>Address</label>
								<input id="address" placeholder="Address" type="Address" name="address" required>
							</td>
						</tr>
						<tr>
							<td>
								<label>Birth Date</label>
								<input id="birthDate" placeholder="Date Of Birth" type="date" name="birthDate" required>
							</td>
						</tr>
						<tr>
							<td>
								<label>Email</label>
								<input id="email" placeholder="Email" type="email" name="email" required>
							</td>
						</tr>
						<tr>
							<td>
								<label>Telephone</label>
								<input id="telephone" placeholder="Telephone" type="text" name="telephone" required>
							</td>
						</tr>
						<tr>
							<td>
								<label>Fax</label>
								<input id="fax" placeholder="Fax number" type="text" name="fax" required>
							</td>
						</tr>
						<tr>
							<td>
								<label>CreditCardNumber</label>
								<input id="creditCardNumber" placeholder="Credit Card number" type="number" name="creditCardNumber" required>
							</td>
						</tr>
						<tr>
							<td>
								<input id="submit" class="submit-btn btn green-btn" type="submit" name="submit" value='Create Account'>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<?php
	}

	function displayEAccount(){
		?>
			<div class="e-account-container">
				<div class="e-account-form-container">
					<label> E-Account Register</label>
					<hr>
					<form class="e-account-form" method="POST" action="index.php?display=register" onkeyup="validateEAccountForm()">
						<table>
							<tr>
								<td colspan="2">
									<input id="username" type="text" name="username" placeholder="Username" class="e-account-input" required>
								</td>
							</tr>
							<tr>
								<td>
									<input id="password" type="password" placeholder="password" name="password" class="e-account-input" required>
									<input id="confirmPassword" type="password" placeholder="confirm-Password" class="e-account-input" name="confirmPassword" required>
								</td>
							</tr>
							<tr>
								<label>
									Your ID is <?php echo generateID();?>
								</label>
							</tr>
							<tr>
							<td>
								<input id="submit" class="submit-btn btn green-btn" type="submit" name="submit" value='Create Account'>
							</td>
						</tr>
						</table>
					</form>
				</div>
			</div>
		<?php
	}

	function generateID(){
		$id = "1142118";
		$_SESSION['id'] = $id;
		return "1142118";
	}
?>