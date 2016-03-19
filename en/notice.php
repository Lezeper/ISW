<?php include "header.php"; include "admin-panel.php";

$sql = "select * from notice";
$query = mysql_query($sql);
$num = 0;
while($rs = mysql_fetch_array($query)){$num++;
    echo "#".$num;
    echo "<br>";
    if(substr($rs['source_id'],0,1) == 's'){
        $id = substr($rs['source_id'],1);
        $sql2 = "select * from scores where id=$id limit 1";
        $query2 = mysql_query($sql2);
        $rs2 = mysql_fetch_array($query2);
        $song_title = $rs2['score_title'];
        echo "Song: ".$song_title;
    }else if(substr($rs['source_id'],0,1) == 'a'){
        $id = substr($rs['source_id'],1);
        $sql2 = "select * from anige where id=$id limit 1";
        $query2 = mysql_query($sql2);
        $rs2 = mysql_fetch_array($query2);
        $anige_title = $rs2['anige_title'];
        echo "Anige: ".$anige_title;
    }
    echo "<br>";
    if(!empty($rs['content'])){
        echo $rs['content'];
        echo "<br>";
    }
    if(!empty($rs['link'])){
        $link =  $rs['link'];
        echo "<a href='$link'>$link</a>";
        echo "<br>";
    }
    echo "<br>";
    ?>
    <a href="process-page.php?delete-notice=<?=$rs['id']?>"><button>Delete</button></a>
    <hr class="style-one">
<?php }?>

<?php include "footer.php";?>