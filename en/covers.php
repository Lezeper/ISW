<?php include("header.php");?>
<div>
    <form method="post" id="post-cover" action="">
        <h1>Share Your Cover!</h1>
        <div <?php if(!empty($_GET['score-id'])) echo "style='display: none;'"?>>
        <label>*Anime or Game Name:</label>
        <!-----------------------------1-------------------------------------->
        <input type="text" id="fromWhich" name="fromWhich" value="" placeholder="Please press 'select' button to select" readonly="readonly">
        <input type="hidden" id="fromWhich_id" value="">
        <!-----------------------------2-------------------------------------->
            <div>
                <label for="title">*Song Title (Japanese):</label>
                <input type="text" id="title" name="title" value="" readonly="readonly" placeholder="Please press 'select' button to select"><br>
            </div>
            <input type="button" id="selectAnige" name="selectAnige" value="Select Song"
                   onclick = "show_song_info_table('')"><br><br>
            <div id="song_info_table_control" style="display: none">
                <?php $pid=2; include("anige-score-table.php");?>
                <hr class="style-one">
            </div>
            <input type="hidden" id="score-id" name="score-id" value="<?php if(!empty($_GET['score-id'])) echo $_GET['score-id'];?>" >
            <div id="edit_song_control"></div>
        </div>

        <div id="preview-cover-video" style="display: none">
            <img src="" id="preview-cover-video-img"><br><br>
            <label for="preview-cover-video-title">*Title:</label>
            <input type="text" id="preview-cover-video-title" value="">
            <label for="preview-cover-video-username">*Username:</label>
            <input type="text" id="preview-cover-video-username" value="">
            <label for="preview-cover-video-published">*Date:</label>
            <input type="text" id="preview-cover-video-published" value="">
            <label for="preview-cover-video-dec">Description:</label>
            <input type="text" id="preview-cover-video-dec" value="" placeholder="[optional]You can said something">
            <div class="more-style">
                <button type="button" onclick="sub_cover()">Submit!</button>
                <button type="button" onclick="cancel_sub_cover()">Cancel</button>
            </div>
        </div>
        <div id="preview-cover-video-request">
            <label for="cover-url">*Video URL:</label>
            <input type="text" id="cover-url" value="" placeholder="Just copy your youtube or niconico video URL here ;)" >
            <div class="more-style">
                <button type="button" onclick="check_cover_link()">OK</button>
            </div>
        </div>
    </form>
</div>
<?php include("footer.php");?>