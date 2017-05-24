<?php 
	function displayRegister(){
		?>
		<div class="customer-registeration-container">
			<form action="index.php?display=register" method="POST">
				<h4>Register</h4>
				<table>
					<tr>
						<td>
							<label>Name</label>
						</td>
						<td>
							<input type="text" name="name" required>
						</td>
					</tr>
					<tr>
						<td>
							<label>Address</label>
						</td>
						<td>
							<input type="Address" name="address" required>
						</td>
					</tr>
					<tr>
						<td>
							<label>Birth Date</label>
						</td>
						<td>
							<input type="date" name="BirthDate" required>
						</td>
					</tr>
					<tr>
						<td>
							<label>Email</label>
						</td>
						<td>
							<input type="email" name="email" required>
						</td>
					</tr>
					<tr>
						<td>
							<label>Telephone</label>
						</td>
						<td>
							<input type="text" name="telephone" required>
						</td>
					</tr>
					<tr>
						<td>
							<label>Fax</label>
						</td>
						<td>
							<input type="text" name="fax" required>
						</td>
					</tr>
					<tr>
						<td>
							<label>CreditCardNumber</label>
						</td>
						<td>
							<input type="number" name="creditCardNumber">
						</td>
					</tr>
				</table>
			</form>
		</div>
		<?php
	}
?>