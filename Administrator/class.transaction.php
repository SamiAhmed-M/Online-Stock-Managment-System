<?php

class transaction {
	
private $TransactionId;
private $CustomerId;
private $TransactionDate;
private $InvoiceNo;
private $InvoiceAmount;
private $SalesMode;
private $DueDate;
private $TransactionName;


  function Delete(){

	// Establish Database selection and connection
	include_once("eurekastock.php");
	//TransactionId sent from ManageTransaction.php
        $Id=$_GET['TransactionId'];
	$Flag=0;
	$Flag1=0;

	// Specify the query to Delete Record from sales table in relation to Transaction to be deleted
        $sql = "delete sales.* from sales where sales.TransactionId='".$Id."' ";
	// execute query
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	if($result)
	  {
	  $Flag=1;
	  }
	else
	  {
	   //alert message
	  echo '<script type="text/javascript">alert("Sales record in relation to the selected transaction is not deleted!");</script>';
	  // HTTP redirect
	  echo '<script>window.location.replace("ManageTransaction.php");</script>';
	  exit();
	  }
	
	// Specify the query to Delete Record from payment table in relation to Transaction to be deleted
        $sql1 = "delete payment.* from payment where payment.TransactionId='".$Id."' ";
	// execute query
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	if($result1)
	  {
	  $Flag1=1;
	  }
	else
	  {
	   //alert message
	  echo '<script type="text/javascript">alert("Payment record in relation to the selected transaction is not deleted!");</script>';
	  // HTTP redirect
	  echo '<script>window.location.replace("ManageTransaction.php");</script>';
	  exit();
	  }

	// Specify the query to Delete transaction Record based on the transaction Id above
        $sql2 = "delete transaction.* from transaction where transaction.TransactionId='".$Id."' ";
	// execute query
	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
        //if (mysqli_affected_rows($con)==0)
       
        if ($result2 && $Flag==1 && $Flag1==1)
	{
	//alert message
	echo '<script type="text/javascript">alert("Transaction with all related sales and payment Records Deleted Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageTransaction.php");</script>';
	exit();
	
	}
	else
	{
	  //alert message
	  echo '<script type="text/javascript">alert("Transaction with all related sales and payment Records NOT deleted!");</script>';
	  // HTTP redirect
	  echo '<script>window.location.replace("ManageItem.php");</script>';
	  exit();
	}
       	
	// Close The Connection
	mysqli_close ($con);
		 
       }


