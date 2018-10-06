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
<center><strong>System Inventory Sheet for Items out of set threshold limits</strong></center><br><br>

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          <table width="100%" border="1" bordercolor="#1CB5F1" >
<tr>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Item Code</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Goods Description</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Minimum Threshold</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Gross Available Quantity</strong></div></th>
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
$ShowItemCode="";
$ShowItemDescription="";
$ShowMinimumQuantity="";
$ShowAvailableStock="";
$ShowMaximumQuantity="";

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
// Retrieve Number of records returned and the display table row is removed to avoid conflict between actual and displayed no. of records
// Because conditions that will not meet the above if statement will display row with null value
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
<a href="AvailableFlagItem.php">Back To System</a>
</html>