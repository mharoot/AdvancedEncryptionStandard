
<?php
    /*  
        The following Test Harness illustrates server-side encryption and 
    decryption using the PHP AES script. Testing is simplified by temporarily 
    setting the nonce to 0, so that the ciphertext is constant for a given 
    plaintext. It provides fields to enter the password and plaintext message, 
    and then invokes itself to encrypt the plaintext and/or decrypt the ciphertext. 
    */
    require 'aes.class.php';     // AES PHP implementation
    require 'aesctr.class.php';  // AES Counter Mode implementation

    $timer = microtime(true);

    // initialise password & plaintext if not set in post array
    $pw = empty($_POST['pw']) ? 'L0ck it up saf3'              : $_POST['pw'];
    $pt = empty($_POST['pt']) ? 'pssst ... đon’t tell anyøne!' : $_POST['pt'];
    $cipher = empty($_POST['cipher']) ? '' : $_POST['cipher'];
    $plain  = empty($_POST['plain'])  ? '' : $_POST['plain'];

    // perform encryption/decryption as required
    $encr = empty($_POST['encr']) ? $cipher : AesCtr::encrypt($pt, $pw, 256);
    $decr = empty($_POST['decr']) ? $plain  : AesCtr::decrypt($cipher, $pw, 256);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>AES in PHP test harness</title>
</head>
<body>
<form method="post">
    <table>
        <tr>
            <td>Password:</td>
            <td><input type="text" name="pw" size="16" value="<?= $pw ?>"></td>
        </tr>
        <tr>
            <td>Plaintext:</td>
            <td><input type="text" name="pt" size="40" value="<?= htmlspecialchars($pt) ?>"></td>
        </tr>
        <tr>
            <td><button type="submit" name="encr" value="Encrypt it">Encrypt it</button></td>
            <td><input type="text" name="cipher" size="80" value="<?= $encr ?>"></td>
        </tr>
        <tr>
            <td><button type="submit" name="decr" value="Decrypt it">Decrypt it</button></td>
            <td><input type="text" name="plain" size="40" value="<?= htmlspecialchars($decr) ?>"></td>
        </tr>
    </table>
</form>
<p><?= round(microtime(true) - $timer, 3) ?>s</p>
</body>
</html>

<?php
/*
The following Test Harness illustrates a possible way of integrating JavaScript encoding with PHP decoding. 
Testing is simplified by temporarily setting the nonce to 0, so that the ciphertext is constant for a given plaintext.
The HTML file presents fields to enter the plaintext message. It uses the JavaScript version to encrypt the message client-side, 
and invokes the PHP file passing the ciphertext in the POST array. The PHP script then uses the PHP version to decrypt the 
ciphertext passed in the POST array and display it.

Of course, any real application would use a more sophisticated approach to password management!
*/
?>