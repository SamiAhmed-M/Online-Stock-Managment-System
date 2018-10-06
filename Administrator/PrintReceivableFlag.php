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
<center><strong>System Generated Receivables List Past Due Dates</strong></center><br><br>

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
$DisplayInvoiceAmount = number_format($InvoiceAmount, 2, '.', ',');
$DueDate=$row['DueDate'];
$TransactionName=$row['TransactionName'];

// Specify the query to execute selection of sum of payments made for the above TransactionId 
$sql1 = "select SUM(payment.PaidAmount) AS SettledAmount from payment where payment.TransactionId='".$TransactionId."'";
// Execute query
$result1 = mysqli_query($con,$sql1) or die(mysqli_error($con));
// Fetch the record
$row = mysqli_fetch_array($result1);
$SettledAmount=$row['SettledAmount'];
$DisplaySettledAmount = number_format($SettledAmount, 2, '.', ',');

$RemainingAmount=$InvoiceAmount-$SettledAmount;
$DisplayRemainingAmount = number_format($RemainingAmount, 2, '.', ',');

//Assign values to display variables
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
<a href="AvailableFlagReceivable.php">Back To System</a>
</html>