<?php include("header.php");

if(!empty($_POST['update-history']))
{
    $content = $_POST['content'];
    $sql = "update history set content='$content' where id=1";
    mysql_query($sql);
}

$sql = "select * from history where id=1";
$query = mysql_query($sql);
$rs = mysql_fetch_array($query);
?>
<form>
    <div style="width: 450px;margin:0 auto;">
        <h2 style="text-align: center">Update History</h2>
        <div style="">
            <br>
            <?=$rs['content']?>
        </div>
        <br>
    </div>
</form>

<?php
if( isset($_SESSION['log']) && ($_SESSION['log'] == 'admin') ){?>
<br>
    <div style="text-align: center">
        <form action="history.php" method="post">
            <textarea rows="25" name="content"><?=$rs['content']?></textarea>
            <input type="submit" value="Update" name="update-history">
        </form>
    </div>
<?php }

include("footer.php");?>