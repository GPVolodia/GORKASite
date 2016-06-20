<html>
<head>
<script type="text/javascript">
timeend = new Date(2016, 04, 31, 23,0);
function time() {
    today = new Date();
    today = Math.floor((timeend-today)/1000);
    tsec=today%60; today=Math.floor(today/60); if(tsec<10)tsec='0'+tsec;
    tmin=today%60; today=Math.floor(today/60); if(tmin<10)tmin='0'+tmin;
    thour=today%24; today=Math.floor(today/24);
    timestr=today +" дней "+ thour+" часов "+tmin+" минут "+tsec+" секунд";
    document.getElementById('time').innerHTML=timestr;
    window.setTimeout("time()",1000);
}
</script>
</head>
<body onload="time()">
	<h1>Countdown</h1>
	<b>Time to 31.05.2016 : </b>
	<span id="time"></span>
</body>
</html> 