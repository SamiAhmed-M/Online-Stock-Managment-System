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
		    <li><strong><a href="AvailableReceivable.php">ACTIVE RECEIVABLES</a></strong></li>
		    <li><a href="receivable.php">RECEIVABLES REGISTRATION</a></li>
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
                   <h1>Active Receivables List</h1>
                </div>
            </div>
             <!-- ./ Main Heading-->
             <hr />
            <div class="row main-low-margin" >
                <div class="col-md-10  col-md-offset-1 ">
              
                <div class="col-md-6  " data-scrollreveal="enter right and move 100px, wait 0.4s">
                        <h3>Unsettled Amounts List</h3>
                        <hr />
			<div style="overflow:scroll; width:870px;height:290px" >      

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          <table width="100%" border="1" bordercolor="#1CB5F1" >
<tr>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Transaction_Name</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Transaction_Date</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Invoice_Amount</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Total_Paid_Amount</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Remaining_Amount</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Due_Date</strong></div></th>

</tr>
<?php
// Establish Database selection and connection
include_once("eurekastock.php");
// Specify the query to execute
$sql = "select * from transaction WHERE transaction.SalesMode='Credit' ORDER BY transaction.TransactionId, transaction.TransactionDate";
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
$InvoiceAmount = $row['InvoiceAmount'];
$DisplayInvoiceAmount = number_format($InvoiceAmount, 2, '.', ',');
$DueDate=$row['DueDate'];
$TransactionName=$row['TransactionName'];

// Specify the query to execute selection of sum of payments made for the above TransactionId 
$sql1 = "select SUM(payment.PaidAmount) AS SettledAmount from payment where payment.TransactionId='".$TransactionId."'";
// Execute query
$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
// Fetch the record
$row = mysqli_fetch_array($result1);
$SettledAmount = $row['SettledAmount'];
$DisplaySettledAmount = number_format($SettledAmount, 2, '.', ',');

$RemainingAmount=$InvoiceAmount-$SettledAmount;
$DisplayRemainingAmount = number_format($RemainingAmount, 2, '.', ',');

//$CurrentDate= date('y/m/d');

//Assign values of transactions with unsettled amounts to display variables 
if ($RemainingAmount > 0)
{
$ShowTransactionName=$TransactionName;
$ShowTransactionDate=$TransactionDate;
$ShowInvoiceAmount=$DisplayInvoiceAmount;
$ShowSettledAmount=$DisplaySettledAmount;
$ShowRemainingAmount=$DisplayRemainingAmount;
$ShowDueDate=$DueDate;
}
?>
<tr>

<td><div align="left"><?php echo $ShowTransactionName;?></div></td>
<td><div align="left"><?php echo $ShowTransactionDate;?></div></td>
<td><div align="left"><?php echo $ShowInvoiceAmount;?></div></td>
<td><div align="left"><?php echo $ShowSettledAmount;?></div></td>
<td><div align="left"><?php echo $ShowRemainingAmount;?></div></td>
<td><div align="left"><?php echo $ShowDueDate;?></div></td>
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
<br>
<br>
<br>
<br>
          </div>
                    
                </div>
               
            </div>
            <!-- ./ Row Content-->
            
       </div>
  


      <!--END RECEIVABLE SECTION -->

    
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