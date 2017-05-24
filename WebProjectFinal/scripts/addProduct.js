function validateAddProductForm(){
	var isNameValid = validateNameAddProduct();
	var isDiscriptionValid = validateDescriptionAddProduct();
	var isPriceValid = validatePriceAddProduct();
	var isSizeValid = validateSizeAddProduct();
	var isTargetAgeValid = validateTargetAgeAddProduct();
	var isRemarkValid = validateRemarkAddProduct();
	var isIDValid = validateIDAddProduct();
	//var isRemarkValid = validateRemarkAddProduct();
	var isSaleValid = validateSaleAddProduct();
	var isAmountValid = validateAmountAddProduct();

	var isAllValid = isNameValid && isDiscriptionValid && isPriceValid && isSizeValid && isTargetAgeValid;
	isAllValid = isAllValid && isRemarkValid && isIDValid  && isSaleValid && isAmountValid;
	if(!isAllValid){
		document.getElementById("submitAddProduct").disabled = true;
	}else{
		document.getElementById("submitAddProduct").disabled = false;
	}
}

function validateNameAddProduct(){
	var name = document.getElementById("addProduct-form-control-name");
	if(name.value == ''){
		return false;
	}else{
		document.getElementById("nameErrorMessage").innerHTML = '';
		return true;
	}
}

function validateDescriptionAddProduct(){
	var discription = document.getElementById("addProduct-form-control-discription");
	if(discription.value == ''){
		return false;
	}else{ 
		document.getElementById("discriptionErrorMessage").innerHTML = '';
		return true;
	}
}

function validatePriceAddProduct(){
	var price = document.getElementById("addProduct-form-control-price");
	if(price.value == ''){
		return false;
	}else{
		if(parseInt(price.value) < 0){
			document.getElementById("priceErrorMessage").innerHTML = 'must be positive price';
			return false;
		}else{
			document.getElementById("priceErrorMessage").innerHTML = '';
			return true;
		}
	}
}

function validateSizeAddProduct(){
	var sizeX = document.getElementById("addProduct-form-control-sizeX");
	var sizeY = document.getElementById("addProduct-form-control-sizeY");
	var sizeZ = document.getElementById("addProduct-form-control-sizeZ");

	if(sizeX.value == '' || sizeY.value == '' || sizeZ.value == ''){
		return false;
	}else{
		if(parseInt(sizeX.value) < 0 || parseInt(sizeY.value) < 0 || parseInt(sizeZ.value) < 0){
			document.getElementById("sizeErrorMessage").innerHTML = "positive sizes*";
			return false;
		}else{
			document.getElementById("sizeErrorMessage").innerHTML = "";
			return true;
		}
	}
}

function validateTargetAgeAddProduct(){
	var from = document.getElementById("addProduct-form-control-targetAge-from");
	var to = document.getElementById("addProduct-form-control-targetAge-to");

	if(from.value == '' || to.value == ''){
		return false;
	}else{
		if(parseInt(from.value) < 0 ||  parseInt(to.value) < 0){
			document.getElementById("targetAgeErrorMessage").innerHTML = "positive values";
			return false;
		}else{
			if(parseInt(from.value) > parseInt(to.value)){
				document.getElementById("targetAgeErrorMessage").innerHTML = "from < To";
				return false;
			}else{
				document.getElementById("targetAgeErrorMessage").innerHTML = "";
				return true;
			}
		}
	}
}

function validateRemarkAddProduct(){
	var remark = document.getElementById("addProduct-form-control-remark");
	if(remark.value == ''){
		return false;
	}else{
		document.getElementById("remarkErrorMessage").innerHTML = "";
		return true;
	}
}

function validateIDAddProduct(){
	var id = document.getElementById("addProduct-form-control-ID");
	if(id.value == ''){
		return false;
	}else{
		if(id.value.length  == 10){
			document.getElementById("idErrorMessage").innerHTML = '';
			return true;
		}else{
			document.getElementById("idErrorMessage").innerHTML = 'must be 10 digits';
			return false;
		}
	}
}

function validateSaleAddProduct(){
	var sale = document.getElementById("addProduct-form-control-sale");
	if(sale.value == ''){
	}else{
		if(parseInt(sale.value) > 100 || parseInt(sale.value) < 0){
			document.getElementById("saleErrorMessage").innerHTML = 'range [0-100]';
		}else{
			document.getElementById("saleErrorMessage").innerHTML = '';
			return true;
		}
	}
	return false;
}

function validateAmountAddProduct(){
	var amount = document.getElementById("addProduct-form-control-amount");
	if(amount.value == ''){
		return false;
	}else{
		if(parseInt(amount.value) < 0){
			document.getElementById("amountErrorMessage").innerHTML = 'positive value';
		}else{
			document.getElementById("amountErrorMessage").innerHTML = '';
			return true;
		}
	}
	return false;
}