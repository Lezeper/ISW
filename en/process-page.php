<?php include("conn.php");session_start();

function del_DirAndFile($dirName){
    if(is_dir($dirName)){
        if ( $handle = opendir( "$dirName" ) ) {
            while ( false !== ( $item = readdir( $handle ) ) ) {
                if ( $item != "." && $item != ".." ) {
                    if ( is_dir( "$dirName/$item" ) ) {
                        del_DirAndFile( "$dirName/$item" );
                    } else {
                        if( unlink( "$dirName/$item" ) ){}
                    }
                }
            }
            closedir( $handle );
            if( rmdir( $dirName ) ) {}
        }
    }
}

if(!empty($_POST['sub-checked-wanted'])){
    $anige_title = $_POST['fromWhich'];
    $title = $_POST['title'];
    $roma_title = $_POST['roma-title'];
    $description = $_POST['description'];
    $w_wanted_id = $_POST['w-wanted-id'];

    $sql = "insert into wanted(id, anige_title, score_title, score_title_roma, description) VALUES (NULL, '$anige_title', '$title', '$roma_title', '$description')";
    if(mysql_query($sql)) {
        //delete from w_table
        $sql1 = "delete from w_wanted WHERE id='" . $w_wanted_id . "'";
        if (mysql_query($sql1)) {?>
            <script>window.location.href = "admin-panel.php";</script><?php
        }
    }
}
if(!empty($_POST['del-checked-wanted'])){
    $w_wanted_id = $_POST['w-wanted-id'];

    $sql = "delete from wanted WHERE id='$w_wanted_id'";
	
    if(mysql_query($sql)){
        ?><script>window.location.href = "admin-panel.php";</script><?php
    }
}

