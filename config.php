<?php

$db = mysqli_connect('localhost','root','','rumah_sakit');
if(!$db){
    throw new Exception("Gagal terhubung dengan database", 1);
}

?>