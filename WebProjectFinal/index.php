<?php 
	session_start();
	
	include 'connections/dataBaseConnection.php';
	include 'components/login.php';
	include 'components/search.php';
	include 'components/addProduct.php';
	include 'components/productDescription.php';
	include 'components/logout.php';
	include 'components/register.php';
	include 'components/forgetPassword.php';

	$customerClassName = '';
	$productClassName = '';
	$loginClassName = '';
	$forgetPasswordClassName = '';
	$registerClassName = '';
	$searchClassName = '';
	$addProductClassName ='';
	if(isset($_GET['display'])){
		$display = $_GET['display'];
		switch ($display) {
			case 'login':
				$customerClassName = 'selected';
				$loginClassName = 'selected';
				break;
			case 'forgetPassword':
				$forgetPasswordClassName = 'selected';
				$customerClassName = 'selected';
				break;
			case 'register':
				$registerClassName = 'selected';
				$customerClassName = 'selected';
				break;
			case 'search':
				$searchClassName = 'selected';
				$productClassName = 'selected';
				break;
			case 'addproduct':
				$addProductClassName = 'selected';
				$productClassName = 'selected';
				break;
			case 'productDescription':
			default:
				$productClassName = 'selected';
				break;
		}
	}else{
		$productClassName = 'selected';
		$searchClassName = 'selected';
		$display = 'default';
	}
?>
<html>
<head>
	<title>Toy Store</title>
	<link rel="icon" href="resources/site_tab_icon.png" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="styles/root.css">
	<link rel="stylesheet" type="text/css" href="styles/header.css">
	<link rel="stylesheet" type="text/css" href="styles/nav.css">
	<link rel="stylesheet" type="text/css" href="styles/login.css">
	<link rel="stylesheet" type="text/css" href="styles/search.css">
	<link rel="stylesheet" type="text/css" href="styles/addProduct.css">
	<link rel="stylesheet" type="text/css" href="styles/productDescription.css">
	<link rel="stylesheet" type="text/css" href="styles/register.css">
	<link rel="stylesheet" type="text/css" href="styles/forgetPassword.css">
	
</head>
<body>
	<header class="main-header-container">
		<div class="inline header-icon">
			<div class="inline header-icon-img-container">
				<img class="header-icon-img" src="resources/Toy_Story_Logo.png">
			</div>
		</div>
		<div class="header-icon-title-container">
			<span class="header-icon-title">
				<kw>T</kw>oy<kw>S</kw>tore</span>
			</span>
		</div>
		<div class="address-container">
			<span class="address">
				Ramallah-Birzeit-university
			</span>
		</div>
	</header>
	<nav id="main-nav-bar" class="main-navBar-container">
		<ul class="nav-bar">
			<li  id="customer" class="main-nav-item <?php echo $customerClassName; ?>" onclick="changeNavBarState('customer','product');">
				<img src="resources/customers.png" class="nav-bar-img">
				Customer
			</li>
			<li class="main-nav-item <?php echo $productClassName; ?>" id="product" onclick="changeNavBarState('product','customer');">
				<img src="resources/products.png"  class="nav-bar-img">
				Product
			</li>
		<hr>
		<li id="customerSubNavBar" style="display:<?php echo $customerClassName==''?'none':'block'; ?>">
			<ul>
				<?php 
				if(isset($_SESSION['admin']) || isset($_SESSION['user'])){
					?>
					<a href="index.php?display=logout">
						<li class="sub-nav-item <?php echo $loginClassName; ?>" id="logout" onclick="activate('logout')">
							<img src="resources/login_icon.png"  class="nav-bar-img">
							Logout
						</li>
					</a>
					<?php
				}
				else{
					?>
					<a href="index.php?display=login">
						<li class="sub-nav-item <?php echo $loginClassName; ?>" id="login" onclick="activate('login')">
							<img src="resources/login_icon.png"  class="nav-bar-img">
								Login
						</li>
					</a>
					<?php

				}
				?>
				<a href="index.php?display=forgetPassword">
					<li class="sub-nav-item <?php echo $forgetPasswordClassName; ?>" id="forgetPassword" onclick="activate('forgetPassword')">
						<img src="resources/forgot_password.png"  class="nav-bar-img">
						Forget password
					</li>
				</a>
				<a href="index.php?display=register">
					<li onclick="activate('register')" class="sub-nav-item <?php echo $registerClassName; ?>" id="register">
						<img src="resources/register.png"  class="nav-bar-img">
						Register
					</li>
				</a>
			</ul>
		</li>
		<li id="productSubNavBar" style="display:<?php echo $productClassName ==''?'none':'block'; ;?>">
			<ul>
				<a href="index.php?display=search">
					<li onclick="activate('search')" class="sub-nav-item <?php echo $searchClassName; ?>" id="search">
						<img src="resources/search_icon.png"  class="nav-bar-img">
						Search
					</li>
				</a>
				<a href="index.php?display=addproduct">
					<li onclick="activate('addProduct')" class="sub-nav-item  <?php echo $addProductClassName; ?>" id="addProduct">
						<img src="resources/add_icon.png"  class="nav-bar-img">
						Add product
					</li>
				</a>
			</ul>
		</li>
		</ul>
	</nav>
	<div class="main-display-container">
		<?php
			switch ($display) {
				case 'login':
					displayLogin();
					break;
				case 'forgetPassword':
					displayForgetPassword();
					break;
				case 'register':
					displayRegister();
					break;
				case 'addproduct':
					displayAddProduct();
					break;
				case 'search':  case 'default' :
					displaySearch();
					break;
				case 'logout':
					logout();
					break;
				case 'productDescription':
					displayProductDescription(isset($_GET['id']));
					break;
			}
		?>
	</div>

	<script type="text/javascript" src="scripts/nav.js"></script>
	<script type="text/javascript" src="scripts/login.js"></script>
	<script type="text/javascript" src="scripts/search.js"></script>
	<script type="text/javascript" src="scripts/addProduct.js"></script>
	<script type="text/javascript" src="scripts/productDescription.js"></script>
	<script type="text/javascript" src="scripts/register.js"></script>
	<script type="text/javascript" src="scripts/forgetPassword.js"></script>
</body>
</html>