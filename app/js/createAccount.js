  function createAccount() {

  //ADD CODE TO WRITE INFO TO DATABASE

    //use getElementById to grab information to send to database
    var username = document.getElementById('create-username').value;
    var password = document.getElementById('create-pass').value;
    var email = document.getElementById('create-email').value;
    var city = document.getElementById('create-city').value;
    var state = document.getElementById('create-state').value;

    //place city-state into one var
    var hyphen = "-";
    var location = city.concat(hyphen);
    var location = location.concat(state);
    
    jQuery.ajax({
        type: "POST",
        url: './app/php/weatherapp.php',
        data: {createUser: true, user: username, pass: password, email_address: email, loc : location},
        success: function (data) {
          if (data != 0){
              //update session variable with current user
            //Log them in
               //login("create");
          }else {
            alert("Create account failed. Please try again.");
          };
        }
    });
      
   
    }