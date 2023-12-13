/*
紀錄同一個地方發生的車禍數量
取小數點後4位才可以同時保持位置的精準度，又同時包含到同一個區域的所有事故。
如果取5位以上，可能在同一個路口發生的事故會當成多個不同地點。
*/

select count(*) as cnt, round(GPS經度,4) as lon,round(GPS緯度,4) as lat
from Location
group by lon,lat
order by cnt desc
limit 50;
