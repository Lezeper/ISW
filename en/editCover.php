<html>
    <head>
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/main.css">
    </head>
    <body>

        <?php include("conn.php");

        // add
        if(!empty($_POST['subAnige']))
        {
            $title = $_POST['title'];
            $roma = $_POST['roma'];
            $year = $_POST['year'];
            $month = $_POST['month'];

            $sql = "insert into anige (id, title, roma, year, month) values (NULL, '$title', '$roma', '$year', '$month')";
            mysql_query($sql);
            echo "<script>location.href='editScore.php'</script>";
        }

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

        <form action="editAnige.php" method="post">
            <h1>Add Cover Video</h1>
            <label for="title">Title: </label>
            <input type="text" id="title" name="title" value="<?php if(!empty($_GET['id'])){echo $rs['title'];} ?>">
            <label for="roma">Roma: </label>
            <input type="text" name="roma" value="<?php if(!empty($_GET['id'])){echo $rs['roma'];} ?>">
            <label for="year">Year: </label>
            <input type="text" name="year" value="<?php if(!empty($_GET['id'])){echo $rs['year'];} ?>">
            <label for="month">Month: </label>
            <input type="text" name="month" value="<?php if(!empty($_GET['id'])){echo $rs['month'];} ?>">
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
                <input type="submit" name="subAnige" value="submit">
            <?php }?>
        </form>
    </body>
</html>
