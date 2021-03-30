

<?php

session_start();
if($_SESSION){

  unset($_SESSION['userinfo']); //unset the session upon logging out
  // header("refresh:1,url=../view/login.php"); //Redirection
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Sign In</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

<style>.cookieConsentContainer {
	z-index: 999;
	width: 350px;
	min-height: 20px;
	box-sizing: border-box;
	padding: 30px 30px 30px 30px;
	background: #232323;
	overflow: hidden;
	position: fixed;
    bottom: 30px;
	right: 30px;
	display: none;
}
.cookieConsentContainer .cookieTitle a {
	font-family: OpenSans, arial, "sans-serif";
	color: #FFFFFF;
	font-size: 22px;
	line-height: 20px;
	display: block;
}
.cookieConsentContainer .cookieDesc p {
	margin: 0;
	padding: 0;
	font-family: OpenSans, arial, "sans-serif";
	color: #FFFFFF;
	font-size: 13px;
	line-height: 20px;
	display: block;
	margin-top: 10px;
} .cookieConsentContainer .cookieDesc a {
	font-family: OpenSans, arial, "sans-serif";
	color: #FFFFFF;
	text-decoration: underline;
}
.cookieConsentContainer .cookieButton a {
	display: inline-block;
	font-family: OpenSans, arial, "sans-serif";
	color: #FFFFFF;
	font-size: 14px;
	font-weight: bold;
	margin-top: 14px;
	background: #000000;
	box-sizing: border-box; 
	padding: 15px 24px;
	text-align: center;
	transition: background 0.3s;
}
.cookieConsentContainer .cookieButton a:hover { 
	cursor: pointer;
	background: #3E9B67;
}

@media (max-width: 980px) {
	.cookieConsentContainer {
		bottom: 0px !important;
		left: 0px !important;
		width: 100%  !important;
	}
}
</style>
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="../controller/logincontroller.php" method="post">
    <img class="mb-4" src="../images/user_icon.png" alt="" width="72" height="80">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <?php if(isset($_GET['msg'])){ ?>
        <div class="alert alert-danger" role="alert">
                <?php 
                    echo base64_decode($_GET['msg']);
                ?>
        </div>
        <?php } ?>   
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"  name="user_nic">
      <label for="floatingInput">Usernames</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="txtPassword"  >
      <label for="floatingPassword">Password</label>
    </div>


    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <a href="./student_register.php" class="w-100 btn btn-lg btn-success mt-3" >Register</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
  </form>
  
</main>
<script>
// --- Config --- //
var purecookieTitle = "Cookies."; // Title
var purecookieDesc = "By using this website, you automatically accept that we use cookies."; // Description
var purecookieLink = '<a href="cookie-policy.html" target="_blank">What for?</a>'; // Cookiepolicy link
var purecookieButton = "Understood"; // Button text
// ---        --- //


function pureFadeIn(elem, display){
  var el = document.getElementById(elem);
  el.style.opacity = 0;
  el.style.display = display || "block";

  (function fade() {
    var val = parseFloat(el.style.opacity);
    if (!((val += .02) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
};
function pureFadeOut(elem){
  var el = document.getElementById(elem);
  el.style.opacity = 1;

  (function fade() {
    if ((el.style.opacity -= .02) < 0) {
      el.style.display = "none";
    } else {
      requestAnimationFrame(fade);
    }
  })();
};

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}

function cookieConsent() {
  if (!getCookie('purecookieDismiss')) {
    document.body.innerHTML += '<div class="cookieConsentContainer" id="cookieConsentContainer"><div class="cookieTitle"><a>' + purecookieTitle + '</a></div><div class="cookieDesc"><p>' + purecookieDesc + ' ' + purecookieLink + '</p></div><div class="cookieButton"><a onClick="purecookieDismiss();">' + purecookieButton + '</a></div></div>';
	pureFadeIn("cookieConsentContainer");
  }
}

function purecookieDismiss() {
  setCookie('purecookieDismiss','1',7);
  pureFadeOut("cookieConsentContainer");
}

window.onload = function() { cookieConsent(); };
</script>
  </body>
</html>
