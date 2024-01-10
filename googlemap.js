// Initialize and add the map
// let map;

async function initMap() {
  // The location of Uluru
  var position = { lat: 24.9917, lng: 121.2990 };
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
//   const { AdvancedMarkerView } = await google.maps.importLibrary("marker");

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 12,
    center: position,
    mapTypeId: 'roadmap',
  });

  // The marker, positioned at Uluru
}

async function handleSelectChange(selectElement) {
  if (selectElement == null)
    return;
  var selectedText;
  var selectedValue;
  if (typeof selectElement == 'string'){
    selectedText = selectElement;
    selectedValue = selectElement;
    var dynamicDefaultValue = selectElement;
    var regionElement = document.getElementById("region");
    for (var i = 0; i < regionElement.options.length; i++) {
      if (regionElement.options[i].text === dynamicDefaultValue) {
          regionElement.options[i].selected = true;
          break;
      }
  }
  }else{
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    selectedText = selectedOption.text;
    selectedValue = selectedOption.value;
  }
  $.ajax({
    method: "POST",
    url: "re_query.php", 
    data: { region: selectedValue },
    success: function(response) {
        $("#sqlquery").html(response);
    }
  });
  var myLatlng;
  switch(selectedText){
      case '桃園區':
        myLatlng = new google.maps.LatLng(24.9917, 121.2990);
        break;
      case '中壢區':
        myLatlng = new google.maps.LatLng(24.9722, 121.2054);
        break;
      case '平鎮區':
        myLatlng = new google.maps.LatLng(24.9296, 121.2054);
        break;
      case '八德區':
        myLatlng = new google.maps.LatLng(24.9469, 121.2912);
        break;
      case '楊梅區':
        myLatlng = new google.maps.LatLng(24.9242, 121.1367);
        break;
      case '蘆竹區':
        myLatlng = new google.maps.LatLng(25.0784, 121.2970);
        break;
      case '大溪區':
        myLatlng = new google.maps.LatLng(24.8658, 121.2970);
        break;
      case '龜山區':
        myLatlng = new google.maps.LatLng(25.0199, 121.3656);
        break;
      case '大園區':
        myLatlng = new google.maps.LatLng(25.0493, 121.1939);
        break;
      case '觀音區':
        myLatlng = new google.maps.LatLng(25.0359, 121.1138);
        break;
      case '新屋區':
        myLatlng = new google.maps.LatLng(24.9827, 121.0679);
        break;
      case '龍潭區':
        myLatlng = new google.maps.LatLng(24.8445, 121.2054);
        break;
      case '復興區':
        myLatlng = new google.maps.LatLng(24.7091, 121.3770);
        break;
      default:
        console.log('yes');
        break;
  }
  var mapOptions = {
    zoom: 15,
    center: myLatlng,
    mapTypeId: 'roadmap'
  };
  var locations_length = 50;
  let locations = new Array(locations_length);
  $.ajax({
    url: "getMarker.php", 
    method: 'POST',
    dataType: 'json',
    data: { region: selectedValue },
    success: function(response) {
        // console.log(response);
        for (var i = 0; i < response.length; i++) {
          locations[i] = new Array("交通事故次數 : "+response[i].cnt, response[i].lon, response[i].lat, response[i].dsum);
          // console.log(response[i].cnt);
        }
      var map = new google.maps.Map(document.getElementById('map'),
      mapOptions);
      var marker, i;
      for (i=0;i<locations_length;i++){
        if (locations[i][3] == 0){
          marker = new google.maps.Marker({
              position: new google.maps.LatLng(locations[i][2], locations[i][1]),
              map: map,
              title: locations[i][0]
          });
        }else{
          const image ="https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][2], locations[i][1]),
            map: map,
            icon: image,
            title: locations[i][0]
          });
        }
          marker.addListener("click", function () {
              alert(this.title);
          });
      }
    },
    error: function(error) {
      console.error('Error:', error);
    }
  });
}
