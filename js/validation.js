function validate(){
	//get values from form
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var confirmPassword = document.getElementById('confirmPassword').value;
	var email = document.getElementById('email').value;
	var dateOfBirth = document.getElementById('dateOfBirth').value;
	var termsOfService = document.getElementById('termsOfService').checked;
	//username must:
	//be at least 6 characters long
	//be at most 30 characters long
	//contain only letters, numbers, and special characters
	var usernameRegex = /^[A-Za-z0-9!@#$%&*_.]{6,30}$/;
	//password must:
	//be at least 8 characters long
	//contain at least one digit, lowercase, uppercase, and special charazcter
	var passwordRegex = /^.*(?=.{8,})(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*? ]).*$/;
	//email must be of the form ___@___.___
	var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+.[A-Za-z]{2,4}$/;
	//date of birth must be of the form [4 digits]-[2 digits]-[2 digits]
	var dateOfBirthRegex = /^\d{4}-\d{2}-\d{2}$/;

	//test the regex
	var usernameResult = usernameRegex.test(username);
	var passwordResult = passwordRegex.test(password);
	//password must match confirmed password
	var confirmPasswordResult = (password === confirmPassword);
	var emailResult = emailRegex.test(email);
	var dateOfBirthResult = dateOfBirthRegex.test(dateOfBirth);
	//user must agree to Terms of Service
	var termsOfServiceResult = (termsOfService === true);
	//check if the validation passed
	//if it didn't, show a message and return false
	//otherwise, return true
	if(!usernameResult)
	{
		alert('Please enter a valid username\nA username must:\nbe at least 6 characters long\nbe at most 30 characters long\ncan contain any amount of letters (upper  or lower case), numbers, and special characters (!@#$%&*_.)');
		return false;
	}
	if(!passwordResult)
	{
		alert('Please enter a valid password.\nA password must:\nbe at least 8 characters long\ncontain at least 1 uppercase letter\ncontain at least 1 lowercase letter\ncontain at least 1 special character (!@#$%^&*?)');
		return false;
	}
	if(!confirmPasswordResult)
	{
		alert('Password confirmation does not match password');
		return false;
	}
	if(!emailResult)
	{
		alert('Please enter a valid email\nAn email must be of the form ___@___.___\ne.g. example@test.com');
		return false;
	}
	if(!dateOfBirthResult)
	{
		alert('Please enter a valid date of birth');
		return false;
	}
	if(!termsOfServiceResult)
	{
		alert('You must agree to the Terms of Service in order to use this site');
		return false;
	}
	return true;
}