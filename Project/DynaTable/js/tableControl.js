var latData;
var lonData;
var lat;
var lon;
$( document ).ready(function() {

   getLocation();    
    // Getting clicked table element.
$("#resultTable").on("click", "tr", function() {  
    
    
    var cellValue = $(this).children(":first").text();
   
    getDataDb(cellValue);
})});
function getDataDb(cellValue){
    // Get 'addr', 'img_id', 'web'
$.get("/Project/DynaTable/script/canvasResult.php?q=" + cellValue , function(data){
    
    var splittedStr = data.split(" - ")
    canvasModify(splittedStr, cellValue);
})};


function canvasModify(data, name){(
    // Get keyword(s)
$.get("/Project/DynaTable/script/getKeywords.php?q=" + name  , function(keywords){

var $name = $('<div/>').attr('class','name');
var $addr = $('<div/>').attr('class','box');
var $web = $('<div/>').attr('class','box');
var $keywords = $('<div/>').attr('class','box');



    var headerText = $('<h1/>', {
    html:   name
});
  var headerText1 = $('<h3/>', {
    html:  data[0]
});

 var headerText2 = $('<h3/>', {
    html:  data[2]
});
  var content = $('<div/>', {
    html:  headerText
});
 var content1 = $('<div/>', {
    html:  headerText1
});
var content2 = $('<div/>', {
    html:  headerText2
});

var imgUrl = 'img/' + data[1] + '.jpg';
var getImg = '<img src="' + imgUrl + '">';
//console.log(data[3]);
fillDiv(content, content1, content2, getImg, data[3], data[4]);


}))}

function fillDiv(content, content1, content2, img, lat1, lon1){


if ($('#rightTab').is(':empty')){
if(content !== ""){
$('#rightTab').append(content, content1, content2, img);

getLocation();
 

}
}else{
$('#rightTab').empty();
$('#map').empty();
fillDiv(content, content1, content2, img, lat1, lon1);

}

lat = lat1;
lon = lon1;
    
};
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
};
function showPosition(position) {
    latData = position.coords.latitude;
    lonData = position.coords.longitude;
 
   initMap(lat, lon, latData, lonData);
    
};
 

       function initMap(lat, lon, latData, lonData) {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        // console.log(latData);
        var lat1 = parseFloat(lat) ;
          var lon1 = parseFloat(lon) ;
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: lat1, lng: lon1}
        });
        directionsDisplay.setMap(map);

        
          calculateAndDisplayRoute(directionsService, directionsDisplay, lat, latData, lon, lonData);
        
       
      }

      function calculateAndDisplayRoute(directionsService, directionsDisplay, lat, latData, lon, lonData) {
          var origin1 = new google.maps.LatLng(latData, lonData);
 var dest = new google.maps.LatLng(lat, lon);
         directionsService.route({
           
          origin:origin1,
          destination:dest,
          travelMode: 'TRANSIT'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            console.log('Directions request failed due to ' + status);
          }
        });
      }
