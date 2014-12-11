<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>   
<title></title> 
<style type="text/css">
#text{ margin:50px auto; width:500px; font-weight:bold; height:100px}
#text img{ float:left; border:0}
#text p{ float:left; width:366px; height:30px; line-height:30px; margin-top:33px}
a { color:#666; text-decoration: none; cursor:pointer; }
a:hover { text-decoration:underline; color:#f00; }
</style> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
<meta name="Author" content="PengRong" />   
</head>   
<body>   
  
<div id="text"><img src="/static/error/images/404.gif"/>
<p>访问页面不存在,<strong id="tt"></strong>后跳转至：<span id="link"></span></p></div>   
  
<script type="text/javascript">   
<!--   
var t = 5;//设置跳转时间：秒   
var url = "http://www.520.net";//设置跳转网址   
  
document.getElementById("link").innerHTML="<a href="+url+" title='520导航网站'>"+url+"</a>";   
function $(){   
ta = t-1;   
tb = t+"000";   
d = document.getElementById("tt");   
d.innerHTML=t;   
setInterval("go_to()",1000);   
}   
$();   
  
function go_to(){   
d.innerHTML=ta--;   
if(ta<0){     
location.href=url;   
}   
else{   
return;   
}   
}   
//-->   
</script>   
  
</body>   
</html>   