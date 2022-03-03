// JavaScript Document

 function initialize() {
  var myLatlng = new google.maps.LatLng(37.53049711192905, 127.00040714215666);
  var myOptions = {
   zoom: 15,
   center: myLatlng

  }
  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
 
  var marker = new google.maps.Marker({
   position: myLatlng, 
   map: map, 
   title:"반디집"
  });   
  
 
  var infowindow = new google.maps.InfoWindow({
   content: "지비지비"
  });
 
  infowindow.open(map,marker);
 }
 
 
 window.onload=function(){
  initialize();
 }

