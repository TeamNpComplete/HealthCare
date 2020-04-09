var activeTab = 'login';

var email = false, passwd = false, confirm = false;
var error = null;

function init(){
    activeTab = 'login';
    document.querySelector('.signup-tab').classList.remove('active-tab');
    document.querySelector('.login-tab').classList.remove('active-tab');
    document.querySelector('.login-tab').classList.add('active-tab');
    document.getElementById('signup-form').style.display = 'none';
    $('.input .user_check').hide();
}

function onSignupTabClicked(){
    if(activeTab === 'login'){
        $('.signup-tab').toggleClass('active-tab');
        $('.login-tab').toggleClass('active-tab');
        $('#signup-form').fadeToggle();
        $('#login-form').hide();
        activeTab = 'signup';
    }
}

function onLoginTabClicked(){
    if(activeTab === 'signup'){
        $('.signup-tab').toggleClass('active-tab');
        $('.login-tab').toggleClass('active-tab');
        $('#login-form').fadeToggle();
        $('#signup-form').hide();
        activeTab = 'login';
    }
}

function validateEmail(){
	email = document.getElementById('username').value;
    var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}/;
    	if(!re.test(email)){
		document.getElementById('username').parentElement.style["border-bottom"] = "2px solid red";
        console.log('Invalid Email');
        email = false;
	}else{
        document.getElementById('username').parentElement.style["border-bottom"] = "";
        email = true;
	}
}

$('#passwd').keyup(() => {
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
    if(!re.test($('#passwd').val())){
        $('#passwd').parent().css('border-bottom', '2px solid red');
        passwd = false;
    } else {
        $('#passwd').parent().css('border-bottom', '');
        passwd = true;
    }
});

$('#confirm-passwd').keyup(() => {
    if($('#passwd').val() != $('#confirm-passwd').val()){
        $('#confirm-passwd').parent().css('border-bottom', '2px solid red');
        confirm = false;
    } else {
        $('#confirm-passwd').parent().css('border-bottom', '');
        confirm = true;
    }
});

$('.signup-btn').on('click', (event) => {
    validateEmail();
    if(error){
    	alert(error);
    } else if(!email){
    	alert('Invalid Email ID !');
    } else if(!passwd){
    	alert('Password must contain atleast 8 characters, 1 uppercase, 1 lowercase , 1 digit and 1 Symbol !');
    } else if(!confirm){
    	alert('Password and Confirm password does not match !');
    } else {
    	$('#signup-form').submit();
    }
    
});

$('#login-btn').on('click', (event) => {
    var username = ('#login-username').val();
    var password = ('#login-password').val();

    if(username && password){
        $('#login-form').submit();
    } else {
        if(!username){
            ('#login-username').parent().css('border-bottom', '2px solid red');
        }
        if(!password){
            ('#line').css('border-bottom', '3px solid red');
        }
    }
});

('#login-username').keyup(() => {
    ('#login-username').parent().css('border-bottom', '');
});

('#login-password').keyup(() => {
    ('#line').css('border-bottom', '');
});

$('#username').keyup(() => {
	var text = $('#username').val();
	if(text.length === 0) {
		$('.input .user_check').hide();
	} else {
		var request = new XMLHttpRequest();
		request.onreadystatechange = () => {
			if (request.readyState == 4 && request.status == 200) {
				if(request.responseText == 'yes'){
					$('.input .user_check').show();
					error = 'username already exist !'
				} else {
					$('.input .user_check').hide();
					error = null;
				}
            } else {
            	$('.input .user_check').hide();
            	error = null;
            }
		};
		request.open("GET", "user_check.php?q=" + text, true);
		request.send();
	}
	
});


init();
