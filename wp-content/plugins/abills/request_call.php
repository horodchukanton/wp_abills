<?php
/**
 * Created by PhpStorm.
 * User: Anykey
 * Date: 19.07.2016
 * Time: 22:45
 */

require_once('/var/www/wordpress/wp-load.php');



    $abills_billing_url    = get_option('abills_billing_url');
    $api_key    = get_option('abills_api_key');
    if(!empty($_POST['phone'])){
        $phone =  $_POST['phone'];
        #$today = date("Y-m-d G:i:s");

        // curl_setopt($curl,CURLOPT_URL, "$abills_billing_url/admin/index.cgi");
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER , 0);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, "get_index=wordpress_to_msgs&xml=1&API_KEY=$api_key&header=1&PHONE=$phone&REQUEST_CALL=1");
        // $out = curl_exec($curl);
        // curl_close($curl);
        $url    = "$abills_billing_url/admin/index.cgi";
        $params = "get_index=wordpress_to_msgs&xml=1&API_KEY=$api_key&header=1&PHONE=$phone&REQUEST_CALL=1";

        $result = curl_to_msgs($url, $params);


        if(strcasecmp($result, 'success') == 0){
            print 'success';
        }
        return 1;
    }

    print '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>';

    if(!empty($_POST['REQUEST_MSG'])){

        $email = $_POST['EMAIL'];
        $message = $_POST['MESSAGE'];
        // curl_setopt($curl,CURLOPT_URL, "$abills_billing_url/admin/index.cgi");
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER , 0);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, "get_index=wordpress_to_msgs&xml=1&API_KEY=$api_key&header=1&MESSAGE=$message&EMAIL=$email&REQUEST_MSG=1");
        // $out = curl_exec($curl);
        // curl_close($curl);

        // $result = new SimpleXMLElement($out);

        $url    = "$abills_billing_url/admin/index.cgi";
        $params = "get_index=wordpress_to_msgs&xml=1&API_KEY=$api_key&header=1&MESSAGE=$message&EMAIL=$email&REQUEST_MSG=1";

        $result = curl_to_msgs($url, $params);

        if(strcasecmp($result, 'success') == 0){
            echo "<div class='container'>";
            echo "<div class='row'>";
            echo "<div class='alert alert-success' role='alert'>";
            echo "<h3>Вы будете перенаправлены на главную страницу сайта через 5 секунд.</h3><br>";
            echo "Если этого не произошло, нажмите ";
            echo "<a href=$_SERVER[HTTP_REFERER]>здесь</a>";
            echo "</div></div></div>";
            header("Refresh:5; URL=$_SERVER[HTTP_REFERER]");
        }
    }

    if(isset($_POST['confirm'])){

      $abills_billing_url    = get_option('abills_billing_url');
      $api_key               = get_option('abills_api_key');
      $fio = $_POST['FIO'];
      $phone = $_POST['PHONE'];
      $address = $_POST['ADDRESS'];
      $date = $_POST['DATE'];


        // curl_setopt($curl,CURLOPT_URL, "$abills_billing_url/admin/index.cgi");
        // curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER , 0);
        // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        // curl_setopt($curl, CURLOPT_POST, true);
        // curl_setopt($curl, CURLOPT_POSTFIELDS, "get_index=wordpress_to_msgs&xml=1&API_KEY=$api_key&header=1&FIO=$fio&PHONE=$phone&ADDRESS=$address&DATE=$date&REGISTRATION=1&language=russian");
        // $out = curl_exec($curl);
        // curl_close($curl);

        // $result = new SimpleXMLElement($out);

      $url    = "$abills_billing_url/admin/index.cgi";
        $params = "get_index=wordpress_to_msgs&xml=1&API_KEY=$api_key&header=1&FIO=$fio&PHONE=$phone&ADDRESS=$address&DATE=$date&REGISTRATION=1&language=russian";

        $result = curl_to_msgs($url, $params);

        if(strcasecmp($result, 'success') == 0){
          echo "<div class='container'>";
          echo "<div class='row'>";
          echo "<div class='alert alert-success' role='alert'>";
          echo "<h3>Заявка на регистрацию успешно отправлена.</h3><br>";
          echo "<h3>Вы будете перенаправлены на главную страницу сайта через 5 секунд.</h3><br>";
          echo "Если этого не произошло, нажмите ";
          echo "<a href='$_SERVER[HTTP_REFERER]'>здесь</a>";
          echo "</div></div></div>";

          header("Refresh:5; URL='/'");
          return 1;
        }
      }
      


?>