<?php
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] === False)
{
   $_SESSION["logged_in"] = False;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <!-- Bootstrap Core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Custom CSS -->
	<link href="css/custom.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">
	
	<title>SW-DevOps Weather App</title>
</head>


<body>
	<div class="bg-blue">
		<section id="header">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center ">
						<h1>SW-DevOps Weather App</h1>
					</div>
				</div>
			</div>
		</section>
	</div>

    <div class="container">
        <div class="form">
            <div class="form-screen">
                <div>
                    <h1 class="app-title">Location</h1>
                </div>
                <div class="form-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="control-group">
                                <input type="text" class="form-field" value="" placeholder="city" id="city">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="control-group">
                                <select type="text" class="form-field" id="state">
                                    <option selected="selected">state</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                </select>	
                            </div>
                        </div>
                    </div>
                    <div class="alert" id="alert" style="display:none">
                        Not a valid location.
                    </div>
                    <div class="row">
                        <a class="btn btn-primary btn-large btn-block" id="submitButton" onclick="getWeather();">Go!</a>
                    </div>
                </div>
            </div>
        </div>
	</div>

    <div class="container" id="weather-info" style="display:none">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class="weather-text">Here's the weather for&nbsp;</h2>
                <h2 class="weather-text" id="location"></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center">
                <h4 class="weather-text" id="weather"></h4>
                <h4 class="weather-text"> and </h4>
                <h4 class="weather-text" id="temp_f"></h4>
                <h4 class="weather-text"> degrees fahrenheit.</h4>
            </div>
            <div class="col-med-6 text-center">
                <h4 class="weather-text">Wind conditions: </h4>
                <h4 class="weather-text" id="wind_mph"></h4>
                <h4 class="weather-text"> mph, </h4>
                <h4 class="weather-text" id="wind_dir"></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center" >
                <h4 class="weather-text">Relative Humidity: </h4>
                <h4 class="weather-text" id="relative_humidity"></h4>
            </div>
        </div>
    </div>
	

	


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    <script>
    function getWeather() {
        var city = document.getElementById('city').value
        var state = document.getElementById('state').value
        jQuery(document).ready(function($) {
            $.ajax({
                url : "http://api.wunderground.com/api/8bbe2bcb995d1e41/conditions/q/"+state+"/"+city+".json",
                dataType : "jsonp",
                success : function(parsed_json) {
                    if(parsed_json.hasOwnProperty('current_observation')){
                    //if(parsed_json['current_observation']['display_location']['full'] != ''){
                        var location = parsed_json['current_observation']['display_location']['full'];
                        var zip = parsed_json['current_observation']['display_location']['zip'];
                        var weather = parsed_json['current_observation']['weather'];
                        var temp_f = parsed_json['current_observation']['temp_f'];
                        var wind_mph = parsed_json['current_observation']['wind_mph'];
                        var wind_dir = parsed_json['current_observation']['wind_dir'];
                        var relative_humidity = parsed_json['current_observation']['relative_humidity'];
                        
                        document.getElementById('location').innerHTML = location;
                        //document.getElementById('zip').innerHTML = zip;
                        document.getElementById('weather').innerHTML = weather;
                        document.getElementById('temp_f').innerHTML = temp_f;
                        document.getElementById('wind_mph').innerHTML = wind_mph;
                        document.getElementById('wind_dir').innerHTML = wind_dir;
                        document.getElementById('relative_humidity').innerHTML = relative_humidity;

                        document.getElementById('weather-info').style.display = 'block';
                        if(document.getElementById('alert').style.display = 'block'){
                            document.getElementById('alert').style.display = 'none';
                        }
                    }else{
                        document.getElementById('alert').style.display = 'block';
                    }

                }
            });
        });
    }

    $(document).keypress(function(e){
		if (e.which == 13){
			$("#submitButton").click();
		}
	});
    </script>

</body>

	
</html>