<?php include("header.php");include("admin-panel.php");
$sql = "select * from comments";
$query = mysql_query($sql);
while($rs = mysql_fetch_array($query)){
    $score_id = $rs['score_id'];
    $sql2 = "select score_title from scores where id=$score_id limit 1";
    $query2 = mysql_query($sql2);
    $rs2 = mysql_fetch_array($query2);
?>
    <form action="process-page.php" method="post">
        Username: <span class="weighted-font"><?=$rs['username']?></span> Post on <a href="scores.php?id=<?=$score_id?>">
            <span class="weighted-font"><?=$rs2['score_title']?></span></a> <br>
        Date: <?=$rs['date']?><br>
        Content:  <span class="weighted-font"><?=$rs['contents']?></span><br>
        <div style="text-align: center">
            <br><input type="submit" value="Delete" name="del-comment-admin">
        </div>
        <input type="hidden" name="comment-id" value="<?=$rs['id']?>">
    </form>
<?php }?>

<?php include("footer.php");?>