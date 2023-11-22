<?php 

$con=new mysqli("localhost","root","","ambika");
if($con->connect_error)
{
	echo "Database Connection Failed";
}
?>