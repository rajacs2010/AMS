<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("index.php");
    exit;
}

?>
<link media="screen" rel="stylesheet" href="style/fixed_table_header/960.css">
        <link media="screen" rel="stylesheet" href="style/fixed_table_header/defaultTheme.css">
        <link media="screen" rel="stylesheet" href="style/fixed_table_header/myTheme.css">
        <script src="scripts/fixed_table_header/jquery.min.js"></script>
        <script src="scripts/fixed_table_header/jquery.fixedheadertable.min.js"></script>
        <script src="scripts/fixed_table_header/demo.js"></script>
		<script>
		function show_confirm()
{
var r=confirm("Are you sure want to delete");
if (r==true)
  {
  return true;
  }
else
  {
  return false;
  }
}
</script>
<?php
	$fgmembersite->DBLogin();
//PAGE NUMBER, RESULTS PER PAGE, AND OFFSET OF THE RESULTS
if($_GET["page"]){
    $pagenum = $_GET["page"];
} else {
    $pagenum = 1;
}

$rowsperpage = 7; //MAXIMUM RESULTS PER PAGE
$offset = ($pagenum - 1) * $rowsperpage; //WHERE THE RESULTS START FROM

//FOR RESULTS OF THE PAGE
if($_GET["searchvalue"]){
$search=$_GET["searchvalue"];
    $q = mysql_query("SELECT *,b.name,a.id as eid FROM building a ,building_type b where a.building_type=b.id and a.building_name like '%$search%' ORDER BY a.id LIMIT $offset, $rowsperpage");
} else {
    $q = mysql_query("SELECT *,b.name,a.id as eid  FROM building a ,building_type b where a.building_type=b.id  ORDER BY a.id LIMIT $offset, $rowsperpage");
}

$page_nums = mysql_num_rows($q); //NUMBER OF RESULTS FOR THE PAGE
if ($page_nums!=0)
{
if($_GET["searchvalue"]){
$search=$_GET["searchvalue"];
	 $total_q = mysql_query("SELECT *,b.name,a.id as eid  FROM building a ,building_type b where a.building_type=b.id and  a.building_name like '%$search%' "); //FOR THE ALL RESULTS
} else {
    $total_q = mysql_query("SELECT *,b.name,a.id as eid  FROM building a ,building_type b where a.building_type=b.id "); //FOR THE ALL RESULTS
}

$total_nums = mysql_num_rows($total_q); //TOTAL NUMBER OF RESULTS
$total_pages = ceil($total_nums/$rowsperpage); //NUMBER OF PAGES
//<table class="myTable01">
//IF PAGE NUMBER IS WITHIN THE FIRST AND LAST PAGES
if($pagenum>=1&&$pagenum<=$total_pages)
{

echo '
<table class="owntable">
<thead>
<tr>
<th>Building Name</th>
<th>Building code</th>
<th>Building type</th>
<th>Building status</th>
<th>Edit</th>
<th>Delete</th>

</tr>
</thead>
<tbody>';

    while($r=mysql_fetch_array($q))
    {
	
	
        $content = $r["building_name"];
		$emp_id = $r["eid"];
		$building_code=$r["building_code"];
		$name=$r["name"];
		
		$status=$r["building_status"];
		
		if($status== 1)
		{
		$building_status="owned";
		}
		elseif($status== 2)
		{
		$building_status="rented";
		}
		else
		{
		$building_status="lease";
		}
        echo '<tr><td>'.$content.'</td><td>'.$building_code.'</td><td>'.$name.'</td><td>'.$building_status.'</td><td><a href=edit_building.php?id='.$emp_id.'><img src="images/user_edit.png"/></a></td>
		<td><a href=view_building.php?delete_id='.$emp_id.'&delete=1><img src="images/delete.png" onclick="return show_confirm()"/></a></td></tr>';
	
    }
    echo '</tbody></table>';
    echo '<br>';
    
    //IF ANY RESULTS
    if($total_nums)
    {
        $range = 4; //NUMBER OF PAGES TO BE SHOWN BEFORE AND AFTER THE CURRENT PAGE NUMBER
        
        //FIRST, PREVIOUS, NEXT, AND LAST LINKS
        if($pagenum>1)
        {
            $page = $pagenum - 1;
            $first = '<a class="page" id="1" >First</a> ';
            $prev = '<a class="page" id="'.$page.'"><<</a> ';
        }
        if($pagenum<$total_pages)
        {
            $page = $pagenum + 1;
            $next = '<a class="page" id="'.$page.'">>></a> ';
            $last = '<a class="page" id="'.$total_pages.'">Last</a> ';
        }
        
        //PAGINATION
        for($page=($pagenum-$range); $page<=($pagenum+$range); $page++)
        {
            if($page>=1&&$page<=$total_pages)
            {
                if($page==$pagenum)
                {
                    $nav .= '<span class="pagenum">'.$page.'</span> ';
                }
                else
                {
                    $nav .= '<a class="page" id="'.$page.'">'.$page.'</a> ';
                }
            }
        }
    }
    
    //DISPAYS IN HTML
	if ($total_nums>$rowsperpage)
	{
	 echo $first . $prev . $nav . $next . $last;
	}
	
} 
else {
    //OTHERWISE...
    header("Location: ajax_viewbuilding.php"); //WILL REDIRECT TO THE FIRST PAGE OF RESULTS
}
}
else
{
$q_initial = mysql_query("SELECT * FROM building");
$page_nums_initial = mysql_num_rows($q_initial);
if ($page_nums_initial !=0)
{
echo '
<table class="owntable">
<thead>
<tr>
<th>Building Name</th>
<th>Building code</th>
<th>Building type</th>
<th>Building status</th>
<th>Edit</th>
<th>Delete</th>

</tr>
</thead>
<tbody>
<tr>
<td align="right" colspan="6">
<font style="font-size: 16px;color:red;padding-right:230px;">No Records Found</font>
</td>


</tr>
</tbody>
</table>
';
}
}
?>
