<?php
$apiKey = getenv('API_KEY');
?>
<!DOCTYPE html>
<html>
<head> 
    <title>Final Project</title>
    <style type="text/css">
            .container{
                height: 650px;
            }
            #map{
                width: 100%;
                height: 100%;
                border: 1px solid blue;
            }
        </style>
</head>
<body>
    <div class="container">
        <center><h1>Google Map </h1></center>
        <td>選擇地區</td>
        <td>
            <select onchange="handleSelectChange(this)">
                <option>桃園區</option>
                <option>中壢區</option>
                <option>平鎮區</option>
                <option>八德區</option>
                <option>楊梅區</option>
                <option>蘆竹區</option>
                <option>大溪區</option>
                <option>龜山區</option>
                <option>大園區</option>
                <option>觀音區</option>
                <option>新屋區</option>
                <option>龍潭區</option>
                <option>復興區</option>
            </select>
        </td>
        <div id="map"></div>
    </div>
</body>
<script type="text/javascript" src="googlemap.js"></script>
<script src="select.js"></script>
<script async>
    var apiKey = '<?php echo getenv("API_KEY"); ?>';
            
// Your original JavaScript code with the API key
    var script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=' + apiKey + '&libraries=geometry&callback=initMap';
    document.head.appendChild(script);
    
</script>
</html>
