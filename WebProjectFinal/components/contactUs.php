<?php
	function displayContactUs(){
		if(isset($_POST['content'])){
			if(!empty($_POST['content'])){
				addContact($_POST['content'],getCustomerByUserName($_SESSION['user'])['id']);
				header("Refresh:0 ; url=index.php?display=search");
			}
		}
		?>
		<div class="contact-us-container">
			<div class="contact-us-templat">
				<fieldset>
					<legend>Template</legend>
					<h3>From : <?php echo getCustomerByUserName($_SESSION['user'])['name']; ?></h3>
					<strong>Content</strong>
					<p id="contact-us-content">
						
					</p>
				</fieldset>
			</div>
			<div class="contact-us-form-container">
				<fieldset>
				<legend>Form</legend>
					<form action="index.php?display=contactUs" method="POST">
						<table>
							<tr>
								<td>
									<label>
										Description
									</label>
								</td>
								<td>
									<textarea id="content" name="content" onkeyup="updateTemplate()" required>
										
									</textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" name="submit" value="send">
								</td>
							</tr>
						</table>
					</form>
				</fieldset>
			</div>
		</div>
		<?php
	}

	function displayViewContact(){
		$contacts = getContacts();
		?>
			<div class="contact-us-container">
				<?php
					foreach ($contacts as $contact) {
						echo "<fieldset>";
						echo "<legend>Message</legend>";
						echo "<h3> from : ".getCustomerById($contact['customerId'])['name']." </h3>";
						echo "<p> Description :".$contact['message']." </p>";
						echo "</fieldset>";
					}
				?>
			</div>
			<?php
	}
?>