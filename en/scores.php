<?php include("header.php");

    // get request then view this score
    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        // click+1
        $sql3 = "update scores set clicks=clicks+1 where id=$id";
        mysql_query($sql3);

        $sql = "select * from scores where id = $id";
        $query = mysql_query($sql);
        $rs = mysql_fetch_array($query);
        // get anige name
        $sql2 = "select anige_title from anige where id = '".$rs['anige_id']."'";
        $query2 = mysql_query($sql2);
        $rs2 = mysql_fetch_array($query2);
        ?>
        <div class="twiiter" style="float: right">
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="imlewis15">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </div>
        <br>
        <?php if($rs['images']!= null){ ?>
        <button onclick="show_score_img()">Score Image</button>
        <?php }?>
        <?php if($rs['harmonic']!= null){ ?>
        <button onclick="show_chord_progressions()">Chord Progress</button>
        <?php }?>

        <div class="center-margin-top">
            <table id="scoreInfoTable">
                <thead>
                    <tr>
                        <th>Title</th><th>From</th><th>Singer</th><th>Composer</th><th>Arranger</th>
                        <?php if(!empty($rs['tempo'])){?><th>Tempo</th><?php }?>
                        <?php if(!empty($rs['guitarist'])){?><th>Guitarist</th><?php }?>
                        <?php if(!empty($rs['bassist'])){?><th>Bassist</th><?php }?><?php if(!empty($rs['drummer'])){?><th>Drummer</th><?php }?>
                        <?php if(!empty($rs['strings'])){?><th>Strings</th><?php }?><?php if(!empty($rs['mixing'])){?><th>Mixing</th><?php }?>
                    </tr>
                </thead>
                <tr>
                    <td><?=$rs['score_title'] ?></td><td><?=$rs2['anige_title'] ?></td><td><?=$rs['singer'] ?></td>
                    <td><?=$rs['composer'] ?></td><td><?php echo $rs['arranger'] ?></td>
                    <?php if(!empty($rs['tempo'])){?><td><?=$rs['tempo']?></td><?php }?>
                    <?php if(!empty($rs['guitarist'])){?><td><?=$rs['guitarist']?></td><?php }?>
                    <?php if(!empty($rs['bassist'])){?><td><?=$rs['bassist']?></td><?php }?>
                    <?php if(!empty($rs['drummer'])){?><td><?=$rs['drummer']?></td><?php }?>
                    <?php if(!empty($rs['strings'])){?><td><?=$rs['strings']?></td><?php }?>
                    <?php if(!empty($rs['mixing'])){?><td><?=$rs['mixing']?></td><?php }?>
                </tr>
            </table>

            <?php if($rs['images']== null && $rs['harmonic']== null && $rs['sheet_link']== null){?>
                <br>
                No music sheet image file or harmony progression found. You can <a style="color: blueviolet;text-decoration: underline;"
                                                                                  href="editScore.php?id=<?=$rs['id']?>">ADD</a> one.
                <br>
                Or post a wanted <a style="color: blueviolet;text-decoration: underline;" href="sub-wanted.php?id=<?=$rs['id']?>">HERE</a>
                <br>
            <?php }?>
            <?php if($rs['sheet_link']!= null){
                //http://anison.ifdef.jp/i/524.html
                //http://ja.chordwiki.org/wiki/Birthday
                $provided = null;
                if(strpos($rs['sheet_link'], "ifdef")){
                    $provided = "Anisone Chord Collection";
                }elseif(strpos($rs['sheet_link'], "chordwiki")){
                    $provided = "ChordWiki";
                }elseif(strpos($rs['sheet_link'], "ufret")){
                    $provided = "U-フレット";
                }elseif(strpos($rs['sheet_link'], "anison-chord")){
                    $provided = "Anime Song Chords Book";
                }else{
                    $provided = "Unknown";
                }
                ?>
                <br>
                    You can find chord progression <a style="color: blueviolet;text-decoration: underline;"
                                                      href="<?=$rs['sheet_link']?>">HERE</a>
                    <br>Provided by <span style="font-weight: bold"><?=$provided?></span>

                <br>
            <?php }?>
            <!------------------------images--------------------------->
            <br>
            <div id="score-img">
                <?php
                    $img_folder='../score_img/s'.$rs['id'];
                    $images=explode("*",$rs['images']);
                    for($i=1;$i<count($images);$i++){
                    $img_path = $img_folder.'/'.$images[$i];
                ?>
                <img src="<?=$img_path?>" class="staff">
                <?php }?>
            </div>
            <?php if($rs['harmonic']!= null){   $harmonic=$rs['harmonic'];
                $bars = explode("|",$harmonic); $bar_n=0;?>
            <div id="chord-progressions" style="display: none"><br>
                <!------------------------chord--------------------------->
                <?php for($i=0;$i<count($bars)-1;$i++){
                    $bar_n++;

                    if(strpos($bars[$i], '[') === false){
                        if(!ctype_space($bars[$i])){
                            echo "| ".$bars[$i]." ";
                        }
                        if($bar_n%5==0){echo " |";echo "<br>";}
                    }else{
                        echo "$bars[$i]";echo "<br>";
                    }
                }?>
            </div>
            <?php }?>
        </div>

        <?php $thisID = $_GET['id'];?>
        <hr class="style-one" style="margin-bottom: 30px;">

        <div id="scores_button_widget">
            <div id="cover-widget">
                <?php include("cover-widget.php");?>
                <br>
                <a href="covers.php?score-id=<?=$thisID?>"><button>Add your Cover</button></a>
            </div>
            <div id="comment-modle">
                <?php include("comment-modle.php");?>
            </div>
        </div>

    <?php
    }
    else{ ?>
    <?php $pid=1; include("anige-score-table.php");?>

    <?php }?>
<br>

    <?php include("footer.php"); ?>