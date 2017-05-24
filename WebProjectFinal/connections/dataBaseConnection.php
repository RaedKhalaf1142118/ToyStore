<?php

	$database = mysqli_connect("localhost","root","") OR die("ERROR");
	mysqli_select_db($database,"toystore");

	function getCustomerByUserName($username){
		global $database;
		$resultSet = mysqli_query($database,"SELECT * FROM customer c WHERE c.username = '".$username."'");
		if($resultSet)
			return mysqli_fetch_array($resultSet);
		else
			return null;
	}

	function getProductsByPrice($from,$to){
		global $database;
		$resultSet = mysqli_query($database, "SELECT * FROM product");
	}

	function dataBaseLogin($userName,$password){
		if(substr($userName, 0, 5 ) === "Admin"){
			return getAdmin($userName,$password);
		}else{
			return getCustomer($userName,$password);
		}
	}

	function getAdmin($userName,$password){
		global $database;
		$resultSet = mysqli_query($database,"SELECT * FROM manager m WHERE m.userName = '".$userName."' AND m.managerPassword = '".$password."'");
		return $resultSet;

	}

	function getCustomer($userName,$password){
		global $database;
		$resultSet = mysqli_query($database,"SELECT * FROM customer m WHERE m.userName = '".$userName."' AND m.userPassword = '".$password."'");
		return $resultSet;
	}

	function getAllCategories(){
		global $database;
		$resultSet = mysqli_query($database,"SELECT * FROM category");
		return $resultSet;
	}

	function addProductToDataBase($name,$discription,$price,$category,$sizeX,$sizeY,$sizeZ,$from,$to,$remarks,$sale,$id,$amount,$imageOne,$imageTwo,$imageThree){
		global $database;
		mysqli_query($database, "INSERT INTO product(name,discription,price,categoryId,sizeX,sizeY,sizeZ,ageFrom,ageTo,remarks,productID,imageOne,imageTwo,imageThree,dateCreated,numberOfOrders,salesPercentage,availableAmount) VALUES ('{$name}','{$discription}','{$price}',{$category},{$sizeX},{$sizeY},{$sizeZ},{$from},{$to},'{$remarks}',{$id},'{$imageOne}','{$imageTwo}','{$imageThree}',NOW(),0,{$sale},{$amount})");
	}

	function getProductById($id){
		global $database;
		$resultSet = mysqli_query($database,"SELECT * FROM product where productID = {$id}");
		return mysqli_fetch_assoc($resultSet);
	}

	function getProductsWithPriceRange($to,$from){
		global $database;
		$products = array();
		$resultSet = mysqli_query($database , "SELECT * FROM product p where p.price >= {$from} AND p.price <= {$to}");
		if($resultSet){
			while($resultRow = mysqli_fetch_assoc($resultSet)){
				$products[] = $resultRow;
			}
		}
		return $products;
	}

	function getCategoryById($categoryId){
		global $database;
		$resultSet = mysqli_query($database,"SELECT name FROM category c WHERE c.id = {$categoryId}");
		return mysqli_fetch_assoc($resultSet)['name'];
	}
?>