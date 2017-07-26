  function pageStart() {

    jQuery.ajax({
      type: "GET",
      url: 'php/weatherapp.php',
      data: {pageStart: true},
      success: function (data) {
        if(data != 0){

            data = data.split("%");

            //place returned location into var location
            var loc = data[1].split("-");
            addLocation(loc[0],loc[1]);

            //keep track of user
            globalUser = data[0];          

            document.getElementById("signInStuff").style.display="none";
            document.getElementById("signOutBtn").style.display="inline-block";
            document.getElementById("locationList").style.display="inline-block";
            document.getElementById("addLocation").style.display="inline-block";

        }else{
          alert("Please login as usual.");
        };
      }
    });

  }