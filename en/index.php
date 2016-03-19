<?php include("header.php");?>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-61294858-1', 'auto');
    ga('send', 'pageview');

</script>

<?php $image1=null;$image2=null;$image3=null;$title1=null;$title2=null;$title3=null;
$result = mysql_query("SELECT max(id) FROM settings");  //get last settings
$id = mysql_result($result, 0);

$sql6 = "select image1,image2,image3,title1,title2,title3 from settings where id=$id";
if($query6 = mysql_query($sql6)){
    $rs6 = mysql_fetch_array($query6);
    $image1 = $rs6['image1'];
    $image2 = $rs6['image2'];
    $image3 = $rs6['image3'];
    $title1 = $rs6['title1'];
    $title2 = $rs6['title2'];
    $title3 = $rs6['title3'];
}
?>

<link rel="stylesheet" href="../css/bjqs.css">
<link rel="stylesheet" href="../css/demo.css">
<script src="../js/bjqs-1.3.min.js"></script>

<div class="topContainer">
    <!------------------image slider-------------------->
    <div id="image-slider">
        <div id="banner-fade" style="width: 90%; height: 90%; margin: 15px auto 42px auto">
            <ul class="bjqs">
                <?php if($image1!=null){?>
                    <li><img src="../img/img_slider/<?=$image1?>" title="<?=$title1?>"></li>
                <?php }?>
                <?php if($image2!=null){?>
                    <li><img src="../img/img_slider/<?=$image2?>" title="<?=$title2?>"></li>
                <?php }?>
                <?php if($image3!=null){?>
                    <li><img src="../img/img_slider/<?=$image3?>" title="<?=$title3?>"></li>
                <?php }?>
            </ul>
        </div>
        <script class="secret-source">
            jQuery(document).ready(function($) {
                $('#banner-fade').bjqs({
                    height      : 480,
                    width       : 640,
                    responsive  : true
                });
            });
        </script>
    </div>
    <!------------------Hot Tracks-------------------->
    <div class="right-widget">
        <div class="widget">
            <ol class="widget-list" id="clicks-tab">
                <?php $sql3 = "select score_title,id,clicks from scores ORDER BY clicks DESC limit 8 ";
                $query3 = mysql_query($sql3);
                while($rs3 = mysql_fetch_array($query3)){?>
                    <li>
                        <a class="widget-list-link" href="scores.php?id=<?=$rs3['id'];?>">
                            <p class="widget-font"><strong><?=$rs3['score_title']?></strong></p>
                            <span class="widget-right-corner">Click:<?=$rs3['clicks'];?></span>
                            <p style="clear: both"></p>
                        </a>
                    </li>
                <?php }?>
            </ol>
            <ul class="widget-tabs">
                <li class="widget-tab">
                    <a href="#clicks-tab" class="widget-tab-link">Hot Tracks</a>
                </li>
            </ul>
        </div>
    </div>

</div>

<div class="midContainer">
    <!------------------Left Bar-------------------->
    <div class="left-part">
        <div class="widget">
            <ol class="widget-list" id="new-sheet-tab">
                <?php $sql = "select score_title,occasion,id,upload_date,anige_id from scores ORDER BY upload_date DESC limit 15 ";
                $query = mysql_query($sql);
                while($rs = mysql_fetch_array($query)){
                    $sql5 = "select anige_title from anige where id='".$rs['anige_id']."'";
                    $query5 = mysql_query($sql5);
                    $rs5 = mysql_fetch_array($query5)
                    ?>
                    <li>
                        <a class="widget-list-link" href="scores.php?id=<?=$rs['id'];?>">
                            <p class="widget-font"><strong><?=$rs['score_title']?></strong>  ~  <?=$rs5['anige_title']?> [<?=$rs['occasion']?>]
                            <span class="widget-right-corner"><?=$rs['upload_date']?></span>
                            </p>
                        </a>
                    </li>
                <?php }?>
                <li class="more-style" onmouseover="this.style.color='#FFFFF';this.style.textDecoration='underline';"
                    onMouseOut="this.style.color='#808284';this.style.textDecoration='none'"><a href="scores.php"><span>More</span></a>
                </li>
            </ol>

            <ul class="widget-tabs">
                <li class="widget-tab">
                    <a href="#new-sheet-tab" class="widget-tab-link">New Sheet</a>
            </ul>
        </div>
    </div>

    <!------------------Right Bar-------------------->

    <div class="right-widget">
        <ul>
            <li>
                <div class="widget">
                    <ol class="widget-list" id="category-tab">
                        <?php $sql4 = "select anige_title from anige ORDER BY id DESC limit 10 ";
                        $query4 = mysql_query($sql4);
                        while($rs4 = mysql_fetch_array($query4)){?>
                            <li>
                                <a href="search.php?search-key=<?=$rs4['anige_title']?>&search-type=anige_title" class="widget-list-link">
                                    <p class="widget-font"><?=$rs4['anige_title']?></p>
                                </a>
                            </li>
                        <?php }?>
                        <li style="text-align: center" onmouseover="this.style.color='#FFFFF';this.style.textDecoration='underline';"
                            onMouseOut="this.style.color='#808284';this.style.textDecoration='none'">
                            <a href="scores.php"><span>More</span></a>
                        </li>
                    </ol>
                    <ul class="widget-tabs">
                        <li class="widget-tab">
                            <a href="#category-tab" class="widget-tab-link">Anige Name</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <br>
        <!-- Complete it in the future
        <ul>
            <li>
                <div class="widget" style="margin-bottom: 5%;float: right">
                    <ol class="widget-list" id="article-tab">
                        <li></li>
                    </ol>
                    <ul class="widget-tabs">
                        <li class="widget-tab">
                            <a href="#article-tab" class="widget-tab-link">New Article</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul> -->
        <ul>
            <li>
                <div class="widget">
                    <ol class="widget-list" id="wanted-list">
                        <?php $sql2 = "select * from wanted ORDER BY id DESC limit 5 ";
                        $query2 = mysql_query($sql2);
                        while($rs2 = mysql_fetch_array($query2)){?>
                            <li>
                                <a href="wanted-page.php?wanted_id=<?=$rs2['id']?>" class="widget-list-link">
                                    <p class="widget-font"><?=$rs2['anige_title']?> - <?=$rs2['occasion']?></p>
                                </a>
                            </li>
                        <?php }?>
                        <li style="text-align: center" onmouseover="this.style.color='#FFFFF';this.style.textDecoration='underline';"
                            onMouseOut="this.style.color='#808284';this.style.textDecoration='none'"><a href="wanted-page.php"><span>More</span></a>
                        </li>
                    </ol>
                    <ul class="widget-tabs">
                        <li class="widget-tab">
                            <a href="#comments-tab" class="widget-tab-link">Wanted list</a>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- Complete it in the future
        <ul>
            <li>
                <div class="widget" style="margin-bottom: 5%;float: right">
                    <ol class="widget-list" id="links-tab">
                        <li>
                            <a class="widget-list-link" href="#" style="font-size: 12px;text-shadow: 1px 1px 0 #fff;">
                                User: <?php echo $rs2['title']?> said: <?php echo $rs2['contents']?></a>
                        </li>
                    </ol>
                    <ul class="widget-tabs">
                        <li class="widget-tab">
                            <a href="#links-tab" class="widget-tab-link">Links</a>
                    </ul>
                </div>
            </li>
        </ul> -->
    </div>
</div>

<?php include("footer.php"); ?>
