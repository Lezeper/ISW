<?php


// delete
if(!empty($_GET['del']))
{
    $d = $_GET['del'];
    $sql = "delete from anige where id = '$d'";
    mysql_query($sql);
    echo "<script>alert('Delete Success!');location.href='sily/anige.php'</script>";
}

// edit
if(!empty($_GET['id']))
{
    $sql = "select * from anige where id = '".$_GET['id']."'";
    $query = mysql_query($sql);
    $rs = mysql_fetch_array($query);
}
if(!empty($_POST['edit']))
{
    $title = $_POST['title'];
    $roma = $_POST['roma'];
    $year = $_POST['year'];
    $month = $_POST['month'];
    $editID = $_POST['editID'];
    $sql = "update anige set title='$title', roma='$roma',year=$year,month=$month where id='$editID' limit 1";
    mysql_query($sql);
    echo "<script>alert('Update Success!');location.href='sily/anige.php'</script>";
}
?>
<script>

</script>

