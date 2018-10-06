<?php

class customer {
	
private $CustomerId;
private $CustomerName;
private $ContactPersonName;
private $ContactPersonTel;


  function Delete(){

	// Establish Database selection and connection
	include_once("eurekastock.php");
	//Id of CustomerId from ManageCustomer.php
        $Id=$_GET['CustomerId'];

	// Specify the query to execute
	$sql = "select * from transaction WHERE transaction.CustomerId='".$Id."'";
	// Execute query
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	// Loop through each records 
	while($row = mysqli_fetch_array($result))
	{
	$TransactionId=$row['TransactionId'];

	// Specify the query to Delete Record from payment table as per the the transacation id above
        $sql1 = "delete payment.* from payment where payment.TransactionId='".$TransactionId."' ";
	// execute query
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));


	// Specify the query to Delete Record from sales table as per the the transacation id above
        $sql2 = "delete sales.* from sales where sales.TransactionId='".$TransactionId."' ";
	// execute query
	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));

	// Specify the query to Delete Record from transaction table as per the the transacation id above
	$sql3 = "delete transaction.* from transaction where transaction.TransactionId='".$TransactionId."' ";
	// execute query
	$result3 = mysqli_query($con,$sql3) or die(mysqli_error($con));

	}
	
	// Specify the query to Delete Record from customer table
        $sql4 = "delete customer.* from customer where customer.CustomerId='".$Id."' ";
	// execute query
	$result4 = mysqli_query($con,$sql4) or die(mysqli_error($con));
               
        	if ($result4)
		{
		//alert message
		echo '<script type="text/javascript">alert("Customer  record and related transaction, sales and payment records are deleted Successfully!");</script>';
		// HTTP redirect
		echo '<script>window.location.replace("ManageCustomer.php");</script>';
		exit();
		}
		else
		{
		//alert message
		echo '<script type="text/javascript">alert("Customer record not deleted!");</script>';
		// HTTP redirect
		echo '<script>window.location.replace("ManageCustomer.php");</script>';
		exit();
		}
	       	
	// Close The Connection
	mysqli_close ($con);
		
       }


   function Edit(){
	// Establish Database selection and connection
	include_once("eurekastock.php");
	
        $Id=mysqli_real_escape_string($con,$_POST['txtCustomerId']);
	$CustomerName=mysqli_real_escape_string($con,$_POST['txtCustomerName']);
	$ContactName=mysqli_real_escape_string($con,$_POST['txtContactPersonName']);
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
	if((checkSpecialTel($_POST['txtContactPersonTel']) != FALSE ) || (checkLowerTel($_POST['txtContactPersonTel']) != FALSE ) || (checkUpperTel($_POST['txtContactPersonTel']) != FALSE ))
	    {
	    //alert message
	    echo '<script type="text/javascript">alert("Only , and numbers are allowed in telephone number registration!");</script>';
	    // HTTP redirect
	    echo '<script>window.location.replace("ManageCustomer.php");</script>';
	    exit();
            }
        else
            {
            //if the checks are ok i.e. no small or capital letter and no special characters except , in the telephone we assign the number to a variable
        $ContactTel=mysqli_real_escape_string($con,$_POST['txtContactPersonTel']);
            }
	

	// Check for duplicate customer name
	$sql = "select * from customer where CustomerName='".$CustomerName."' and CustomerId != '".$Id."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$records = mysqli_num_rows($result);
        if ($records==0)
        {

	// Specify the query to Update Record
	$sql1 = "Update customer set customer.CustomerName='".$CustomerName."',customer.ContactPersonName='".$ContactName."',customer.ContactPersonTel='".$ContactTel."' where customer.CustomerId='".$Id."' ";

	// Execute query
	mysqli_query($con,$sql1) or die(mysqli_error($con));
        }
	else
        {
        //alert message
	echo '<script type="text/javascript">alert("Customer Name already exists!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageCustomer.php");</script>';
	exit();
        }
	// Close The Connection
	mysqli_close($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Customer Record Updated Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageCustomer.php");</script>';
	exit();
	
	}


    function Register(){
	// Establish Database selection and connection
        include_once("eurekastock.php");

	
	$CustomerName=mysqli_real_escape_string($con,$_POST['txtCustomer']);
	$ContactName=mysqli_real_escape_string($con,$_POST['txtContact']);
	
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
	if((checkSpecialTel($_POST['txtTel']) != FALSE ) || (checkLowerTel($_POST['txtTel']) != FALSE ) || (checkUpperTel($_POST['txtTel']) != FALSE ))
	    {
	    //alert message
	    echo '<script type="text/javascript">alert("Only , and numbers are allowed in telephone number registration!");</script>';
	    // HTTP redirect
	    echo '<script>window.location.replace("customer.php");</script>';
	    exit();
            }
        else
            {
            //if the checks are ok i.e. no small or capital letter and no special characters except , in the telephone we assign the number to a variable
        $ContactTel=mysqli_real_escape_string($con,$_POST['txtTel']);
            }
	
	// Check for duplicate customer name
	$sql = "select * from customer where CustomerName='".$CustomerName."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$records = mysqli_num_rows($result);
        if ($records==0)
       {
        // Specify the query to Insert Record into supplier table
	$sql1 = "insert into customer (CustomerName,ContactPersonName,ContactPersonTel) values('".$CustomerName."','".$ContactName."','".$ContactTel."')";
	// execute query
	mysqli_query($con,$sql1) or die(mysqli_error($con));
       }
	else
       {
	//alert message
	echo '<script type="text/javascript">alert("Customer Name already exists!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("customer.php");</script>';
	exit();
       }
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Customer Recorded Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("customer.php");</script>';
	
	}

}

?>