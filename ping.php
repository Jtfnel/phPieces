<?php

    /*
        @Author: Jtfnel
        @Version: 1.0.0
        @Description: pings a site and return if site is up or not
        @TODO: - None
    */

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