if(!empty($_POST['sub-checked-anige'])){
    $title = $_POST['title'];
    $roma_title = $_POST['roma-title'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $w_anige_id = $_POST['w-anige-id'];

    $sql = "insert into anige(id, anige_title, anige_roma, anige_year, anige_month) VALUES (NULL, '$title', '$roma_title', '$year', '$month')";
    if(mysql_query($sql)){
        //delete from w_table
        $sql1 = "delete from w_anige WHERE id='".$w_anige_id."'";
        if(mysql_query($sql1)){
            ?><script>window.location.href = "admin-panel.php";</script><?php
        }
    }
}
if(!empty($_POST['del-checked-anige'])){
    $w_anige_id = $_POST['w-anige-id'];

    $sql = "delete from anige WHERE id='$w_anige_id'";
    if(mysql_query($sql)){
        ?><script>window.location.href = "admin-panel.php";</script><?php
    }
}

// add required info from editScore.php
if(isset($_GET['required_info'])) {
    $score_id = $_POST['score_id'];
    $tempo = $_POST['tempo'];

    if(!empty($tempo)){
        if(is_numeric($tempo)){
            // update data to scores
            $sql = "update scores set tempo=$tempo where id=$score_id";
            mysql_query($sql);

            echo $score_id;
        }else{echo "tempo not valid!";}
    }else{echo "tempo should be filled!";}

    /*
    // add score info
    $title = null; $roma = null; $singer = null; $composer = null; $arranger = null; $singer_ro = null; $composer_ro = null; $arranger_ro = null;

    $tempo = $_POST['tempo'];
    $occasion = $_POST['musicType'];
    $anige_id = $_POST['anige-id'];

    $title = $_POST['title'];
    $roma = $_POST['roma-title'];

    // jp staff
    if(isset($_POST['singer'])){$singer = $_POST['singer'];}
    if(isset($_POST['composer'])){$composer = $_POST['composer'];}
    if(isset($_POST['arranger'])){$arranger = $_POST['arranger'];}
    // roma staff
    if(isset($_POST['singer-ro'])){$singer_ro = $_POST['singer-ro'];}
    if(isset($_POST['composer-ro'])){$composer_ro = $_POST['composer-ro'];}
    if(isset($_POST['arranger-ro'])){$arranger_ro = $_POST['arranger-ro'];}

    if(!(empty($title)&&empty($roma))){
        if(!(empty($arranger_ro) && empty($arranger))){
            if(!(empty($composer) && empty($composer_ro))){
                if(!empty($anige_id)){
                    if(!empty($occasion)){
                        if(!(empty($singer) && empty($singer_ro))){
                            if(!empty($tempo)){
                                if(is_numeric($tempo)){
                                    // insert data to scores
                                    $sql = "insert into w_scores (id, score_title, tempo, composer, arranger, singer,
                                                upload_date, occasion, anige_id) values (NULL, '$title', '$tempo',
                                                '$composer', '$arranger', '$singer','now()', '$occasion',$anige_id)";
                                    mysql_query($sql);

                                    // get the last insert id
                                    $sql2 = "select last_insert_id()";
                                    $query2 = mysql_query($sql2);
                                    $last_insert_id = mysql_fetch_row($query2)[0];
                                    echo $last_insert_id;

                                    $sql6 = "insert into w_scores_roma(id,score_id,score_title_roma,composer_roma,arranger_roma,singer_roma)
                                          VALUES (NULL,$last_insert_id,'$roma','$composer_ro','$arranger_ro','$singer_ro')";
                                    mysql_query($sql6);
                                }else{echo "tempo is not valid.";}
                            }else{echo "tempo";}
                        }else{echo "singer";}
                    }else{echo "music type";}
                }else{echo "Inner ERROR";}
            }else{echo "composer";}
        }else{echo "arranger";}
    }else{echo "Song title";}
    */
}

// image upload handler, access by upload-modle.php
if(!empty($_GET['folder_name'])) {
    $folder_name = $_GET['folder_name'];

    // create folder and check when upload image
    $path = '../score_img/'.$folder_name;
    if(!is_dir($path)){
        mkdir($path, 0777);
    }

    $u_fileName = $_FILES["file1"]["name"]; // The file name display for user
    $fileName = $_FILES["file1"]["name"]; // The file name keeping in server
    $i=0;
    while(($char=substr($fileName,$i,1)!= '.')){
        $i--;
    }
    $extend = substr($fileName,$i);
    $fileName = $_GET['page'].$extend;

    $fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
    $fileType = $_FILES["file1"]["type"]; // The type of file it is
    $fileSize = $_FILES["file1"]["size"]; // File size in bytes
    $fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true

    if (!$fileTmpLoc) { // if file not chosen
        echo "<script>alert('ERROR: Please browse for a file before clicking the upload button.')</script>";
        exit();
    }
    if(move_uploaded_file($fileTmpLoc, "../score_img/$folder_name/$fileName")){
        echo "<a href='../score_img/$folder_name/$fileName' target='_blank'><img src='../score_img/$folder_name/$fileName' width='30%'></a>|$|";
        echo "$u_fileName upload is complete";
        $score_id = substr($folder_name,3); // file name : w_sXXX
        $fileName = '*'.$fileName; // seperate images by '*'
        // if not exist, create w_scores
        $sql4 = "SELECT COUNT(1) FROM w_scores WHERE score_id='$score_id'";
        $query4 = mysql_query($sql4);
        $result = mysql_fetch_row($query4);
        if($result[0] >=1){
            $sql3 = "update w_scores set images=concat(images,'$fileName') where score_id=$score_id limit 1";
        }else{
            $sql3 = "insert into w_scores (id, images,score_id) VALUES (null, concat(images,'$fileName'), $score_id)";
        }

        mysql_query($sql3);

    } else {
        echo "<script>alert('move_uploaded_file function failed')</script>";
    }
}

// submit options table from editScore.php
if(!empty($_POST['subScore'])) {
    $guitarist = null;$bassist = null;$drummer = null;$strings = null; $mixing = null;
    $guitarist_roma = null;$bassist_roma = null;$drummer_roma = null;$strings_roma = null; $mixing_roma = null;
    $harmonic = $_POST['harmonic'];
    $chord_progressions_link = $_POST['chord-progressions-link'];
    $score_id = $_POST['score_id'];

    // instrument player
    if(isset($_POST['guitarist'])){$guitarist = $_POST['guitarist'];}
    if(isset($_POST['bassist'])){$bassist = $_POST['bassist'];}
    if(isset($_POST['drummer'])){$drummer = $_POST['drummer'];}
    if(isset($_POST['strings'])){$strings = $_POST['strings'];}
    if(isset($_POST['mixing'])){$mixing = $_POST['mixing'];}
/*
    if(isset($_POST['guitarist_roma'])){$guitarist_roma = $_POST['guitarist_roma'];}
    if(isset($_POST['bassist_roma'])){$bassist_roma = $_POST['bassist_roma'];}
    if(isset($_POST['drummer_roma'])){$drummer_roma = $_POST['drummer_roma'];}
    if(isset($_POST['strings_roma'])){$strings_roma = $_POST['strings_roma'];}
    if(isset($_POST['mixing_roma'])){$mixing_roma = $_POST['mixing_roma'];}*/

    if($harmonic!=null){
        $sql4 = "update scores set guitarist='$guitarist',bassist='$bassist',drummer='$drummer',strings='$strings',
             mixing='$mixing' WHERE id=$score_id";
        // let admin check chord progress
        $sql5 = "insert into w_scores(id, harmonic,score_id) VALUES (null,'$harmonic',$score_id)";
        mysql_query($sql5);
    }elseif($chord_progressions_link != null){
        $sql4 = "update scores set guitarist='$guitarist',bassist='$bassist',drummer='$drummer',strings='$strings',
             mixing='$mixing', sheet_link='$chord_progressions_link' WHERE id=$score_id";
    }else{
        $sql4 = "update scores set guitarist='$guitarist',bassist='$bassist',drummer='$drummer',strings='$strings',
             mixing='$mixing',harmonic='$harmonic' WHERE id=$score_id";
    }

    mysql_query($sql4);
/*
    $sql5 = "update scores_roma set guitarist_roma='$guitarist_roma',bassist_roma='$bassist_roma',drummer_roma='$drummer_roma',
             mixing_roma='$mixing_roma', strings_roma='$strings_roma' WHERE score_id=$score_id";
    mysql_query($sql5);*/

    ?><script>alert("Upload Completed! Thank you for your work :)\nI will check it asap");window.location.href = "scores.php";</script><?php
}

if(!empty($_POST['sub-score-admin'])){
    $w_score_id = $_GET['this_score_id'];
    $w_img_folder = '../score_img/w_s'.$w_score_id;
    $images = $_POST['up-images'.$w_score_id];

    //required info
    $tempo = $_POST['tempo'.$w_score_id];
    $occasion = $_POST['musicType'.$w_score_id];
    $anige_id = $_POST['anige-id'.$w_score_id];
    //title
    $title = $_POST['title'.$w_score_id];
    $roma = $_POST['roma-title'.$w_score_id];
    // jp staff
    $singer = $_POST['singer'.$w_score_id];
    $composer = $_POST['composer'.$w_score_id];
    $arranger = $_POST['arranger'.$w_score_id];
    // roma staff
    $singer_ro = $_POST['singer-ro'.$w_score_id];
    $composer_ro = $_POST['composer-ro'.$w_score_id];
    $arranger_ro = $_POST['arranger-ro'.$w_score_id];
    // chord
    $harmonic = $_POST['harmonic'.$w_score_id];
    // instrument player JP
    $guitarist = $_POST['guitarist'.$w_score_id];
    $bassist = $_POST['bassist'.$w_score_id];
    $drummer = $_POST['drummer'.$w_score_id];
    $strings = $_POST['strings'.$w_score_id];
    $mixing = $_POST['mixing'.$w_score_id];
    // instrument player Roma
    $guitarist_roma = $_POST['guitarist_roma'.$w_score_id];
    $bassist_roma = $_POST['bassist_roma'.$w_score_id];
    $drummer_roma = $_POST['drummer_roma'.$w_score_id];
    $strings_roma = $_POST['strings_roma'.$w_score_id];
    $mixing_roma = $_POST['mixing_roma'.$w_score_id];

    if(!(empty($title)&&empty($roma))){
        if(!(empty($arranger_ro) && empty($arranger))){
            if(!(empty($composer) && empty($composer_ro))){
                if(!empty($anige_id)){
                    if(!empty($occasion)){
                        if(!(empty($singer) && empty($singer_ro))){
                            if(!empty($tempo)){
                                if(is_numeric($tempo)){

                                    // insert data to scores
                                    $sql = "insert into scores (id, score_title, tempo, composer, arranger, singer,
                                                upload_date, occasion, anige_id, harmonic, mixing, strings, drummer, bassist,
                                                guitarist, images, sub_score) values (NULL, '$title', '$tempo','$composer', '$arranger',
                                                '$singer',now(), '$occasion',$anige_id,'$harmonic', '$mixing', '$strings',
                                                '$drummer', '$bassist', '$guitarist', '$images', 1)";
                                    mysql_query($sql);

                                    if(mysql_affected_rows()!=0) {
                                        // get the last insert id
                                        $sql2 = "select last_insert_id()";
                                        $query2 = mysql_query($sql2);
                                        $last_insert_id = mysql_fetch_row($query2)[0];

                                        //process image
                                        $newFolder = '../score_img/s' . $last_insert_id;
                                        mkdir('../score_img/s' . $last_insert_id, 0777);    //create new folder
                                        $images = explode("*", $images);
                                        for ($i = 1; $i < count($images); $i++) {
                                            rename($w_img_folder.'/'.$images[$i], $newFolder.'/'.$images[$i]);    //remove img from temp to score
                                        }
                                        del_DirAndFile($w_img_folder . '/');   //delete old folder and files

                                        $sql6 = "insert into scores_roma(id,score_id,score_title_roma,composer_roma,arranger_roma,singer_roma,
                                          guitarist_roma, bassist_roma, drummer_roma, strings_roma, mixing_roma)
                                          VALUES (NULL,$last_insert_id,'$roma','$composer_ro','$arranger_ro','$singer_ro',
                                          '$guitarist_roma', '$bassist_roma', '$drummer_roma', '$strings_roma', '$mixing_roma')";
                                        mysql_query($sql6);
                                        if (mysql_affected_rows() != 0) {
                                            $sql = "delete from w_scores WHERE id='$w_score_id'";
                                            mysql_query($sql);
                                            echo "<script>location.href='score-admin-page.php';</script>";
                                        }
                                    }

                                }else{echo "invalid tempo!";}
                            }else{echo "tempo";}
                        }else{echo "singer";}
                    }else{echo "music type";}
                }else{echo "Inner ERROR";}
            }else{echo "composer";}
        }else{echo "arranger";}
    }else{echo "Song title";}
}

