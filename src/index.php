<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

</head>
<body>
<title>Title</title>
<form action="" name="postway" method="post">
    用户名: <input type="text" name="userid" />
    密码: <input type="text" name="password" />
    验证码: <input type="text" name="code" />
    

   
   <button onclick="wei()"/>院系选修登录</button>
    <button onclick="zhi()" />公选课登录 </button>

</form>

<script language="javascript" type="text/javascript">
    function wei(){
//        document.("表单的name值").action
//        document.("表单的name值").submit
       document.postway.action ="testlogin.php";
       document.input.type="sumit";
       document.postway.submit();
      window.location.href="testlogin.php";
    }
    function zhi() {
        document.postway.action ="publiclogin.php";
      document.input.type="sumit";
       document.postway.submit();
      
      window.location.href="publiclogin.php";
    }
</script>




</body>
</html>
<?php
date_default_timezone_set("PRC");


#$cookie_file2 = dirname(__FILE__).'/cookie2.txt';

session_start();
//$_SESSION['cookie']=$cookie_file;;
$cookie_file = dirname(__FILE__).'/cookie/'.strtotime(date ("Y-m-d h:i:s")).'cookie.txt';
$getlocal='/cookie/'.strtotime(date ("Y-m-d h:i:s")).'img.jpeg';
//echo $cookie_file;
$_SESSION['cookie']=$cookie_file;;
#echo $cookie_file;

$filename = dirname(__FILE__).'/cookie/'.strtotime(date ("Y-m-d h:i:s")).'img.jpeg';
$_SESSION['filename']=$filename;

//$_SESSION['filename']=$filename;;
//$cookie_file = tempnam("tmp","cookie");
//$IMGfile = dirname(__FILE__).'/cookie.JPG';
#$cookie_file = '$DOCUMENT_ROOT/cookie.txt';
#$filename = '$DOCUMENT_ROOT/img.jpeg';
//print_r($_POST);
//先获取cookies并保存;
session_write_close();
$url = "http://jxgl.gdufs.edu.cn/jsxsd/verifycode.servlet";
$headers = array();
$headers[] = "X-Apple-Tz: 0";
$headers[] = "X-Apple-Store-Front: 143444,12";
$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
$headers[] = "Accept-Encoding: gzip, deflate";
$headers[] = "Accept-Language: zh-CN,zh;q=0.8";
$headers[] = "Cache-Control: no-cache";
$headers[] = "Content-Type: application/x-www-form-urlencoded; charset=utf-8";
$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0";

$headers[] = "X-MicrosoftAjax: Delta=true";
$headers[] = "Connection: keep-alive";
$headers[] = "Host: jxgl.gdufs.edu.cn";
$headers[] = "Origin: http://jxgl.gdufs.edu.cn";

$ch = curl_init($url); //初始化
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0); //不返回header部分
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //返回字符串，而非直接输出
curl_setopt($ch, CURLOPT_COOKIEJAR,  $cookie_file); //存储cookies


$response=curl_exec($ch);

//preg_match('/Set-Cookie:(.*);/iU',$response,$str); //正则匹配

#//获得COOKIE（SESSIONID）
#header('Content-Type:image/jpeg;charset=UTF-8');
#echo $response;
#$img_data = ob_get_contents();


$fp2=@fopen($filename,'w');
fwrite($fp2,$response);
fclose($fp2);
echo '<img src= "'.$getlocal.'" />';

#curl_close($ch);



//使用上面保存的cookies再次访问
//$url = "http://www.baidu.com/s?wd=hello";
//$ch = curl_init($url);
//curl_setopt($ch, CURLOPT_HEADER, 0);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file); //使用上面获取的cookies
//curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//$response = curl_exec($ch);
//curl_close($ch);

//echo $response;
?>


