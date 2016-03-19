<?php include("header.php");include("admin-panel.php");
$sql = "select * from wanted ORDER by id ASC ";
$query = mysql_query($sql);
?>
<script>
    function myCheck(){
        return confirm("DO you want to delete?");
    }
</script>
<?php while($rs=mysql_fetch_array($query)){?>
    <form action="process-page.php" method="post" onsubmit="return myCheck()">
        <h1>Check Wanted Posts</h1>
        <label>Anime or Game Title: </label>
        <input type="text" id="fromWhich" name="fromWhich" value="<?=$rs['anige_title']?>" readonly="readonly">
        <input type="button" value="select" onclick = "show_anige_info_table()"><br>

        <div id="anige_info_table_control" style="display: none">
            <hr class="style-one">

            <?php $pid=0; include("anige-score-table.php");?>

            <hr class="style-one">
        </div>
        <br>
        <div>
            <label for="title">*Song Title (Japanese):</label>
            <input type="text" id="title" name="title" value="<?=$rs['score_title']?>"><br>
        </div>
        <br>
        <input type="radio" id="OP" value="OP" name="musicType" <?php if($rs['occasion']=='OP'){echo 'checked';}?>><label for="OP" class="light">OP</label>
        <input type="radio" id="ED" value="ED" name="musicType" <?php if($rs['occasion']=='ED'){echo 'checked';}?>><label for="ED" class="light">ED</label>
        <input type="radio" id="BGM" value="BGM" name="musicType" <?php if($rs['occasion']=='BGM'){echo 'checked';}?>><label for="BGM" class="light">BGM</label>
        <input type="radio" id="Others" value="Others" name="musicType" <?php if($rs['occasion']=='Others'){echo 'checked';}?>><label for="Others" class="light">Others</label>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?=$rs['anige_title']?></textarea>
        </div>

        <div style="text-align: center">
            <input type="hidden" name="w-wanted-id" value="<?=$rs['id']?>">
            <input type="submit" name="sub-checked-wanted" value="Edit">
        </div>
        <input type="submit" name="del-checked-wanted" value="Delete">
    </form>
    <hr class="style-one">
<?php }?>
<?php include("footer.php");?>