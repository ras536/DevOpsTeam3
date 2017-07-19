  function createAccount() {

  //ADD CODE TO WRITE INFO TO DATABASE

    var city = document.getElementById('create-city').value;
    var state = document.getElementById('create-state').value;  
    addLocation(city,state);
    login();
    }