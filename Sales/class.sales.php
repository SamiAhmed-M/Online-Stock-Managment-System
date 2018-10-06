<?php

class sales {
	
private $SalesId;
private $TransactionId;
private $ItemId;
private $Quantity;


  function Delete(){

	// Establish Database selection and connection
	include_once("eurekastock.php");
	//SalesId from ManageSales.php
        $Id=$_GET['SalesId'];
	// Specify the query to Delete Record
        $sql = "delete sales.* from sales where sales.SalesId='".$Id."' ";
	// execute query
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
        //if (mysqli_affected_rows($con)==0)
       
        if ($result)
	{
	//alert message
	echo '<script type="text/javascript">alert("Sales Record Deleted Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageSales.php");</script>';
	exit();
	}
	else
	{
	//alert message
	echo '<script type="text/javascript">alert("Sales Record is NOT Deleted!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageSales.php");</script>';
	exit();
	}
       	
	// Close The Connection
	mysqli_close ($con);
		
       }


   function Edit(){
	// Establish Database selection and connection
	include_once("eurekastock.php");
	
	$SalesId=mysqli_real_escape_string($con,$_POST['txtSalesId']);
        $TransactionName=mysqli_real_escape_string($con,$_POST['txtTransactionName']);
	$ItemDescription=mysqli_real_escape_string($con,$_POST['txtItemDescription']);
	$Quantity=mysqli_real_escape_string($con,$_POST['txtQuantity']);
	   if (!is_numeric($Quantity))
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Quantity value should be numeric!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManageSales.php");</script>';
	   exit();
	   }
	   if ($Quantity < 0)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Quantity value can not be less than 0!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManageSales.php");</script>';
	   exit();
	   }
        // Retrieve ItemId based on selected Item Description
	$sql = "select * from item where GoodsDescription='".$ItemDescription."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$ItemId=$row['ItemId'];
	$DamagedQty=$row['DamagedQuantity'];

	// Retrieve TransactionId based on selected Transaction Name
	$sql1 = "select * from transaction where TransactionName='".$TransactionName."'";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result1);
	$TransactionId=$row['TransactionId'];
	
	// Specify the query to execute selection of sum of purchased quantity for the above ItemId 
	$sql2 = "select SUM(purchase.Quantity) AS PurchaseQuantity from purchase where purchase.ItemId='".$ItemId."'";
	// Execute query
	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	// Fetch the record
	$row = mysqli_fetch_array($result2);
	$PurchaseQuantity=$row['PurchaseQuantity'];

	// Specify the query to execute selection of sum of sold quantity for the above ItemId 
	$sql3 = "select SUM(sales.Quantity) AS SalesQuantity from sales where sales.ItemId='".$ItemId."'";
	// Execute query
	$result3 = mysqli_query($con,$sql3) or die(mysqli_error($con));
	// Fetch the record
	$row = mysqli_fetch_array($result3);
	$SalesQuantity=$row['SalesQuantity'];

	$AvailableStock=$PurchaseQuantity-$SalesQuantity;
	$AvailableSaleStock=$AvailableStock-$DamagedQty;

	if ($Quantity > $AvailableSaleStock)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Requested Item Quantity not available in stock!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManageSales.php");</script>';
	   exit();	
	   }

	// Specify the query to Update Record
	$sql4 = "Update sales set sales.TransactionId='".$TransactionId."',sales.ItemId='".$ItemId."',sales.Quantity='".$Quantity."' where sales.SalesId='".$SalesId."' ";

	// Execute query
	mysqli_query($con,$sql4) or die(mysqli_error($con));
       
	// Close The Connection
	mysqli_close($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Sales Transaction Record Updated Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageSales.php");</script>';
	exit();
	
	}


    function Register(){
	// Establish Database selection and connection
        include_once("eurekastock.php");
	
	$TransactionName=mysqli_real_escape_string($con,$_POST['cmbTransaction']);
	$ItemDescription=mysqli_real_escape_string($con,$_POST['cmbItem']);
	$Quantity=mysqli_real_escape_string($con,$_POST['txtQuantity']);
	   if (!is_numeric($Quantity))
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Quantity value should be numeric!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("sales.php");</script>';
	   exit();
	   }
	   if ($Quantity < 0)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Quantity value can not be less than 0!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("sales.php");</script>';
	   exit();
	   }
        
	// Retrieve ItemId based on selected Item Description
	$sql = "select * from item where GoodsDescription='".$ItemDescription."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$ItemId=$row['ItemId'];
	$DamagedQty=$row['DamagedQuantity'];

	// Retrieve CustomerId based on selected Customer Name
	$sql1 = "select * from transaction where TransactionName='".$TransactionName."'";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result1);
	$TransactionId=$row['TransactionId'];

	//Check for the availability of the requested quantity for sale
	//$sql2 = "select item.*, SUM(purchase.Quantity) AS PurchaseQuantity, SUM(sales.Quantity) AS SalesQuantity from item, purchase, sales WHERE item.ItemId=purchase.ItemId AND item.ItemId=sales.ItemId AND item.ItemId='".$ItemId."'";
	$sql2 = "select SUM(Quantity) AS PurchaseQuantity from purchase where purchase.ItemId='".$ItemId."'";
	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	$records = mysqli_num_rows($result2);
        // Loop through each records 
	while($row = mysqli_fetch_array($result2))
	{
	$PurchaseQuantity=$row['PurchaseQuantity'];
	}
	// If there is no returned record i.e. the item is not purchased yet
	if ($records==0)
          {
	   //alert message
	   echo '<script type="text/javascript">alert("This item is not purchased yet. Please refer to the purchase history!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("sales.php");</script>';
	   exit();
	  }

	$sql3 = "select SUM(Quantity) AS SalesQuantity from sales where sales.ItemId='".$ItemId."'";
	$result3 = mysqli_query($con,$sql3) or die(mysqli_error($con));
	// Loop through each records 
	while($row = mysqli_fetch_array($result3))
	{
	$SalesQuantity=$row['SalesQuantity'];
	}

	$AvailableStock=$PurchaseQuantity-$SalesQuantity;
	$AvailableSaleStock=$AvailableStock-$DamagedQty;

	if ($Quantity > $AvailableSaleStock)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Requested quantity for sale is more than available stock ready for sale of the selected item!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("sales.php");</script>';
	   exit();
	   }	

	
        // Specify the query to Insert Record into sales table
	$sql4 = "insert into sales (TransactionId,ItemId,Quantity) values('".$TransactionId."','".$ItemId."','".$Quantity."')";
	// execute query
	mysqli_query($con,$sql4) or die(mysqli_error($con));
       
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Sales transaction recorded successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("sales.php");</script>';
	
	}

}

?>