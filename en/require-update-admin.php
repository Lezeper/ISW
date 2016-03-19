<?php include "header.php"; include "admin-panel.php";

$sql = "select * from require_update";
$query = mysql_query($sql);
while($rs = mysql_fetch_array($query)){
    $anige_title = null; $song_title = null;
    $get_id = $rs['source_id'];
    if(substr($get_id,0,1) == 'a'){
        // require to edit anige
        $id = substr($get_id,1);
        $sql2 = "select * from anige where id=$id limit 1";
        $query2 = mysql_query($sql2);
        $rs2 = mysql_fetch_array($query2);
        $anige_title = $rs2['anige_title'];

        $original = $rs2[$rs['title']];

    }else if(substr($get_id,0,1) == 's'){
        // require to edit song
        $id = substr($get_id,1);
        $sql2 = "select * from scores where id=$id limit 1";
        $query2 = mysql_query($sql2);
        $rs2 = mysql_fetch_array($query2);
        $song_title = $rs2['score_title'];

        $original = $rs2[$rs['title']];
    }
?>
    <div style="text-align: center">
        <?php if($anige_title!=null){?><h2>Modify Anige Info</h2><?php }?>
        <?php if($song_title!=null){?><h2>Modify Song Info</h2><?php }?>
    </div>
    <form action="process-page.php" method="post">
        <label>Title:</label>
        <input type="text" readonly="true" value="<?php if($anige_title!=null){echo $anige_title;}else if($song_title!=null){echo $song_title;}?>">
        <label>Modification :</label>
        <input type="text" readonly="true" value="<?=$rs['title']?>">
        <label>Original:</label>
        <input type="text" readonly="true" value="<?=$original?>">
        <label>New:</label>
        <input type="text" readonly="true" value="<?=$rs['change_value']?>">
        <labe>Notes:</labe>
        <textarea readonly="true"><?=$rs['notes']?></textarea>
        <labe>Code:</labe>
        <input type="text" value="<?=$rs['sql_content']?>" name="sql-content">
        <input type="hidden" value="<?=$rs['id']?>" name="require-update-id">
        <div style="text-align: center">
            <input type="submit" name="checked-require-update" value="Update">
        </div>
        <input type="submit" name="del-require-update" value="Delete">
    </form>

<?php }?>

<?php include "footer.php";?>