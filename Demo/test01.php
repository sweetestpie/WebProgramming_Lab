<?php
$get_score = $_POST['Score'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Score</title>
    <style type="text/css">
      body{
        background: rosybrown;
      }
      .center{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 5vh;
            width: 60vh;
            background: rosybrown;
      }
      fieldset {
            border-color: rgb(177, 81, 81);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 5vh;
            width: 60vh;
        }
      .style1{
            background-color: red;
      }
      .style2{
            background-color: #fbd741;
      }
      .style3{
            background-color: green;
      }
      </style>
</head>
<body>
<h1>YOUR SCORE!!</h1>

   <table> <tr><h1><?php 
    
    $css_class = "";
    if ($get_score < 50) {
        echo" $get_score คะแนน : ได้รับระดับคะแนน F";
        $css_class ="style1";
      } elseif ($get_score < 55) {
        echo" $get_score คะแนน : ได้รับระดับคะแนน D";
      } elseif($get_score < 60) {
        echo" $get_score คะแนน : ได้รับระดับคะแนน D+";
      } elseif ($get_score < 65) {
        echo" $get_score คะแนน : ได้รับระดับคะแนน C";
      } elseif($get_score < 70) {
        echo" $get_score คะแนน : ได้รับระดับคะแนน C+";
      } elseif($get_score < 75) {
        echo" $get_score คะแนน : ได้รับระดับคะแนน B";
      } elseif ($get_score < 80) {
        echo" $get_score คะแนน : ได้รับระดับคะแนน B+";
      } elseif($get_score >= 80) {
        echo" $get_score คะแนน : ได้รับระดับคะแนน A";
      }
      ?></h1>
      <td class="<?=$css_class?>"></td>
      <tr>
     </table>
      <a href= "Grade.html"> BACK </a>
</body>
</html>