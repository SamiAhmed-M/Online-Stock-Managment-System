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
<center><strong>System Generated All Transaction List</strong></center><br><br>

        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td>
          <table width="100%" border="1" bordercolor="#1CB5F1" >
<tr>

<th bgcolor="#1CB5F1" ><div align="left" ><strong>Customer_Name&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Sales_Mode&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Invoice_No.&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Invoice_Amount&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Transaction_Date&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Due_Date&nbsp;&nbsp;</strong></div></th>
<th bgcolor="#1CB5F1" ><div align="left" ><strong>Transaction_Name&nbsp;&nbsp;</strong></div></th>

</tr>
<?php
// Establish Database selection and connection
include_once("eurekastock.php");
// Specify the query to execute
$sql = "select * from transaction ORDER BY transaction.TransactionDate";
// Execute query
$result = mysqli_query($con,$sql) or die(mysqli_error($con));
// Loop through each records 
while($row = mysqli_fetch_array($result))
{
$Id=$row['TransactionId'];
$CustomerId=$row['CustomerId'];
$TransactionDate=$row['TransactionDate'];
$InvoiceNo=$row['InvoiceNo'];
$InvoiceAmount = number_format($row['InvoiceAmount'], 2, '.', ',');
$SalesMode=$row['SalesMode'];
$DueDate=$row['DueDate'];
$TransactionName=$row['TransactionName'];

// Retrieve CustomerName based on retrieved CustomerId above
$sql1 = "select * from customer where CustomerId='".$CustomerId."'";
$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
$row = mysqli_fetch_array($result1);
$CustomerName=$row['CustomerName'];
?>
<tr>

<td><div align="left"><?php echo $CustomerName;?></div></td>
<td><div align="left"><?php echo $SalesMode;?></div></td>
<td><div align="left"><?php echo $InvoiceNo;?></div></td>
<td><div align="left"><?php echo $InvoiceAmount;?></div></td>
<td><div align="left"><?php echo $TransactionDate;?></div></td>
<td><div align="left"><?php echo $DueDate;?></div></td>
<td><div align="left"><?php echo $TransactionName;?></div></td>
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
<a href="ManageTransaction.php">Back To System</a>
</html>