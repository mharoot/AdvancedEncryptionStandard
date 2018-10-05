<?php
//$key should have been previously generated in a cryptographically safe way, like openssl_random_pseudo_bytes
$plaintext = "message to be encrypted";
$timer = microtime(true);
$key = bin2hex(openssl_random_pseudo_bytes(16)); // feels faster than --> $key = bin2hex(random_bytes(16));
$cipher = "aes-256-gcm"; // aes-256-gcm  or aes-128-gcm or  aes-anything-gcm
if (in_array($cipher, openssl_get_cipher_methods()))
{
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
    //store $cipher, $iv, and $tag for decryption later
    $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);
    // echo "Key:       ".$key."</br>";
    echo "Original:  ".$original_plaintext."</br>";
    echo "Encrypted: ".$ciphertext."</br>";
    var_dump($key);
}

?>
<p><?= round(microtime(true) - $timer, 5) ?>s</p>

<?php var_dump(openssl_get_cipher_methods()); ?>