CREATE DATABASE traffic;
USE traffic;
CREATE TABLE AccidentCategory (
    事件編號 INT PRIMARY KEY,
    事故類型及型態大類別代碼 INT,
    事故類型及型態大類別名稱 VARCHAR(255),
    事故類型及型態子類別代碼 INT,
    事故類型及型態子類別名稱 VARCHAR(255),
    肇因研判大類別代碼_主要 INT,
    肇因研判大類別名稱_主要 VARCHAR(255),
    肇因研判子類別代碼_主要 INT,
    肇因研判子類別名稱_主要 VARCHAR(255)
);
CREATE TABLE Location (
    事件編號 INT PRIMARY KEY,
    GPS經度 DECIMAL(10, 6),
    GPS緯度 DECIMAL(10, 6),
    事故類別名稱 VARCHAR(255),
    地址類型名稱 VARCHAR(255),
    發生縣市名稱 VARCHAR(255),
    發生市區鄉鎮名稱 VARCHAR(255),
    發生地址_路街 VARCHAR(255),
    發生地址_號 VARCHAR(255),
    發生地址_側名稱 VARCHAR(255),
    發生交叉路口_村里名稱 VARCHAR(255),
    發生交叉路口_路街口 VARCHAR(255),
    發生交叉路口_巷 VARCHAR(255),
    發生地址_其他 VARCHAR(255)
);

CREATE TABLE Time (
    事件編號 INT PRIMARY KEY,
    發生日期 DATE,
    發生時間 INT,
    發生年度 INT,
    發生月份 INT,
    發生星期 VARCHAR(255),
    到場處理日期 DATE,
    到場處理時間 INT,
    結束_事故排除_日期 DATE,
    結束_事故排除_時間 INT
);

CREATE TABLE Deaths (
    事件編號 INT PRIMARY KEY,
    死亡人數_24小時內 INT,
    死亡人數_2_30日內 INT,
    受傷人數 INT
);

CREATE TABLE AccidentCondition (
    事件編號 INT PRIMARY KEY,
    道路第1當事者_代碼 INT,
    道路第1當事者_名稱 VARCHAR(255),
    速限_第1當事者 INT,
    道路型態大類別代碼 INT,
    道路型態大類別名稱 VARCHAR(255),
    道路型態子類別代碼 INT,
    道路型態子類別名稱 VARCHAR(255),
    事故位置大類別代碼 INT,
    事故位置大類別名稱 VARCHAR(255),
    路面狀況_路面鋪裝代碼 INT,
    路面狀況_路面鋪裝名稱 VARCHAR(255),
    路面狀況_路面狀態代碼 INT,
    路面狀況_路面狀態名稱 VARCHAR(255),
    路面狀況_路面缺陷代碼 INT,
    路面狀況_路面缺陷名稱 VARCHAR(255),
    道路障礙_障礙物代碼 INT,
    道路障礙_障礙物名稱 VARCHAR(255),
    道路障礙_視距品質代碼 INT,
    道路障礙_視距品質名稱 VARCHAR(255),
    道路障礙_視距代碼 INT,
    道路障礙_視距名稱 VARCHAR(255),
    號誌_號誌種類代碼 INT,
    號誌_號誌種類名稱 VARCHAR(255),
    號誌_號誌動作代碼 INT,
    號誌_號誌動作名稱 VARCHAR(255),
    車道劃分設施_分向設施大類別代碼 INT,
    車道劃分設施_分向設施大類別名稱 VARCHAR(255),
    車道劃分設施_分向設施子類別代碼 INT,
    車道劃分設施_分向設施子類別名稱 VARCHAR(255),
    車道劃分設施_快車道或一般車道間代碼 INT,
    車道劃分設施_快車道或一般車道間名稱 VARCHAR(255),
    車道劃分設施_快慢車道間代碼 INT,
    車道劃分設施_快慢車道間名稱 VARCHAR(255),
    車道劃分設施_路面邊線代碼 INT
);

CREATE TABLE Camera (
    事件編號 INT PRIMARY KEY,
    address VARCHAR(255),
    camera_direction VARCHAR(255),
    Haya_gen INT,
    GPS緯度 DECIMAL(10, 7),
    GPS經度 DECIMAL(10, 7)
);

CREATE TABLE Weather (
    事件編號 INT PRIMARY KEY,
    天候代碼 INT,
    天候名稱 VARCHAR(255),
    光線代碼 INT,
    光線名稱 VARCHAR(255)
);

CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comments (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    comment_text text NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    users_id INT(11) ,
    FOREIGN KEY(users_id) REFERENCES users(id) ON DELETE SET NULL
);


LOAD DATA LOCAL INFILE '/mnt/c/Users/User/OneDrive/桌面/資料庫/Traffic/交通事故的地點資訊.csv'
INTO TABLE Location
CHARACTER SET UTF8
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
ignore 1 lines;

LOAD DATA LOCAL INFILE '/mnt/c/Users/User/OneDrive/桌面/資料庫/Traffic/交通事故的死傷資訊.csv'
INTO TABLE Deaths
CHARACTER SET UTF8
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
ignore 1 lines;

LOAD DATA LOCAL INFILE '/mnt/c/Users/User/OneDrive/桌面/資料庫/Traffic/交通事故的事故類別資訊.csv'
INTO TABLE AccidentCategory
CHARACTER SET UTF8
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
ignore 1 lines;

LOAD DATA LOCAL INFILE '/mnt/c/Users/User/OneDrive/桌面/資料庫/Traffic/交通事故的時間資訊.csv'
INTO TABLE Time
CHARACTER SET UTF8
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
ignore 1 lines;

LOAD DATA LOCAL INFILE '/mnt/c/Users/User/OneDrive/桌面/資料庫/Traffic/交通事故的氣候資訊.csv'
INTO TABLE Weather
CHARACTER SET UTF8
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
ignore 1 lines;

LOAD DATA LOCAL INFILE '/mnt/c/Users/User/OneDrive/桌面/資料庫/Traffic/交通事故的路況資訊.csv'
INTO TABLE AccidentCondition
CHARACTER SET UTF8
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
ignore 1 lines;

LOAD DATA LOCAL INFILE '/mnt/c/Users/User/OneDrive/桌面/資料庫/Traffic/測速照相資訊.csv'
INTO TABLE Camera
CHARACTER SET UTF8
FIELDS TERMINATED BY ','
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
ignore 1 lines;




