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
    // query 1 區域總交通事故
    $query = "select 發生市區鄉鎮名稱, count(*) from Location where
    Location.發生市區鄉鎮名稱 = \"{$selectedRegion}\" group by 發生市區鄉鎮名稱 ;
    ";
    $result = $conn->query($query);
    while($row = mysqli_fetch_array($result)) {
        echo "{$row['發生市區鄉鎮名稱']}交通事故次數: {$row['count(*)']}<br>";
    }

    // query 2 平均事故處理用時
    $query = "SELECT Location.發生市區鄉鎮名稱,
    ROUND(AVG(
        ((Time.結束_事故排除_時間 / 10000) % 100) * 3600 +
        ((Time.結束_事故排除_時間 / 100) % 100) * 60 +
        (Time.結束_事故排除_時間 % 100) -
        ((Time.到場處理時間 / 10000) % 100) * 3600 -
        ((Time.到場處理時間 / 100) % 100) * 60 -
        (Time.到場處理時間 % 100)
    )) AS 平均處理時間
    FROM
        Time
    JOIN
        Location ON Time.事件編號 = Location.事件編號
    WHERE Location.發生市區鄉鎮名稱 = \"{$selectedRegion}\"
    GROUP BY
        Location.發生市區鄉鎮名稱;
    ";
    $result = $conn->query($query);
    while($row = mysqli_fetch_array($result)) {
        echo "{$row['發生市區鄉鎮名稱']}平均事故處理用時(S): {$row['平均處理時間']}<br>";
    }
    //query 3 死傷
    $query = "with temp as(
        select distinct d.死亡人數_24小時內,d.死亡人數_2_30日內,d.受傷人數, l.發生市區鄉鎮名稱, t.發生日期, t.到場處理時間
        from Deaths d 
        join Location as l on l.事件編號 = d.事件編號
        join Time as t on t.事件編號 = d.事件編號
    )
    SELECT
        發生市區鄉鎮名稱,
        SUM(死亡人數_24小時內) AS 事故後24小時內死亡人數,
        SUM(死亡人數_2_30日內+死亡人數_24小時內) AS 事故後30日內死亡人數,
        SUM(受傷人數) AS 總受傷人數,
        AVG(死亡人數_24小時內) AS 平均事故後24小時內死亡人數,
        AVG(死亡人數_2_30日內+死亡人數_24小時內) AS 平均事故後30日內死亡人數,
        AVG(受傷人數) AS 平均受傷人數
    from temp
    WHERE 發生市區鄉鎮名稱 = \"{$selectedRegion}\"
    GROUP BY 發生市區鄉鎮名稱;
    ";
    $result = $conn->query($query);
    while($row = mysqli_fetch_array($result)) {
        echo "事故後24小時內死亡人數: {$row['事故後24小時內死亡人數']}, 事故後30日內死亡人數: {$row['事故後30日內死亡人數']}<br>";
        echo "總受傷人數: {$row['總受傷人數']}, 平均事故後24小時內死亡人數: {$row['平均事故後24小時內死亡人數']}<br>";
    }
    //query 4 天候比例
    $query = "SELECT
    Location.發生市區鄉鎮名稱,
    ROUND(SUM(CASE WHEN Weather.天候名稱 = '晴' THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS 晴,
    ROUND(SUM(CASE WHEN Weather.天候名稱 = '暴雨' THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS 暴雨,
    ROUND(SUM(CASE WHEN Weather.天候名稱 = '陰' THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS 陰,
    ROUND(SUM(CASE WHEN Weather.天候名稱 = '雨' THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS 雨,
    ROUND(SUM(CASE WHEN Weather.天候名稱 = '霧或煙' THEN 1 ELSE 0 END) * 100.0 / COUNT(*), 2) AS  霧或煙
    FROM
        Location
    JOIN
        Weather ON Location.事件編號 = Weather.事件編號
    WHERE
        Location.發生市區鄉鎮名稱 = \"{$selectedRegion}\"
    GROUP BY
        Location.發生市區鄉鎮名稱
    ORDER BY
        Location.發生市區鄉鎮名稱;
    ";
    $result = $conn->query($query);
    while($row = mysqli_fetch_array($result)) {
        echo "晴: {$row['晴']} % 暴雨: {$row['暴雨']} % 陰: {$row['陰']} % 雨: {$row['雨']} % 霧或煙: {$row['霧或煙']}  %<br>";
    }