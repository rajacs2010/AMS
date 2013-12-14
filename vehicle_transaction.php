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

   <script src="scripts/date.js"></script>
<link rel="stylesheet" href="style/date.css" media="screen">
   <script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"license_date",
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
                    target:"renewal_date",
                    dateFormat:"%Y-%m-%d"

                });
				            
		              
	};
</script>
<script>
function validateForm()
{

	var driver_name=document.getElementById("driver_name");
	if(driver_name.value==0)
	{
	alert("Please select the name");
	document.getElementById("driver_name").focus();
	return false;
	}
	var address1=document.getElementById("address1");
	if(address1.value=="")
	{
	alert("Please enter the address line1");
	document.getElementById("address1").focus();
	return false;
	}
	var address2=document.getElementById("address2");
	if(address2.value=="")
	{
	alert("Please enter the address line2");
	document.getElementById("address2").focus();
	return false;
	}
	var address3=document.getElementById("address3");
	if(address3.value=="")
	{
	alert("Please enter the address line3");
	document.getElementById("address3").focus();
	return false;
	}

	var city_driver=document.getElementById("city_driver");
	if(city_driver.value==0)
	{
	alert("Please select the city");
	document.getElementById("city_driver").focus();
	return false;
	}
	var contact_number=document.getElementById("contact_number");
	if(contact_number.value=="")
	{
	alert("Please enter the contact number");
	document.getElementById("contact_number").focus();
	return false;
	}
	
	var alt_contact_number=document.getElementById("alt_contact_number");
	if(alt_contact_number.value=="")
	{
	alert("Please enter the alternate contact number");
	document.getElementById("alt_contact_number").focus();
	return false;
	}
	var licence_number=document.getElementById("licence_number");
	if(licence_number.value=="")
	{
	alert("Please enter the licence number");
	document.getElementById("licence_number").focus();
	return false;
	}
	
	var license_date=document.getElementById("license_date").value;
	if(license_date==""||license_date==0 || !license_date)
	{
	alert("Please select the dlicense date");
	document.getElementById("license_date").focus();
	return false;
	}
	
	var renewal_date=document.getElementById("renewal_date").value;
	if(renewal_date==""||renewal_date==0 || !renewal_date)
	{
	alert("Please select the renewal date");
	document.getElementById("renewal_date").focus();
	return false;
	}
	
}
	</script>

   <script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#driver_name").change(function(event){
	var selvalue_incharge_empcode=document.getElementById("driver_name").value;
	if (selvalue_incharge_empcode != 0)
	{
          $('#display_empcode').load('ajax_driver.php?selvalue_incharge_empcode='+selvalue_incharge_empcode);
	}
	else
	{
	document.getElementById("emp_code").value = "";
	
	}
      });		
   });
   </script>
   <script type="text/javascript" language="javascript">
   $(document).ready(function() {
	$("#city_driver").change(function(event){
	var selvalue_driver=document.getElementById("city_driver").value;
	if (selvalue_driver != 0)
	{
          $('#display_state_driver').load('ajax_driver.php?selvalue_driver='+selvalue_driver);
	}
	else
	{
	document.getElementById("state_driver").value = "";
	
	}
      });		
   });
   </script>
<?php
if(isset($_POST['save']))
{
$driver_code=$_POST['code'];
$emp_code=$_POST['emp_code'];

				$fgmembersite->DBLogin();
				$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) 
				or die("Opps some thing went wrong");
				mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");
				$result_emp_id=mysql_query("select first_name from pim_emp_info where emp_code='$emp_code'  order by emp_id",$bd);
				while($row=mysql_fetch_array($result_emp_id))
				{
				$emp_name=$row['first_name'];
				}
				
$address1=$_POST['address1'];
$address2=$_POST['address2'];
$address3=$_POST['address3'];
$city_driver=$_POST['city_driver'];
$contact_number=$_POST['contact_number'];
$alt_contact_number=$_POST['alt_contact_number'];
$licence_number=$_POST['licence_number'];
$license_date=$_POST['license_date'];
$renewal_date=$_POST['renewal_date'];
$user_id=$_SESSION['user_id'];
$fgmembersite->DBLogin();
if(!mysql_query('insert into driver SET driver_code="'.$driver_code.'",emp_name="'.$emp_name.'",emp_code="'.$emp_code.'",address1="'.$address1.'",address2="'.$address2.'",address3="'.$address3.'",city_id="'.$city_driver.'",contact_number="'.$contact_number.'",alt_contact_number="'.$alt_contact_number.'",license_number="'.$licence_number.'",license_date="'.$license_date.'",renewal_date="'.$renewal_date.'",created_by="'.$user_id.'" '))
{
die('Error: ' . mysql_error());
}
echo'<script> window.location="driver.php?success=true"; </script> ';


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
<span class="success_message">Vehicle transactions  created successfully</span>
<?php
}

}
?>
&nbsp;
<div class="header_bold">Vehicle transactions</div>
<div class="scroll_not">
<form id='driver_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">

