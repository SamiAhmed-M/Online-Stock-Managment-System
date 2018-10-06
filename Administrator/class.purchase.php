<?php

class purchase {
	
private $PurchaseId;
private $SupplierId;
private $ItemId;
private $PurchaseDate;
private $Quantity;
private $Remark;


  function Delete(){

	// Establish Database selection and connection
	include_once("eurekastock.php");
	//PurchaseId from ManagePurchase.php
        $Id=$_GET['PurchaseId'];

	// Specify the query to retrieve ItemId in relation to the above PurchaseId
	$sql = "select * from purchase where purchase.PurchaseId='".$Id."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$ItemId=$row['ItemId'];
	$Quantity=$row['Quantity'];

	// Specify the query to execute selection of sum of purchased quantity for the above ItemId 
	$sql1 = "select SUM(purchase.Quantity) AS PurchaseQuantity from purchase where purchase.ItemId='".$ItemId."'";
	// Execute query
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	// Fetch the record
	$row = mysqli_fetch_array($result1);
	$PurchaseQuantity=$row['PurchaseQuantity'];

	// Specify the query to execute selection of sum of sold quantity for the above ItemId 
	$sql2 = "select SUM(sales.Quantity) AS SalesQuantity from sales where sales.ItemId='".$ItemId."'";
	// Execute query
	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	// Fetch the record
	$row = mysqli_fetch_array($result2);
	$SalesQuantity=$row['SalesQuantity'];

	$AvailableStock=$PurchaseQuantity-$SalesQuantity;

	//Check how much stock will remain after deduction of quantity (due to deletion) of the particular item in selected purchase
	$StockRemain=$AvailableStock-$Quantity;

	// Remaining stock balance can not be below 0
	if(0 > $StockRemain)
	   {
	        //alert message
		echo '<script type="text/javascript">alert("Deletion of this purchase record will result in Stock Imbalance so it can not be deleted!");</script>';
		// HTTP redirect
		echo '<script>window.location.replace("ManagePurchase.php");</script>';
		exit();
	   }
	else
	   {
	     // Specify the query to Delete Record in purchase record related to the above purchase id
             $sql3 = "delete purchase.* from purchase where purchase.PurchaseId='".$Id."' ";
	     // execute query
	     $result3 = mysqli_query($con,$sql3) or die(mysqli_error($con));
             //if (mysqli_affected_rows($con)==0)
       
             if ($result3)
	       {
	       //alert message
	       echo '<script type="text/javascript">alert("Purchase Record Deleted Successfully!");</script>';
	       // HTTP redirect
	       echo '<script>window.location.replace("ManagePurchase.php");</script>';
	       exit();
	       }
	     else
	       {
	       //alert message
	       echo '<script type="text/javascript">alert("Purchase Record is NOT Deleted!");</script>';
	       // HTTP redirect
	       echo '<script>window.location.replace("ManagePurchase.php");</script>';
	       exit();

	       }
       	
	// Close The Connection
	mysqli_close ($con);	
	  } 
       }


   function Edit(){
	// Establish Database selection and connection
	include_once("eurekastock.php");
	
	$Id=mysqli_real_escape_string($con,$_POST['txtPurchaseId']);
        $SupplierName=mysqli_real_escape_string($con,$_POST['txtSupplierName']);
	$ItemDescription=mysqli_real_escape_string($con,$_POST['txtItemDescription']);
	$PurchaseDate=mysqli_real_escape_string($con,$_POST['txtPurchaseDate']);
	$Quantity=mysqli_real_escape_string($con,$_POST['txtQuantity']);
	   if (!is_numeric($Quantity))
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Quantity value should be numeric!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManagePurchase.php");</script>';
	   exit();
	   }
	   if ($Quantity < 0)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Quantity value can not be less than 0!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("ManagePurchase.php");</script>';
	   exit();
	   }
	$Remark=mysqli_real_escape_string($con,$_POST['txtRemark']);
	
	// Retrieve ItemId based on selected Item Description
	$sql = "select * from item where GoodsDescription='".$ItemDescription."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$ItemId=$row['ItemId'];

	// Retrieve SupplierId based on selected Supplier Name
	$sql1 = "select * from supplier where SupplierName='".$SupplierName."'";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result1);
	$SupplierId=$row['SupplierId'];

	// Specify the query to Update Record
	$sql2 = "Update purchase set purchase.SupplierId='".$SupplierId."',purchase.ItemId='".$ItemId."',purchase.PurchaseDate='".$PurchaseDate."',purchase.Quantity='".$Quantity."',purchase.Remark='".$Remark."' where purchase.PurchaseId='".$Id."' ";

	// Execute query
	mysqli_query($con,$sql2) or die(mysqli_error($con));
       
	// Close The Connection
	mysqli_close($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Purchase Transaction Record Updated Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManagePurchase.php");</script>';
	exit();
	
	}


    function Register(){
	// Establish Database selection and connection
        include_once("eurekastock.php");
	
	$SupplierName=mysqli_real_escape_string($con,$_POST['cmbSupplier']);
	$ItemDescription=mysqli_real_escape_string($con,$_POST['cmbItem']);
	$PurchaseDate=mysqli_real_escape_string($con,$_POST['txtPurchaseDate']);
        $Quantity=mysqli_real_escape_string($con,$_POST['txtQuantity']);
	   if (!is_numeric($Quantity))
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Quantity value should be numeric!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("purchase.php");</script>';
	   exit();
	   }
	   if ($Quantity < 0)
	   {
	   //alert message
	   echo '<script type="text/javascript">alert("Quantity value can not be less than 0!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("purchase.php");</script>';
	   exit();
	   }
	$Remark=mysqli_real_escape_string($con,$_POST['txtRemark']);
        
	// Retrieve ItemId based on selected Item Description
	$sql = "select * from item where GoodsDescription='".$ItemDescription."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result);
	$ItemId=$row['ItemId'];

	// Retrieve SupplierId based on selected Supplier Name
	$sql1 = "select * from supplier where SupplierName='".$SupplierName."'";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$row = mysqli_fetch_array($result1);
	$SupplierId=$row['SupplierId'];

	// Specify the query to Insert Record into purchase table
	$sql2 = "insert into purchase (SupplierId,ItemId,PurchaseDate,Quantity,Remark) values('".$SupplierId."','".$ItemId."','".$PurchaseDate."','".$Quantity."','".$Remark."')";
	// execute query
	mysqli_query($con,$sql2) or die(mysqli_error($con));
       
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Purchase information recorded successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("purchase.php");</script>';
	
	}
}

?>