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
$("#page_show").load("ajax_viewdriver.php");

//PAGE NUMBER onClick FUNCTION
$(".page").live("click", function(){
var page = $(this).attr("id");
$("#page_show").load("ajax_viewdriver.php?page="+page);
});
});
</script>


<script src="scripts/jquery_pagination.js"></script>
<script>
$(document).ready(function(){
  $("#imageclick").click(function(){
 var searchvalue=$('#searchname').val();
 var searchvalue=$.trim(searchvalue).replace(/ /g,'+');
$("#page_show").load("ajax_viewdriver.php?searchvalue="+searchvalue);
  });
});
</script>
<?php
if(isset($_GET['delete_id']) && intval($_GET['delete_id'])) 
{
if ($_GET['delete'] ==1)
{
 $id=$_GET['delete_id'];
 $delete_query = "delete FROM driver where id=$id"; 
 $delete_result = mysql_query($delete_result);
 if(!mysql_query("delete FROM driver where id=$id"))
{
die('Error: ' . mysql_error());
}
 echo '<div class="success_message">driver deleted successfully</div>';

 // 
  //echo "hi";
}
}
?>
<div id="inside_content">
&nbsp;
<div class="header_bold">View Driver</div>
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