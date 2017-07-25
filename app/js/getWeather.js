  function getWeather(city, state) {
    jQuery(document).ready(function ($) {
      $.ajax({
        url: "http://api.wunderground.com/api/8bbe2bcb995d1e41/conditions/q/" + state + "/" + city + ".json",
        dataType: "jsonp",
        success: function (parsed_json) {
          if (parsed_json.hasOwnProperty('current_observation')) {
            //if(parsed_json['current_observation']['display_location']['full'] != ''){
            var location = parsed_json['current_observation']['display_location']['full'];
            var zip = parsed_json['current_observation']['display_location']['zip'];
            var weather = parsed_json['current_observation']['weather'];
            var temp_f = parsed_json['current_observation']['temp_f'];
            var wind_mph = parsed_json['current_observation']['wind_mph'];
            var wind_dir = parsed_json['current_observation']['wind_dir'];
            var relative_humidity = parsed_json['current_observation']['relative_humidity'];

            document.getElementById('location').innerHTML = location;
            document.getElementById('weather').innerHTML = weather;
            document.getElementById('temp_f').innerHTML = temp_f;
            document.getElementById('wind_mph').innerHTML = wind_mph;
            document.getElementById('wind_dir').innerHTML = wind_dir;
            document.getElementById('relative_humidity').innerHTML = relative_humidity;
            document.getElementById('weather-info').style.display = 'block';
            if (document.getElementById('alert').style.display = 'block') {
              document.getElementById('alert').style.display = 'none';
            }
          } else {
            document.getElementById('alert').style.display = 'block';
          }
        }
      });
    });
  }