<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>AES JavaScript+PHP test harness (client-side encrypt)</title>
<script src="aes.js">/* AES JavaScript implementation */</script>
<script src="aes-ctr.js">/* AES Counter Mode implementation */</script>
<script src="base64.js">/* Base64 encoding */</script>
<script src="utf8.js">/* UTF-8 encoding */</script>
</head>
<body>
<!-- encrypt the message before submitting the form -->
<form name="frm" id="frm" method="post"
      onsubmit="frm.message.value = Aes.Ctr.encrypt(frm.message.value, 'L0ck it up saf3', 256);">
  <p>Message: <input type="text" name="message" id="message" size="40" value=""></p>
  <p><input type="submit" value="Encrypt it:"></p>
</form>
</body>
</html>


<script>
    var password = 'L0ck it up saf3';
    var plaintext = 'pssst ... đon’t tell anyøne!';
    var ciphertext = AesCtr.encrypt(plaintext, password, 256);
    var origtext = AesCtr.decrypt(ciphertext, password, 256);

    console.log(ciphertext);
    console.log(origtext);
</script>