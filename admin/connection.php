<?php
ob_start();
session_start();


// $db=mysqli_connect("localhost:3306","user_hotel","pass_hotel","db_hotel") or die(mysqli_error());
$db=mysqli_connect("localhost","root","","db_hotel") or die(mysqli_error($db));


function msg($a,$b)
{
echo "<script language='javascript'>alert('$a');window.location='$b';</script>";
}

function CompressImage($source_url, $destination_url, $quality) {

      $info = getimagesize($source_url);

          if ($info['mime'] == 'image/jpeg')
          $image = imagecreatefromjpeg($source_url);

          elseif ($info['mime'] == 'image/gif')
          $image = imagecreatefromgif($source_url);

          elseif ($info['mime'] == 'image/png')
          $image = imagecreatefrompng($source_url);
          elseif ($info['mime'] == 'image/webp')
          $image = imagecreatefromwebp($source_url);


          imagejpeg($image, $destination_url, $quality);
          return $destination_url;
        }
// Store a string into the variable which 
// need to be Encrypted 



function enc($simple_string)
{
//echo "Original String: " . $simple_string; 
  
// Store the cipher method 
$ciphering = "AES-128-CTR"; 
  
// Use OpenSSl Encryption method 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
  
// Non-NULL Initialization Vector for encryption 
$encryption_iv = '1234567891011121'; 
  
// Store the encryption key 
$encryption_key = "GeeksforGeeks"; 
  
// Use openssl_encrypt() function to encrypt the data 
$encryption = openssl_encrypt($simple_string, $ciphering, 
            $encryption_key, $options, $encryption_iv); 
return $encryption;
}

function dec($encryption)
{

  $decryption_iv = '1234567891011121'; 
  $ciphering = "AES-128-CTR"; 
  
// Use OpenSSl Encryption method 
$iv_length = openssl_cipher_iv_length($ciphering); 
$options = 0; 
  
// Store the decryption key 
$decryption_key = "GeeksforGeeks"; 
  
// Use openssl_decrypt() function to decrypt the data 
$decryption=openssl_decrypt ($encryption, $ciphering,  
        $decryption_key, $options, $decryption_iv); 
  
// Display the decrypted string 
return $decryption; 
}

 





?>