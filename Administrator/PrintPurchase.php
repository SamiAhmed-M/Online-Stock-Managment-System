<html>
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=400, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Inel Power System</title>'); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 400px; font-size:12px; font-family:arial;">');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
}
</script>
<a href="javascript:Clickheretoprint()">Print</a>
<div id="print_content" style="width: 400px;">
<center><strong>EUREKA INDUSTRIAL SUPPLIES PLC</strong></center><br>
<center><strong>STOCK MANAGEMENT SYSTEM PRINT OUT</strong></center><br>
<center><strong>Addis Ababa, ETHIOPIA</strong></center><br>
<center><strong>Tel. 251 114 404255 Fax. 251 114 404236 P.O.Box 15714</strong></center><br>
<center><strong>E-mail: eureka@ethionet.et - website: www.eurekaindustrialsupplies.com</strong></center><br><br>
<center><strong>System Generated Item Purchase History</strong></center><br><br>
<?php
// Establish Database selection and connection
include_once("eurekastock.php");

//ItemId sent from ItemHistory.php
$Id=$_GET['ItemId'];

// Retrieve information from item table based on item id
$sql = "select * from item where item.ItemId='".$Id."'";
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
$row = mysqli_fetch_array($result);
$ItemDescription=$row['GoodsDescription'];
$ItemCode=$row['ItemCode'];
$Display=$ItemDescription. ", Item Code: " .$ItemCode;
?>
<center><strong><u><?php echo $Display;?></u></strong></center><br>
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
$sql = "select * from purchase WHERE purchase.ItemId = '".$Id."' ORDER BY purchase.PurchaseId";
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
<a href="ItemSelection.php">Back To System</a>
</html>