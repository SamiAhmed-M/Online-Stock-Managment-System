<html lang="en">
<!--<![endif]-->
<!-- HEAD SECTION -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <title>Eureka Industrial Supplies Plc</title>
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--BOOTSTRAP MAIN STYLES -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!--FONTAWESOME MAIN STYLE -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--CUSTOM STYLE -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
      <link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
      
    <![endif]-->
</head>
    <!--END HEAD SECTION -->
<body>   
     <!-- NAV SECTION -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
		    <li><strong><a href="ItemSelection.php">ITEM SELECTION</a></strong></li>
		    <li><a href="item.php">ITEM REGISTRATION</a></li>
		    <li><a href="index.php">HOME</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                
                </ul>
            </div>
           
        </div>
    </div>
     <!--END NAV SECTION -->
     <!-- ABOUT SECTION -->
    <div id="about-section">
        <div class="container">
            <div class="row main-top-margin text-center" data-scrollreveal="enter top and move 100px, wait 0.3s">
                <div class="col-md-8 col-md-offset-2">
<?php
// Establish Database selection and connection
include_once("eurekastock.php");

// Transaction Name sent from ReceivableTransaction.php
$ItemDescription=mysqli_real_escape_string($con,$_POST['cmbItem']);

// Retrieve information from item table based on item description
$sql = "select * from item where item.GoodsDescription='".$ItemDescription."'";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$ItemId=$row['ItemId'];
$ItemCode=$row['ItemCode'];
$Display=$ItemDescription. ", Item Code: " .$ItemCode;
?>
                    <h1>   </h1>
		    <h2><u><?php echo $Display;?></u></h2>                        
		</div>
            </div>
        <div class="row main-low-margin" >
          <div class="col-md-10  col-md-offset-1 ">
              <div class="col-md-4 col-sm-4" data-scrollreveal="enter left and move 100px, wait 0.8s">
                     <h3>Purchase History</h3>
                        <hr />
	      <div style="overflow:scroll; width:100%;height:265px" >      

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          <table width="100%" border="1" bordercolor="#1CB5F1" >
<tr>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Purchase Date&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Purchased Quantity&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Supplier&nbsp;&nbsp;</strong></div></th>

</tr>
<?php

// Specify the query to execute
$sql = "select * from purchase WHERE purchase.ItemId = '".$ItemId."' ORDER BY purchase.PurchaseId";
// Execute query
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
// Loop through each records 
while($row = mysqli_fetch_array($result))
{

$SupplierId=$row['SupplierId'];
$PurchaseDate=$row['PurchaseDate'];
$PQuantity=$row['Quantity'];

// Specify the query to execute selection of supplier name based on SupplierId above 
$sql1 = "select * from supplier where supplier.SupplierId='".$SupplierId."'";
// Execute query
$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
// Fetch the record
$row = mysqli_fetch_array($result1);
$SupplierName=$row['SupplierName'];

?>
<tr>

<td><div align="left"><?php echo $PurchaseDate;?></div></td>
<td><div align="left"><?php echo $PQuantity;?></div></td>
<td><div align="left"><?php echo $SupplierName;?></div></td>
</tr>

<?php
}

// Retrieve Number of records returned
$records = mysqli_num_rows($result);
?>



<?php
// Close the connection
//mysqli_close($con);
?>
</table>
          </td>
        </tr>
      </table>
  
  </div>
<br>
                 <form id="form" name="form2" >
                    <table width="100%" border="0">
                      <tr>
                  	<td>
                  	<label><div align="center">
                  	<strong><u>Sum Total of Purchased Qty:</u></strong>
		  	
                  	</div></label>
                  	</td>
                      </tr>
                      <tr>
			<?php
			// Establish Database selection and connection
			//include_once("eurekastock.php");
			// Specify the query to execute
			$sql = "select SUM(purchase.Quantity) AS PurchaseQuantity from purchase WHERE purchase.ItemId='".$ItemId."'";
			// Execute query
			$result = mysqli_query($con,$sql) or die(mysqli_error($con));
			$RemainingSum=0;

			// Loop through each records 
			while($row = mysqli_fetch_array($result))
			{		
			$PQty=$row['PurchaseQuantity'];
			}
			?>
                  	<td>
                  	<label><div align="center">                 	
		  	<input type="text" name="txtPSum" id="txtPSum" size="20" readonly="true" value="<?php echo $PQty;?>" />
                  	</div></label>
                  	</td>
                      </tr>                                     
                    </table>
                   </form>  
                   <form id="form1" name="form1" method="post" action="PrintPurchase.php">
                            
                            <div class="row">                                 
                                <div class="col-md-12 ">
                                    <div class="form-group">
					<strong><a href="PrintPurchase.php?ItemId=<?php echo $ItemId;?>">Print Purchase History</a></strong>
                                    </div>
                                </div>
                            </div>
                       </form>             

    </div>



            <div class="col-md-6 " data-scrollreveal="enter right and move 100px, wait 0.4s">
                        <h3>Sales History</h3>
                        <hr />
			<div style="overflow:scroll; width:100%;height:265px" >      

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          <table width="100%" border="1" bordercolor="#1CB5F1" >
<tr>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Sales Date&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Sold Quantity&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Transaction Name&nbsp;&nbsp;</strong></div></th>

