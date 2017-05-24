
function validateRegisterFormInput(){
	var email = document.getElementById("email");
	var creditCardNumber = document.getElementById('creditCardNumber');
	if(email.value.match(/[A-z]{0,}\@[A-z]{0,}\.[A-z]{0,3}/g)){
		return true;
	}
	return false;
}

function validateRegisterForm(){
	var submitButton = document.getElementById('submit');
	
	var isValid = validateRegisterFormInput();
	if(isValid){
		submitButton.className = "submit-btn btn green-btn";
		submitButton.disabled = false;
	}else{
		submitButton.className = "submit-btn btn green-btn blocked";
		submitButton.disabled = "disabled";
	}
}

function validateEAccountForm(){
	var username = document.getElementById('username');
	var password = document.getElementById('password');
	var confirmPassword = document.getElementById('confirmPassword');
	var submit = document.getElementById("submit");
	
	var isValid = false;
	var errorMessage = "";
	if(username.value.length > 13 || username.value.length < 6){
		isValid = false;
		errorMessage = "username length must br [6,13] char";
	}else{
		if(password.value.length < 8 || password.value.length > 12){
			isValid = false;
			errorMessage = "password length must be [8,12]";
		}else{
			if(password.value == confirmPassword.value){
				isValid = true;
			}else{
				isValid = false;
				errorMessage = "passwords fields are not matched";
			}
		}
	}

	if(isValid){
		submit.className = "submit-btn btn green-btn";
		submit.title = "Submit";
	}else{
		submit.className = "submit-btn btn green-btn blocked";
		submit.title = errorMessage;
	}
}