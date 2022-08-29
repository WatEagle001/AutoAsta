
function checkText(input, text, regexp){
	var element = document.getElementById(input);
	var test = element.value;
	var parent = element.parentNode;
	var alert = parent.querySelector(".invalid-feedback");

	return showAlert(alert, regexp.test(test) || test === "" , text, parent);
}

function checkEmail(){
    var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$/;
	var element = document.getElementById('email');
	var test = element.value;
	var parent = element.parentNode;
	var alert = parent.querySelector(".invalid-feedback");

	return showAlert(alert,regex.test(test) || test === "", 'Email non valida', parent);
}

function checkPassword(){
    var inputPassword = document.getElementById('psw');
    var inputRepeatPassword =document.getElementById('password-repeat');
    var parent = inputRepeatPassword.parentNode;
	var alert = parent.querySelector(".invalid-feedback");
	return showAlert(alert, inputPassword.value === inputRepeatPassword.value, 'Password e Conferma Password non coincidono, riprova', parent);
}

function checkDateProfile(){
    var element = document.getElementById("data_nascita");
	var parent = element.parentNode;
	var alert = parent.querySelector(".invalid-feedback");
	var condition = false;
	var userAge= getAge(element.value);
    if(userAge < 18){
        text = 'Devi avere almeno 18 anni per registrarti al nostro portale';
    }
	else
		condition = true;

	return showAlert(alert, condition, text, parent);
}

function getAge(DOB) {
    var today = new Date();
    var birthDate = new Date(DOB);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }    
    return age;
}

function showAlert(alert, condition, text, parent){
	if(alert) parent.removeChild(alert);

	if(!condition && text !== ""){
		var div = document.createElement("div");
		div.classList.add("feedback");
		div.classList.add("invalid-feedback");
		var p = document.createElement("p");
		p.appendChild(document.createTextNode(text));
		div.appendChild(p);
		parent.appendChild(div);

		return false;
	}

	return true;
}

