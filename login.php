<?php
//to avoid resending of header 
ob_start();
session_start();
// Establish Database selection and connection
include_once("eurekastock.php");

$UserName=mysqli_real_escape_string($con,$_POST['txtUser']);
$Password=mysqli_real_escape_string($con,$_POST['txtPass']);
$UserType=mysqli_real_escape_string($con,$_POST['cmbUser']);
if($UserType=="Administrator")
{
$sql = "select user.* from user where user.UserName='".$UserName."' and user.Password='".$Password."' and user.Privilege='Administrator'";
$result = mysqli_query($con,$sql);
$records = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
//Check for output using echo $Password; and it works plain cool
if ($records==0)
{
//alert message
echo '<script type="text/javascript">alert("Wrong UserName and / or Password!");</script>';
//redirect
echo '<script>window.location.replace("index.php");</script>';
exit();
}
else
{
$_SESSION['ID']=$row['UserId'];
$Fname=$row['FullName'];
//$FullName=$Fname . " " . $Mname;  
$_SESSION['Name']=$FullName;
header("location:Administrator/index.php");
} 
mysqli_close($con);
}
//End of Administrator Verification
if($UserType=="Account")
{
$sql = "select user.* from user where user.UserName='".$UserName."' and user.Password='".$Password."' and user.Privilege='Account'";
$result = mysqli_query($con,$sql);
$records = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($records==0)
{
//alert message
echo '<script type="text/javascript">alert("Wrong UserName and / or Password!");</script>';
//redirect
echo '<script>window.location.replace("index.php");</script>';
exit();
}
else
{
$_SESSION['ID']=$row['UserId'];
$Fname=$row['FullName'];
//$FullName=$Fname . " " . $Mname;  
$_SESSION['Name']=$FullName;
header("location:Account/index.php");
} 
mysqli_close($con);
}
// End of Account verification
else if($UserType=="Sales")
{
$sql = "select user.* from user where user.UserName='".$UserName."' and user.Password='".$Password."' and user.Privilege='Sales'";
$result = mysqli_query($con,$sql);
$records = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($records==0)
{
//alert message
echo '<script type="text/javascript">alert("Wrong UserName and / or Password!");</script>';
//redirect
echo '<script>window.location.replace("index.php");</script>';
exit();
}
else
{
$_SESSION['ID']=$row['UserId'];
$Fname=$row['FullName'];
//$FullName=$Fname . " " . $Mname;  
$_SESSION['Name']=$FullName;
header("location:Sales/index.php");
} 
mysqli_close($con);
}

?>