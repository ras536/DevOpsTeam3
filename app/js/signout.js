  function signout() {

    jQuery.ajax({
      type: "GET",
      url: 'php/weatherapp.php',
      data: {logout: true},
      success: function (data) {
        if(data != "0"){
          console.log(data);
            
          document.getElementById("displayUsername").style.display="none";
          document.getElementById("displayUsername").innerHTML = "<h2></h2>";
          document.getElementById("signInStuff").style.display="inline-block";
          document.getElementById("signOutBtn").style.display="none";
          document.getElementById("locationList").style.display="none";
          document.getElementById("addLocation").style.display="none";

        }else{
          alert("Logout failure. Please try again.");
        };
      }
    });


  }