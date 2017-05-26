function validateForgetPasswordForm(){
	var id = document.getElementById("forgetPasswordId");
	var message = "";
	var submit = document.getElementById("forgetPasswordSubmit");

	if(id.value.length == 10){
		submit.className = "submit-btn btn green-btn forget-password-btn";
		submit.title = "Show Password";
		submit.disabled = false;
	}else{
		submit.className = "submit-btn btn green-btn forget-password-btn blocked";
		submit.title = "id length must be 10 digits";
		submit.disabled = true;
	}
}