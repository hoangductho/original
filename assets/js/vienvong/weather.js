// Docs at http://simpleweatherjs.com

/* 
* Test Locations
* Austin lat/long: 30.2676,-97.74298
* Austin WOEID: 2357536
*/
$(document).ready(function() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      loadWeather(position.coords.latitude+','+position.coords.longitude); //load weather using your lat/lng coordinates
    }, defaultlocation );
  } else {
    defaultlocation(0);
  }
});

function defaultlocation(error) {
  loadWeather('Ha Noi',''); //@params location, woeid
}

function loadWeather(location, woeid) {
  $.simpleWeather({
    location: location,
    woeid: woeid,
    unit: 'c',
    success: function(weather) {
      html = '<h2><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'</h2>';
      html += '<ul><li> <i class="fa fa-tint"></i> '+weather.humidity+' %</li>';
      html += '<li><i class="fa fa-flag-checkered"></i> '+weather.wind.speed +" "+ weather.units.speed +'</li>';
      html += '<li><i class="fa fa-thermometer-full"></i> '+weather.alt.temp+'&deg;F</li>';
      html += '<li>'+weather.city+', '+weather.country+'</li></ul>';
      // html += '<li class="currently">'+weather.currently+'</li>';  
      
      $("#weather").html(html);
    },
    error: function(error) {
      $("#weather").html('<p>'+error+'</p>');
    }
  });
}
