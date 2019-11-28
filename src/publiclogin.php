<html lang="en">
<head>
    <meta charset="UTF-8">

</head>
<body>
<title>Title</title>
<form action="select.php" method="post">

    选课序号: <input type="text" name="code" />
    <input type="submit"  value="登录" name="submit">
</form>

</body>
</html>





<?php
/**
 * Created by PhpStorm.
 * User: sam
 * Date: 2017/6/13
 * Time: 下午4:42
 *
 */
//header("Content-Type:text/html;charset=utf-8");

session_start();


$user_id=$_POST["userid"];
$user_password=$_POST["password"];
$code = $_POST["code"];

#$cookie_file = dirname(__FILE__)."/cookie.txt";

$cookie_file = $_SESSION['cookie'];
$imagefile = $_SESSION['filename'];
$result = @unlink ($imagefile);


//echo $cookie_file."地址是这个";
$post_data = array("USERNAME" => $user_id,"PASSWORD" => $user_password,"PASSWORD" => $user_password,"RANDOMCODE"=>$code);

$post = "USERNAME=".$user_id."&PASSWORD=".$user_password."&RANDOMCODE=".$code;
$url = "http://jxgl.gdufs.edu.cn/jsxsd/xk/LoginToXkLdap";
//echo "hello";
#echo $url;
// $newcookie = file_get_contents($cookie_file);
// preg_match('/JSESSIONID\s(.*)/',$newcookie,$str);
//echo $str[1];


$headers = array();
$headers[] = "X-Apple-Tz: 0";
$headers[] = "X-Apple-Store-Front: 143444,12";
$headers[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
$headers[] = "Accept-Encoding: gzip, deflate";
$headers[] = "Accept-Language: zh-CN,zh;q=0.8";
#$headers[] = $mycookie;

$headers[] = "Cache-Control: no-cache";
$headers[] = "Content-Type: application/x-www-form-urlencoded; charset=utf-8";
$headers[] = "User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0";

$headers[] = "X-MicrosoftAjax: Delta=true";
$headers[] = "Connection: keep-alive";
$headers[] = "Host: jxgl.gdufs.edu.cn";
$headers[] = "Origin: http://jxgl.gdufs.edu.cn";


//USERNAME:20141002544
//PASSWORD:223918
//RANDOMCODE:xvbv
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file); //使用上面获取的cookies
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$response = curl_exec($ch);
#echo $response;
curl_close($ch);

$testurl = "http://jxgl.gdufs.edu.cn/jsxsd/xsxk/xsxk_index?jx0502zbid=BBAE8A1CF5C644608DB207B9E2C34BBA";

$ch = curl_init($testurl);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file); //使用上面获取的cookies
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
#curl_setopt($ch, CURLOPT_POST, 1);
#curl_setopt($ch, CURLOPT_POSTFIELDS, $newData);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$response = curl_exec($ch);
curl_close($ch);
//print_r($response);



$thirdurl="http://jxgl.gdufs.edu.cn/jsxsd/framework/main.jsp";

$lessonurl = "http://jxgl.gdufs.edu.cn/jsxsd/xsxkkc/xsxkGgxxkxk?kcxx=&skls=&skxq=&skjc=&sfym=false&sfct=false&szjylb=&szkclb=11";
$postdata = "sEcho=1&iColumns=1&sColumns=&iDisplayStart=0&iDisplayLength=100&mDataProp_0=kch&mDataProp_1=kcmc&mDataProp_2=xf&mDataProp_3=skls&mDataProp_4=sksj&mDataProp_5=skdd&mDataProp_6=xkrs&mDataProp_7=syrs&mDataProp_8=ctsm&mDataProp_9=szkcflmc&mDataProp_10=czOper";

$ch = curl_init($lessonurl);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file); //使用上面获取的cookies
curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$response = curl_exec($ch);
curl_close($ch);
$datas=json_decode($response,true);
//echo $response;
//print_r($response);
//$seconddata = $datas[3];
$i=0;
$lession_id =array();
foreach ($datas as $data) {
    foreach($datas['aaData'] as $aadata)
    {print_r($i." ".$aadata['kcmc']."   ".$aadata['skls']."     ".$aadata['sksj']);
        $lession_id[]=$aadata['jx0404id'];
        $i++;
        print_r("</br>");
    }
    break;

}

$_SESSION['headers']=$headers;
$_SESSION['array']=$lession_id;
session_write_close();


?>
