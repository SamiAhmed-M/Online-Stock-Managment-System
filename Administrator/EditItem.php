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
		    <li><strong><a href="ManageItem.php">ITEM DETAIL MANAGEMENT</a></strong></li>
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
                   <h1>Item Detail Management</h1>
                </div>
            </div>
             <!-- ./ Main Heading-->
             <hr />
            <div class="row main-low-margin" >
                <div class="col-md-10  col-md-offset-1 ">
              <div class="col-md-2 col-sm-2" data-scrollreveal="enter left and move 100px, wait 0.8s">
                    
                </div>
                <div class="col-md-8  " data-scrollreveal="enter right and move 100px, wait 0.4s">
                        <h3>Edit Item Detail</h3>
                        <hr />
			<div style="overflow:scroll; width:100%;height:290px" >
                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                    <td>
<?php
//ItemId sent from ManageItem.php
$Id=$_GET['ItemId'];
// Establish Database selection and connection
include_once("eurekastock.php");
// Specify the query to execute
$sql = "select * from item where ItemId='".$Id."'";
// Execute query
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
// Loop through each records 
while($row = mysqli_fetch_array($result))
{
$ItemId=$row['ItemId'];
$Code=$row['ItemCode'];
$Description=$row['GoodsDescription'];
$DamagedQty=$row['DamagedQuantity'];
$Remark=$row['Remark'];
}

?>
                    <form form name="form1" method="post" action="UpdateItem.php">
                     <table width="100%" border="0">
                      <tr>
			<td>
			<label><div align="center">
                  	<strong>System Item Id:</div></label></td>
                  	<td>
		  	<input type="text" name="txtItemId" id="txtItemId" size="35" readonly="true" value="<?php echo $ItemId;?>" />
                  	</td>
                      </tr>
		      <tr>
			<td>
                  	<label><div align="center">
			<strong>  </div></label></td>
                      </tr>
                      <tr>
                  	<td>
                  	<label><div align="center">
                  	<strong>Item Code:</div></label></td>
			<td>
		  	<input type="text" name="txtItemCode" id="txtItemCode" size="35" value="<?php echo $Code;?>" />
                  	</td>
                      </tr>
		      <tr>
			<td>
                  	<label><div align="center">
			<strong>  </div></label></td>
                      </tr>
	              <tr>
                  	<td>
                  	<label><div align="center">
                  	<strong>Item Description:</div></label></td>
			<td>
		  	<input type="text" name="txtGoodsDescription" id="txtGoodsDescription" size="35" value="<?php echo $Description;?>" />
                  	</td>
              	      </tr>
		      <tr>
			<td>
                  	<label><div align="center">
			<strong>  </div></label></td>
                      </tr>
	              <tr>
                  	<td>
                  	<label><div align="center">
                  	<strong>Damaged Quantity:</div></label></td>
			<td>
		  	<input type="text" name="txtDamagedQty" id="txtDamagedQty" size="35" value="<?php echo $DamagedQty;?>" />
                  	</td>
              	      </tr>
		      <tr>
			<td>
                  	<label><div align="center">
			<strong>  </div></label></td>
                      </tr>
              	      <tr>
                  	<td>
                  	<label><div align="center">
                  	<strong>Remark:</div></label></td>
                  	<td>
		  	<input type="text" name="txtRemark" id="txtRemark" size="35" value="<?php echo $Remark;?>" />
                  	</td>
              	      </tr>
		      <tr>
			<td>
                  	<label><div align="center">
			<strong>  </div></label></td>
                      </tr>
                      <tr>
                    	<td><label>
                        <div align="center">                  	
			<strong> </div></label></td>
			<td>
                    	<input type="submit" name="button" id="button" value="UpdateRecord">
                    	</td>
                     </tr>                            
                    </table>
                  </form>
<?php
// Close the connection
mysqli_close($con);
?>

                      
                  </tr>
                </table></div>
                   </div>
                    
                </div>
               
            </div>
            <!-- ./ Row Content-->
            
       </div>
  
<br>
<br>
<br>
<br>
<br>
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