<table id="building_class" align="center" width="90%"CELLPADDING="3" CELLSPACING="0"  style=" border: 0px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;"      >
  <!--<tr>
    <th style="background: url('images/th.png'); height: 29px;color:#ffffff;text-align: left;font-size: 14px;text-align:center">
Building
    </th
<th style=" height: 29px;text-align: left;font-size: 14px;text-align:center">
Building
    </th>
  </tr>-->
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
  

<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

                    <tr>
						<td  width="150px"><label style="margin-left:0px;">Vehicle registration number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php
						$result_state=mysql_query("select * from vehicle");
					echo '<select name="vehicle_reg_id" id="vehicle_reg_id" class="selectbox">';
					echo '<option value="0">Please select a  vehicle register number</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['vehicle_regno'].'</option>';

					}
					echo '</select>';
		           ?>
				 		
						</td>
						<td  width="150px"><label style="margin-left:0px;">Date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='transaction_date' id='transaction_date' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Transaction type<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php
						$result_state=mysql_query("select * from transaction_type");
					echo '<select name="transaction_type_id" id="transaction_type_id" class="selectbox">';
					echo '<option value="0">Please select a  transaction type</option>';
					while($row=mysql_fetch_array($result_state))
					{
					echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

					}
					echo '</select>';
		           ?>
				 		
						</td>
						
						
						
                    </tr>
					
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Transaction number<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php
		 if(!isset($_GET[id]) && $_GET[id] == '') {
			$cusid					=	"SELECT transaction_number FROM  vehicle_transaction ORDER BY id DESC";			
			$cusold					=	mysql_query($cusid) or die(mysql_error());
			$cuscnt					=	mysql_num_rows($cusold);
			//$cuscnt					=	0; // comment if live
			if($cuscnt > 0) {
				$row_cus					  =	 mysql_fetch_array($cusold);
				$cusnumber	  =	$row_cus['transaction_number'];

				$getcusno						=	abs(str_replace("TR",'',strstr($cusnumber,"TR")));
				$getcusno++;
				if($getcusno < 10) {
					$createdcode	=	"00".$getcusno;
				} else if($getcusno < 100) {
					$createdcode	=	"0".$getcusno;
				} else {
					$createdcode	=	$getcusno;
				}

				$customer_code				=	"TR".$createdcode;
			} else {
				$customer_code				=	"TR001";
			}
		}
	?>
						<input type='text' name='code' id='code' class="textbox" value="<?php echo $customer_code;?>" readonly="true"/>
						</td>
						
						<td  width="150px"><label style="margin-left:0px;">Vendor code<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<input type='text' name='vendor_code' id='vendor_code' class="textbox" />
					
							</td>
						<td  width="150px"><label style="margin-left:0px;">Vendor name<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
						<input type='text' name='vendor_name' id='vendor_name' class="textbox" />
					
							</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Uom<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
						<input type='text' name='uom' id='uom' class="textbox" />
					
							</td>
						<td  width="150px"><label style="margin-left:0px;">Units<em style="font-style:normal;color:red;">*</em></label></td>
                       
						<td>
								<input type='text' name='units' id='units' class="textbox"/>
							</td>
						
			<td  width="150px"><label style="margin-left:0px;">Currency<em style="font-style:normal;color:red;">*</em></label></td>
                       
						<td>
							<?php
							$fgmembersite->DBLogin();
							$result_state=mysql_query("select * from currency");
							echo '<select name="total_currency" id="total_currency" class="selectbox">';
							echo '<option value="0">Please select a  currency</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

							}
							echo '</select>';
							?>
							</td>
					</tr>
					<tr>
					
						<td  width="150px"><label style="margin-left:0px;">Rate<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='rate' id='rate' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Cost<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='cost' id='cost' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Description<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea name='desc' id='desc' class="areatext"></textarea>
						</td>
					
			
					</tr>
					<td  width="150px"><label style="margin-left:0px;"><em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea name='desc' id='desc' class="areatext"></textarea>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Description<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea name='desc' id='desc' class="areatext"></textarea>
						</td>			
		<tr>
            <td  width="150px" >&nbsp;</td>
            <td align="center" colspan="5">	
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