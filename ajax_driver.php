<?php
require_once("./include/membersite_config.php");
$fgmembersite->DBLogin();
if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<?php

if($_GET["selvalue_incharge_empcode"])
{
$emp_code=$_GET["selvalue_incharge_empcode"];
?>
<input type='text' name='emp_code' id='emp_code' class="textbox" value="<?php echo $emp_code; ?>" readonly="true"/>
<?php
}
?>
<?php
if($_GET["selvalue_driver"])
{
$selvalue=$_GET["selvalue_driver"];
$result=mysql_query("SELECT a.id  as id ,a.name,b.name as state_name FROM city a, state b where a.state_id=b.id and a.id=$selvalue");
						   while($row=mysql_fetch_array($result))
							{
							$state=$row['state_name'];
							}
?>
<input type='text' name='state_driver' id='state_driver' class="textbox" value="<?php echo $state; ?>" readonly="true"/>
<?php
}
?>