
<?php


	
	
        
        set_time_limit(0);
    

  session_start();

   $lessonselect = $_POST["code"];
   $lession_id=$_SESSION['array'];
     $cookie_file=$_SESSION['cookie'];
 $headers=$_SESSION['headers'];
    //print_r($lession_id);
    //print_r($lesson_id);

    $hello= explode(' ',$lessonselect);
    //echo $lessonselect;
    session_write_close();
   
    ob_end_clean();
    ob_implicit_flush(1);
        # code...
  
    for(;;)
    {
        for ($index = 0; $index < count($hello); $index++) 
        {
            echo $hello[$index];

            $url = 'http://jxgl.gdufs.edu.cn/jsxsd/xsxkkc/xxxkOper?jx0404id=' . $lession_id[$hello[$index]];
            //echo $url;
            //echo $url;


            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, 1);
            //curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding: gzip, deflate'));
            curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

            curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file); //使用上面获取的cookies
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            echo $response . "</br>";
            
            flush();
            
          }
     };
 



 
   

?>