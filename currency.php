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
<script>
$(function(){
$("#content").load("ajax_currency.php");

//PAGE NUMBER onClick FUNCTION
$(".page").live("click", function(){
var page = $(this).attr("id");
$("#content").load("ajax_currency.php?page="+page);
});
});
</script>
<script>
function validateForm()
{
var statename=document.getElementById("currency").value;
	if(statename=="")
	{
		alert("Please enter the currency");
		document.getElementById("currency").focus();
		return false;
	}
}

</script>

<script src="scripts/jquery_pagination.js"></script>
<script>
$(document).ready(function(){
  $("#imageclick").click(function(){
 var searchvalue=$('#searchname').val();
 var searchvalue=$.trim(searchvalue).replace(/ /g,'+');
$("#content").load("ajax_currency.php?searchvalue="+searchvalue);
  });
});
</script>
</script>
<script>
function myFunction()
{
document.getElementById("currency").value="";
document.getElementById("currency").focus();
return false;
}
</script>
<?php
if(isset($_POST['save']))
{

$user_id=$_SESSION['user_id'];
$state=$_POST['currency'];
if ($state != "")
{
if(!mysql_query('INSERT INTO currency (name,created_by)VALUES ("'.$state.'","'.$user_id.'")'))
{
die('Error: ' . mysql_error());
}
echo '<div class="success_message">currency created successfully</div>';
}
else
{
echo '<div class="error_message">The name should not be empty</div>';
}
}

?>
<?php
if(isset($_POST['edit']))
{
$edit_id=$_POST['edit_id'];
$user_id=$_SESSION['user_id'];
$state=$_POST['currency'];
$current_date=date("Y-m-d H:i:s");
if ($state != "")
{
if(!mysql_query('UPDATE currency SET name="'.$state.'",updated_at="'.$current_date.'",updated_by="'.$user_id.'" WHERE id="'.$edit_id.'" '))
{
die('Error: ' . mysql_error());
}
echo '<div class="success_message">currency  updated successfully</div>';
}
else
{
echo '<div class="error_message">The name should not be empty</div>';
}
}

?>
<?php
if(isset($_GET['id']) && intval($_GET['id'])) 
{
$id=$_GET['id'];
$query = "SELECT * FROM currency where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
	$name=$row['name'];
	
}
}
?>
<div id="inside_content">
&nbsp;
<form id='currency_save' action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()"  method='post' accept-charset='UTF-8'>

<table align="center" width="40%"CELLPADDING="3" CELLSPACING="0"  style=" border: 0px solid #00BFFF; border-top:0px;font-family: Arial;
    font-size: 12px;"      >
  <tr>
    <th style=" height: 29px;text-align: left;font-size: 14px;text-align:center">
currency
    </th>
  </tr>
  <tr>
    <td align="center" style=" padding:30px 50px 30px 0px;">
  

<input type='hidden' name='submitted' id='submitted' value='1'/>
             <!-- The inner table below is a container for form -->
                <table style="font-family:Arial;" width="100%"  cellpadding="10px" class="htmlForm" cellspacing="0" border="0">

                    <tr>
                       <td  width="150px"><label style="margin-left:0px;">currency<em style="font-style:normal;color:red;">*</em></label></td>
                        <td>
						<?php if(isset($_GET['id'])){ ?>
							<input type='text' name='currency' id='currency' class="textbox" value="<?php echo $name; ?>"/>
				
						<?php } else {?>
							<input type='text' name='currency' id='currency' class="textbox"/>
						<?php }?>
						</td>
                    </tr>
		<tr >
            <td  width="150px" >&nbsp;</td>
            <td align="right">
			<?php if(isset($_GET['id'])){ ?>
			<input type='submit'  class="flatbutton" name='edit' id="edit" value='Save'/>
			<input type='hidden' name='edit_id' id='edit_id' value='<?php echo $_GET['id'];?>'/>
			<?php } else {?>
			<input type='submit'  class="flatbutton" name='save' id="save" value='Save'/>
			<?php }?>
			
             <input type='button'  class="flatbutton"  value='Clear'  onclick="return myFunction()"/>
        

            </td>
        </tr>
		
		
                </table>
                </form>            </td>

        </tr>




    </table>
	</form>
	<div id="search" style="float:right;padding-right:220px;">

<table>
<tr>
<td>
<input type="text" class="textbox" placeholder="Search By Name" autocomplete="off" value="" name="searchname" id="searchname"/>
</td>
<td>
<img src="images/search.png" height="" alt="" border="0" id="imageclick"></img>
</td>
</tr>
</table>

     
</div>
<br/>
<br/>
	<div id="content" ></div>



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