if(!empty($_POST['checked-score-admin'])){
    $w_score_id = $_GET['this_score_id'];
    $newFolder = '../score_img/s'.$w_score_id.'/';
    $w_img_folder = '../score_img/w_s'.$w_score_id.'/';
    $images = $_POST['up-images'.$w_score_id];
    $harmonic = $_POST['chord'.$w_score_id];
    if($images!=null){
        $sql = "update scores set images= '$images' where id=$w_score_id limit 1";

        //process image
        if(!is_dir($newFolder)){
            mkdir($newFolder, 0777);    //create new folder
        }

        $images = explode("*", $images);
        for ($i = 1; $i < count($images); $i++) {
            rename($w_img_folder.'/'.$images[$i], $newFolder.'/'.$images[$i]);    //remove img from temp to score
        }
        del_DirAndFile($w_img_folder . '/');   //delete old folder and files

        if(mysql_query($sql)){
            $sql3 = "update scores set sub_score= 1 where id=$w_score_id limit 1";
            mysql_query($sql3);
        }
    }
    if($harmonic!=null){
        $sql = "update scores set harmonic= '$harmonic' where id=$w_score_id limit 1";
        mysql_query($sql);
        $sql3 = "update scores set sub_chord= 1 where id=$w_score_id limit 1";
        mysql_query($sql3);
    }

    $sql2 = "delete from w_scores where score_id=$w_score_id limit 1";
    mysql_query($sql2);
    echo "<script>window.location.href = 'score-admin-page.php';</script>";
}

