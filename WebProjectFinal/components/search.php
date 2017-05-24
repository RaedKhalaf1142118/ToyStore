<?php
	$isValid;
	$to;
	$from;

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
		global $isValid,$to,$from;
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
		global $isValid,$to,$from;
		$isValid = false;
		$selectedTool = "price";
		$from = $to = 0;
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

		?>
			<div class="search-container">
				<div class="search-header">
					<ul class="search-tools">
						<li id="price-search-tool" onclick="switchSearchToolState('price','category')" class="<?php echo $selectedTool == 'price'? 'selected-search-tool':'';?>">Price</li>
						<li id="category-search-tool" onclick="switchSearchToolState('category','price')" class="<?php echo $selectedTool == 'price'? '':'selected-search-tool' ;?>">Category</li>
					</ul>
					<hr>
				</div>

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
					<h1>raed</h1>
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