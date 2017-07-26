  function login(from) {

    if (from == "login"){
      var username = document.getElementById('login-name').value;
      var password = document.getElementById('login-pass').value;
    }else if (from = "create"){
      var username = document.getElementById('create-username').value;
      var password = document.getElementById('create-pass').value;
    }

    jQuery.ajax({
      type: "GET",
      url: './app/php/weatherapp.php',
      data: {login: true, user: username, pass: password},
      success: function (data) {
        if(data != 0){
            //temporary for testing
          alert("Login Success!!!");
          //keep track of user
            //update session variable of username
          //place returned location into var location
            //var location = str.split("-");
            //addLocation(location[0],location[1]);
        }else{
          alert("Login failure. Please try again.");
        };
      }
    });

    document.getElementById("signInStuff").style.display="none";
    document.getElementById("signOutBtn").style.display="inline-block";
    document.getElementById("locationList").style.display="inline-block";
    document.getElementById("addLocation").style.display="inline-block";
  }
