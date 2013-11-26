

<script>
function validation()
{
var filenamee=document.getElementById("file").value;
var abc=filenamee.split('.').pop();
	alert(abc);
}
</script>
<?php
if(isset($_POST['submit']))
{
$allowedExts = array("gif", "jpeg", "jpg", "png","pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if (in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("uploads/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "uploads/" . $_FILES["file"]["name"]);
     // echo "Stored in: " . "uploads/" . $_FILES["file"]["name"];
      }
    }
  }
	else
	{
	echo "Invalid file";
	}
		
  }
?>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data" onsubmit="return validation()">
<label for="file">Filename:</label>
<input type="file" name="file" id="file">
<input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
