<?php
	$isValid;
	$to;
	$from;
    $selectedTool;
    $categoryName ; $ageFrom ; $ageTo ; $newArrivals ; $sales ; $mostWanted;
	function displaySearchResultTable(){
		displaySearchTableHeader();
		displayTableResultSet();
		displaySearchTableFooter();
	}

	function displaySearchTableFooter(){
		echo "</table>";
	}

	function displaySearchTableHeader(){
		?>
			<table class='result-table'>
				<thead>
					<th>Select</th>
					<th>ID</th>
					<th>Price</th>
					<th>Category</th>
					<th>Product Availability</th>
					<th>Rank</th>
				</thead>
		<?php
	}

	function displayTableResultSet(){
		global $isValid,$to,$from,$selectedTool, $categoryName , $ageFrom , $ageTo , $newArrivals, $sales , $mostWanted;
		
		if($selectedTool == 'price'){
			if($isValid){
				$products = getProductsWithPriceRange($to,$from);
				if(sizeof($products) == 0){
					displayEmptyRow();
				}else{
					displayRows($products);
				}
			}else{
				displayEmptyRow();
			}
		}else{
			$products = getProductsByCategory($categoryName,$ageFrom,$ageTo,$newArrivals, $sales,$mostWanted);
			if(sizeof($products) == 0){
				displayEmptyRow();
			}else{
				displayRows($products);
			}
		}
	}
	

	function getProductAvailability($product){
		if($product['availableAmount'] != 0){
			return "True";
		}else{
			return "False";
		}
	}

	function getProductRank(){
		// TODO later
		return "Rank";
	}

	function displayRows($products){
		for ($i=0; $i < sizeof($products); $i++) { 
			echo "<tr class='search-table-row'>";
			echo "<td>"."<input type='checkbox'>"."</td>";
			echo "<td>".$products[$i]['productID']."</td>";
			echo "<td>".$products[$i]['price']."</td>";
			echo "<td>".getCategoryById($products[$i]['categoryId'])."</td>";
			echo "<td>".getProductAvailability($products[$i])."</td>";
			echo "<td>".getProductRank($products[$i])."</td>";
			echo "<tr>";
		}
	}

	function displayEmptyRow(){
		?>
		<tr>
			<td>Empty</td>
			<td>Empty</td>
			<td>Empty</td>
			<td>Empty</td>
			<td>Empty</td>
			<td>Empty</td>
		</tr>

		<?php
	}


	function displaySearch(){
		global $isValid,$to,$from,$selectedTool, $categoryName , $ageFrom , $ageTo , $newArrivals, $sales , $mostWanted;
		$isValid = false;
		if(isset($_POST['from'])){
			$selectedTool = "price";
		}else{
			$selectedTool = "category";
		}
		$from = $to = 0;
		?>
		<div class="search-container">
				<div class="search-header">
					<ul class="search-tools">
						<li id="price-search-tool" onclick="switchSearchToolState('price','category')" class="<?php echo $selectedTool == 'price'? 'selected-search-tool':'';?>">Price</li>
						<li id="category-search-tool" onclick="switchSearchToolState('category','price')" class="<?php echo $selectedTool == 'price'? '':'selected-search-tool' ;?>">Category</li>
					</ul>
					<hr>
				</div>
		<?php
		if(isset($_POST['from']) && isset($_POST['to'])){
			if($_POST['from'] !='' && $_POST['to'] != '' ){
				if($_POST['from'] < $_POST['to']){
					$isValid = true;
					$selectedTool = 'price';
					$to = $_POST['to'];
					$from = $_POST['from'];
				}
			}
		}

		if(isset($_POST['categorySearch'])){
			$categoryName = $_POST['categorySearch'];
			$ageFrom = $_POST['ageFromSearch'];
			$ageTo = $_POST['ageToSearch'];
			if(isset($_POST['newArrivalsSearch']))
				$newArrivals = $_POST['newArrivalsSearch'];
			else
				$newArrivals = 'off';
			if(isset($_POST['salesSearch']))
				$sales = $_POST['salesSearch'];
			else
				$sales = 'off';
			if(isset($_POST['mostWantedSearch']))
				$mostWanted = $_POST['mostWantedSearch'];
			else
				$mostWanted = 'off';
		}

			?>
				<div id="price-search-display"  class="<?php echo $selectedTool == 'price'? '':'unselected_search_display' ;?>">
					<form action="index.php?display=search" method="POST" >
						<label>From</label>
						<input onclick="validatePriceSearchForm()" onkeyup="validatePriceSearchForm()" id='from-price' type="number" name="from" min='0' value='<?php echo $isValid? $_POST['from']:'0'; ?>'>
						&nbsp;&nbsp;
						<label>To</label>
						<input onclick="validatePriceSearchForm()" onkeyup="validatePriceSearchForm()" id='to-price' type="number" name="to" min='0' value='<?php echo $isValid? $_POST['to']:'100'; ?>'>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<input id='price-search-button' type="submit" name="submit" value='search'>
						<div id="price-search-form-error" class='price-search-error-hide'>
							<span >from must be less 	than to</span>
						</div>
					</form>
				</div>
				<div id="category-search-display"  class="<?php echo $selectedTool == 'category'? '':'unselected_search_display' ;?>">
					<form action="index.php?display=search" method="POST">
						<table>
							<tr>
								<td>
									<label>Category Name</label>
								</td>
								<td>
									<select name='categorySearch'>
										<option>-All-</option>
										<?php
											$categories = getAllCategories();
											while($category = mysqli_fetch_assoc($categories)){
												$temp = '';
												if(strcmp($categoryName, $category['name']) == 0)
													$temp = "selected";
												echo "<option ".$temp.">{$category['name']}</option>";
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label>Age group</label>
								</td>
								<td>
									<input type="number" name="ageFromSearch" placeholder="From Age" value="<?php echo $ageFrom; ?>">
								</td>
								<td>
									<input type="number" name="ageToSearch" placeholder="To Age" value="<?php echo $ageTo; ?>">
								</td>
							</tr>
							<tr>
								<td>
									<input type="checkbox" name="newArrivalsSearch" <?php echo strcmp( $newArrivals, 'off')==0?"":"checked" ;?> >				
									<label>New Arrivals</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type="checkbox" name="salesSearch" <?php echo strcmp( $sales, 'off')==0?"":"checked" ;?>>
									<label>Sales Items</label>
								</td>
							</tr>
							<tr>
								<td>
									<input type="checkbox" name="mostWantedSearch" <?php echo strcmp( $mostWanted, 'off')==0?"":"checked" ;?>>
									<label>Most wanted</label>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input type="submit" name="submit" value="Search">
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div class="search-result-set">
					<?php 
						displaySearchResultTable();
					?>
				</div>
			</div>
		<?php

	}	
?> 