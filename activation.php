<?php

	/*
		@Author: Jtfnel
		@Version: 1.0.4
		@Description: It is used to generate a activation code for users that 
					  doesn't have to be stored into a database.
		@TODO: - Set the initialization vector parameter of openssl_encrypt()
			   - Set ENKEY to the date to force user to activate their account
			     the same day the got the activation email.
	*/

	//SETTINGS
	define("ENKEY", "<ENTER KEY HERE>");//Replace with a proper key.
	define("ENCIPHER", "AES-128-CBC");//openssl_get_cipher_methods() for a list of cyphers

	function genActivationCode($username,$password){
		$str = $username + $password;
		$str = md5($str);
		$str = openssl_encrypt($str, ENCIPHER, ENKEY);
		$str = substr($str,0,15);
		return $str;
	}

	function checkActivationCode($username,$password,$code){
		if(genActivationCode($username,$password) == $code){
			$valid = TRUE; 
		}else{
			$valid = FALSE;
		}	
		return $valid;
	}

?>