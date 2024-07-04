var elUname = document.getElementById('uname');		
var elPword = document.getElementById('pword');									   
var usernameInput = 0;
var passwordInput = 0;  	  	   
usernameInput = document.getElementById('uname');
var passwordInput = document.getElementById('pword');  	

var feedback = document.getElementById('feedback'); 


elForm = document.getElementById('signUp');


// Get a reference to the button element
const button = document.getElementById("addMeButton");

//button.disabled = true;
button.disabled = true;

function checkUsername() {
	if (usernameInput.value.length < 7) {
		feedback.innerHTML = 'Username and must be at leat 7 characters long';
		button.disabled = true;					
	} else {
		feedback.innerHTML = '';		// Clear any error messages
		button.disabled = false;
	}
}
function checkPassword() {
	if (passwordInput.value.length < 7) {
		feedback.innerHTML = 'Password must be at leat 7 characters long';	
		button.disabled = true;		
	} else {
		feedback.innerHTML = '';
		button.disabled = false;
	}
}
// Create event listeners 
elUname.addEventListener('blur', function() {checkUsername();}, false); 
elPword.addEventListener('blur', function() {checkPassword();}, false); 