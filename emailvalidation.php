<?php

    /*
        @Author: Jtfnel
        @Version: 1.0.1
        @Description: Validates email by check the parts and checking the domain
        @TODO: - None
    */

    function emailvalidate($email){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            if(testdomain($email)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function testdomain($email){
        $domain = substr($email,strpos($email,"@") + 1);
        $domain = "http://" . $domain . "/";
        if(pingsite($domain)){
            return true;
        }else{
            return false;
        }
    }

    function pingsite($domain){
        $test = curl_init($domain);
        $useragent = "Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201";
        curl_setopt($test, CURLOPT_USERAGENT, $useragent);
        curl_setopt($test, CURLOPT_RETURNTRANSFER, true);
        curl_exec($test);
        $httpcode = curl_getinfo($test, CURLINFO_HTTP_CODE);
        if((($httpcode >= 200) && ($httpcode < 400)) && !($httpcode == 308)){
            return true;
        }else{
            return false;
        }
        curl_close($test);
    }

?>