if(!empty($_POST['del-score-admin'])){
    $w_score_id = $_GET['this_score_id'];
    $folder_path = '../score_img/w_s'.$w_score_id.'/';
    // delete folder if exist
    if(is_dir($folder_path)){
        del_DirAndFile($folder_path);
    }

    $sql = "delete from w_scores WHERE score_id=$w_score_id";
    if(mysql_query($sql)){
        ?><script>window.location.href = "score-img-admin.php";</script><?php
    }
}

// edit anige from unfinished.php
if(!empty($_POST['td_type'])){

    $edit_update = $_POST['edit_update'];       // 0:edit 1:update
    $td_type =$_POST['td_type'];

    //edit anige table
    if(($td_type == 'atj') || ($td_type == 'atr') ||($td_type == 'atc') || ($td_type == 'ant')){
        // anige title JP
        if($td_type =='atj')
            $td_type = "anige_title";

        // anige title Roma
        if($td_type =='atr')
            $td_type = "anige_roma";

        // anige title CN
        if($td_type =='atc')
            $td_type = "anige_cn";

        if($td_type =='ant')
            $td_type = "anige_type";

        $edit_id = $_POST['id'];
        $input_value = $_POST['input_value'];

        $source_id = 'a'.$edit_id;

        if($edit_update==0){
            $sql7 = "update anige set $td_type='$input_value' WHERE id=$edit_id";

            if( isset($_SESSION['log']) && ($_SESSION['log'] == 'admin') ) {

            }else{
                $content = $td_type . ' has been update to ' . $input_value;
                $sql11 = "insert into notice(id, content, source_id) VALUES (NULL , '$content', '$source_id')";
                mysql_query($sql11);
            }
        }else{
            if( isset($_SESSION['log']) && ($_SESSION['log'] == 'admin') ){
                $sql7 = "update anige set $td_type='$input_value' WHERE id=$edit_id";
            }else{
                $sql_content = "update anige set $td_type=\'$input_value\' WHERE id=$edit_id";
                $notes = $_POST['notes'];
                $sql7 = "insert into require_update(id,title,sql_content,change_value,notes,source_id) VALUES (NULL ,'$td_type','$sql_content','$input_value','$notes','$source_id')";
            }
        }
        mysql_query($sql7);
    }

    // edit scores staff JP
    if(($td_type == 'stj') || ($td_type == 'guj') || ($td_type == 'baj') || ($td_type == 'drj') || ($td_type == 'ssj')
        || ($td_type == 'mij') || ($td_type == 'occ') || ($td_type == 'sij')){
        if($td_type =='stj')
            $td_type = "score_title";
        if($td_type =='guj')
            $td_type = "guitarist";
        if($td_type =='baj')
            $td_type = "bassist";
        if($td_type =='drj')
            $td_type = "drummer";
        if($td_type =='ssj')
            $td_type = "strings";
        if($td_type =='mij')
            $td_type = "mixing";
        if($td_type =='occ')
            $td_type = "occasion";
        if($td_type =='sij')
            $td_type = "singer";

        $edit_id = $_POST['id'];
        $input_value = $_POST['input_value'];

        $source_id = 's'.$edit_id;

        if($edit_update==0) {
            $sql7 = "update scores set $td_type='$input_value' WHERE id=$edit_id";
            if( isset($_SESSION['log']) && ($_SESSION['log'] == 'admin') ){

            }else{
                $content = $td_type.' has been update to '.$input_value;
                $link = 'scores.php?id='.$edit_id;
                $sql11 = "insert into notice(id, content, link, source_id) VALUES (NULL ,'$content' ,'$link', '$source_id')";
                mysql_query($sql11);
            }
        }else{
            if( isset($_SESSION['log']) && ($_SESSION['log'] == 'admin') ){
                $sql7 = "update scores set $td_type='$input_value' WHERE id=$edit_id";
            }else{
                $sql_content = "update scores set $td_type=\'$input_value\' WHERE id=$edit_id";
                $notes = $_POST['notes'];
                $sql7 = "insert into require_update(id,title,sql_content,change_value,notes,source_id) VALUES (NULL ,'$td_type','$sql_content','$input_value','$notes','$source_id')";
            }
        }
        mysql_query($sql7);
    }

    /*
    // edit scores staff RO
    if(($td_type == 'str') || ($td_type == 'gur') || ($td_type == 'bar') || ($td_type == 'drr') || ($td_type == 'ssr')
        || ($td_type == 'mir') || ($td_type == 'sir')){
        if($td_type =='str')
            $td_type = "score_title_roma";
        if($td_type =='gur')
            $td_type = "guitarist_roma";
        if($td_type =='bar')
            $td_type = "bassist_roma";
        if($td_type =='drr')
            $td_type = "drummer_roma";
        if($td_type =='ssr')
            $td_type = "strings_roma";
        if($td_type =='mir')
            $td_type = "mixing_roma";
        if($td_type =='sir')
            $td_type = "singer_roma";

        $edit_id = $_POST['id'];
        $input_value = $_POST['input_value'];

        if($edit_update==0) {
            $sql7 = "update scores_roma set $td_type='$input_value' WHERE id=$edit_id";
        }else{
            $sql_content = "update scores_roma set $td_type='$input_value' WHERE id=$edit_id";
            $notes = $_POST['notes'];
            $sql7 = "insert into require_update(id,title,sql_content,change_value,notes) VALUES (NULL ,'$td_type','$sql_content','$input_value','$notes');";
        }
        mysql_query($sql7);
    }
    */
}