</tr>
<?php

// Specify the query to execute
$sql = "select * from sales WHERE sales.ItemId = '".$ItemId."' ORDER BY sales.TransactionId";
// Execute query
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
// Loop through each records 
while($row = mysqli_fetch_array($result))
{

$TId=$row['TransactionId'];
$SQuantity=$row['Quantity'];

// Specify the query to execute selection of supplier name based on SupplierId above 
$sql1 = "select * from transaction where transaction.TransactionId='".$TId."'";
// Execute query
$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
// Fetch the record
$row = mysqli_fetch_array($result1);
$TDate=$row['TransactionDate'];
$TName=$row['TransactionName'];

?>
<tr>

<td><div align="left"><?php echo $TDate;?></div></td>
<td><div align="left"><?php echo $SQuantity;?></div></td>
<td><div align="left"><?php echo $TName;?></div></td>
</tr>

<?php
}

// Retrieve Number of records returned
$records = mysqli_num_rows($result);
?>


</table>
          </td>
        </tr>
      </table>
  
  </div>
<br>
                 <form id="form" name="form2" >
                    <table width="100%" border="0">
                      <tr>
                  	<td>
                  	<label><div align="center">
                  	<strong><u>Sum Total of Sold Quantity:</u></strong>
		  	
                  	</div></label>
                  	</td>
                      </tr>
                      <tr>
			<?php
			// Establish Database selection and connection
			//include_once("eurekastock.php");
			// Specify the query to execute
			$sql = "select SUM(sales.Quantity) AS SalesQuantity from sales WHERE sales.ItemId='".$ItemId."'";
			// Execute query
			$result = mysqli_query($con,$sql) or die(mysqli_error($con));
			$RemainingSum=0;

			// Loop through each records 
			while($row = mysqli_fetch_array($result))
			{		
			$SQty=$row['SalesQuantity'];
			}
			?>
                  	<td>
                  	<label><div align="center">                 	
		  	<input type="text" name="txtPSum" id="txtPSum" size="20" readonly="true" value="<?php echo $SQty;?>" />
                  	</div></label>
                  	</td>
                      </tr>                                     
                    </table>
                   </form>  
                      <form id="form1" name="form1" method="post" action="PrintSales.php">
                            <div class="row">                                 
                                <div class="col-md-12 ">
                                    <div class="form-group">
					<strong><a href="PrintSales.php?ItemId=<?php echo $ItemId;?>">Print Sales History</a></strong>
                                    </div>
                                </div>
                            </div>
                       </form>             
    </div>
<?php
// Close the connection
mysqli_close($con);
?>
           
      </div>
               
         </div>
          <!-- ./ Row Content-->
         
           </div>
       
               </div> 
      <!--END ABOUT SECTION -->

    
        <!--FOOTER SECTION -->
    <div id="footer">
        <div class="container">
            <div class="row ">
                &copy; 2016 Yeki Computers Plc | All Rights Reserved 				
		
            </div>
            
        </div>
       
    </div>  
    <!--END FOOTER SECTION --> 
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY LIBRARY -->
    <script src="assets/js/jquery.js"></script>
    <!-- CORE BOOTSTRAP LIBRARY -->
    <script src="assets/js/bootstrap.min.js"></script>
     <!-- SCROLL REVEL LIBRARY FOR SCROLLING ANIMATIONS-->
    <script src="assets/js/scrollReveal.js"></script>
       <!-- CUSTOM SCRIPT-->
    <script src="assets/js/custom.js"></script>
</body>
</html>