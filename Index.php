<?php
$apiKey = getenv('API_KEY');
?>
<!DOCTYPE html>
<html>
<head> 
    <title>Final Project</title>
    <script type="text/javascript" src="googlemap.js"></script>
    <style type="text/css">
            .container{
                height: 700px;
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
        <div id="map"></div>
    </div>
</body>
<script async>
    var apiKey = '<?php echo getenv("API_KEY"); ?>';
            
// Your original JavaScript code with the API key
    var script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=' + apiKey + '&libraries=geometry&callback=initMap';
    document.head.appendChild(script);
    
</script>
</html>
