var isUsernameValid = false;
var isPasswordValid = false;

function validateUserNameLogInForm(formControl){
	var value = formControl.value;
	var message = "";
	var isCorrect = false;
	if(value.length >= 6 && value.length <= 13){
		if(value.match(/\w{6,13}/g)){
			isCorrect = true;
			message = "correct";
		}else{
			isCorrect = false;
			message = "it must contains only world charactors";
		}
	}else{
		isCorrect = false;
		message = "it must be 6-13 charactors";
	}

	if(isCorrect){
		formControl.className = "form-control valid-login-form-control";
	}else{
		formControl.className = "form-control invalid-login-form-control";
	}
	document.getElementById("errorMessage-userName-login").innerHTML = message;
	document.getElementById("errorMessage-userName-login").style.color = isCorrect?"green":"red";
	isUsernameValid = isCorrect;
}

function validatePasswordLogIn(formControl){
	var value = formControl.value;
	var message = "";
	var isCorrect = false;
	if(value.length >= 8 && value.length <= 12){
		if(value.match(/\w{8,12}/g)){
			isCorrect = true;
			message = "correct";
		}else{
			isCorrect = false;
			message = "it must contains normal charactors";
		}
	}else{
		isCorrect = false;
		message = "the Password must be 8-12 charactors";
	}
	if(isCorrect){
		formControl.className = "form-control valid-login-form-control";
	}else{
		formControl.className = "form-control invalid-login-form-control";
	}
	document.getElementById("errorMessage-password-login").innerHTML = message;
	document.getElementById("errorMessage-password-login").style.color = isCorrect?"green":"red";
	isPasswordValid = isCorrect;
}

function validateLogin(){
	document.getElementById("login-button-form").disabled = !(isPasswordValid && isUsernameValid);
}