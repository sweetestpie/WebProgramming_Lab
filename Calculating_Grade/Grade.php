<?php
$get_score = $_POST['Score'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style type="text/css">
 .center{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 5vh;
            width: 60vh;
            background: rosybrown;
      }
.mystyle1{
    background-color: #dc493f;
}
.mystyle2{
    background-color: #fbd741;
}
.mystyle3{
    background-color:rgb(42, 141, 66);
}
</style>

</head>
<body bgcolor="rosybrown">
<center>
<h1>YOUR SCORE!!</h1>
<table>
    <tr>
<?php
$data_value="";
$css_class="";
if ($get_score < 50) {
    $data_value= " $get_score คะแนน : ได้รับระดับคะแนน F";
    $css_class ="mystyle1";
  } elseif ($get_score < 55) {
    $data_value= " $get_score คะแนน : ได้รับระดับคะแนน D";
    $css_class ="mystyle2";
  } elseif($get_score < 60) {
    $data_value= " $get_score คะแนน : ได้รับระดับคะแนน D+";
    $css_class ="mystyle2";
  } elseif ($get_score < 65) {
    $data_value= " $get_score คะแนน : ได้รับระดับคะแนน C";
    $css_class ="mystyle2";
  } elseif($get_score < 70) {
    $data_value= " $get_score คะแนน : ได้รับระดับคะแนน C+";
    $css_class ="mystyle2";
  } elseif($get_score < 75) {
    $data_value= " $get_score คะแนน : ได้รับระดับคะแนน B";
    $css_class ="mystyle3";
  } elseif ($get_score < 80) {
    $data_value= " $get_score คะแนน : ได้รับระดับคะแนน B+";
    $css_class ="mystyle3";
  } elseif($get_score >= 80) {
    $data_value= " $get_score คะแนน : ได้รับระดับคะแนน A";
    $css_class ="mystyle3";
  } 
  ?>
   
        <td class="<?=$css_class?>">
        <?=$data_value?>
        </td>
    </tr>
</table><br><br>
<a href= "Grade.html"> BACK </a>
</center>
</body>
</html>