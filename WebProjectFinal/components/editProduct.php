<?php
	function displayEditProduct(){
		if(isset($_POST['name'])){
			$name = $_POST['name'];
			$dis = $_POST['discription'];
			$price = $_POST['price'];
			setEditesDB($name,$dis,$price,$_GET['id']);
			header("Refresh:0 ; url=index.php?display=search");
		}
		if(isset($_GET['display'])){
			if(isset($_GET['id'])){
				$id = $_GET['id'];
				$product = getProductById($id);
				?> 
					<div class="edit-product-container">
						<fieldset>
							<legend>Edit Product</legend>
								<form action="index.php?display=editProduct&id=$id" method="POST">
									<table>
										<tr>
											<td>
												<label>Name</label>
											</td>
											<td>
												<input type="text" name="name" value="<?php echo $product['name']?>">
											</td>
										</tr>
										<tr>
											<td>
												<label>Discription</label>
											</td>
											<td>
												<input type="text" name="discription" value="<?php echo $product['discription']; ?>">
											</td>
										</tr>
										<tr>
											<td>
												<label>Price</label>
											</td>
											<td>
												<input type="number" name="price" value="<?php echo $product['price']; ?>">
											</td>
										</tr>
										<tr>
											<td>
												<input type="submit" name="submit" value="save">
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
		}
	}
?>