<?php include("conn.php");

    $pid = $_GET['oid'];

    // add comment
    if(!empty($_POST['sub']))
    {
        $title = $_POST['title'];
        if(empty($title)){
            $title = "anonymity";
        }
        $con = $_POST['con'];
        if(!empty($con)){
            $thisID = $_POST['thisID'];
            // $thisID defined from scores.php after click into specific sheet
            $sql = "insert into comments (id, username, date, contents, score_id) values (NULL, '$title', now(), '$con', '$thisID')";
            mysql_query($sql);

            if( isset($_SESSION['log']) && ($_SESSION['log'] == 'admin') ){

            }else{
                $content = 'new comment posted: User: '.$title.' Comment: '.$con;
                $link='scores.php?id='.$thisID;
                $thisID ='s'.$thisID;
                $sql11 = "insert into notice(id, content, source_id, link) VALUES (NULL , '$content', '$thisID', '$link')";
                mysql_query($sql11);
            }
        }

        ?><script>window.location.href = "scores.php?id=<?=$pid ?>";</script><?php
    }

    // delete post
    if(!empty($_GET['del']))
    {
        $d = $_GET['del'];
        $sql = "delete from comments where id = '$d'";
        mysql_query($sql);
    }

    // edit post
/*
    if(!empty($_GET['id']))
    {
        $sql = "select * from news where id = '".$_GET['id']."'";
        $query = mysql_query($sql);
        $rs = mysql_fetch_array($query);
    }
    if(!empty($_POST['edit']))
    {
        $title = $_POST['title'];
        $con = $_POST['con'];
        $editID = $_POST['editID'];
        $sql = "update news set title = '$title', date = now(), contents = '$con' where id='$editID' limit 1";
        mysql_query($sql);
        echo "<script>alert('Update Success!');location.href='comment-modle.php'</script>";
    }*/
