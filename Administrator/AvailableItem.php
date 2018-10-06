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
		    <li><strong><a href="AvailableItem.php">INVENTORY</a></strong></li>
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
        <div class="container" >
            <div class="row main-top-margin text-center" data-scrollreveal="enter top and move 100px, wait 0.3s">
                <div class="col-md-8 col-md-offset-2 ">
                   <h1>Available Stock</h1>
                </div>
            </div>
             <!-- ./ Main Heading-->
             <hr />
        <div class="row main-low-margin" >
          <div class="col-md-10  col-md-offset-1 ">

            <div class="col-md-6  " data-scrollreveal="enter right and move 100px, wait 0.4s">
                        <h3>Inventory</h3>
                        <hr />
	      <div style="overflow:scroll; width:870px;height:295px" >      

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          <table width="100%" border="1" bordercolor="#1CB5F1" >
<tr>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Item Code&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Goods Description&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Gross Available Quantity&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Damaged Quantity&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Quantity Available For Sale</strong></div></th>
</tr>
<?php
// Establish Database selection and connection
include_once("eurekastock.php");
// Specify the query to execute
//$sql = "select item.ItemCode,item.GoodsDescription, SUM(purchase.Quantity) AS PurchaseQuantity, SUM(sales.Quantity) AS SalesQuantity from item INNER JOIN purchase ON item.ItemId=purchase.ItemId INNER JOIN sales ON item.ItemId=sales.ItemId ORDER BY item.ItemCode";
$sql = "select * from item";
// Execute query
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
// Loop through each records 
while($row = mysqli_fetch_array($result))
{
$ItemId=$row['ItemId'];
$ItemCode=$row['ItemCode'];
$ItemDescription=$row['GoodsDescription'];
$DamagedQty=$row['DamagedQuantity'];

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
$AvailableForSale=$AvailableStock-$DamagedQty;
?>
<tr>

<td><div align="left"><?php echo $ItemCode;?></div></td>
<td><div align="left"><?php echo $ItemDescription;?></div></td>
<td><div align="left"><?php echo $AvailableStock;?></div></td>
<td><div align="left"><?php echo $DamagedQty;?></div></td>
<td><div align="left"><?php echo $AvailableForSale;?></div></td>
</tr>
<?php
}
// Retrieve Number of records returned
$records = mysqli_num_rows($result);
?>
<tr>
<td colspan="4" ><div align="left"><?php echo "Total ".$records." Records"; ?> </div></td>
</tr>
<?php
// Close the connection
mysqli_close($con);
?>
</table>
          </td>
        </tr>
      </table>
  
  </div>
<br>
                       <form id="form" name="form1" method="post" action="PrintInventory.php">
                            
                            <div class="row">                                 
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <center><button type="submit" class="btn btn-primary" name="button" id="button">Print Inventory Information</button>
                                    </div>
                                </div>
                            </div>
                       </form>             
          </div>
                    
                </div>
               
            </div>
            <!-- ./ Row Content-->
            
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