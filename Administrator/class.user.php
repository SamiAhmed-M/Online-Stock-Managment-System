<?php

class user {
	
private $UserId;
private $FullNameName;
private $Mobile;
private $UserName;
private $Password;
private $Privilege;


  function Delete(){

	// Establish Database selection and connection
	include_once("eurekastock.php");
	//UserId sent from ManageUser.php
        $Id=$_GET['UserId'];
	// Specify the query to Delete Record
        $sql = "delete user.* from user where user.UserId='".$Id."' and user.UserId!=1";
	// execute query
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
        //if (mysqli_affected_rows($con)==0)
       
        if ($result)
	{
	//alert message
	echo '<script type="text/javascript">alert("User Record Deleted Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageUser.php");</script>';
	exit();
	
	}
	else
	{
	//alert message
	echo '<script type="text/javascript">alert("User Record NOT Deleted!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageUser.php");</script>';
	exit();

	}
       	
	// Close The Connection
	mysqli_close ($con);
		 
       }


   function Edit(){
	// Establish Database selection and connection
	include_once("eurekastock.php");
	
 	$UserId=mysqli_real_escape_string($con,$_POST['txtUserId']);
	$FullName=mysqli_real_escape_string($con,$_POST['txtFullName']);
	// Function 
	function checkSpecialTel($tel){
		//Checks for the usage of any of the special characters in the contact person telephone
	return preg_match('/[\'~`\!@#\$%\^\&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>\.\?\\\]/',$tel) ? TRUE : FALSE;
	}
	function checkLowerTel($tel){
		//Checks for at least one lower case letter in the contact person telephone
 	return preg_match('~[a-z]~', $tel) ? TRUE : FALSE;
	}
	function checkUpperTel($tel){
		//Checks for at least one upper case letter in the contact person telephone
 	return preg_match('~[A-Z]~', $tel) ? TRUE : FALSE;
	}
	if((checkSpecialTel($_POST['txtMobileNumber']) != FALSE ) || (checkLowerTel($_POST['txtMobileNumber']) != FALSE ) || (checkUpperTel($_POST['txtMobileNumber']) != FALSE ))
	    {
	    //alert message
	    echo '<script type="text/javascript">alert("Only , and numbers are allowed in telephone number registration!");</script>';
	    // HTTP redirect
	    echo '<script>window.location.replace("ManageUser.php");</script>';
	    exit();
            }
        else
            {
            //if the checks are ok i.e. no small or capital letter and no special characters except , in the telephone we assign the number to a variable
        $MobileNumber=mysqli_real_escape_string($con,$_POST['txtMobileNumber']);
            }
	$UserName=mysqli_real_escape_string($con,$_POST['txtUserName']);
	$Password=mysqli_real_escape_string($con,$_POST['txtPassword']);
	
	if ($_POST['txtPrivilege'] == "Administrator" || $_POST['txtPrivilege'] == "Account" || $_POST['txtPrivilege'] == "Sales")
	{
	$Privilege=mysqli_real_escape_string($con,$_POST['txtPrivilege']);
	}
	else
	{
	//alert message
	echo '<script type="text/javascript">alert("The User Privilege permitted for System User is one of Administrator, Account or Sales!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageUser.php");</script>';
	exit();
	}

	// Check for duplicate Full Name
	$sql = "select * from user where user.FullName='".$FullName."' and user.UserId != '".$UserId."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$records = mysqli_num_rows($result);
        if ($records==0)
        {

	// Specify the query to Update Record
	$sql1 = "Update user set user.FullName='".$FullName."',user.Mobile='".$MobileNumber."',user.UserName='".$UserName."',user.Password='".$Password."',user.Privilege='".$Privilege."' where user.UserId='".$UserId."' ";

	// Execute query
	mysqli_query($con,$sql1) or die(mysqli_error($con));
        }
	else
        {
        //alert message
	echo '<script type="text/javascript">alert("System User Full Name already exists!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageUser.php");</script>';
	exit();
        }
	// Close The Connection
	mysqli_close($con);
	
	//alert message
	echo '<script type="text/javascript">alert("User Record Updated Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageUser.php");</script>';
	exit();
	
	}


    function Register(){
	// Establish Database selection and connection
        include_once("eurekastock.php");
	
	$FullName=mysqli_real_escape_string($con,$_POST['txtFullName']);
	// Function 
	function checkSpecialTel($tel){
		//Checks for the usage of any of the special characters in the contact person telephone
	return preg_match('/[\'~`\!@#\$%\^\&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>\.\?\\\]/',$tel) ? TRUE : FALSE;
	}
	function checkLowerTel($tel){
		//Checks for at least one lower case letter in the contact person telephone
 	return preg_match('~[a-z]~', $tel) ? TRUE : FALSE;
	}
	function checkUpperTel($tel){
		//Checks for at least one upper case letter in the contact person telephone
 	return preg_match('~[A-Z]~', $tel) ? TRUE : FALSE;
	}
	if((checkSpecialTel($_POST['txtMobileNumber']) != FALSE ) || (checkLowerTel($_POST['txtMobileNumber']) != FALSE ) || (checkUpperTel($_POST['txtMobileNumber']) != FALSE ))
	    {
	    //alert message
	    echo '<script type="text/javascript">alert("Only , and numbers are allowed in telephone number registration!");</script>';
	    // HTTP redirect
	    echo '<script>window.location.replace("user.php");</script>';
	    exit();
            }
        else
            {
            //if the checks are ok i.e. no small or capital letter and no special characters except , in the telephone we assign the number to a variable
        $MobileNumber=mysqli_real_escape_string($con,$_POST['txtMobileNumber']);
            }
	$UserName=mysqli_real_escape_string($con,$_POST['txtUserName']);
	$Password=mysqli_real_escape_string($con,$_POST['txtPassword']);
	$RePassword=mysqli_real_escape_string($con,$_POST['txtRePassword']);
        if ($Password != $RePassword)
	{
	//alert message
	echo '<script type="text/javascript">alert("Password entry mismatch!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("user.php");</script>';
	exit();
	}
	$Privilege=mysqli_real_escape_string($con,$_POST['cmbPrivilege']);

	// Check for duplicate system user full name
	$sql = "select * from user where FullName='".$FullName."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$records = mysqli_num_rows($result);
        if ($records==0)
       {
        // Specify the query to Insert Record into user table
	$sql1 = "insert into user (FullName,Mobile,UserName,Password,Privilege) values('".$FullName."','".$MobileNumber."','".$UserName."','".$Password."','".$Privilege."')";
	// execute query
	mysqli_query($con,$sql1) or die(mysqli_error($con));
       }
	else
       {
	//alert message
	echo '<script type="text/javascript">alert("System User FullName already exists!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("user.php");</script>';
	exit();
       }
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("User Recorded Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("user.php");</script>';
	
	}

}

?>