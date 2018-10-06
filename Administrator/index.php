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
                                                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
            </div><br>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
		    <li><strong><a href="index.php">ADMIN.</a></strong></li>
		    <li><a href="supplier.php">SUPPLIER</a></li>
                    <li><a href="customer.php">CUSTOMER</a></li>
                    <li><a href="item.php">STOCK</a></li>
                    <li><a href="quantity.php">QUANTITY LIMITS</a></li>
                    <li><a href="transaction.php">TRANSACTION</a></li>
                    <li><a href="sales.php">SALES</a></li>
                    <li><a href="purchase.php">PURCHASE</a></li>
                    <li><a href="receivable.php">RECEIVABLES</a></li>
                    <li><a href="user.php">USER</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                
                </ul>
            </div>
           
        </div>
    </div>
     <!--END NAV SECTION -->
     <!-- HEADER SECTION -->
    <div id="header-section">
        <div class="container">
            <div class="row centered">
                <div class="col-md-8 col-md-offset-2">
                    <h1>   </h1>
		    <h2><u>OUTSTANDING</u></h2>                        
		</div>
            </div>
        <div class="row main-low-margin" >
          <div class="col-md-10  col-md-offset-1 ">
              <div class="col-md-4 col-sm-4" data-scrollreveal="enter left and move 100px, wait 0.8s">
                     <h3>Receivables with Flag</h3>
                        <hr />
	      <div style="overflow:scroll; width=100%;height:290px" >      

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          <table width="100%" border="1" bordercolor="#1CB5F1" >
<tr>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Transaction Name&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Unsettled Amount&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Due Date&nbsp;&nbsp;</strong></div></th>

</tr>
<?php
// Establish Database selection and connection
include_once("eurekastock.php");

//Current Date
$CurrentDate=date('y/m/d');


