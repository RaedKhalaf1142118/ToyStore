<?php
	function displayAddProduct(){
		if(isset($_SESSION['admin'])){
			if(isset($_POST['name'])){
				validateAddProduct();
			}else{
				displayAddProductForm();
			}
		}else{
			displayLogin();
		}
	}

	function validateAddProduct(){
		$name = $_POST['name'];
		$description = $_POST['discription'];
		$price = $_POST['price'];
		$category = $_POST['category'];
		$sizeX = $_POST['sizeX'];
		$sizeY = $_POST['sizeY'];
		$sizeZ = $_POST['sizeZ'];
		$from = $_POST['from'];
		$to = $_POST['to'];
		$remark = $_POST['remark'];
		$sale = $_POST['sale'];
		$id = $_POST['id'];
		$amount = $_POST['amount'];

		$categoryId = explode(" ", $category)[2];
		addProductToDataBase($name,$description,$price,$categoryId,$sizeX,$sizeY,$sizeZ,$from,$to,$remark,$sale,$id,$amount,"one","Two","Three");

		displayProductDescription($id);
	}	

	function displayAddProductForm(){
		?>
			<div class="addProduct-form">
				<fieldset>
					<legend>Add Product</legend>
					<form href="index.php?display=addProduct" method="POST" onkeyup="validateAddProductForm()">
						<table>
							<tr id="name-row-addProduct">
								<td>
									<label for="name">Name</label>
								</td>
								<td>
									<input id="addProduct-form-control-name" type="text" class="form-control" name="name" required>
								</td>
								<td>
									<span class="addProductErrorMessage" id="nameErrorMessage"></span>
								</td>
							</tr>
							<tr id="discription-row-addProduct">
								<td>
									<label  for="discription">Discription</label>
								</td>
								<td>
									<textarea type="textarea" class="form-control" name="discription" id="addProduct-form-control-discription" required></textarea>
								</td>
								<td>
									<span class="addProductErrorMessage" id="discriptionErrorMessage"></span>
								</td>
							</tr>
							<tr id="price-row-addProduct">
								<td>
									<label for="price">Price</label>
								</td>
								<td>
									<input type="number" name="price" class="form-control" id="addProduct-form-control-price" required>
								</td>
								<td>
									<span class="addProductErrorMessage" id="priceErrorMessage"></span>
								</td>
							</tr>
							<tr id="category-row-addProduct">
								<td>
									<label for="category">Category</label>
								</td>
								<td>
									<select type="select" name="category" class="form-control" id="addProduct-form-control-category">
										<?php
											$categories = getAllCategories();
											while($category = mysqli_fetch_assoc($categories)){
												echo "<option>{$category['name']} {$category['id']}</option>";
											}
										?>
									</select>
								</td>
								<td>
									<span class="addProductErrorMessage" id="categoryErrorMessage"></span>
								</td>
							</tr>
							<tr id="size-row-addProduct">
								<td>
									<label for="size"> Size </label>
								</td>
								<td>
									<label>X</label>
									<input type="number" name="sizeX" class="form-control" id="addProduct-form-control-sizeX" required>
									&nbsp;&nbsp;
									<label>Y</label>
									<input type="number" name="sizeY" required  class="form-control" id="addProduct-form-control-sizeY"> 
									&nbsp;&nbsp;
									<label>Z</label>
									<input type="number" name="sizeZ" required class="form-control" id="addProduct-form-control-sizeZ">
								</td>
								<td>
									<span class="addProductErrorMessage" id="sizeErrorMessage"></span>
								</td>
							</tr>
							<tr id="targetAge-row-addProduct">
								<td>
									<label for="targetAge">Target Age</label>
								</td>
								<td>
									<label>From</label>
									<input type="number" name="from" required  class="form-control" id="addProduct-form-control-targetAge-from">
									<label>To</label>
									<input type="number" name="to" required  class="form-control" id="addProduct-form-control-targetAge-to"> 
								</td>
								<td>
									<span class="addProductErrorMessage" id="targetAgeErrorMessage"></span>
								</td>
							</tr>
							<tr id="remark-row-addProduct">
								<td>
									<label for="remark">Remark</label>
								</td>
								<td>
									<input type="text" name="remark" required class="form-control" id="addProduct-form-control-remark">
								</td>
								<td>
									<span class="addProductErrorMessage" id="remarkErrorMessage"></span>
								</td>
							</tr>
							<tr id="id-row-addProduct">
								<td>
									<label for="id">ID</label>
								</td>
								<td>
									<input type="text" name="id"  required class="form-control" id="addProduct-form-control-ID">
								</td>
								<td>
									<span class="addProductErrorMessage" id="idErrorMessage"></span>
								</td>
							</tr>
							<tr id="remark-row-addProduct">
								<td>
									<label for="remark">Remark</label>
								</td>
								<td>
									<input type="text" name="remark" required class="form-control" id="addProduct-form-control-remark">
								</td>
								<td>
									<span class="addProductErrorMessage" id="remarkErrorMessage"></span>
								</td>
							</tr>
							<tr id="sale-row-addProduct">
								<td>
									<label for="sale">Sale</label>
								</td>
								<td>
									<input type="number" name="sale" min="0" max="100" required class="form-control" id="addProduct-form-control-sale">%
								</td>
								<td>
									<span class="addProductErrorMessage" id="saleErrorMessage"></span>
								</td>
							</tr>
							<tr id="amount-row-addProduct">
								<td>
									<label for="amount">amount</label>
								</td>
								<td>
									<input type="number" name="amount" required class="form-control" id="addProduct-form-control-amount" min="0">
								</td>
								<td>
									<span class="addProductErrorMessage" id="amountErrorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>
									<input id="submitAddProduct" type="submit" name="submit" value="Add">
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