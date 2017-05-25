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

	function getCategoryByName($categoryName){
			global $database;
			$resultSet = mysqli_query($database,"SELECT * FROM category c WHERE c.name = '{$categoryName}'");
			return mysqli_fetch_assoc($resultSet)['id'];
	}

	function getCreditCardByNumber($number){
		global $database;
		$resultSet = mysqli_query($database,"SELECT * FROM creditcard c WHERE c.id = {$number}");
		return mysqli_fetch_array($resultSet)[0];
	}

	function registerCustomer($name,$address,$birthDate,$email,$telephone,$fax,$username,$userPassword,$id,$creditCardNumber){
		global $database;
		mysqli_query($database,"INSERT INTO customer(name,address,dateOfBirth,email,telephone,faxNumber,userName,userPassword,id,creditCard) VALUES ('{$name}','{$address}','{$birthDate}','{$email}','{$telephone}','{$fax}','{$username}','{$userPassword}',{$id},$creditCardNumber)");
	}

	function getProductsByCategory($categoryName,$ageFrom,$ageTo,$newArrivals, $sales,$mostWanted){
		global $database;
		$catCont = "";
		$flag = false;
		if(strcmp($categoryName,"-All-") != 0){
			$categoryIdTemp = getCategoryByName($categoryName);
			$catCont = "where p.categoryId = ".$categoryIdTemp;
			$flag = true;
		}

		$ageCont = "";
		if($ageTo == '' || $ageFrom == ''){

		}else{
			$flag = true;
			$ageCont = " p.ageFrom <= ".$ageTo." AND p.ageTo >= ".$ageFrom; 
			if(strcmp($categoryName,"-All-") != 0){
				$ageCont = " WHERE ".$ageCont;
			}
		}

		$salesCont = '';

		if(strcmp($sales, 'on') == 0){
			$salesCont = " p.salesPercentage > 0";
			if($flag == false){
				$salesCont = " WHERE ".$salesCont;
			}
		}

		$newArrivalsCont = "";
		if(strcmp($newArrivals, 'on') == 0){
			$newArrivalsCont = " ORDER BY p.dateCreated";
		}
		
		$mostWantedCont = "";
   
		if(strcmp( $mostWanted, 'on') == 0){
			$mostWantedCont = " p.numberOfOrders";
			if(strcmp($newArrivals, 'on') == 0){
				$mostWantedCont = " , ".$mostWantedCont;
			}
		}


		$products = array();
		$resultSet = mysqli_query($database , "SELECT * FROM product p ".$catCont.$ageCont.$salesCont.$newArrivalsCont.$mostWantedCont);
		if($resultSet){
			while($resultRow = mysqli_fetch_assoc($resultSet)){
				$products[] = $resultRow;
			}
		}
		return $products;
	} 
?>