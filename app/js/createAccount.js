  function createAccount() {

  //ADD CODE TO WRITE INFO TO DATABASE

    //use getElementById to grab information to send to database

    var city = document.getElementById('create-city').value;
    var state = document.getElementById('create-state').value;  
    addLocation(city,state);
  
    //***SET PARAMETERS TO SEND TO LOGIN FUNCTION*****/S/
    login();
    }