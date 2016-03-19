<?php include("header.php");include("admin-panel.php");?>
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
    <script src="http://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>

    <div class="center-margin-top">
        <h3>*Use double click to edit information</h3>
    </div>

    <div id="unfinished-anige-info" class="custom-table-style">
        <!----------------------------table 2----------------------------------->
        <table id="unfinished_song_info_table">
            <thead>
            <tr>
                <th>Music Title(JP)</th>
                <th>Anige Title(JP)</th>
                <th>Occasion</th>
                <th>Singer (JP)</th>
                <th>Composer (JP)</th>
                <th>Arranger (JP)</th>
                <th>Others</th>
            </tr>
            </thead>
            <?php
            $sql5 = "select score_title,id,occasion,singer,composer,arranger,anige_id from scores ";
            $query5 = mysql_query($sql5);
            while ($rs5 = mysql_fetch_array($query5)) {
                $anige_id = $rs5['anige_id'];
                $score_id = $rs5['id'];
                $sql6 = "select anige_title from anige where id =$anige_id limit 1 ";
                $query6 = mysql_query($sql6);
                $rs6 = mysql_fetch_array($query6);
                ?>
                <tr>
                    <td style="cursor: hand" id="stj-<?=$score_id?>" class="edit-this"><?php if($rs5['score_title']==null){ echo "/";}else{echo $rs5['score_title'];}?></td>
                    <td class="not-allow"><?=$rs6['anige_title']?></td>
                    <td style="cursor: hand" id="occ-<?=$score_id?>" class="edit-this"><?php if($rs5['occasion']==null){echo "/";}else{echo $rs5['occasion'];}?></td>
                    <td style="cursor: hand" id="sij-<?=$score_id?>" class="edit-this"><?php if($rs5['singer']==null){echo "/";}else{echo $rs5['singer'];}?></td>
                    <td style="cursor: hand" id="coj-<?=$score_id?>" class="edit-this"><?php if($rs5['composer']==null){echo "/";}else{echo $rs5['composer'];}?></td>
                    <td style="cursor: hand" id="arj-<?=$score_id?>" class="edit-this"><?php if($rs5['arranger']==null){echo "/";}else{echo $rs5['arranger'];}?></td>
                    <td colspan="5"><button type="button" id="other-staff-but<?=$score_id?>" onclick="unfinished_score_Staff_table(<?=$score_id?>)">Other staff</button>
                    <span id="unfinished_score_Staff-<?=$score_id?>" style="display: none">
                        <span class="others_staff">Guitar: </span><span style="cursor: hand;" class="edit-this" id="guj-<?=$score_id?>"></span><br>
                        <span class="others_staff">Bassist: </span><span style="cursor: hand;" class="edit-this" id="baj-<?=$score_id?>"></span><br>
                        <span class="others_staff">Drummer: </span><span style="cursor: hand;" class="edit-this" id="drj-<?=$score_id?>"></span><br>
                        <span class="others_staff">Strings:  </span><span style="cursor: hand;" class="edit-this" id="ssj-<?=$score_id?>"></span><br>
                        <span class="others_staff">Mixing: </span><span style="cursor: hand;" class="edit-this" id="mij-<?=$score_id?>"></span><br>
                    </span>
                    </td>
                </tr>
            <?php }?>
        </table>
        <br>
        <hr class="style-one">
    </div>
<?php  include("footer.php");?>