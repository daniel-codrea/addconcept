<?php
$to = "daniel.codrea@gmail.com";
$subject= "Formular www.addconcept.ro";
$todayis = date("l, F j, Y, g:i a") ;
$siName = $_POST['siName'];
$siEmail = $_POST['siEmail'];
$siMessage = $_POST['siMessage'];
$message = "
Data --------------- $todayis
Nume ------------ $siName
Email -------------- $siEmail
Mesaj -------------- $siMessage
";
$textbody = "
	Buna ziua $siName,

	Multumim pentru mesaj!
	Aceasta este o notificare automana care va instiinteaza ca mesajul trimis prin intermediul formularului de pe siteul www.addconcept.ro a fost trimis cu success.
	Vom raspunde in cel mai scurt timp posibil mesajului dumneavoastra.

	Cu respect,
	Echipa AddConcept
";

  $mime_boundary="==Multipart_Boundary_x".md5(mt_rand())."x";

	      $headers = "From: $siEmail\n" .
	      "MIME-Version: 1.0\n" .
	         "Content-Type: multipart/mixed;\n" .
	         " boundary=\"{$mime_boundary}\"";

	      $headersnew = "Content-Type: text/plain; charset=us-ascii\nFrom: $to <$to>\nReturn-Path: <$colaboratormail>\nX-Mailer: PHP";

	      $message = "This is a multi-part message in MIME format.\n\n" .
	         "--{$mime_boundary}\n" .
	         "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
	         "Content-Transfer-Encoding: 7bit\n\n" .
	      $message . "\n\n";


	      foreach($_FILES as $userfile)
	      {
	         $tmp_name = $userfile['tmp_name'];
	         $type = $userfile['type'];
	         $name = $userfile['name'];
	         $size = $userfile['size'];

	         if (file_exists($tmp_name))
	         {
	            if(is_uploaded_file($tmp_name))
	            {
	               $file = fopen($tmp_name,'rb');

	               $data = fread($file,filesize($tmp_name));

	               fclose($file);


	               $data = chunk_split(base64_encode($data));
	            }

	            $message .= "--{$mime_boundary}\n" .
	               "Content-Type: {$type};\n" .
	               " name=\"{$name}\"\n" .
	               "Content-Disposition: attachment;\n" .
	               " filename=\"{$fileatt_name}\"\n" .
	               "Content-Transfer-Encoding: base64\n\n" .
	            $data . "\n\n";

	         }
	      }

	      $message.="--{$mime_boundary}--\n";


if (mail($to, $subject, $message, $headers))
	{
?>
<script language="javascript" type="text/javascript">
<!--

	alert("Mesajul dumneavoastra a fost trimis cu succes!");

	document.location = "contact.html";
	//history.go(-1);

-->
</script>
<?
		}

	else
	{
?>
<script language="javascript" type="text/javascript">
<!--

	alert("Ne pare rau, mesajul dumneavoastra nu a putut fi trimis. Va rugam incercati din nou.");

	document.location = "contact.html";
	//history.go(-1);

-->
</script>
<?
	}
?>
