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
$("#page_show").load("ajax_viewbuilding.php");

//PAGE NUMBER onClick FUNCTION
$(".page").live("click", function(){
var page = $(this).attr("id");
$("#page_show").load("ajax_viewbuilding.php?page="+page);
});
});
</script>


<script src="scripts/jquery_pagination.js"></script>
<script>
$(document).ready(function(){
  $("#imageclick").click(function(){
 var searchvalue=$('#searchname').val();
 var searchvalue=$.trim(searchvalue).replace(/ /g,'+');
$("#page_show").load("ajax_viewbuilding.php?searchvalue="+searchvalue);
  });
});
</script>
<?php
if(isset($_GET['delete_id']) && intval($_GET['delete_id'])) 
{
if ($_GET['delete'] ==1)
{
$id=$_GET['delete_id'];
$query = "SELECT * FROM building where id=$id"; 

$result = mysql_query($query);
if($result === FALSE) {
    die(mysql_error()); // TODO: better error handling
}

while($row = mysql_fetch_array($result))
{
$saleagreement=$row['building_saleagreement'];
$leasedead=$row['leasedead'];
$attach4=$row['attach4'];
$attach5=$row['attach5'];
$attach6=$row['attach6'];
$attach7=$row['attach7'];
$attach8=$row['attach8'];
$attach9=$row['attach9'];
}

if(file_exists("uploads/" . $saleagreement))
 {
	 if ($saleagreement!="")
	 {
		unlink("uploads/" . $saleagreement); 
	}
 }
 if(file_exists("uploads/" . $leasedead))
 {
	if ($leasedead!="")
	 {
		unlink("uploads/" . $leasedead); 
	}
 }
 if(file_exists("uploads/" . $attach4))
 {
	if ($attach4!="")
	 {
		unlink("uploads/" . $attach4); 
	}
 }
 if(file_exists("uploads/" . $attach5))
 {
	if ($attach5!="")
	 {
		unlink("uploads/" . $attach5); 
	}
 }
 if(file_exists("uploads/" . $attach6))
 {
	if ($attach6!="")
	 {
		unlink("uploads/" . $attach6); 
	}
 }
 if(file_exists("uploads/" . $attach7))
 {
	if ($attach7!="")
	 {
		unlink("uploads/" . $attach7); 
	}
 }
  if(file_exists("uploads/" . $attach8))
 {
	if ($attach8!="")
	 {
		unlink("uploads/" . $attach8); 
	}
 }
 if(file_exists("uploads/" . $attach9))
 {
	if ($attach9!="")
	 {
		unlink("uploads/" . $attach9); 
	} 
 }
 $delete_query = "delete FROM building where id=$id"; 
 $delete_result = mysql_query($delete_result);
 if(!mysql_query("delete FROM building where id=$id"))
{
die('Error: ' . mysql_error());
}
 echo '<div class="success_message">buiding deleted successfully</div>';

 // 
  //echo "hi";
}
}
?>
<div id="inside_content">
&nbsp;
<div class="header_bold">View Building</div>
<br/>
<br/>
<br/>
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
<br/>
<br/>

	<div id="page_show"></div>


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