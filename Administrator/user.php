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
		    <li><strong><a href="user.php">USER REGISTRATION</a></strong></li>
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
                   <h1>User Registration</h1>
                </div>
            </div>
             <!-- ./ Main Heading-->
             <hr />
            <div class="row main-low-margin" >
                <div class="col-md-10  col-md-offset-1 ">
              <div class="col-md-2 col-sm-2" data-scrollreveal="enter left and move 100px, wait 0.8s">
                    
                </div>
                <div class="col-md-8  " data-scrollreveal="enter right and move 100px, wait 0.4s">
                        <h3>Please fill all the fields</h3>
                        <hr />
			<form id="form1" name="form1" method="post" action="RegisterUser.php">
                            
			    <div class="row">
				<div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Full Name" name="txtFullName" id="txtFullName" size="35">
				    </div>
                                </div>
			    </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="Mobile Number" name="txtMobileNumber" id="txtMobileNumber" size="35">
				    </div>
                                </div>
                            </div>
                            <div class="row">
				<div class="col-md-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" required="required" placeholder="User Name" name="txtUserName" id="txtUserName" size="35">
				    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="password" class="form-control" required="required" placeholder="Password" name="txtPassword" id="txtPassword" size="35">
				    </div>
                                </div>
				<div class="col-md-4">
                                    <div class="form-group">
                                        <input type="password" class="form-control" required="required" placeholder="Re-enter Password" name="txtRePassword" id="txtRePassword" size="35">
				    </div>
                                </div>
                            </div>
			    <div class="row">
				<div class="col-md-4 ">
                                     <div class="form-group">
                                            System User Privilege:
                                     </div>
                                </div>
			        <div class="col-md-12">
                                    <div class="form-group">
                                        <select style="width: 300px" name="cmbPrivilege" id="cmbPrivilege">
                        			   <option selected="selected">Administrator</option>
						   <option>Account</option>
						   <option>Sales</option>
						   </select>
                                    </div>
                                </div>
			    </div>
			<br>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="button" id="button">Register User Information</button>
                                    </div>
                                </div>
                            </div>
			    
                       </form>
                    
			
			
                       <form id="form2" name="form1" method="post" action="ManageUser.php">
                                                        
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="button" id="button">Manage Registered System User Information</button>
                                    </div>
                                </div>
                            </div>
                       </form>
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