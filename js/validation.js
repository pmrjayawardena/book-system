$(document).ready(function () {
  //if this page is load to browser then execute this code(call back functions)
  $("form").submit(function () {
    // this is happenning when submit button is clicked

    var user_fname = $("#user_fname").val(); //val is use to getting value of inside element
    var user_email = $("#user_email").val(); //get the value of the input feild with the id $user_email
    var user_nic = $("#user_nic").val(); //get the value of the input feild with the id $user_nic
    var user_group = $("#user_group").val();
    var captcha = $("#captcha").val();

    var pattel = /^\+94[0-9]{9}$/; //reguler expression
    var pattel1 = /^[0][0-9]{9}$/;
    var patnic = /^[0-9]{9}[vVxX]$/;
    var patnic1 = /^[0-9]{12}$/;
    var hid = $("#hid").val();

    var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;



    if (user_fname == "") {
      $("#uname").text("Empty first name"); //if fname is empty then do this
      $("#user_fname").css("border-color", "red");
      $("#user_fname").focus(); //focus the pointer to the relevent input feild
      return false; // is yes then dont go to server
    }

    if (user_email == "") {
      $("#eemailerr").text("Empty Email");
      $("#user_email").css("border-color", "red");
      $("#user_email").focus();
      return false; // i
    }

    if (user_email != "") {
      if (!user_email.match(mailformat) ) {
        $("#eemailerr").text("Invalid Email Format");
        $("#user_email").css("border-color", "red");
        $("#user_email").select();
        return false;
      }
    }
    if (user_nic != "") {
      if (!user_nic.match(patnic) && !user_nic.match(patnic1)) {
        $("#unic").text("Invalid NIC");
        $("#user_nic").css("border-color", "red");
        $("#user_nic").select();
        return false;
      }
    }

    if (user_group == "") {
      $("#grouperror").text("Select a group"); //if fname is empty then do this
      $("#user_group").css("border-color", "red");
      $("#user_group").focus(); //focus the pointer to the relevent input feild
      return false; // is yes then dont go to server
    }
  });

  $("#user_fname").keypress(function () {
    $("#uname").text(""); //to delete error message after enter a text
  });

  $("#user_email").keypress(function () {
    $("#eemailerr").text(""); //to delete error message after enter a text
  });

  $("#user_nic").keypress(function () {
    $("#unic").text(""); //to delete error message after enter a text
  });
  $("#user_group").keypress(function () {
    $("#grouperror").text(""); //to delete error message after enter a text
  });
});

//To check email
function checkNIC(str) {
  $("#unic").text("");
  $("unic").removeClass("alert-danger"); //we can remove css class using remove class
  var xhttp;
  if (str == "") {
    document.getElementById("showNIC").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest(); // get request using javascript start from here (0)
  xhttp.onreadystatechange = function () {
    // document.getElementById("showFun").innerHTML = '<img src="../images/loading.gif" alt="Please Wait" />';(3)
    if (this.readyState == 4 && this.status == 200) {
      //4 is for server giv reply. 200 is for successfull
      document.getElementById("showNIC").innerHTML = this.responseText; //get responce and show that imail in
      //showemail span
    }
  };
  xhttp.open("GET", "../ajax/getEmail.php?q=" + str, true); //send str and get requst from getemail.true is
  //for expecting respond.if there is false not expecting respond. (1)
  xhttp.send(); // after send xhttp.onreadystatechange = function () { is execute(2)
}
