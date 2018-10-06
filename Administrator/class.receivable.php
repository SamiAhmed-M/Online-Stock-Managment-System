<?php

class receivable {
	
private $PaymentId;
private $TransactionId;
private $PaymentDate;
private $PaidAmount;
private $DebitNoteNo;
private $Remark;


  function Delete(){

	// Establish Database selection and connection
	include_once("eurekastock.php");
	//Id sent from ManageReceivable.php
        $PaymentId=$_GET['Id'];
	// Specify the query to Delete Record
        $sql = "delete payment.* from payment where payment.PaymentId='".$PaymentId."' ";
	// execute query
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
        //if (mysqli_affected_rows($con)==0)
       
        if ($result)
	{
	//alert message
	echo '<script type="text/javascript">alert("Payment Record Deleted Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageReceivable.php");</script>';
	exit();
	
	}
	else
	{
	//alert message
	echo '<script type="text/javascript">alert("Payment Record NOT Deleted!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageReceivable.php");</script>';
	exit();
	}
       	
	// Close The Connection
	mysqli_close ($con);
		
       }


   function Edit(){
	// Establish Database selection and connection
	include_once("eurekastock.php");
	
	$PaymentId=mysqli_real_escape_string($con,$_POST['txtPaymentId']);
        $TransactionName=mysqli_real_escape_string($con,$_POST['txtTransactionName']);
        $PaymentDate=mysqli_real_escape_string($con,$_POST['txtPaymentDate']);
        $NewPaidAmount=mysqli_real_escape_string($con,$_POST['txtPaidAmount']);
	if (!is_numeric($NewPaidAmount))
	{
	//alert message
	echo '<script type="text/javascript">alert("Payment amount should be numeric!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageReceivable.php");</script>';
	exit();
	}
	if ($NewPaidAmount < 0)
	{
	//alert message
	echo '<script type="text/javascript">alert("Payment amount can not be less than 0!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageReceivable.php");</script>';
	exit();
	}
        $DebitNoteNo=mysqli_real_escape_string($con,$_POST['txtDebitNoteNo']);
	$Remark=mysqli_real_escape_string($con,$_POST['txtRemark']);

	// Retrieve transaction information based on transaction name
	$sql = "select * from transaction where TransactionName='".$TransactionName."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$TransactionId=$row['TransactionId'];
	$TransactionDate=$row['TransactionDate'];
	$InvoiceAmount=$row['InvoiceAmount'];
	$DueDate=$row['DueDate'];

	if ($PaymentDate < $TransactionDate)
	{
	//alert message
	echo '<script type="text/javascript">alert("Wrong Date Sequence. The new payment date is prior to the transaction date or invoice date!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageReceivable.php");</script>';
	exit();
	} 

	// Retrieve Sum of Paid amounts for the particular transaction till settlement to determine the remaining amount
	$sql1 = "select SUM(payment.PaidAmount) AS SettledAmount from payment where payment.TransactionId='".$TransactionId."'";
	// Execute query
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	// Fetch the record
	$row = mysqli_fetch_array($result1);
	$SettledAmount=$row['SettledAmount'];

	$RemainingAmount=$InvoiceAmount-$SettledAmount;

	if ($RemainingAmount >= $NewPaidAmount)
	{
	// Specify the query to Update Record
	$sql2 = "Update payment set payment.TransactionId='".$TransactionId."',payment.PaymentDate='".$PaymentDate."',payment.PaidAmount='".$NewPaidAmount."',payment.DebitNoteNo='".$DebitNoteNo."',payment.Remark='".$Remark."' where payment.PaymentId='".$PaymentId."' ";

	// Execute query
	mysqli_query($con,$sql2) or die(mysqli_error($con));
	}
	else
	{
	//alert message
	echo '<script type="text/javascript">alert("Extra amount paid! Please refer to the payment history of the particular transaction.");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageReceivable.php");</script>';
	exit();
	}
        
	// Close The Connection
	mysqli_close($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Payment Record Updated Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageReceivable.php");</script>';
	exit();
	
	}


    function Register(){
	// Establish Database selection and connection
        include_once("eurekastock.php");
	
	$TransactionName=mysqli_real_escape_string($con,$_POST['cmbTransaction']);
        $PaymentDate=mysqli_real_escape_string($con,$_POST['txtPaymentDate']);
	$NewPaidAmount=mysqli_real_escape_string($con,$_POST['txtPaidAmount']);
	if (!is_numeric($NewPaidAmount))
	{
	//alert message
	echo '<script type="text/javascript">alert("Payment amount should be numeric!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("receivable.php");</script>';
	exit();
	}
	if ($NewPaidAmount < 0)
	{
	//alert message
	echo '<script type="text/javascript">alert("Payment amount can not be less than 0!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("receivable.php");</script>';
	exit();
	}
	$DebitNoteNo=mysqli_real_escape_string($con,$_POST['txtDebitNoteNo']);
	$Remark=mysqli_real_escape_string($con,$_POST['txtRemark']);

	//$CurrentDate= date('y/m/d');

	// Retrieve transaction information based on transaction name
	$sql = "select * from transaction where TransactionName='".$TransactionName."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$TransactionId=$row['TransactionId'];
	$TransactionDate=$row['TransactionDate'];
	$InvoiceAmount=$row['InvoiceAmount'];
	$DueDate=$row['DueDate'];

	if ($PaymentDate < $TransactionDate)
	{
	//alert message
	echo '<script type="text/javascript">alert("Wrong Date Sequence. The new payment date is prior to the transaction date or invoice date!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("receivable.php");</script>';
	exit();
	} 

	// Retrieve Sum of Paid amounts for the particular transaction till settlement to determine the remaining amount
	$sql1 = "select SUM(payment.PaidAmount) AS SettledAmount from payment where payment.TransactionId='".$TransactionId."'";
	// Execute query
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	// Fetch the record
	$row = mysqli_fetch_array($result1);
	$SettledAmount=$row['SettledAmount'];

	$RemainingAmount=$InvoiceAmount-$SettledAmount;

	if ($RemainingAmount >= $NewPaidAmount)
	{
        // Specify the query to Insert Record into supplier table
	$sql2 = "insert into payment (TransactionId,PaymentDate,PaidAmount,DebitNoteNo,Remark) values('".$TransactionId."','".$PaymentDate."','".$NewPaidAmount."','".$DebitNoteNo."','".$Remark."')";
	// execute query
	mysqli_query($con,$sql2) or die(mysqli_error($con));
	}
	else
	{
	//alert message
	echo '<script type="text/javascript">alert("Extra amount paid! Please refer to the payment history of the particular transaction.");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("receivable.php");</script>';
	exit();
	}
     
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Payment Recorded Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("receivable.php");</script>';
	
	}

}

?>