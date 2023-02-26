<?php



session_start();
$id =  $_SESSION['id'];

if($id==null){

    header('location:main.php');

}

$datatablelogin='login';
$dtPhoto='photo';
$dtfinalmark='finalmark';
$dtlogin='login';
$s = "select * from $dtlogin where id=$id ";
$r = mysqli_query($con,$s);
$v = mysqli_fetch_assoc($r);
$name=$v['name'];
$email= $v['email'];
$pass= $v['password'];
$type=$v['type'];
if($type=='Student')
{
    $roll=$v['roll'];

}

$phone=$v['phone'];


//


?>