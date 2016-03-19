<?php include "header.php";?>

<?php // specific wanted
if(!empty($_GET['wanted_id'])){
    $this_wanted_id = $_GET['wanted_id'];
    $sql2 = "select * from wanted where id =$this_wanted_id";
    $query2 = mysql_query($sql2);
    $rs2=mysql_fetch_array($query2)

    ?>
    <form action="editScore.php?id=<?=$rs2['score_id']?>" method="post">
        <h1>Wanted</h1>
        <label>Anime or Game Title: </label>
        <input type="text" id="agt-<?=$this_wanted_id?>" name="agt-<?=$this_wanted_id?>" value="<?=$rs2['anige_title']?>" readonly="readonly">
        <br>
        <div>
            <label for="jst-<?=$this_wanted_id?>">*Song Title (Japanese):</label>
            <input type="text" id="jst-<?=$this_wanted_id?>" name="jst-<?=$this_wanted_id?>" value="<?=$rs2['score_title']?>" readonly="readonly">
        </div>
        <!--<div id="est-<?=$this_wanted_id?>" <?php if($rs2['score_title_roma']==null){?> style="display: none" <?php }?> >
            <br><label for="rst-<?=$this_wanted_id?>">*Song Title(Roma or English):</label>
            <input type="text" id="rst-<?=$this_wanted_id?>" name="rst-<?=$this_wanted_id?>" value="<?=$rs2['score_title_roma']?>" readonly="readonly">
        </div>-->
        <?php if($rs2['occasion']=='OP'){?>
            <input type="radio" id="OP" value="OP" name="occ-<?=$this_wanted_id?>" checked><label for="OP" class="light">OP</label><?php }?>
        <?php if($rs2['occasion']=='ED'){?>
            <input type="radio" id="ED" value="ED" name="occ-<?=$this_wanted_id?>" checked><label for="ED" class="light">ED</label><?php }?>
        <?php if($rs2['occasion']=='BGM'){?>
            <input type="radio" id="BGM" value="BGM" name="occ-<?=$this_wanted_id?>" checked><label for="BGM" class="light">BGM</label><?php }?>
        <?php if($rs2['occasion']=='Others'){?>
            <input type="radio" id="Others" value="Others" name="occ-<?=$this_wanted_id?>" checked><label for="Others" class="light">Others</label><?php }?>
        <br>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="des-<?=$this_wanted_id?>" readonly="readonly"><?=$rs2['description']?></textarea>
        </div>
        <input type="hidden" name="wanted_id" value="<?=$this_wanted_id?>">
        <div style="text-align: center">
            <input type="submit" name="accept-wanted" value="Accept!">
        </div>
        <input type="button" value="Back" onclick="location.href='wanted-page.php'">
    </form>


<?php }else{?>

        <h1> Wanted List</h1>


<!--<input type="button" value="Submit a Wanted!" onclick="location.href='sub-wanted.php'">-->

<?php
    // wanted page list
    $sql = "select * from wanted ORDER BY id DESC ";
    $query = mysql_query($sql);
    $number= 0;
    while($rs=mysql_fetch_array($query)){
        $number++;
        $wanted_id = $rs['id']; $score_id = $rs['score_id'];

        $sql2 = "select score_title_roma from scores_roma where score_id=$score_id limit 1";
        $query2 = mysql_query($sql2);
        $rs2 = mysql_fetch_array($query2);
        ?>
    <form action="editScore.php?id=<?=$score_id?>" method="post">
        <div style="text-align: center">
            <h2>Wanted #<?=$number?></h2><br>
        </div>
        <label>*Anime or Game Title: </label>
        <input type="text" id="agt-<?=$wanted_id?>" name="agt-<?=$wanted_id?>" value="<?=$rs['anige_title']?>" readonly="readonly">
        <br>
        <div>
            <label for="jst-<?=$wanted_id?>">*Song Title (Japanese):</label>
            <input type="text" id="jst-<?=$wanted_id?>" name="jst-<?=$wanted_id?>" value="<?=$rs['score_title']?>" readonly="readonly">
        </div>
        <div id="est-<?=$wanted_id?>" <?php if($rs2['score_title_roma']==null){?> style="display: none" <?php }?> >
            <br><label for="rst-<?=$wanted_id?>">*Song Title(Roma or English):</label>
            <input type="text" id="rst-<?=$wanted_id?>" name="rst-<?=$wanted_id?>" value="<?=$rs2['score_title_roma']?>" readonly="readonly">
        </div>
        <?php if($rs['occasion']=='OP'){?>
        <input type="radio" id="OP" value="OP" name="occ-<?=$wanted_id?>" checked><label for="OP" class="light">OP</label><?php }?>
        <?php if($rs['occasion']=='ED'){?>
        <input type="radio" id="ED" value="ED" name="occ-<?=$wanted_id?>" checked><label for="ED" class="light">ED</label><?php }?>
        <?php if($rs['occasion']=='BGM'){?>
        <input type="radio" id="BGM" value="BGM" name="occ-<?=$wanted_id?>" checked><label for="BGM" class="light">BGM</label><?php }?>
        <?php if($rs['occasion']=='Others'){?>
        <input type="radio" id="Others" value="Others" name="occ-<?=$wanted_id?>" checked><label for="Others" class="light">Others</label><?php }?>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="des-<?=$wanted_id?>" readonly="readonly"><?=$rs['description']?></textarea>
        </div>
        <input type="hidden" name="wanted_id" value="<?=$wanted_id?>">
        <div style="text-align: center">
            <input type="submit" name="accept-wanted" value="Accept!">
        </div>
    </form>
        <hr class="style-one">
    <?php }?>
<?php }?>

<?php include "footer.php";?>