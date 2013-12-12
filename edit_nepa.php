<?PHP
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<?php
if ($fgmembersite->usertype() == 1)
{
$header_file='./layout/admin_header.php';
}
if(file_exists($header_file))
{
include_once($header_file);
}
else
{
$fgmembersite->RedirectToURL("index.php");
exit;
}
?>
<style>
input[type="text"]:disabled
{
background:#dddddd;
}
</style>

   <script src="scripts/date.js"></script>
<link rel="stylesheet" href="style/date.css" media="screen">
   <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"mduedate",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
                                new JsDatePick({
                    useMode:2,
                    target:"donedate",
                    dateFormat:"%Y-%m-%d"

                });
				        
           new JsDatePick({
                    useMode:2,
                    target:"nextduedate",
                    dateFormat:"%Y-%m-%d"

                });						
		              
	};
</script>
<script>
function validateForm()
{
		
		var building_code=document.getElementById("building_code");
		if(building_code.value==0)
		{
		alert("Please select the building code");
		document.getElementById("building_code").focus();
		return false;
		}
		var mnumber=document.getElementById("mnumber");
		if(mnumber.value=="")
		{
		alert("Please enter the nepa meter number");
		document.getElementById("mnumber").focus();
		return false;
		}
		
		var mdate=document.getElementById("mdate").value;
		if(mdate==""||mdate==0 || !mdate)
		{
		alert("Please select the date");
		document.getElementById("mdate").focus();
		return false;
		}
	
		var amount=document.getElementById("amount");
		if(amount.value=="")
		{
		alert("Please enter the amount");
		document.getElementById("amount").focus();
		return false;
		}
	
		var add_currency=document.getElementById("add_currency");
		if(add_currency.value==0)
		{
		alert("Please select  the currency");
		document.getElementById("add_currency").focus();
		return false;
		}
			
		
}
</script>

 <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"mdate",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
							
		              
	};
</script>


<?php
if(isset($_POST['save']))
{
$building_code=$_POST['building_code'];
$mnumber=$_POST['mnumber'];
$mdate=$_POST['mdate'];
$amount=$_POST['amount'];
$add_currency=$_POST['add_currency'];
$user_id=$_SESSION['user_id'];
$edit_id=$_POST['edit_id'];
$current_date=date("Y-m-d H:i:s");
if(!mysql_query('update nepa SET building_code="'.$building_code.'",nepa_meter_number="'.$mnumber.'",date="'.$mdate.'",amount="'.$amount.'",currency="'.$add_currency.'",updated_by="'.$user_id.'",updated_at="'.$current_date.'" WHERE id="'.$edit_id.'"'))
{
die('Error: ' . mysql_error());
}
$fgmembersite->RedirectToURL("edit_nepa.php?id=$edit_id&success=true");
}
?>


<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM nepa where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{

$building_code=$row['building_code'];
$meter_number=$row['nepa_meter_number'];
$date=$row['date'];
$amount=$row['amount'];
$currency=$row['currency'];
}
}
?>

<div id="inside_content">
&nbsp;
<?php
if(isset($_GET['success']))
{
if ($_GET['success']=="true")
{

?>
<span class="success_message">Nepa updated successfully</span>
<?php
}

}
?>
&nbsp;
<div class="header_bold">Nepa</div>
<br/>
<br/>
<div class="scroll_not">
<form id='diesel_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">

<table id="building_class" align="center" width="90%"CELLPADDING="3" CELLSPACING="0"  style=" border: 0px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;">
  <!--<tr>
    <th style="background: url('images/th.png'); height: 29px;color:#ffffff;text-align: left;font-size: 14px;text-align:center">
Building
    </th
<th style=" height: 29px;text-align: left;font-size: 14px;text-align:center">
Building
    </0
	th>
  </tr>-->
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
  

<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">
					
					<tr>
						
	
                        <td  width="150px"><label style="margin-left:0px;">Building Code<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$result_state=mysql_query("SELECT id,building_code from building");
							echo '<select name="building_code" id="building_code" >';
							echo '<option value="0">Please select a  building code</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $building_code){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['building_code']."</option>";

							}
							echo '</select>';
							?>
							</td>
							<td  width="150px"><label style="margin-left:0px;">Nepa meter number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='mnumber' id='mnumber' class="textbox" value="<?php echo $meter_number;?>"/>
						</td>
					
							
						<td  width="150px"><label style="margin-left:0px;">Date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='mdate' id='mdate' class="textbox" value="<?php echo $date;?>"/>
						</td>
					
			
					</tr>
					<tr>
							
					
						<td  width="150px"><label style="margin-left:0px;">Amount paid<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='amount' id='amount' class="textbox" value="<?php echo $amount;?>"/>
						</td>
			<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
								   
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="add_currency" id="add_currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							if($row['id'] == $currency){
								  $isSelected = ' selected="selected"'; // if the option submited in form is as same as this row we add the selected tag
							 } else {
								  $isSelected = ''; // else we remove any tag
							 }
							
							echo "<option value='".$row['id']."'".$isSelected.">".$row['name']."</option>";

							}
							echo '</select>';
							?>
							</td>
					</tr>
					
									
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="center" colspan="5">
	<br/><br/><br/><br/><br/><br/><br/><br/>
		<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_GET['id'];?>"/>
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<input type='button'  class="flatbutton" name='view' id="view" value='View' onclick="location.href='view_nepa.php'"/>
	
            </td>
        </tr>
		
		
                </table>
                </form>            </td>

        </tr>




    </table>
	</form>



</div>
</div>

<?php
$footerfile='./layout/footer.php';
if(file_exists($footerfile))
{
include_once($footerfile);
}
else
{
echo _FILENOTFOUNT.$footerfile;
}
?>