<!DOCTYPE html>
<html>
    <head>
    <style type="text/css">
    body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: rosybrown;
        }
        </style>
    </head>
<body >

<?php
 
echo "<b><i>รหัสนักศึกษา 65543206073-0 </i><b><br><br>";
echo "แม่สูตรคูณ 73 <br><br>";
$i = 1;
do {
	$j = 73 * $i;
  echo"73 X $i : $j <br>";
  $i++;
} while ($i <= 12);

?>
<a href= "index.html"> BACK </a>
</body>
</html>