// Specify the query to execute
$sql = "select * from transaction WHERE transaction.SalesMode='Credit' AND transaction.DueDate < '".$CurrentDate."' ORDER BY transaction.TransactionId, transaction.TransactionDate";
// Execute query
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
// Loop through each records 
while($row = mysqli_fetch_array($result))
{
//Set Display variables to Null in order to avoid duplicate display when below if stat't is not met
$ShowTransactionName=NULL;
$ShowTransactionDate=NULL;
$ShowInvoiceAmount=NULL;
$ShowSettledAmount=NULL;
$ShowRemainingAmount=NULL;
$ShowDueDate=NULL;

$TransactionId=$row['TransactionId'];
$TransactionDate=$row['TransactionDate'];
$InvoiceAmount=$row['InvoiceAmount'];
$DueDate=$row['DueDate'];
$TransactionName=$row['TransactionName'];

// Specify the query to execute selection of sum of payments made for the above TransactionId 
$sql1 = "select SUM(payment.PaidAmount) AS SettledAmount from payment where payment.TransactionId='".$TransactionId."'";
// Execute query
$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
// Fetch the record
$row = mysqli_fetch_array($result1);
$SettledAmount=$row['SettledAmount'];

$RemainingAmount=$InvoiceAmount-$SettledAmount;
//Foramtting Displayed Amount
$DisplayRemainingAmount = number_format($RemainingAmount, 2, '.', ',');


//Assign values to display variables
if ($RemainingAmount > 0)
{
$ShowTransactionName=$TransactionName;
$ShowTransactionDate=$TransactionDate;
$ShowInvoiceAmount=$InvoiceAmount;
$ShowSettledAmount=$SettledAmount;
$ShowRemainingAmount=$DisplayRemainingAmount;
$ShowDueDate=$DueDate;
}
?>
<tr>

<td><div align="left"><?php echo $ShowTransactionName;?></div></td>
<td><div align="left"><?php echo $ShowRemainingAmount;?></div></td>
<td><div align="left"><?php echo $ShowDueDate;?></div></td>
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
                  	<strong><u>Sum Total of Active Receivables:</u></strong>
		  	
                  	</div></label>
                  	</td>
                      </tr>
                      <tr>
			<?php
			// Establish Database selection and connection
			//include_once("eurekastock.php");
			// Specify the query to execute
			$sql = "select * from transaction WHERE transaction.SalesMode='Credit' ORDER BY transaction.TransactionId, transaction.TransactionDate";
			// Execute query
			$result = mysqli_query($con,$sql) or die(mysqli_error($con));
			$RemainingSum=0;

			// Loop through each records 
			while($row = mysqli_fetch_array($result))
			{		

			$TransactionId=$row['TransactionId'];
			$TransactionDate=$row['TransactionDate'];
			$InvoiceAmount=$row['InvoiceAmount'];
			$DueDate=$row['DueDate'];
			$TransactionName=$row['TransactionName'];

			// Specify the query to execute selection of sum of payments made for the above TransactionId 
			$sql1 = "select SUM(payment.PaidAmount) AS SettledAmount from payment where payment.TransactionId='".$TransactionId."'";
			// Execute query
			$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
			// Fetch the record
			$row = mysqli_fetch_array($result1);
			$SettledAmount=$row['SettledAmount'];

			$RemainingAmount=$InvoiceAmount-$SettledAmount;
		
			//Sum total of all remaining amounts of every transaction
			$RemainingSum=$RemainingSum + $RemainingAmount;
			//Formatting Displayed Sum
			$DisplayRemainingSum = number_format($RemainingSum, 2, '.', ',');
			}
			?>
                  	<td>
                  	<label><div align="center">                 	
		  	<input type="text" name="txtRemainingSum" id="txtRemainingSum" size="15" readonly="true" value="<?php echo $DisplayRemainingSum;?>" />
                  	</div></label>
                  	</td>
                      </tr>                                     
                    </table>
                   </form>  

    </div>



            <div class="col-md-6 " data-scrollreveal="enter right and move 100px, wait 0.4s">
                        <h3>List of Items with Flag</h3>
                        <hr />
			<div style="overflow:scroll; width=100%;height:290px" >      

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          <table width="100%" border="1" bordercolor="#1CB5F1" >
<tr>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Item Code</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Goods Description</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Minimum Threshold</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Gross Quantity</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Maximum Threshold</strong></div></th>
</tr>
<?php
// Establish Database selection and connection
include_once("eurekastock.php");
// Specify the query to execute
//  $sql = "select item.ItemCode,item.GoodsDescription, quantityflag.MinimumQuantity, quantityflag.MaximumQuantity, SUM(purchase.Quantity) AS PurchaseQuantity, SUM(sales.Quantity) AS SalesQuantity from item INNER JOIN purchase ON item.ItemId=purchase.ItemId INNER JOIN sales ON item.ItemId=sales.ItemId INNER JOIN quantityflag ON item.ItemId=quantityflag.ItemId GROUP BY item.ItemCode HAVING (SUM(purchase.Quantity)-SUM(sales.Quantity)) < quantityflag.MinimumQuantity OR quantityflag.MaximumQuantity > (SUM(purchase.Quantity)-SUM(sales.Quantity)) ";
$sql = "select * from item";
// Execute query
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
// Loop through each records 
while($row = mysqli_fetch_array($result))
{
//Set Display variables to Null in order to avoid duplicate display when below if stat't is not met
$ShowItemCode=NULL;
$ShowItemDescription=NULL;
$ShowMinimumQuantity=NULL;
$ShowAvailableStock=NULL;
$ShowMaximumQuantity=NULL;

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
$AvailableSaleStock=$AvailableStock-$DamagedQty;
  
// Specify the query to execute selection of threshhold data from quantityflag for the above ItemId 
$sql3 = "select * from quantityflag where quantityflag.ItemId='".$ItemId."'";
// Execute query
$result3 = mysqli_query($con,$sql3) or die(mysqli_error($con));
// Loop through each records 
$row = mysqli_fetch_array($result3);
$MinimumQuantity=$row['MinimumQuantity'];
$MaximumQuantity=$row['MaximumQuantity'];

if ($AvailableStock < $MinimumQuantity || $AvailableStock > $MaximumQuantity)
{
$ShowItemCode=$ItemCode;
$ShowItemDescription=$ItemDescription;
$ShowMinimumQuantity=$MinimumQuantity;
$ShowAvailableStock=$AvailableStock;
$ShowAvailableSaleStock=$AvailableSaleStock;
$ShowMaximumQuantity=$MaximumQuantity;
}
     
?>

<tr>

<td><div align="left"><?php echo $ShowItemCode;?></div></td>
<td><div align="left"><?php echo $ShowItemDescription;?></div></td>
<td><div align="left"><?php echo $ShowMinimumQuantity;?></div></td>
<td><div align="left"><?php echo $ShowAvailableStock;?></div></td>
<td><div align="left"><?php echo $ShowMaximumQuantity;?></div></td>
</tr>

<?php
}

// Retrieve Number of records returned
$records = mysqli_num_rows($result);
?>



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
 
    </div>
           
      </div>
               
         </div>
          <!-- ./ Row Content-->
         
           </div>
       
               </div> 
      <!--END HEADER SECTION -->
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