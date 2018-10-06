<?php

class item {
	
private $ItemId;
private $ItemCode;
private $GoodsDescription;
private $DamagedQuantity;
private $Remark;


  function Delete(){

	// Establish Database selection and connection
	include_once("eurekastock.php");
	//Id of ItemId from ManageItem.php
        $Id=$_GET['ItemId'];
	$Flag=0;
	$Flag1=0;
	$Flag2=0;

	
	// Specify the query to execute selection of sum of purchased quantity for the above ItemId 
	$sql = "select SUM(purchase.Quantity) AS PurchaseQuantity from purchase where purchase.ItemId='".$Id."'";
	// Execute query
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	// Fetch the record
	$row = mysqli_fetch_array($result);
	$PurchaseQuantity=$row['PurchaseQuantity'];

	// Specify the query to execute selection of sum of sold quantity for the above ItemId 
	$sql1 = "select SUM(sales.Quantity) AS SalesQuantity from sales where sales.ItemId='".$Id."'";
	// Execute query
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	// Fetch the record
	$row = mysqli_fetch_array($result1);
	$SalesQuantity=$row['SalesQuantity'];

	$QuantityToBeDeleted=$PurchaseQuantity;
	$AvailableStock=$PurchaseQuantity-$SalesQuantity;

	$QuantityAfterDeletion=$AvailableStock-$QuantityToBeDeleted;

	//The quantity after deletion can not be below 0
	if(0 > $QuantityAfterDeletion)
	   {
	        //alert message
		echo '<script type="text/javascript">alert("Deletion of this item record will delete related purchase records which in return may cause Stock Imbalance (Negative stock quantity) so it can not be deleted!");</script>';
		// HTTP redirect
		echo '<script>window.location.replace("ManageItem.php");</script>';
		exit();
	   }
	else
	   {
	// Specify the query to Delete Record from purchase table in relation to Item to be deleted
        $sql2 = "delete purchase.* from purchase where purchase.ItemId='".$Id."' ";
	// execute query
	$result2 = mysqli_query($con,$sql2) or die(mysqli_error($con));
	if($result2)
	  {
	  $Flag2=1;
	  }
	else
	  {
	   //alert message
	  echo '<script type="text/javascript">alert("Purchase Record in relation to the selected item is not deleted!");</script>';
	  // HTTP redirect
	  echo '<script>window.location.replace("ManageItem.php");</script>';
	  exit();
	  }
	   }

	// Specify the query to Delete Record from quantityflag table in relation to Item to be deleted
        $sql3 = "delete quantityflag.* from quantityflag where quantityflag.ItemId='".$Id."' ";
	// execute query
	$result3 = mysqli_query($con,$sql3) or die(mysqli_error($con));
	if($result3)
	  {
	  $Flag=1;
	  }
	else
	  {
	   //alert message
	  echo '<script type="text/javascript">alert("Quantity treshold Record in relation to the selected item is not deleted!");</script>';
	  // HTTP redirect
	  echo '<script>window.location.replace("ManageItem.php");</script>';
	  exit();
	  }

	// Specify the query to Delete Record from sales table in relation to Item to be deleted
        $sql4 = "delete sales.* from sales where sales.ItemId='".$Id."' ";
	// execute query
	$result4 = mysqli_query($con,$sql4) or die(mysqli_error($con));
	if($result4)
	  {
	  $Flag1=1;
	  }
	else
	  {
	   //alert message
	  echo '<script type="text/javascript">alert("Sales record in relation to the selected item is not deleted!");</script>';
	  // HTTP redirect
	  echo '<script>window.location.replace("ManageItem.php");</script>';
	  exit();
	  }
	
	// Specify the query to Delete Record from item table
        $sql5 = "delete item.* from item where item.ItemId='".$Id."' ";
	// execute query
	$result5 = mysqli_query($con,$sql5) or die(mysqli_error($con));
        //if (mysqli_affected_rows($con)==0)
       
        if ($result5 && $Flag==1 && $Flag1==1 && $Flag2==1)
	  {
	  //alert message
	  echo '<script type="text/javascript">alert("Item with all related quantity threshold, sales and purchase Records Deleted Successfully!. Please amend related transaction records accordingly!");</script>';
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
	
	$ItemId=mysqli_real_escape_string($con,$_POST['txtItemId']);
        $ItemCode=mysqli_real_escape_string($con,$_POST['txtItemCode']);
        $ItemDescription=mysqli_real_escape_string($con,$_POST['txtGoodsDescription']);
	$DamagedQty=mysqli_real_escape_string($con,$_POST['txtDamagedQty']);
	if (!is_numeric($DamagedQty))
	{
	//alert message
	echo '<script type="text/javascript">alert("Damaged Quantity should be numeric!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageItem.php");</script>';
	exit();
	}
	if ($DamagedQty < 0)
	{
	//alert message
	echo '<script type="text/javascript">alert("Damaged Quantity can not be less than 0!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageItem.php");</script>';
	exit();
	}
	$Remark=mysqli_real_escape_string($con,$_POST['txtRemark']);

	// Check for duplicate entry of item using item code 
	$sql = "select * from item where ItemCode='".$ItemCode."' and ItemId != '".$ItemId."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$records = mysqli_num_rows($result);
        if ($records==0)
        {
	   // Check if this item has a purchase history
	   $sql1 = "select * from purchase where purchase.ItemId='".$ItemId."'";
	   $result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	   $records1 = mysqli_num_rows($result1);
           // No purchase history
           if ($records1==0)
           {
	   $DamagedQty=0;
           }

	// Specify the query to Update Record
	$sql2 = "Update item set item.ItemCode='".$ItemCode."',item.GoodsDescription='".$ItemDescription."',item.DamagedQuantity='".$DamagedQty."',item.Remark='".$Remark."' where item.ItemId='".$ItemId."' ";

	// Execute query
	mysqli_query($con,$sql2) or die(mysqli_error($con));
        }
	else
        {
        //alert message
	echo '<script type="text/javascript">alert("Item Code already exists for another record!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageItem.php");</script>';
	exit();
        }
	// Close The Connection
	mysqli_close($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Item Record Updated Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("ManageItem.php");</script>';
	exit();
	
	}



    function Register(){
	// Establish Database selection and connection
        include_once("eurekastock.php");
	
	$ItemCode=mysqli_real_escape_string($con,$_POST['txtItemCode']);
        $ItemDescription=mysqli_real_escape_string($con,$_POST['txtItemDescription']);
	$Remark=mysqli_real_escape_string($con,$_POST['txtRemark']);

	// Check for duplicate item code
	$sql = "select * from item where ItemCode='".$ItemCode."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	$records = mysqli_num_rows($result);
        if ($records==0)
       {
        // Specify the query to Insert Record into supplier table
	$sql1 = "insert into item (ItemCode,GoodsDescription,Remark) values('".$ItemCode."','".$ItemDescription."','".$Remark."')";
	// execute query
	mysqli_query($con,$sql1) or die(mysqli_error($con));
       }
	else
       {
	//alert message
	echo '<script type="text/javascript">alert("Item Code already exists!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("item.php");</script>';
	exit();
       }
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Item Recorded Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("item.php");</script>';
	
	}




    function RegisterDamage(){
	// Establish Database selection and connection
        include_once("eurekastock.php");
	
	$ItemDescription=mysqli_real_escape_string($con,$_POST['cmbItem']);
	$DamagedQuantity=mysqli_real_escape_string($con,$_POST['txtQuantity']);
	if (!is_numeric($DamagedQuantity))
	{
	//alert message
	echo '<script type="text/javascript">alert("Damaged Quantity should be numeric!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("item.php");</script>';
	exit();
	}
	if ($DamagedQuantity < 0)
	{
	//alert message
	echo '<script type="text/javascript">alert("Damaged Quantity can not be less than 0!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("item.php");</script>';
	exit();
	}
	
	// Retrieve details of item selected above 
	$sql = "select * from item where item.GoodsDescription='".$ItemDescription."'";
	$result = mysqli_query($con,$sql) or die(mysqli_error($con));
	//$records = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	$Id=$row['ItemId'];
	$RegisteredDamagedQty=$row['DamagedQuantity'];
	
	// Check if this item has a purchase history
	$sql1 = "select * from purchase where purchase.ItemId='".$Id."'";
	$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
	$records = mysqli_num_rows($result1);
        if ($records==0)
       {
	//alert message for already available damage value 
	echo '<script type="text/javascript">alert("This Item is not purchased yet!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("item.php");</script>';
	exit();
       }
	else
       {    
	   if ($RegisteredDamagedQty != 0)
	  {
	   //alert message for already available damage value 
	   echo '<script type="text/javascript">alert("The Item has already registered Damaged Quantity. Please update the record to change the damaged quantity!");</script>';
	   // HTTP redirect
	   echo '<script>window.location.replace("item.php");</script>';
	   exit();
	  }
	   else
          {
           // Specify the query to update the record in the item table with the new damaged quantity
	   $sql2 = "Update item set item.DamagedQuantity='".$DamagedQuantity."' where item.GoodsDescription='".$ItemDescription."' ";	
	   // execute query
	   mysqli_query($con,$sql2) or die(mysqli_error($con));
          }
       }
	// Close The Connection
	mysqli_close ($con);
	
	//alert message
	echo '<script type="text/javascript">alert("Damaged Quantity of Item Recorded Successfully!");</script>';
	// HTTP redirect
	echo '<script>window.location.replace("item.php");</script>';

	}

}

?>