<?php

class Curl{
  private $handle;
  private $username;
  private $password;

  public function __construct(){
    $this->username = "HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41";
    $this->password = "";
    $this->handle = curl_init();
  }

  public function getHttp($url){
    curl_setopt_array($this->handle,
      array(
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
        CURLOPT_USERPWD => $this->username . ":" . $this->password,
        // Enable the post response.
        // CURLOPT_POST       => true,
        // The data to transfer with the response.
        // CURLOPT_POSTFIELDS => $postData,
        CURLOPT_RETURNTRANSFER     => true,
      )
    );
    
    $data = curl_exec($this->handle); 
    if (curl_errno($this->handle)) {
      $error_msg = curl_error($this->handle);
    } 
    curl_close($this->handle);
    
    if (isset($error_msg)){
      return $error_msg;  
    }else{
      return $data;  
    }     
  } 

  public function postHttp($url, $post){
    curl_setopt_array($this->handle,
      array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => array('Content-Type: application/x-www-form-urlencoded'),
        CURLOPT_USERPWD => $this->username . ":" . $this->password,
        // Enable the post response.
        CURLOPT_POST       => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        // The data to transfer with the response.
        CURLOPT_POSTFIELDS => $post,
        CURLOPT_RETURNTRANSFER     => true,
        CURLOPT_FAILONERROR => true
      )
    );
     
    $data = curl_exec($this->handle);
    if (curl_errno($this->handle)) {
      $error_msg = curl_error($this->handle);
    } 
    curl_close($this->handle);
    
    if (isset($error_msg)){
      return $error_msg;  
    }else{
      return $data;  
    }     
    
  }
   
    
}
