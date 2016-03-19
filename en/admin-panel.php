<?php
if( !isset($_SESSION['log']) || ($_SESSION['log'] != 'admin') ){
    //if the user is not allowed, display a message and a link to go back to login page
    echo "<script>location.href='login.php';</script>";
	exit();
}

$sql1 = "SELECT COUNT(1) FROM wanted";
$query1 = mysql_query($sql1);
$rs1=mysql_result($query1, 0);

$sql2 = "SELECT COUNT(1) FROM w_scores";
$query2 = mysql_query($sql2);
$rs2=mysql_result($query2, 0);

$sql3 = "SELECT COUNT(1) FROM anige";
$query3 = mysql_query($sql3);
$rs3=mysql_result($query3, 0);

$sql4 = "SELECT COUNT(1) FROM scores";
$query4= mysql_query($sql4);
$rs4=mysql_result($query4, 0);

$sql5 = "SELECT COUNT(1) FROM require_update";
$query5= mysql_query($sql5);
$rs5=mysql_result($query5, 0);

$sql6 = "SELECT COUNT(1) FROM comments";
$query6= mysql_query($sql6);
$rs6=mysql_result($query6, 0);

$sql7 = "SELECT COUNT(1) FROM notice";
$query7= mysql_query($sql7);
$rs7=mysql_result($query7, 0);
?>
<hr class="style-one">
<div id="menu">
    <ul class="hover-color-underline">
        <li><a href="notice.php">| Notice <span class="number_small"><?=$rs7?></span></a></li>
        <li onclick=""><a href="require-update-admin.php">| reqUpdate</a> <span class="number_small"><?=$rs5?></span></li>
        <li onclick=""><a href="score-img-admin.php">| subChord</a> <span class="number_small"><?=$rs2?></span></li>
        <li><a href="score-admin-page.php" >| Scores</a> <span class="number_small"><?=$rs4?></span></li>
        <li><a href="wanted-admin-page.php" >| Wanted</a> <span class="number_small"><?=$rs1?></span></li>
        <li><a href="anige-admin-page.php" >| Anige</a> <span class="number_small"><?=$rs3?></span></li>
        <li><a href="comment-admin.php">| Comments <span class="number_small"><?=$rs6?></span></a></li>
        <li onclick=""><a href="imageslider-admin.php">| ImageSlider |</a></li>
    </ul>
</div>
<hr class="style-one"><br>

<div id="show-admin-page"></div>