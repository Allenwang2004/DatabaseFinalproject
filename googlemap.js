// Initialize and add the map
let map;

async function initMap() {
  // The location of Uluru
  var position = { lat: 24.9917, lng: 121.2990 };
  // Request needed libraries.
  //@ts-ignore
  const { Map } = await google.maps.importLibrary("maps");
//   const { AdvancedMarkerView } = await google.maps.importLibrary("marker");

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 15,
    center: position,
    mapTypeId: 'roadmap',
  });

  // The marker, positioned at Uluru
  var my_pos = {lat: 25.011572, lng: 121.21478};
  const marker = new google.maps.Marker({
    map: map,
    position: my_pos,
    title: "Uluru",
  });
}
async function handleSelectChange(selectElement) {
  var selectedOption = selectElement.options[selectElement.selectedIndex];
  var selectedText = selectedOption.text;
  var selectedValue = selectedOption.value;
  console.log("Selected option text: " + selectedText);
  console.log("Selected option value: " + selectedValue);
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
  var map = new google.maps.Map(document.getElementById('map'),
    mapOptions);
  // var marker_pos = {lat: 125.209935, lng: 24.9601};
  // const marker = new google.maps.Marker({
  //   map: map,
  //   position: marker_pos,
  //   title: "traffic",
  // });
}
