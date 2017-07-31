function addLocation(newCity, newState) {
    if (newCity === undefined) {
      newCity = document.getElementById('newCity').value;    
    }
    if (newState === undefined) {
      newState = document.getElementById('newState').value;
    }
    //check via API call for valid entries
    jQuery(document).ready(function ($) {
      $.ajax({
        url: "http://api.wunderground.com/api/8bbe2bcb995d1e41/conditions/q/" + newState + "/" + newCity + ".json",
        dataType: "jsonp",
        success: function (parsed_json) {
          //if valid, perform operation to add li
          if (parsed_json.hasOwnProperty('current_observation')) {
                //get username from session variable
                var username;
                //place city-state into one var to send to DB
                var location = newCity.concat("-");
                var location = location.concat(newState);
                jQuery.ajax({
                    type: "POST",
                    url: 'php/weatherapp.php',
                    data: {editLocation: true, user: globalUser, loc : location},
                    success: function (data) {
                      if (data != "0"){
                        console.log(data);
                        //keep track of user
                        globalUser = username;
                        //begin updating page with new location
                        document.getElementById('addLocForm').style.display='none';

                        //var subLocationList = document.getElementById('subLocationList');  
                        //var li = document.createElement("li");

                        //li.setAttribute("id", newCity+"-"+newState);
                        //subLocationList.appendChild(li);
                        document.getElementById('defaultLoc').innerHTML = "\<button onclick=\"getWeather('"+newCity+"','"+newState+"');\" class=\"btn btn-primary btn-large btn-block\">"+newCity+", "+newState+"\</button>";
                        //document.getElementById(newCity+'-'+newState).innerHTML = "\<button onclick=\"getWeather('"+newCity+"','"+newState+"');\" class=\"btn btn-primary btn-large btn-block\">"+newCity+", "+newState+"\</button>";
                      }else {
                        alert("Add location failed. Please try again.");
                      };
                    }
                });

            //Make sure error text is not being displayed
            if (document.getElementById('incorrectEntry').style.display = 'block') {
              document.getElementById('incorrectEntry').style.display = 'none';
            }
            //else, generate red text saying "invalid location"
          } else {
            document.getElementById('incorrectEntry').style.display = 'block';
          }
        }
      });
    });
  }