//request for youtube video cover link
if(!empty($_POST['y_vid'])){
    $y_vid = $_POST['y_vid'];
    $y_request_url = "http://gdata.youtube.com/feeds/api/videos/".$y_vid;
    $doc = new DOMDocument;
    $doc->load($y_request_url);

    $title = $doc->getElementsByTagName("title")->item(0)->nodeValue;
    $username = $doc->getElementsByTagName("name")->item(0)->nodeValue;
    $published = $doc->getElementsByTagName("published")->item(0)->nodeValue;
    $published = substr($published,0,10);
    echo $title.'|$|'.$username.'|$|'.$published;
}

//request for niconico video cover link
if(!empty($_POST['n_vid'])){
    $y_vid = $_POST['n_vid'];
    $y_request_url = "http://ext.nicovideo.jp/api/getthumbinfo/sm".$y_vid;
    $doc = new DOMDocument;
    $doc->load($y_request_url);

    $title = $doc->getElementsByTagName("title")->item(0)->nodeValue;
    $username = $doc->getElementsByTagName("user_nickname")->item(0)->nodeValue;
    $thumbnail_url = $doc->getElementsByTagName("thumbnail_url")->item(0)->nodeValue;
    $published = $doc->getElementsByTagName("first_retrieve")->item(0)->nodeValue;
    $published = substr($published,0,10);
    echo $title.'|$|'.$username.'|$|'.$published.'|$|'.$thumbnail_url;
}


