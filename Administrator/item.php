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
		    <li><strong><a href="item.php">ITEM REGISTRATION</a></strong></li>
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
                   <h1>Item Registration</h1>
                </div>
            </div>
             <!-- ./ Main Heading-->
             <hr />
            <div class="row main-low-margin" >
                <div class="col-md-10  col-md-offset-1 ">
                <div class="col-md-4 col-sm-4" data-scrollreveal="enter left and move 100px, wait 0.8s">
                                        <h3>Registered Items</h3>
                        <hr />
	      <div style="overflow:scroll; width:100%;height:290px" >      

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          <table width="100%" border="1" bordercolor="#1CB5F1" >
<tr>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Goods Description&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Item Code&nbsp;&nbsp;</strong></div></th>
</tr>
<?php
// Establish Database selection and connection
include_once("eurekastock.php");

// Specify the query to execute
$sql = "select * from item ORDER BY item.GoodsDescription";
// Execute query
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
// Loop through each records 
while($row = mysqli_fetch_array($result))
{

$ItemDescription=$row['GoodsDescription'];
$ItemCode=$row['ItemCode'];
?>
<tr>

<td><div align="left"><?php echo $ItemDescription;?></div></td>
<td><div align="left"><?php echo $ItemCode;?></div></td>
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

                </div>
                <div class="col-md-6  " data-scrollreveal="enter right and move 100px, wait 0.4s">
                        <h3>Please fill all the fields</h3>
                        <hr />
			<form id="form1" name="form1" method="post" action="RegisterItem.php">
                            
			    
			    <div class="row">
				<div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Item Code / ID" name="txtItemCode" id="txtItemCode" size="35">
				    </div>
                                </div>
                            </div>
			    <div class="row">
				<div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Item Description" name="txtItemDescription" id="txtItemDescription" size="35">
				    </div>
                                </div>
                            </div>
			    <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <textarea name="txtRemark" id="txtRemark" required="required" class="form-control" rows="2"  placeholder="Remark"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="button" id="button">Register Item Information</button>
                                    </div>
                                </div>
                            </div>
                       </form>
		       
                       
                       <div class="row">                                 
                                <div class="col-md-6 ">
				   <form id="form2" name="form2" method="post" action="ManageItem.php">                      
                                     <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="button" id="button">Manage Registered Items Information</button>
                                     </div>
				   </form>
                                </div>
				<div class="col-md-4 ">
				   <form id="form3" name="form2" method="post" action="ItemSelection.php">                      
                                     <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="button" id="button">Item History</button>
                                     </div>
				   </form>
                                </div>
                       </div>
                       
<br>
		
		       <div class="row">
                            <div class="col-md-4 ">
		                 <form id="form4" name="form3" method="post" action="AvailableItem.php">                        
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="button" id="button">Stock Inventory</button>
                                    </div>
                                 </form>
                            </div>
                            <div class="col-md-4 ">
		                 <form id="form5" name="form4" method="post" action="AvailableFlagItem.php">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="button" id="button">Flag Item Inventory</button>
                                    </div>
                                 </form>
                            </div>
			    <div class="col-md-4 ">
		                 <form id="form6" name="form4" method="post" action="ItemDamage.php">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="button" id="button">Damaged Items Registration</button>
                                    </div>

                                 </form>
                            </div>
                       </div>		                       
                   </div>
                              
                </div>
               
            </div>
            <!-- ./ Row Content-->
            
       </div>
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