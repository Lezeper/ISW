<?php include("header.php");
$anige_title = null;
$song_title = null;

if(!empty($_POST['sub-wanted'])){

    $score_id = $_POST['score-id'];
    $description = $_POST['description'];
    $fromWhich = $_POST['fromWhich'];
    $title = $_POST['title'];

    // check if this wanted exist
    $sql3 = "select COUNT(1) from wanted where score_id=$score_id";
    $query3 = mysql_query($sql3);
    $result = mysql_fetch_row($query3);
    if($result[0] >= 1){
        echo "<script>alert('this wanted already exist!');</script>";
    }else{
        $sql = "update scores set wanted=1 where id=$score_id limit 1";
        $query = mysql_query($sql);

        $sq4 = "select occasion from scores where id = $score_id limit 1";
        $query4 = mysql_query($sq4);
        $rs4 = mysql_fetch_array($query4);
        $occasion = $rs4['occasion'];

        $sql2 = "insert into wanted (id, score_title,anige_title,score_id,description,occasion) VALUES (NULL ,'$title','$fromWhich',$score_id,'$description','$occasion')";
        $query2 = mysql_query($sql2);
        echo "<script>location.href='wanted-page.php'</script>";
    }
}
// get id means user add a new anige or song data just now.
if(!empty($_GET['id'])){
    $score_id = $_GET['id'];
    $sql2 = "select score_title, anige_id from scores where id='$score_id' limit 1";
    $query2 = mysql_query($sql2);
    $rs2=mysql_fetch_array($query2);
    $song_title = $rs2['score_title'];
    $anige_id = $rs2['anige_id'];

    $sql3 = "select anige_title from anige where id='$anige_id' limit 1";
    $query3 = mysql_query($sql3);
    $rs3=mysql_fetch_array($query3);
    $anige_title = $rs3['anige_title'];
}

?>
<script>
    function myCheck(){
         if(document.getElementById("fromWhich").value == ''){
             alert("Oops, you didn't select a Anime or Game!");
             return false;
         }else{
             if(document.getElementById("title").value == ''){
                 if(document.getElementById("roma-title").value == ''){
                     alert("Oops, you didn't enter song title neither!");
                    return false;
                 }
             }
         }
    }
</script>
    <form action="sub-wanted.php" method="post" onsubmit="return myCheck()">
        <h1>Post a Wanted!</h1>
        <label>*Anime or Game Title: </label>
        <input type="text" id="fromWhich" name="fromWhich" placeholder="please press 'select' button to select" readonly="readonly" value="<?=$anige_title?>">

        <br>
        <div>
            <label for="title">*Song Title (Japanese):</label>
            <input type="text" id="title" name="title" value="<?=$song_title?>" readonly="readonly" placeholder="please press 'select' button to select"><br>
        </div>

        <input type="button" value="Select" onclick = "show_song_info_table('')">
        <br><br>

        <div id="song_info_table_control" style="display: none">
            <hr class="style-one">

            <?php $pid=3; $ppid=2;include("anige-score-table.php");?>

            <hr class="style-one">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="You can said something to other helpers :)"></textarea>
        </div>
        <input type="hidden" id="anige-id" value="" name="anige-id">
        <input type="hidden" id="score-id" value="<?php if(!empty($_GET['id'])){echo $_GET['id'];}?>" name="score-id">
        <div style="text-align: center">
            <input type="submit" name="sub-wanted" value="submit">
        </div>
    </form>

<?php include("footer.php");?>