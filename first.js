console.log("hello");<?php
if(isset($_POST['Logout']))
{
    session_destroy();
    header("location:adminlogin.php");

}

?>