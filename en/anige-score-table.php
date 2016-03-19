<link rel="stylesheet" href="http://cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
<script src="http://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $("#songs_info_table tr").click(function(){
            $(this).addClass("selected").siblings().removeClass("selected");
        });
    });

</script>
<?php
if(isset($pid)) {
    // show anige title. operate by edit song.
    if ($pid == 0) {
        ?>
        <table id="anige_info_table<?php if(isset($temp)){echo $temp;}?>">
            <thead>
            <tr>
                <th>Date</th>
                <th>Anige Title</th>
                <th>Existing Song</th>
            </tr>
            </thead>
            <?php
            $sql2 = "select id,anige_title,anige_roma,anige_year,anige_month from anige ";
            $query2 = mysql_query($sql2);
            while ($rs2 = mysql_fetch_array($query2)) {$id = $rs2['id']?>
                <tr onclick="select_anige('<?= $rs2['anige_title'] ?>',<?=$id?>)">
                    <td><?= $rs2['anige_year'] ?>-<?= $rs2['anige_month'] ?></td>
                    <td><?= $rs2['anige_title'] ?><?php if (!empty($rs2['anige_roma'])) { ?>(<?= $rs2['anige_roma'] ?>)<?php }?></td>
                    <?php
                    $sql3 = "select id,score_title,occasion from scores where anige_id = $id";
                    $query3 = mysql_query($sql3);
                    ?>
                    <td><?php while ($rs3 = mysql_fetch_array($query3)) {
                            ; ?>
                            <?= $rs3['score_title'] ?> [<?=$rs3['occasion']?>]<br><hr class="style-one">
                        <?php }?>
                    </td>
                </tr>
            <?php }?>
        </table>
        <div style="text-align: center">
            <br>
            <input type="button" value="OK" onclick="seleted_anige()"><br><br>
        </div>
        <input type="button" value="Anige Not Found?Add one!" onclick="show_edit_anige_control(1)">
        <br><br>
        <hr class="style-one">
    <?php }?>

    <?php
    // operate from score.php to display scores list
    if ($pid == 1) {
        ?>
        <table id="scores_info_table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Song Title</th>
                <th>Occasion</th>
                <th>From</th>
                <th>Singer</th>
                <th>Composer</th>
                <th>Arranger</th>
            </tr>
            </thead>
            <?php
            $sql2 = "select score_title,singer,composer,arranger,id,anige_id,occasion from scores ";
            $query2 = mysql_query($sql2);
            while ($rs2 = mysql_fetch_array($query2)) {
                $anige_id = $rs2['anige_id'];
                $sql3 = "select * from anige where id='$anige_id' limit 1 ";
                $query3 = mysql_query($sql3);
                $rs3 = mysql_fetch_array($query3);

                $score_id = $rs3['id'];
                $sql4 = "select * from scores_roma where score_id='$score_id' limit 1 ";
                $query4 = mysql_query($sql4);
                $rs4 = mysql_fetch_array($query4)
                ?>
                <tr>
                    <td><?= $rs3['anige_year'] ?>-<?= $rs3['anige_month'] ?></td>
                    <td><a href="scores.php?id=<?= $rs2['id'] ?>"><?= $rs2['score_title'] ?></a></td>
                    <td><?=$rs2['occasion']?></td>
                    <td><?= $rs3['anige_title'] ?></td>
                    <td><?= $rs2['singer'] ?><?php if(!empty($rs4['singer_roma'])){echo ' (';echo $rs4['singer_roma']; echo ')';}?></td>
                    <td><?= $rs2['composer'] ?><?php if(!empty($rs4['composer_roma'])){echo ' (';echo $rs4['composer_roma']; echo ')';}?></td>
                    <td><?= $rs2['arranger'] ?><?php if(!empty($rs4['arranger_roma'])){echo ' (';echo $rs4['arranger_roma']; echo ')';}?></td>
                </tr>
            <?php }?>
        </table>
    <?php }?>

    <?php
    // display song lists(whether have score or not) operate by cover.php
    if ($pid == 2) {?>
        <table id="songs_info_table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Song Title</th>
                <th>From</th>
            </tr>
            </thead>
            <?php
            // get score info
            $sql3 = "select id,score_title,occasion,anige_id from scores ";
            $query3 = mysql_query($sql3);
            while ($rs3 = mysql_fetch_array($query3)) {
                // get anige info
                $anige_id = $rs3['anige_id'];
                $sql2 = "select id,anige_title,anige_roma,anige_year,anige_month from anige where id = $anige_id limit 1";
                $query2 = mysql_query($sql2);
                $rs2 = mysql_fetch_array($query2);
                // get song title roma
                $score_id = $rs3['id'];
                $sql4 = "select id,score_title_roma from scores_roma where score_id = $score_id limit 1";
                $query4 = mysql_query($sql4);
                $rs4 = mysql_fetch_array($query4);
                ?>
                <tr onclick="select_song_info('<?= $rs2['anige_title'] ?>',<?=$rs3['id']?>,'<?=$rs3['score_title']?>')">
                    <td><?= $rs2['anige_year'] ?>-<?= $rs2['anige_month'] ?></td>
                    <td>
                        <?= $rs3['score_title'] ?> <?php if($rs4['score_title_roma']!=null){echo " (".$rs4['score_title_roma'].")";}?>
                        <br>
                    </td>
                    <td><?= $rs2['anige_title'] ?><?php if (!empty($rs2['anige_roma'])) { ?>(<?= $rs2['anige_roma'] ?>)<?php }?> [<?=$rs3['occasion']?>]</td>
                </tr>
            <?php }?>
        </table>
        <div style="text-align: center">
            <br>
            <input type="button" value="OK" onclick="seleted_song()">
        </div>
       <input type="button" value="Not Found?Add one!" onclick="show_edit_song_control(3)">
        <Br>
    <?php }?>

    <?php
    // operate from editScore.php and wanted
    if ($pid == 3) {
    ?>
    <table id="songs_info_table<?php if(isset($temp)){echo $temp;}?>">
        <thead>
        <tr>
            <th>Date</th>
            <th>Song Title</th>
            <th>From</th>
        </tr>
        </thead>
        <?php
        // get score info
        $sql3 = "select id,score_title,occasion,anige_id,sub_score,wanted from scores ";
        $query3 = mysql_query($sql3);
        while ($rs3 = mysql_fetch_array($query3)) {
            // get anige info
            $id = $rs3['anige_id'];
            $sql2 = "select id,anige_title,anige_roma,anige_year,anige_month from anige where id = $id limit 1";
            $query2 = mysql_query($sql2);
            $rs2 = mysql_fetch_array($query2);
            // get song title roma
            $score_id = $rs3['id'];
            $sql4 = "select id,score_title_roma from scores_roma where score_id = $score_id limit 1";
            $query4 = mysql_query($sql4);
            $rs4 = mysql_fetch_array($query4);
            ?>
            <tr onclick="select_song('<?= $rs2['anige_title'] ?>',<?=$id?>,<?=$rs3['id']?>,'<?=$rs3['score_title']?>',<?=$rs3['sub_score']?>)">
                <td><?= $rs2['anige_year'] ?>-<?= $rs2['anige_month'] ?></td>
                <td>
                    <?php if($rs3['sub_score']==1){ echo "<a href=\"scores.php?id=".$rs3['id']."\">"; }?>
                    <?= $rs3['score_title'] ?> <?php if($rs4['score_title_roma']!=null){echo " (".$rs4['score_title_roma'].")";}?><?php if($rs3['sub_score']==1){echo "*";}?>
                    <?php if($rs3['sub_score']==1){ echo "</a>";}?><?php if($rs3['wanted']==1){echo "[wanted!]";}?>
                    <br>
                </td>
                <td><?= $rs2['anige_title'] ?><?php if (!empty($rs2['anige_roma'])) { ?>(<?= $rs2['anige_roma'] ?>)<?php }?> [<?=$rs3['occasion']?>]</td>
            </tr>
        <?php }?>
    </table>
    <div style="text-align: center">
        <br>
        <input type="button" value="OK" onclick="show_song_info_table('')">
    </div><br>
    <input type="button" value="Song Not Found?Add one!" onclick="show_edit_song_control(<?=$ppid?>)">
        <br>
<?php } ?>

<?php }?>
