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

		var generator_code=document.getElementById("generator_code");
		if(generator_code.value==0)
		{
		alert("Please select the generator code");
		document.getElementById("generator_code").focus();
		return false;
		}
		var mduedate=document.getElementById("mduedate").value;
		if(mduedate==""||mduedate==0 || !mduedate)
		{
		alert("Please select the maintenance due date");
		document.getElementById("mduedate").focus();
		return false;
		}
	
		var status=document.getElementById("status");
		if(status.value=="")
		{
		alert("Please enter the status");
		document.getElementById("status").focus();
		return false;
		}
	
		var donedate=document.getElementById("donedate").value;
		if(donedate==""||donedate==0 || !donedate)
		{
		alert("Please select the done date");
		document.getElementById("donedate").focus();
		return false;
		}
	
		var nextduedate=document.getElementById("nextduedate").value;
		if(nextduedate==""||nextduedate==0 || !nextduedate)
		{
		alert("Please select the next due date");
		document.getElementById("nextduedate").focus();
		return false;
		}
	
		var desc=document.getElementById("desc");
		if(desc.value=="")
		{
		alert("Please enter the description");
		document.getElementById("desc").focus();
		return false;
		}
		var addcost=document.getElementById("addcost");
		if(addcost.value=="")
		{
		alert("Please enter the additional cost");
		document.getElementById("addcost").focus();
		return false;
		}
		
		var add_currency=document.getElementById("add_currency");
		if(add_currency.value==0)
		{
		alert("Please select the currency");
		document.getElementById("add_currency").focus();
		return false;
		}
	
		
}
	
	
</script>

<?php
if(isset($_POST['save']))
{
$generator_code=$_POST['generator_code'];
$mduedate=$_POST['mduedate'];
$status=$_POST['status'];
$donedate=$_POST['donedate'];
$nextduedate=$_POST['nextduedate'];
$desc=$_POST['desc'];
$addcost=$_POST['addcost'];
$add_currency=$_POST['add_currency'];
$user_id=$_SESSION['user_id'];
if(!mysql_query('insert into generator_maintain SET generator_code="'.$generator_code.'",due_date="'.$mduedate.'", 	status="'.$status.'",done_date="'.$donedate.'",next_due_date="'.$nextduedate.'",description="'.$desc.'",cost="'.$addcost.'",currency="'.$add_currency.'",created_by="'.$user_id.'" '))
{
die('Error: ' . mysql_error());
}
echo'<script> window.location="generator_maintain.php?success=true"; </script> ';


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
<span class="success_message">Generator created successfully</span>
<?php
}

}
?>
&nbsp;
<div class="header_bold">Generator Maintenance Schedule</div>
<br/>
<br/>
<div class="scroll_not">
<form id='generator_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm();"  method='post' accept-charset='UTF-8' enctype="multipart/form-data">

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
						<td  width="150px"><label style="margin-left:0px;">Generator Code<em style="font-style:normal;color:red;">*</em></label></td>
				
							<td>
							<?php
							$result_state=mysql_query("SELECT id,generator_code from generator");
							echo '<select name="generator_code" id="generator_code" >';
							echo '<option value="0">Please select a  generator code</option>';
							while($row=mysql_fetch_array($result_state))
							{
							echo '<option value="'.$row['id'].'">'.$row['generator_code'].'</option>';

							}
							echo '</select>';
							?>
							</td>
						
						<td  width="150px">
						
						<label style="margin-left:0px;">Maintenance due date<em style="font-style:normal;color:red;">*</em></label>
						
						</td>
                        <td>
						<input type='text' name='mduedate' id='mduedate' class="textbox" />
					
						</td>
						<td  width="150px">
						
						<label style="margin-left:0px;">Status<em style="font-style:normal;color:red;">*</em></label>
						
						</td>
                        <td>
						<input type='text' name='status' id='status' class="textbox" />
					
						</td>
			
					</tr>
					<tr>
						<td  width="150px"><label style="margin-left:0px;">Done date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='donedate' id='donedate' class="textbox"/>
						</td>
						<td  width="150px"><label style="margin-left:0px;">Next Due Date<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<input type='text' name='nextduedate' id='nextduedate' class="textbox"/>
						</td>
					
					
						<td  width="150px"><label style="margin-left:0px;">Description<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<textarea name='desc' id='desc' class="textbox"></textarea>
						</td>
			
					</tr>
					
					<tr>
					<td  width="150px"><label style="margin-left:0px;">Additional Cost<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
					<input type='text' name='addcost' id='addcost' class="textbox"/>
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
							echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';

							}
							echo '</select>';
							?>
							</td>
					</tr>
									
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="center" colspan="5">
	<br/><br/><br/><br/><br/><br/><br/><br/>
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<input type='button'  class="flatbutton" name='view' id="view" value='View' onclick="location.href='view_generator_maintain.php'"/>
	
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