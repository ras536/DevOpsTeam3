
QUnit.module('Login Tests');
QUnit.test( "login.js Test", function( assert ) {
  
  //call login function
  login();

  //assign variables to get display values
  var signInStuff = document.getElementById("signInStuff").style.display;
  var signOutBtn = document.getElementById("signOutBtn").style.display;
  var locationList = document.getElementById("locationList").style.display;
  var addLocation = document.getElementById("addLocation").style.display;

  //test to be sure the displays are correct
  assert.equal(signInStuff, "none");
  assert.equal(signOutBtn, "inline-block");
  assert.equal(locationList, "inline-block");
  assert.equal(addLocation, "inline-block");

});

QUnit.module('Signout Tests');
QUnit.test( "signout.js Test", function( assert ) {
  
  //call login function
  signout();

  //assign variables to get display values
  var signInStuff = document.getElementById("signInStuff").style.display;
  var signOutBtn = document.getElementById("signOutBtn").style.display;
  var locationList = document.getElementById("locationList").style.display;
  var addLocation = document.getElementById("addLocation").style.display;

  //test to be sure the displays are correct
  assert.equal(signInStuff, "inline-block");
  assert.equal(signOutBtn, "none");
  assert.equal(locationList, "none");
  assert.equal(addLocation, "none");

});

QUnit.module('Get Weather Tests');
QUnit.test( "getWeather.js Test with Bad Info", function( assert ) {
  
  //send bad city,state
  getWeather("notarealcity","notarealstate");
  assert.expect( 1 );
  var done = assert.async();

  setTimeout(function() {
    var alert = document.getElementById('alert').style.display;
    assert.equal(alert, "block", "Alert Shown");
    done();
  }, 500 );
});
QUnit.test( "getWeather.js Test with Good Info", function( assert ) {
  
  //send bad city,state
  getWeather("Starkville","MS");
  assert.expect( 2 );
  var done = assert.async(2);

  setTimeout(function() {
    var alert = document.getElementById('alert').style.display;
    assert.equal(alert, "none", "Alert Hidden");
    done();
  }, 500 );
  setTimeout(function() {
  var location = document.getElementById('location').innerHTML;
    assert.equal(location, "Starkville, MS", "Location Correct");
    done();
  }, 500 );
});