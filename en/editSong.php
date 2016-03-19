<?php include("header.php");?>

<div id="edit_anige_control" style="display: none">
    <form action="" method="post" id="edit-anige-form">
        <h1>Add Anige Info</h1>
        <div id="title-JP">
            <input type="button" onclick="document.getElementById('title-roma').style.display='block';document.getElementById('title-JP').style.display='none'" value="Enter In Roma"><br><br>
            <label for="title">*Title(JP): </label>
            <input type="text" id="title" name="title" value="<?php if(!empty($_GET['id'])){echo $rs['title'];} ?>">
        </div>
        <div id="title-roma" style="display: none">
            <input type="button" onclick="document.getElementById('title-JP').style.display='block';document.getElementById('title-roma').style.display='none'" value="Enter In Japanese"><br><br>
            <label for="roma">*Title(Roma): </label>
            <input type="text" name="roma" id="roma" value="<?php if(!empty($_GET['id'])){echo $rs['roma'];} ?>">
        </div>
        <label for="year">*Year: </label>
        <input type="text" name="year" id="year" value="<?php if(!empty($_GET['id'])){echo $rs['year'];} ?>">
        <label for="month">*Month: </label>
        <input type="text" name="month" id="month" value="<?php if(!empty($_GET['id'])){echo $rs['month'];} ?>">

        <input type="radio" id="Anime" value="Anime" name="anigeType" checked ><label for="Anime" class="light">Anime</label>
        <input type="radio" id="Game" value="Game" name="anigeType"><label for="Game" class="light">Game</label>
        <?php
        // determine edit or add
        if(!empty($_GET['id']))
            // use a hidden button to transfer post ID to next sentence
        {?>
            <input type="hidden" name="editID" value="<?php echo $rs['id']?>">
            <input type="submit" name="edit" value="Edit">
        <?php }else{?>
            <input type="hidden" name="thisID" value="<?php echo $_GET['thisID'];?>">
            <input type="hidden" name="getUrl">
            <div style="text-align: center">
                <input type="submit" name="subAnige" value="Submit Anige Info">
            </div>
        <?php }?>
        <button type="button" onclick="EABackToES()">Back</button>
    </form>
</div>

<div id="edit_song_control">
    <form action="process-page.php" method="post" onsubmit="return check_edit_song()">
        <h1>Add Song Info</h1>
        <label>Anime Or Game Name</label>
        <input type="text" id="fromWhich" value="" readonly="readonly" placeholder="Please use 'Select' button to choose">
        <button type="button" onclick="show_anige_info_table('')">Select</button><br><br>

        <div id="anige_info_table_control" style="display: none"><?php $pid = 0; include("anige-score-table.php");?></div>

        <input type="radio" id="OP" value="OP" name="musicType" checked ><label for="OP" class="light">OP</label>
        <input type="radio" id="ED" value="ED" name="musicType" ><label for="ED" class="light">ED</label>
        <input type="radio" id="BGM" value="BGM" name="musicType" ><label for="BGM" class="light">BGM</label>
        <input type="radio" id="Others" value="Others" name="musicType"><label for="Others" class="light">Others</label>
        <br><br>

        <div id="add-song-title-roma" style="display: none">
            <label for="song-title-ro">*Song Title (Roma or English)</label>
            <input id="song-title-ro" type="text" name="song-title-ro">
            <label>*Singer (Roma or English):</label>
            <input type="text" id="singer-ro" name="singer-ro" value="">
            <label>*Lyricist (Roma or English):</label>
            <input type="text" id="lyricist-ro" name="lyricist-ro" value="">
            <label>*Composer (Roma or English):</label>
            <input type="text" id="composer-ro" name="composer-ro" value="">
            <label>*Arranger (Roma or English):</label>
            <input type="text" id="arranger-ro" name="arranger-ro" value="">
            <button type="button" onclick="show_add_song_title_jp()">Enter in Japanese</button>
        </div>
        <div id="add-song-title-jp">
            <label for="song-title-jp">*Song Title (Japanese)</label>
            <input id="song-title-jp" name="song-title-jp" type="text">
            <label>*Singer (Japanese):</label>
            <input type="text" id="singer-jp" name="singer-jp" value="">
            <label>*Lyricist (Japanese):</label>
            <input type="text" id="lyricist-jp" name="lyricist-jp" value="">
            <label>*Composer (Japanese):</label>
            <input type="text" id="composer-jp" name="composer-jp" value="">
            <label>*Arranger (Japanese):</label>
            <input type="text" id="arranger-jp" name="arranger-jp" value="">

            <button type="button" onclick="show_add_song_title_roma()">Or Enter in Roma(or English)</button>
        </div>

        <input type="hidden" id="anige-id" name="anige-id">
        <input type="hidden" id="from-editScore" name="from-editScore" value="<?php if(!empty($_GET['fes'])){echo $_GET['fes'];}else{echo 0;}?>">
        <br>
        <div style="text-align: center">
            <input type="submit" name="sub-song-info" value="Submit Song Info!">

        </div>
    </form>
</div>

<?php include("footer.php");?>
