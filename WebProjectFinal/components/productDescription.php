<?php
	function displayProductDescription(){
		$id;
		$isValid = false;
		$errorMessage = "";
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}else{
			header("Refresh:0; url=index.php?display=search");		
		}
		$product = getProductById($id);	
		if(isset($_POST['stars'])){
			if(isset($_SESSION['user'])){
				$rank = $_POST['stars'];
				$review = $_POST['review'];
				if(strcmp($rank, "") == 0 || strcmp($review, "") == 0){
					header("Refresh:0; url=index.php?display=productDescription&id=".$product['productID']);
				}else{
					addRankReview($product['productID'],$_SESSION['user'],$rank,$review);
				}
			}else{
				header("Refresh:0; url=index.php?display=login");	
			}
		}
		if(isset($_GET['addToChart'])){
			if(isset($_SESSION['user'])){
				$numberOfOrder = $product['numberOfOrders'];
				$availabledAmount = $product['availableAmount'];

				if($availabledAmount > 0){
					orderProduct($product['productID']);
					$errorMessage = "Successful Order";
					$isValid = true;
				}else{
					$errorMessage = "There is no available Items";
					$isValid = false;
				}
			}else{
				header("Refresh:0; url=index.php?display=login");
			}
		}
		?>
		<div class="product-description">
			<div class="img-container">
				<div class="img-list-container">
					<ul class="img-list">
						<li>
							<img onclick="selectNewImage('img-one')" id='img-one' src="<?php echo $product['imageOne']; ?>" class="img selected-img">
						</li>
						<li>
							<img onclick="selectNewImage('img-two')" id='img-two' src="<?php echo $product['imageTwo']; ?>" class="img">
						</li>
						<li>
							<img onclick="selectNewImage('img-three')" id='img-three' src="<?php echo $product['imageThree']; ?>" class="img">
						</li>
					</ul>
				</div>
				<div class="currentImage">
					<img id='img-selected' src="<?php echo $product['imageOne']?>">
				</div>
			</div>
			<div class="product-description-container">
				<div class="product-description-title">
					<label>
						<?php echo $product['name']; ?>
					</label>
					<div class="remarks">
						<?php echo $product['remarks']; ?>
					</div>
				</div>
				<hr>
				<div class="critical-information">
					<table>
						<tr>
							<td>
								<label>Price</label>
							</td>
							<td>
								<label>
									<?php echo $product['price'] ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<label>Category Name</label>
							</td>
							<td>
								<label>
									<?php echo getCategoryById($product['categoryId']); ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<label>
									Size (x,y,z)
								</label>
							</td>
							<td>
								<label>
									<?php echo $product['sizeX']."*".$product['sizeY']."*".$product['sizeZ'] ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<label>
									Target Age
								</label>
							</td>
							<td>
								<label>
									<?php echo "[".$product['ageFrom'].",".$product['ageTo']."]" ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<label>
									Sale %
								</label>
							</td>
							<td>
								<label>
									<?php echo $product['salesPercentage']."%"; ?>
								</label>
							</td>
						</tr>
						<tr>
							<td>
								<label>Rank</label>
							</td>
							<td>
								<?php echo getProductRank($product['productID']); ?>
							</td>
						</tr>
					</table>
				</div>
				<hr class="hrz">
				<div class="operations">
					<div class="add-to-chart">
						<a href="index.php?display=productDescription&id=<?php echo $product['productID']; ?>&addToChart=true">
						<?php 
							if(isset($_GET['addToChart'])){
								if($isValid){
									echo $errorMessage;
								}else{
									echo $errorMessage;
								}
							}else{
								echo "Add to Chart";
							}
						?>
						</a>
					</div>
					<hr>
					<div class="ranks-reviews">
						Ranks and Reviews
						<ul>
							<?php
								$productReviews = getProductRanksAndReviews($product['productID']);
								foreach ($productReviews as $review) {
    								$customer = getCustomerById($review['customerId']);
    								?>
    								<div class="rank-review">    									
    									<fieldset class="review-container">
    										<legend>By <?php echo $customer['name'];?></legend>
    										<h4> Rank : <?php echo  $review['rank']." Stars";?></h4>
	    									<p>
	    										Review :
	    										<?php
	    											echo $review['review'];
	    										?>
	    									</p>
    									</fieldset>
    								</div>
    								<?php
								}
							?>
							<div>
								<form action="index.php?display=productDescription&id=<?php echo $product['productID'];?>" method="POST">
									<table>
										<caption>Add Review</caption>
										<tr>
											<td>
												<label>
													Stars
												</label>
											</td>
											<td>
												<input type="number" name="stars" min="1" max="5" required>
											</td>
										</tr>
										<tr>
											<td>
												<label>Review</label>
											</td>
											<td>
												<textarea required name="review"></textarea>
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<input type="submit" name="submit" value="Add" class="btn green-btn review-submit">
											</td>
										</tr>
									</table>
								</form>
							</div>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
?>