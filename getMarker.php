<?php
    $username = "milkycat";
    $password = "111";
    $servername = "localhost";
    $dbname = "final";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //////////// connect to mysql
    $selectedRegion;
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["region"])) {
        $selectedRegion = $_POST["region"];
    } else {
        echo "請求失敗";
    }
    $query = "select count(*) as cnt, round(l.GPS經度,4) as lon,round(l.GPS緯度,4) as lat,sum(d.死亡人數_24小時內+d.死亡人數_2_30日內) as dsum
    from Location as l
    join Deaths as d on d.事件編號 = l.事件編號
    where l.發生市區鄉鎮名稱 = \"{$selectedRegion}\"
    group by lon, lat
    order by cnt desc
    limit 50; ";

    $result = $conn->query($query);   
    // echo $result;
    $dataArray = array();
    while ($row = $result->fetch_assoc()) {
        // 只取得 cnt、lon 和 lat 的值
        $cnt = $row['cnt'];
        $lon = $row['lon'];
        $lat = $row['lat'];
        $dsum = $row['dsum'];
        $dataArray[] = array('cnt' => $cnt, 'lon' => $lon, 'lat' => $lat, 'dsum' => $dsum);
    }
    // $mysqli->close();
    $jsonLocations = json_encode($dataArray, JSON_UNESCAPED_UNICODE);
    echo $jsonLocations;