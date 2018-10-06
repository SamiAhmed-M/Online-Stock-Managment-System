<?php

class quantity {
	
private $QFlagId;
private $MinimumQuantity;
private $MaximumQuantity;


  function Delete(){

	// Establish Database selection and connection
	include_once("eurekastock.php");
	//Id of QFlagId from ManageQuantity.php
        $Id=$_GET['QFlagId'];

	// Specify the query to Delete Record
        $sql = "delete quantityflag.* from quantityflag where quantityflag.QFlagId='".$Id."' ";
	// execute query
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
        //if (mysqli_affected_rows($con)==0)
    
        if ($result)
	{
	//alert message
	echo '<script type="text/javascript">alert("Quantity Limit Record Deleted Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageQuantity.php");</script>';
	exit();
	
	}
	else
	{
	//alert message
	echo '<script type="text/javascript">alert("Quantity Limit data can not be deleted!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageQuantity.php");</script>';
	exit();
	}
       	
	// Close The Connection
	mysqli_close ($con);
		
	}


   function Edit(){
	// Establish Database selection and connection
	include_once("eurekastock.php");
	
        $Id=mysqli_real_escape_string($con,$_POST['txtQuantityId']);
	$ItemDescription=mysqli_real_escape_string($con,$_POST['txtItemDescription']);
	$QMin=mysqli_real_escape_string($con,$_POST['txtMinQuantity']);
	if (!is_numeric($QMin))
	{
	//alert message
	echo '<script type="text/javascript">alert("Minimum Quantity Limit should be numeric!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageQuantity.php");</script>';
	exit();
	}
	if ($QMin < 0)
	{
	//alert message
	echo '<script type="text/javascript">alert("Minimum Quantity Limit can not be less than 0!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageQuantity.php");</script>';
	exit();
	}
	$QMax=mysqli_real_escape_string($con,$_POST['txtMaxQuantity']);
	if (!is_numeric($QMax))
	{
	//alert message
	echo '<script type="text/javascript">alert("Maximum Quantity Limit should be numeric!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageQuantity.php");</script>';
	exit();
	}
	if ($QMax < 0)
	{
	//alert message
	echo '<script type="text/javascript">alert("Maximum Quantity Limit can not be less than 0!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageQuantity.php");</script>';
	exit();
	}
	if ($QMax < $QMin)
	{
	//alert message
	echo '<script type="text/javascript">alert("Maximum Quantity Limit can not be less than Minimum Quantity Limit!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageQuantity.php");</script>';
	exit();
	}

	// Retrieve ItemId based on ItemDescription from item table
	$sql = "select * from item where GoodsDescription='".$ItemDescription."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$ItemId=$row['ItemId'];


	// Specify the query to Update Record
	$sql1 = "Update quantityflag set quantityflag.ItemId='".$ItemId."',quantityflag.MinimumQuantity='".$QMin."',quantityflag.MaximumQuantity='".$QMax."' where quantityflag.QFlagId='".$Id."' ";

	// Execute query
	mysqli_query($con,$sql1) or die(mysqli_error($con));
        
	// Close The Connection
	mysqli_close($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Quantity Limit Record Updated Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageQuantity.php");</script>';
	exit();
	
	}


    function Register(){
	// Establish Database selection and connection
        include_once("eurekastock.php");
	
	$ItemDescription=mysqli_real_escape_string($con,$_POST['cmbItem']);
        $QMin=mysqli_real_escape_string($con,$_POST['txtMinQuantity']);
	if (!is_numeric($QMin))
	{
	//alert message
	echo '<script type="text/javascript">alert("Minimum Quantity Limit should be numeric!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("quantity.php");</script>';
	exit();
	}
	if ($QMin < 0)
	{
	//alert message
	echo '<script type="text/javascript">alert("Minimum Quantity Limit can not be less than 0!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("quantity.php");</script>';
	exit();
	}
        $QMax=mysqli_real_escape_string($con,$_POST['txtMaxQuantity']);
	if (!is_numeric($QMax))
	{
	//alert message
	echo '<script type="text/javascript">alert("Maximum Quantity Limit should be numeric!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("quantity.php");</script>';
	exit();
	}
	if ($QMax < 0)
	{
	//alert message
	echo '<script type="text/javascript">alert("Maximum Quantity Limit can not be less than 0!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("quantity.php");</script>';
	exit();
	}
	if ($QMax < $QMin)
	{
	//alert message
	echo '<script type="text/javascript">alert("Maximum Quantity Limit can not be less than Minimum Quantity Limit!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("quantity.php");</script>';
	exit();
	}

	// Check for duplicate Quantity Limit registration for same item
	$sql = "select * from item where GoodsDescription='".$ItemDescription."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$ItemId=$row['ItemId'];

	$sql1 = "select * from quantityflag where ItemId='".$ItemId."'";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$records = mysqli_num_rows($result1);
        if ($records==0)
       {
        // Specify the query to Insert Record into quantityflag table
	$sql2 = "insert into quantityflag (ItemId,MinimumQuantity,MaximumQuantity) values('".$ItemId."','".$QMin."','".$QMax."')";
	// execute query
	mysqli_query($con,$sql2) or die(mysqli_error($con));
       }
	else
       {
	//alert message
	echo '<script type="text/javascript">alert("Quantity Limit is already set for the selected Item!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("quantity.php");</script>';
	exit();
       }
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Quantity Limit Recorded Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("quantity.php");</script>';
	
	}

}

?>