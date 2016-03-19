<?php include "header.php"; include "admin-panel.php";
$dirname = "../img/img_slider";
$images = scandir($dirname);
?>
<div style="text-align: center">
    Images number: <?=count($images)-2;?><br><br>

    <img style="max-width: 680px;max-height: 480px" src="../img/img_slider/<?=$images[2]?>" alt="1">
    <img style="max-width: 680px;max-height: 480px" src="../img/img_slider/<?=$images[3]?>" alt="2">
    <img style="max-width: 680px;max-height: 480px" src="../img/img_slider/<?=$images[4]?>" alt="3">
</div>

<div style="text-align: center">
    <h2 style="font-size: 24px;">Supported image file format: .jp(e)g/.png/.gif<br>maximum file size:3M each</h2>

    <form action="process-page.php?img_slider=1" method="post"
          enctype="multipart/form-data">
        <label for="file">Image1:</label>
        <input type="file" name="file" id="file" />
        <br><br>Title1:
        <input type="text" name="title1" value="">
        <br />
        <input type="submit" name="submit" value="Submit" />
    </form>
    <form action="process-page.php?img_slider=2" method="post"
          enctype="multipart/form-data">
        <label for="file">Image2:</label>
        <input type="file" name="file" id="file" />
        <br><br>Title2:
        <input type="text" name="title2" value="">
        <br />
        <input type="submit" name="submit" value="Submit" />
    </form>
    <form action="process-page.php?img_slider=3" method="post"
          enctype="multipart/form-data">
        <label for="file">Image3:</label>
        <input type="file" name="file" id="file" />
        <br><br>Title3:
        <input type="text" name="title3" value="">
        <br />
        <input type="submit" name="submit" value="Submit" />
    </form>
</div>

<?php include "footer.php";?>