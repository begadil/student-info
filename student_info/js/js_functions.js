/**
 * All js functions (ajax)
 */

/******************************* LOGIN.HTML *******************************/
function email_password_check(){
	$email = $("#email").val();
	$password = $("#password").val();
	$.ajax({
		type:"POST",
		url:"./php/php_functions.php?",
		data:{"function":'email_password_check', "email":$email, "password":$password},
		cache:false,
		success:function(res){
			if(res == "ok"){
				window.location.href = "./index.html";
			}
			else{
				document.getElementById("email_password_error").style.display = "block";
			}
		}
	});
}
/************************************************************************/

/******************************* INDEX.HTML *******************************/
function sign_out(){
	$.ajax({
		type:"POST",
		url:"./php/php_functions.php?",
		data:{"function":'sign_out'},
		cache:false,
		success:function(res){
			window.alert(res);
			if(res == "ok"){
				window.location.href = "./login.html";
			}
		}
	});
}
/************************************************************************/