   function Edit(){
	// Establish Database selection and connection
	include_once("eurekastock.php");

	// Functions
	function checkSpecialInv($inv){
		//Checks for the usage of any of the special characters in the invoice number
	return preg_match('/[\'~`\!@#\$%\^\&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',$inv) ? TRUE : FALSE;
	}
	function checkLowerInv($inv){
		//Checks for at least one lower case letter in the invoice number
 	return preg_match('~[a-z]~', $inv) ? TRUE : FALSE;
	}
	function checkUpperInv($inv){
		//Checks for at least one upper case letter in the invoice number
 	return preg_match('~[A-Z]~', $inv) ? TRUE : FALSE;
	}
	
	$TransactionId=mysqli_real_escape_string($con,$_POST['txtTransactionId']);
        //$TransactionName=mysqli_real_escape_string($con,$_POST['txtTransactionName']);
	$CustomerName=mysqli_real_escape_string($con,$_POST['txtCustomerName']);
	if ($_POST['txtSalesMode'] == "Credit" || $_POST['txtSalesMode'] == "Cash")
	   {
	$SalesMode=mysqli_real_escape_string($con,$_POST['txtSalesMode']);
	   }
	else
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Our accepted mode of transaction is either Cash basis or Credit basis!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManageTransaction.php");</script>';
	   exit();
	   }
	$TransactionDate=mysqli_real_escape_string($con,$_POST['txtTransactionDate']);
	$DueDate=mysqli_real_escape_string($con,$_POST['txtDueDate']);
	   if ($TransactionDate > $DueDate)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Wrong date sequence! Due Date is prior to Sales Date.");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManageTransaction.php");</script>';
	   exit();
	   }
	if ($SalesMode == "Cash" && $TransactionDate != $DueDate)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("During Cash Sales Transaction, the Transaction Date and the Due Date has to be the same!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManageTransaction.php");</script>';
	   exit();
	   }
        $InvoiceAmount=mysqli_real_escape_string($con,$_POST['txtInvoiceAmount']);
	   if (!is_numeric($InvoiceAmount))
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("InvoiceAmount value should be numeric!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManageTransaction.php");</script>';
	   exit();
	   }
	   if ($InvoiceAmount < 0)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Invoice Amount value can not be less than 0!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManageTransaction.php");</script>';
	   exit();
	   }
        
	// Trim all non digit characters from invoice number
	if((checkSpecialInv($_POST['txtInvoiceNo']) != FALSE ) || (checkLowerInv($_POST['txtInvoiceNo']) != FALSE ) || (checkUpperInv($_POST['txtInvoiceNo']) != FALSE ))
	    {
	    //alert message
	    echo '<script type="text/javascript">alert("Only digits are allowed in invoice number registration!");</script>';
	    // HTTP redirect
	    echo '<script>window.location.replace("ManageTransaction.php");</script>';
	    exit();
            }
        else
            {
            //if the checks are ok i.e. no small or capital letter and no special characters in the invoice number assign to a variable
        $InvoiceNo=mysqli_real_escape_string($con,$_POST['txtInvoiceNo']);
            }
        
	$TransactionName=$CustomerName . " " . $TransactionDate . " Inv. No. " . $InvoiceNo;
	
	// Retrieve CustomerId based on selected Customer Name
	$sql = "select * from customer where CustomerName='".$CustomerName."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$CustomerId=$row['CustomerId'];

	// Check for duplicate transaction name ... check all records except the one being updated
	$sql1 = "select * from transaction where TransactionName='".$TransactionName."' and TransactionId != '".$TransactionId."' ";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$records = mysqli_num_rows($result1);
        if ($records==0)
       {
	// Specify the query to Update Record
	$sql2 = "Update transaction set transaction.CustomerId='".$CustomerId."',transaction.TransactionDate='".$TransactionDate."',transaction.InvoiceNo='".$InvoiceNo."',transaction.InvoiceAmount='".$InvoiceAmount."',transaction.SalesMode='".$SalesMode."',transaction.DueDate='".$DueDate."',transaction.TransactionName='".$TransactionName."' where transaction.TransactionId='".$TransactionId."' ";

	// Execute query
	mysqli_query($con,$sql2) or die(mysqli_error($con));
       }
	else
       {
	//alert message
	echo '<script type="text/javascript">alert("Record of transaction for same customer on same date with same invoice number is already available!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("transaction.php");</script>';
	exit();
       }
       
	// Close The Connection
	mysqli_close($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Transaction Record Updated Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageTransaction.php");</script>';
	exit();
	
	}


    function Register(){
	// Establish Database selection and connection
        include_once("eurekastock.php");

	// Functions
	function checkSpecialInv($inv){
		//Checks for the usage of any of the special characters in the invoice number
	return preg_match('/[\'~`\!@#\$%\^\&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/',$inv) ? TRUE : FALSE;
	}
	function checkLowerInv($inv){
		//Checks for at least one lower case letter in the invoice number
 	return preg_match('~[a-z]~', $inv) ? TRUE : FALSE;
	}
	function checkUpperInv($inv){
		//Checks for at least one upper case letter in the invoice number
 	return preg_match('~[A-Z]~', $inv) ? TRUE : FALSE;
	}
	
	$CustomerName=mysqli_real_escape_string($con,$_POST['cmbCustomer']);
	$SalesMode=mysqli_real_escape_string($con,$_POST['cmbSalesMode']);
	$TransactionDate=mysqli_real_escape_string($con,$_POST['txtTransactionDate']);
	$DueDate=mysqli_real_escape_string($con,$_POST['txtDueDate']);
	   if ($TransactionDate > $DueDate)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Wrong date sequence! Due Date is prior to Sales Date.");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("transaction.php");</script>';
	   exit();
	   }
	if ($SalesMode == "Cash" && $TransactionDate != $DueDate)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("During Cash Sales Transaction, the Transaction Date and the Due Date has to be the same!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("transaction.php");</script>';
	   exit();
	   }
        $InvoiceAmount=mysqli_real_escape_string($con,$_POST['txtInvoiceAmount']);
	   if (!is_numeric($InvoiceAmount))
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Invoice Amount value should be numeric!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("transaction.php");</script>';
	   exit();
	   }
	   if ($InvoiceAmount < 0)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Invoice Amount value can not be less than 0!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("transaction.php");</script>';
	   exit();
	   }

        // Trim all non digit characters from invoice number
	if((checkSpecialInv($_POST['txtInvoice']) != FALSE ) || (checkLowerInv($_POST['txtInvoice']) != FALSE ) || (checkUpperInv($_POST['txtInvoice']) != FALSE ))
	    {
	    //alert message
	    echo '<script type="text/javascript">alert("Only digits are allowed in invoice number registration!");</script>';
	    // HTTP redirect
	    echo '<script>window.location.replace("transaction.php");</script>';
	    exit();
            }
        else
            {
            //if the checks are ok i.e. no small or capital letter and no special characters in the invoice number assign to a variable
        $InvoiceNo=mysqli_real_escape_string($con,$_POST['txtInvoice']);
            }

	$TransactionName=$CustomerName . " " . $TransactionDate . " Inv. No. " . $InvoiceNo;

	// Retrieve CustomerId based on selected Customer Name
	$sql = "select * from customer where CustomerName='".$CustomerName."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$CustomerId=$row['CustomerId'];

	// Check for duplicate transaction name
	$sql1 = "select * from transaction where TransactionName='".$TransactionName."'";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$records = mysqli_num_rows($result1);
        if ($records==0)
       {
        // Specify the query to Insert Record into sales table
	$sql2 = "insert into transaction (CustomerId,TransactionDate,InvoiceNo,InvoiceAmount,SalesMode,DueDate,TransactionName) values('".$CustomerId."','".$TransactionDate."','".$InvoiceNo."','".$InvoiceAmount."','".$SalesMode."','".$DueDate."','".$TransactionName."')";
	// execute query
	mysqli_query($con,$sql2) or die(mysqli_error($con));
       }
	else
       {
	//alert message
	echo '<script type="text/javascript">alert("Record of transaction for same customer on same date with same invoice number is already available!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("transaction.php");</script>';
	exit();
       }
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Transaction recorded successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("transaction.php");</script>';
	
	}

}

?>