if(!empty($_POST['sub_cover_title'])){
    $sub_cover_title = $_POST['sub_cover_title'];
    $username = $_POST['username'];
    $published = $_POST['published'];
    $img_address = $_POST['img_address'];
    $video_link = $_POST['video_link'];
    $description = $_POST['description'];
    $score_id = $_POST['score_id'];

    $sql8 = "insert into cover (id,title,image,link,username,published,description,score_id) VALUES (NULL ,'$sub_cover_title',
                '$img_address','$video_link','$username','$published','$description',$score_id)";

    if( isset($_SESSION['log']) && ($_SESSION['log'] == 'admin') ){

    }else{
        $content = 'new cover posted';
        $link='scores.php?id='.$score_id;
        $thisID ='s'.$score_id;
        $sql11 = "insert into notice(id, content, source_id, link) VALUES (NULL , '$content', '$thisID', '$link')";
        mysql_query($sql11);
    }
    mysql_query($sql8);
}

if(!empty($_GET['subAnige'])){
    $title = $_POST['title'];
    $roma = $_POST['roma'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $type = $_POST['anigeType'];

    if(($title != '') || ($roma != '')){
        if($year != ''){
            if($month != ''){
                if($roma != ''){
                    //check is it exist in the list.
                    $sql3 = "SELECT COUNT(1) FROM anige WHERE anige_roma='$roma'";
                }else{
                    $sql3 = "SELECT COUNT(1) FROM anige WHERE anige_title='$title'";
                }
                $query3 = mysql_query($sql3);
                $result = mysql_fetch_row($query3);

                if($result[0] >= 1){
                    echo "This anige is already exist!";
                }else{
                    $sql = "insert into anige (id, anige_title, anige_roma, anige_year, anige_month,anige_type) values (NULL, '$title', '$roma', '$year', '$month','$type')";
                    mysql_query($sql);

                    $sql2 = "select last_insert_id()";
                    $query2 = mysql_query($sql2);
                    $last_insert_id = mysql_fetch_row($query2)[0];
                    echo $last_insert_id;
                }
            }else{echo "month is not valid!";}
        }else{echo "year is not valid!";}
    }else{echo "title is not valid!";}
}

if(!empty($_POST['sub-song-info'])){
    $song_title_jp = $_POST['song-title-jp'];
    $singer_jp = $_POST['singer-jp'];
    $lyricist = $_POST['lyricist-jp'];
    $composer_jp = $_POST['composer-jp'];
    $arranger_jp = $_POST['arranger-jp'];

    $song_title_ro = $_POST['song-title-ro'];
    $singer_ro = $_POST['singer-ro'];
    $lyricist_ro = $_POST['lyricist-ro'];
    $composer_ro = $_POST['composer-ro'];
    $arranger_ro = $_POST['arranger-ro'];

    $anige_id = $_POST['anige-id'];
    $musicType = $_POST['musicType'];

    $from_editScore = $_POST['from-editScore']; // 0: from main page, 1: from editScore. 2: wanted

    $sql = "insert into scores (id, score_title,composer,arranger,singer,anige_id,occasion,lyrics, upload_date) values
            (NULL, '$song_title_jp', '$composer_jp','$arranger_jp','$singer_jp',$anige_id,'$musicType','$lyricist', now())";
    mysql_query($sql);

    $sql2 = "select last_insert_id()";
    $query2 = mysql_query($sql2);
    $last_insert_id = mysql_fetch_row($query2)[0];

    $sql2 = "insert into scores_roma (id, score_title_roma,composer_roma,arranger_roma,singer_roma, score_id,lyrics_roma) values
                (NULL, '$song_title_ro', '$composer_ro','$arranger_ro','$singer_ro',$last_insert_id,'$lyricist_ro')";
    mysql_query($sql2);

    if($from_editScore == 0){
        echo "<script>window.location.href = 'scores.php';</script>";
    }else if($from_editScore == 1){
        echo "<script>window.location.href=\"editScore.php?id=".$last_insert_id."\";</script>";
    }else if($from_editScore == 2){
        echo "<script>window.location.href=\"sub-wanted.php?id=".$last_insert_id."\";</script>";
    }
}

// delete anige . operate by admin
if(!empty($_POST['del-anige'])){
    $anige_id = $_POST['anige-id'];
    $id = $_POST['anige-id'];
    $sql = "delete from anige where id = $id";
    mysql_query($sql);
    echo "<script>alert('Delete Success!');location.href='anige-admin-page.php'</script>";
}

// update anige from admin
if(!empty($_POST['update-anige']))
{
    $title = $_POST['title'];
    $roma = $_POST['roma'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $id = $_POST['anige-id'];

    $sql2 = "update anige set anige_title='$title',anige_roma='$roma',anige_year='$year',anige_month='$month' where id=$id";
    mysql_query($sql2);
    echo "<script>location.href='anige-admin-page.php'</script>";
}

// show unfinished_score_Staff small table
if(!empty($_GET['unfinished_score_Staff_table'])){
    $score_id = $_POST['score_id'];
    $sql6 = "select guitarist,bassist,drummer,strings,mixing,id from scores where id=$score_id limit 1 ";
    $query6 = mysql_query($sql6);
    $rs6 = mysql_fetch_array($query6);

    if($rs6['guitarist']==null){$guitarist= "/";}else{$guitarist= $rs6['guitarist'];}
    if($rs6['bassist']==null){$bassist= "/";}else{$bassist= $rs6['bassist'];}
    if($rs6['drummer']==null){$drummer= "/";}else{$drummer=$rs6['drummer'];}
    if($rs6['strings']==null){$strings= "/";}else{$strings=$rs6['strings'];}
    if($rs6['mixing']==null){$mixing= "/";}else{$mixing=$rs6['mixing'];}

    echo "|$|".$guitarist."|$|".$bassist."|$|".$drummer."|$|".$strings."|$|".$mixing;
}

if(!empty($_POST['del-comment-admin'])){
    $comment_id = $_POST['comment-id'];
    $sql2 = "delete from comments where id=$comment_id";
    mysql_query($sql2);
    echo "<script>location.href='comment-admin.php'</script>";
}

if(!empty($_POST['checked-require-update'])){
    $sql_content = $_POST['sql-content'];
    mysql_query($sql_content);
    $id = $_POST['require-update-id'];
    $sql = "delete from require_update where id=$id";
    mysql_query($sql);
    echo "<script>location.href='require-update-admin.php'</script>";
}

if(!empty($_POST['del-require-update'])){
    $id = $_POST['require-update-id'];
    $sql2 = "delete from require_update where id=$id";
    mysql_query($sql2);
    echo "<script>location.href='require-update-admin.php'</script>";
}

if(!empty($_POST['go'])){
    $username = $_POST['u_name'];
    $password = $_POST['u_pass'];

    $sql4 = "SELECT COUNT(1) FROM users WHERE username='$username' AND password='$password'";
    $query4 = mysql_query($sql4);
    $result = mysql_fetch_row($query4);
    $result[0];
    if($result[0] ==1){
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $query = mysql_query($sql);
        $result = mysql_fetch_array($query);

        session_start();
        if($result['admin'] == 1){
            // admin
            $_SESSION['log'] = 'admin';
            echo "<script>window.location.href='admin-index.php';</script>";
        }else{
            $_SESSION['log'] = 'user';
            echo "<script>window.location.href='admin-index.php';</script>";
        }
    }else{
        echo "<script>alert('not correct!');window.location.href='login.php';</script>";
    }
}

// change img_slider
if(!empty($_GET['img_slider'])){
    $changeN = $_GET['img_slider'];
    $title=null;

    if(isset($_POST['title1']))
        $title = $_POST['title1'];
    if(isset($_POST['title2']))
        $title = $_POST['title2'];
    if(isset($_POST['title3']))
        $title = $_POST['title3'];

    if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] < 3000000))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
            //echo "Type: " . $_FILES["file"]["type"] . "<br />";
            //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
            //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

            $sql4 = "SELECT COUNT(1) FROM settings";
            $query4 = mysql_query($sql4);
            if(mysql_fetch_row($query4)[0] ==0){
                // no records. add a new one
                $sql2 = "insert into settings(id) VALUES (NULL )";
                $query2 = mysql_query($sql2);
            }

            $img_name = $changeN.".".explode("/",$_FILES["file"]["type"])[1];
            $result = glob ("../img/img_slider/".$changeN.".*");
            if (count($result)>=1)
            {
                array_map('unlink', glob("../img/img_slider/".$changeN.".*"));
                move_uploaded_file($_FILES["file"]["tmp_name"], "../img/img_slider/" .$changeN.".".substr($_FILES["file"]["type"],6) );
                $sql = "update settings set image$changeN='$img_name' ORDER BY id DESC LIMIT 1";
                mysql_query($sql);
               $sql3 = "update settings set title$changeN='$title' ORDER BY id DESC LIMIT 1";
                mysql_query($sql3);

                echo "<script>location.href='index.php'</script>";
            }
            else
            {
                move_uploaded_file($_FILES["file"]["tmp_name"], "../img/img_slider/" .$changeN.".".substr($_FILES["file"]["type"],6) );
                $sql = "update settings set image$changeN='$img_name' ORDER BY id DESC LIMIT 1";
                mysql_query($sql);
                $sql3 = "update settings set title$changeN='$title' ORDER BY id DESC LIMIT 1";
                mysql_query($sql3);

                echo "<script>location.href='index.php'</script>";
            }
            echo "<script>location.href='index.php'</script>";
        }
    }
    else
    {
        echo "<script>alert('Invalid file')</script>";
        echo "<script>location.href='index.php'</script>";
    }
}

// delete notice from admin
if(!empty($_GET['delete-notice'])){
    $id = $_GET['delete-notice'];
    $sql = "delete from notice where id=$id";
    mysql_query($sql);
    echo "<script>location.href='notice.php'</script>";
}




















