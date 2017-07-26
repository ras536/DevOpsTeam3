  function signout() {

    //****WRITE CODE TO ERASE ALL SIGNS OF BEING LOGGED IN*****/

    document.getElementById("displayUsername").style.display="none";
    document.getElementById("signInStuff").style.display="inline-block";
    document.getElementById("signOutBtn").style.display="none";
    document.getElementById("locationList").style.display="none";
    document.getElementById("addLocation").style.display="none";
  }