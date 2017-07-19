  function submitLocation() {
    city = document.getElementById("city").value;
    state = document.getElementById("state").value;
    getWeather(city,state);
  }