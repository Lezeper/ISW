<?php include("header.php");include("admin-panel.php");
$sql = "select * from w_scores";
$query = mysql_query($sql);
$number = 0;
$images=null;
while($rs = mysql_fetch_array($query)){$number++;
    //$images = explode("*",$rs['images']);

    $score_id = $rs['score_id'];
    $sql2 = "select score_title from scores where id=$score_id limit 1";
    $query2 = mysql_query($sql2);
    $rs2 = mysql_fetch_array($query2);

    if($rs['images']!= null){
        $dirname = '../score_img/w_s'.$score_id;
        $images = scandir($dirname);

    }?>
    <form method="post" action="process-page.php?this_score_id=<?=$score_id?>">
        <div style="text-align: center">
            <h2>#<?=$number?></h2>
            <h1>Check Upload Score Images</h1>
        </div>
        <label><strong>Song Title</strong></label>
        <input type="text" value="<?=$rs2['score_title']?>" readonly="true">
        <div>
            <span id="need-to-fill"><strong>Image files:</strong></span><br>

            <div id="upload_work">
                <?php if($images!=null){
                $img_folder = '../score_img/w_s'.$score_id;
                for($i=2;$i<count($images);$i++){
                    $img_path = $img_folder.'/'.$images[$i];?>
                    <div id="<?='*'.$images[$i]?><?=$score_id?>">
                        <input type="button" value="X" style="float: left" onclick="delete_img_admin('<?='*'.$images[$i]?>','<?=$score_id?>')">
                        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';">
                            <a href="<?=$img_path?>" target="_blank"><img width="40%" style="float: left" src="<?=$img_path?>"></a>
                        </a>
                    </div>
                <?php }
                }else{echo "No Images";}?>
                <br><br>
                <label><strong>Chord Progress</strong></label>
                <?php if($rs['harmonic']!=null){?>
                    <textarea rows="10" cols="1" name="chord<?=$score_id?>"><?=$rs['harmonic']?></textarea>
                <?php }else{echo "No Chord Progress";}?>
                <br clear="both">
                <input type="hidden" id="up-images<?=$score_id?>" name="up-images<?=$score_id?>" value="<?=$rs['images']?>">
                <div id="show-uploaded-img"></div>
            </div>
        </div>
        <div style="text-align: center">
            <input type="submit" name="checked-score-admin" value="Checked">
        </div>
        <input type="submit" name="del-score-admin" value="Delete">
    </form>

<?php }?>

<?php include("footer.php");?>