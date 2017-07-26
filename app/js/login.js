  function login(from) {

    if (from == "login"){
      var username = document.getElementById('login-name').value;
      var password = document.getElementById('login-pass').value;
    }else if (from = "create"){
      var username = document.getElementById('create-username').value;
      var password = document.getElementById('create-pass').value;
    };

    jQuery.ajax({
      type: "GET",
      url: 'php/weatherapp.php',
      data: {login: true, user: username, pass: password},
      success: function (data) {
        if(data != "0"){
          console.log(data);
          //keep track of user
            globalUser = username;
          //place returned location into var location
            var location = data;
            location = location.split("-");
            addLocation(location[0],location[1]);
            
            document.getElementById("displayUsername").style.display="inline-block";
            document.getElementById("displayUsername").innerHTML = "<h2>"+globalUser+"</h2>";
            document.getElementById("signInStuff").style.display="none";
            document.getElementById("signOutBtn").style.display="inline-block";
            document.getElementById("locationList").style.display="inline-block";
            document.getElementById("addLocation").style.display="inline-block";

        }else{
          alert("Login failure. Please try again.");
        };
      }
    });


  }
