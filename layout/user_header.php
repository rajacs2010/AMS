<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <link rel="shortcut icon" href="../images/favicon.ico" />
  <title>AMS</title>
  <meta name="description" content=""/>
  <meta name="keywords" content=""/>

  <meta http-equiv="Content-Type"
 content="text/html; charset=iso-8859-1"/>

   
<link rel="stylesheet" href="style/superfish.css" media="screen">
		
		<script src="scripts/jquery.js"></script>
		<script src="scripts/jquery_pagination.js"></script>
		<script src="scripts/hoverIntent.js"></script>
		<script src="scripts/superfish.js"></script>
		<script>

		(function($){ //create closure so we can safely use $ as alias for jQuery

			$(document).ready(function(){

				// initialise plugin
				var example = $('#example').superfish({
					//add options here if required
				});

				// buttons to demonstrate Superfish's public methods
				$('.destroy').on('click', function(){
					example.superfish('destroy');
				});

				$('.init').on('click', function(){
					example.superfish();
				});

				$('.open').on('click', function(){
					example.children('li:first').superfish('show');
				});

				$('.close').on('click', function(){
					example.children('li:first').superfish('hide');
				});
			});

		})(jQuery);


		</script>
		<script type = "text/javascript" >
function disableBackButton()
{
window.history.forward();
}
setTimeout("disableBackButton()", 0);

</script> 
  <style type="" >
    body a {color:#ffffff;}
.bottom a{color:#ffffff; text-decoration: none;}
.htmlForm td{
    font-family: Arial;
    font-size:14px;
    color:#3b3b3b;

}
.htmlForm input[type="text"],input[type="password"]{
    border:1px #00BFFF solid;
    font-family:Arial;
    font-size:14px;
    padding:2px;
     background-color:#F2F5F7;
}

.htmlForm select{
    border:1px #00BFFF solid;
    font-family:Arial;
    font-size:14px;
    padding:2px;
     background-color:#F2F5F7;
	 width:157px;
}
.htmlForm input[type="file"]{
    border:1px #00BFFF solid;
    font-family:Arial;
    font-size:14px;
    padding:2px;
     background-color:#F2F5F7;
	  width:150px;
	  height:23px;
}
  .header
  {
  margin: 0 auto;
    width: 1000px;

background-color:#00BFFF;
 
  }
  .footer
  {
   margin: 0 auto;
    width: 1000px;

background-color:#00BFFF;
  }
  .bodycontent
  {
  margin: 0 auto;
    width: 996px;
  border: 2px solid #00BFFF; 
  border-top:0px;
   border-bottom:0px;
   height:540px;
  }
  </style>
</head>
 <body >
   
<div class="page">
<div class="top">
<div class="header">
<div class="header-top">
<table width="100%"><tbody><tr><td width="10%"><a href="#"><img alt="fmcl" src="images/logo_fmcl.png" border="0" width="70" height="70"></a></td><td width="78%" align="center" style="padding-right:70px"> <em style="color:#0092b3;font-style: normal; font-weight: bold;font-size: 30px;"> Ticketing System</em>
</td><td width="10%" align="right"><a href="#"><img alt="fmcl" src="images/kcs.png" border="0" width="70" height="70"/></a></td></tr></tbody>
<tr>
<td width="15%">
Welcome <?= $fgmembersite->UserFullName(); ?>
</td>

</tr></table>
</div>
</div>
</div>

</div>
 <div class="bodycontent">
<div class="content">
		<ul class="sf-menu" id="example">
		
		<!---- first menu start------>
			<li class="current">
				<a href="#">Request Form</a>
				<ul>
					
					
				</ul>
			</li>
			<!---- first menu end------>
			<!----- second menu start---->
				<li class="current">
				<a href="#">Request Status</a>
				<ul>
					
					
				</ul>
			</li>
				<!---- second menu end---->
			<!----  third menu start---->
				<li class="current">
				<a href="change-pwd.php">Change Password</a>
				<ul>
					
					
				</ul>
			</li>
			<!---- third menu end------->
			
			<!-------- fourth Menu start---------->
			<li class="current">
				<a href="#">User</a>
			<ul>
			<li class="current">
						<a href="logout.php">Log out</a>
						
					</li>
					</ul>
					</li>
			<!---------fourth menu end------>
				
		</ul>

