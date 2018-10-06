<?php

class supplier {
	
private $SupplierId;
private $SupplierName;
private $Description;


  function Delete(){

	// Establish Database selection and connection
	include_once("eurekastock.php");
	//Id of SupplierId from ManageSupplier.php
        $Id=$_GET['SupplierId'];

	// Specify the query to retrieve items related to the selected supplier in order to avoid stock imbalance due to deletion
	$sql = "select * from purchase WHERE purchase.SupplierId='".$Id."'";
	// Execute query
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	// Loop through each records 
	while($row = mysqli_fetch_array($result))
	{
	$ItemId=$row['ItemId'];

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

        $QuantityToBeDeleted=$PurchaseQuantity;
	$AvailableStock=$PurchaseQuantity-$SalesQuantity;

	$QuantityAfterDeletion=$AvailableStock-$QuantityToBeDeleted;

	//item quantity can not be below 0 after deletion
	if(0 > $QuantityAfterDeletion)
	   {
	        //alert message
		echo '<script type="text/javascript">alert("Deletion of this supplier record will delete related purchase records which in return may cause Stock Imbalance (Negative stock quantity) so it can not be deleted!");</script>';
		// HTTP redirect
		echo '<script>window.location.replace("ManageSupplier.php");</script>';
		exit();
	   }
	else
	   {
	        // Specify the query to Delete Record from purchase table i.e. record of purchase from the supplier to be deleted
		$sql3 = "delete purchase.* from purchase where purchase.SupplierId='".$Id."' ";
		// Execute query
		$result3 = mysqli_query($con,$sql3) or die(mysqli_error($con));
	   }
        }//End of while loop

	

	// Specify the query to Delete Record from supplier table
        $sql4 = "delete supplier.* from supplier where supplier.SupplierId='".$Id."' ";
	// Execute query
	$result4 = mysqli_query($con,$sql4) or die(mysqli_error($con));
        
       if ($result4)
 	{
 	//alert message
 	echo '<script type="text/javascript">alert("Supplier and related purchase records deleted successfully!");</script>';
 	// HTTP redirect
 	echo '<script>window.location.replace("ManageSupplier.php");</script>';
 	}
       else
 	{
 	//alert message
 	echo '<script type="text/javascript">alert("Supplier record not deleted!");</script>';
 	// HTTP redirect
 	echo '<script>window.location.replace("ManageSupplier.php");</script>';
 	exit();
 	}
	       	
	// Close The Connection
	mysqli_close ($con);
		
       }


   function Edit(){
	// Establish Database selection and connection
	include_once("eurekastock.php");
	
        $Id=mysqli_real_escape_string($con,$_POST['txtSupplierId']);
	$SupplierName=mysqli_real_escape_string($con,$_POST['txtSupplierName']);
	$Description=mysqli_real_escape_string($con,$_POST['txtSupplierDescription']);

	// Check for duplicate supplier name
	$sql = "select * from supplier where supplier.SupplierName='".$SupplierName."' and supplier.SupplierId != '".$Id."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$records = mysqli_num_rows($result);
        if ($records==0)
        {

	// Specify the query to Update Record
	$sql1 = "Update supplier set supplier.SupplierName='".$SupplierName."',supplier.Description='".$Description."' where supplier.SupplierId='".$Id."' ";

	// Execute query
	mysqli_query($con,$sql1) or die(mysqli_error($con));
        }
	else
        {
        //alert message
	echo '<script type="text/javascript">alert("Supplier Name already exists!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageSupplier.php");</script>';
	exit();
        }
	// Close The Connection
	mysqli_close($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Supplier Record Updated Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageSupplier.php");</script>';
	exit();
	
	}


    function Register(){
	// Establish Database selection and connection
        include_once("eurekastock.php");
	
	$SupplierName=mysqli_real_escape_string($con,$_POST['txtSupplier']);
        $Description=mysqli_real_escape_string($con,$_POST['txtDescription']);

	// Check for duplicate supplier name
	$sql = "select * from supplier where SupplierName='".$SupplierName."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$records = mysqli_num_rows($result);
        if ($records==0)
       {
        // Specify the query to Insert Record into supplier table
	$sql1 = "insert into supplier (SupplierName,Description) values('".$SupplierName."','".$Description."')";
	// execute query
	mysqli_query($con,$sql1) or die(mysqli_error($con));
       }
	else
       {
	//alert message
	echo '<script type="text/javascript">alert("Supplier Name already exists!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("supplier.php");</script>';
	exit();
       }
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Supplier Recorded Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("supplier.php");</script>';
	
	}

}

?>