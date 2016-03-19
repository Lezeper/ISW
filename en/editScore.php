<?php include("header.php");

$anige_title=null;$song_title_JP=null;$song_title_Roma=null;$occasion=null;$singer=null;$arranger=null;$composer=null;
$singer_roma=null;$arranger_roma=null;$composer_roma=null;$song_id=null;

if(!empty($_GET['id'])){

    // get score info from adding new anige or score info
    $song_id = $_GET['id'];
    $sql = "select score_title,singer,composer,arranger,anige_id,occasion from scores where id=$song_id limit 1";
    $query = mysql_query($sql);
    $rs = mysql_fetch_array($query);
    $anige_id = $rs['anige_id'];
    $occasion = $rs['occasion'];

    $sql2 = "select score_title_roma,singer_roma,composer_roma,arranger_roma from scores_roma where score_id=$song_id limit 1";
    $query2 = mysql_query($sql2);
    $rs2 = mysql_fetch_array($query2);

    $sql3 = "select anige_title,anige_roma from anige where id=$anige_id limit 1";
    $query3 = mysql_query($sql3);
    $rs3 = mysql_fetch_array($query3);

    $anige_title = $rs3['anige_title'];
    $song_title_JP = $rs['score_title'];
    $song_title_Roma = $rs2['score_title_roma'];

    $singer = $rs['singer'];
    $arranger = $rs['arranger'];
    $composer = $rs['composer'];

    $singer_roma = $rs2['singer_roma'];
    $arranger_roma = $rs2['arranger_roma'];
    $composer_roma = $rs2['composer_roma'];

}
?>
    <!-------------------Add files-------------------------->
    <div id="light" class="white_content" style="font-weight: bold;font-size: 16px;">
        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"
           style="font-weight: bold;font-size: 18px;float: right"><input type="button" value="Close"></a>
        <div id="upload-modle" style="text-align: center;"></div>
    </div>

    <div id="fade" class="black_overlay"></div>

    <h2 style="text-align: center">Add a new music sheet</h2>
                                        <!-----------------------------Table 1-------------------------------------->
    <form action="" method="post" id="required-info-form">
        <fieldset>
            <legend><span class="number">1</span> Required Info </legend>
                <label>*Anime or Game Name:</label>
            <!-----------------------------1-------------------------------------->
                <input type="text" id="fromWhich" name="fromWhich" value="<?=$anige_title?>" placeholder="Please press 'select' button to select" readonly="readonly">
                <input type="hidden" id="fromWhich_id" value="">
                <!-----------------------------2-------------------------------------->
            <div <?php if(!empty($_GET['id'])){if($song_title_JP == null){echo "style='display:none'";}}?>>
                <label for="title">*Song Title (Japanese):</label>
                <input type="text" id="title" name="title" value="<?=$song_title_JP?>" readonly="readonly" placeholder="Please press 'select' button to select"><br>
            </div>
            <?php if(!empty($_GET['id'])){if($song_title_Roma != null){?>
            <div>
                <label for="title">*Song Title (Roma or English):</label>
                <input type="text" id="title-roma" name="title-roma" value="<?=$song_title_Roma?>" readonly="readonly" placeholder="Please press 'select' button to select"><br>
            </div>
            <?php }}?>
            <div id="after-sub-table1">
                <div id="required_info" <?php if(!empty($_GET['id'])){echo "style='display:none'";}?>>
                    <?php if(empty($_POST['accept-wanted'])){?>
                    <input type="button" id="selectAnige" name="selectAnige" value="Select Song"
                           onclick = "show_song_info_table('')"><br><br>

                    <div id="song_info_table_control" style="display: none">
                        <hr class="style-one">
                        <?php $pid=3; $ppid=1;include("anige-score-table.php");?>
                        <hr class="style-one">
                        <br>
                    </div>

                    <?php }?>
                    <?php if(!empty($_POST['add-song-info'])){?>
                    <input type="button" value="I want to enter Roma or English"><br> <?php }?>
                    <div id="english-song-title" <?php if($song_title_Roma == null){?>style="display: none"<?php }?> >
                        <br><label for="roma-title">*Song Title(Roma or English):</label>
                        <!-----------------------------3-------------------------------------->
                        <input type="text" id="roma-title" name="roma-title" value="<?=$song_title_Roma?>" readonly="readonly"><br>
                    </div>
                    <!-----------------------------4-------------------------------------->
                    <?php if(!empty($_GET['id'])){?>
                    <div>
                        <input type="radio" id="OP" value="OP" name="musicType" <?php if(($occasion=='OP')||($occasion=='')){echo 'checked';}?>><label for="OP" class="light">OP</label>
                        <input type="radio" id="ED" value="ED" name="musicType" <?php if($occasion=='ED'){echo 'checked';}?>><label for="ED" class="light">ED</label>
                        <input type="radio" id="BGM" value="BGM" name="musicType" <?php if($occasion=='BGM'){echo 'checked';}?>><label for="BGM" class="light">BGM</label>
                        <input type="radio" id="Others" value="Others" name="musicType" <?php if($occasion=='Others'){echo 'checked';}?>><label for="Others" class="light">Others</label>
                        <br><br>
                    </div>
                    <?php }?>
                    <!-----------------------------6------------------------------------>
                    <?php if($composer!=null || $composer!=''){?>
                    <div class="staff-jp">
                        <label>*Singer (Japanese):</label>
                        <input type="text" id="singer-jp" name="singer" value="<?=$singer?>">
                        <label>*Composer (Japanese):</label>
                        <input type="text" id="composer-jp" name="composer" value="<?=$composer?>">
                        <label>*Arranger (Japanese):</label>
                        <input type="text" id="arranger-jp" name="arranger" value="<?=$arranger?>">
                    </div>
                    <?php }?>
                    <!-----------------------------7--------------------------------------->
                    <?php if($composer_roma!=null || $composer_roma!=''){?>
                    <div class="staff-roma">
                        <label>*Singer(Roma):</label>
                        <input type="text" id="singer-ro" name="singer-ro" value="<?=$singer_roma?>">
                        <label>*Composer(Roma):</label>
                        <input type="text" id="composer-ro" name="composer-ro" value="<?=$composer_roma?>">
                        <label>*Arranger(Roma):</label>
                        <input type="text" id="arranger-ro" name="arranger-ro" value="<?=$arranger_roma?>">
                    </div>
                    <?php }?>
                </div>

                <label>*Tempo:</label>
                <input type="text" id="tempo" name="tempo" value="">

                <input type="hidden" name="anige-id" id="anige-id" value="">
                <div style="text-align: center">
                    <input type="submit" name="sub-required" value="submit">
                </div>
            </div>
            <input type="hidden" id="score-id" name="score_id" value="<?=$song_id?>">
        </fieldset>
    </form>
                            <!----------------Table 2--------------------->
    <form action="process-page.php" method="post" enctype="multipart/form-data">
        <fieldset style="margin: 10px 0;">
            <legend><span class="number">2</span> Chord Progression</legend>
            <span id="need-to-fill">Please submit required info first!</span>
            <div id="upload_work" style="display: none">
                <Label>I want to:</Label><br>
                <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';show_img_file();">
                    <input style="font-size: 15px;" type="button" value="Upload sheet music image file" onclick="show_upload_modle('')">
                    <input type="hidden" id="last-insert-id" name="folder_name" value="">
                </a>

                <input style="font-size: 15px;" type="button" value="Type in Chord Progressions" onclick="show_chord_progressions('')">

                <div id="chord-progressions" style="display: none">
                    <hr class="style-one">
                    <label>Chord Progressions</label>
                    <?php $tip = "Please type like this format:\n\n[Intro]\n| Cm Dm | Esus2 C/D | Ddim Csus4 | Ddim Csus4 |\n[A]\n| Cm Dm | Esus2 C/D | Ddim Csus4 | Ddim Csus4 |"?>
                    <textarea rows="10" cols="10" name="harmonic" placeholder="<?=$tip?>"></textarea><br>
                </div>
                <div id="show-uploaded-img"></div>

                <br><span>Or you can enter the URL which other website have already finished this work.</span><br><br>
                <input style="font-size: 15px;" type="button" value="Enter URL" onclick="show_chord_progressions_link()">

                <div id="chord-progressions-link" style="display: none"><br>
                    <label>*URL</label>
                    <input type="text" name="chord-progressions-link" value="">
                </div>
            </div>
        </fieldset>
        <hr>
        <!----------------Table 3--------------------->
        <fieldset style="margin: 10px 0">
            <legend><span class="number">3</span> <input type="button" id="options-but" value="Options" onclick="show_options()"></legend>
            <div id="options" style="display: none">
                <label>Guitarist(Japanese):</label>
                <input type="text" name="guitarist" value="">
                <label>Bassist(Japanese):</label>
                <input type="text" name="bassist" value="">
                <label>Drummer(Japanese):</label>
                <input type="text" name="drummer" value="">
                <label>Strings(Japanese):</label>
                <input type="text" name="strings" value="">
                <label>Mixing(Japanese):</label>
                <input type="text" name="mixing" value="">
            </div>
        </fieldset>
        <div class="center-margin-top">
            <input type="hidden" id="score-id" name="score_id" value="<?=$song_id?>">
            <input type="submit" name="subScore" class="after-sub-required" value="submit" style="display: none">
        </div>
        <input type="hidden" value="0" id="page">
    </form>
<div style="width: 480px; margin: 0 auto;"><input type="button" value="Reset All" onclick="javascript:window.location.href='editScore.php'"></div>

<?php include("footer.php");?>