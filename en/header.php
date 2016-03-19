<?php header("Content-Type:text/html;   charset=UTF-8");include("conn.php");
    session_start();
	?>
<html>
    <head>
        <link rel="stylesheet" href="../css/style.css">
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="http://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>
        <script src="../js/functions.js"></script>
    </head>
    <header>
        
    </header>
    <body>
    <?php 
    if(isset($_GET['log']) && ($_GET['log']=='out')){
        //if the user logged out, delete any SESSION variables
        session_destroy();
        echo "<script>location.href='index.php';</script>";
    }
    ?>
        <div>
            <div class="full-center-color">
                <!---------logo--------->
                <div class="logo">
                    <div style="width: 72px; position: absolute; margin-left: 80%">
                        <div id="language" style="height: 65px; text-align: left;">
                            <ul style="font-size: 12px;">
                                <li><a href="../cn/index.php"><img src="../img/cn.png" width="28" height="18" style="vertical-align: top; margin-bottom: 4px;"><strong>中文</strong></a></li>
                                <li><a href="../en/index.php"><img src="../img/us.png" width="28" height="18" style="vertical-align: top; margin-bottom: 2px;"><strong>English</strong></a></li>
                                <li><a href="../jp/index.php"><img src="../img/jp.png" width="28" height="18" style="vertical-align: top;"><strong>日本語</strong></a></li>
                                <?php
                                if( isset($_SESSION['log']) && ($_SESSION['log'] == 'admin') ){?>
                                    <br>
                                    <li><a href="admin-index.php"><img src="../img/admin.jpg" width="50" height="50"></a></li>
                                    <li><a href="header.php?log=out">Logout</a></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <div>
                        <a href="index.php"><img src="../img/Layer_4-01-512.png" width="50" height="50"></a>
                    </div>
                    <div>
                        <p style="font-size: 20px"><strong>Anige Tracks</strong></p>
                        <p style="font-size: 14px">Latest Anime and Game Music Information</p>
                    </div>
                </div>
                <!---------search box--------->
                <div>
                    <form id="search-box" action="search.php" method="post" onSubmit="return check_search_key()" style="max-width:600px;">
                        <select form="search-box" style="width: auto" name="search-type">
                            <option value="score_title">Song Title</option>
                            <option value="anige_title">Anige Title</option>
                            <option value="singer">Singer</option>
                            <option value="composer">Composer</option>
                            <option value="arranger">Arranger</option>
                            <option value="musician">Musician</option>
                        </select>
                        <input id="search-bar" type="text" name="search-key" style="width: 50%;" onfocus="javascript:if(this.value=='')this.value=''; ">
                        <input type="submit" name="sub-search-key" value="Search" style="">
                    </form>
                </div>
            </div>


            <hr class="style-one">
            <div id="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li style="margin-left: 15%"><a href="scores.php">Music</a></li>
                    <li style="margin-left: 15%"><a href="about.php">About</a></li>
                    <!-- <li><a href="#">Articles</a></li> -->
                </ul>
            </div>

            <hr class="style-one">


            <?php
            if(!empty($_GET['keys']))
            {
                echo "<script>location.href='search.php?keyword=".$_GET['keys']."'</script>";
            }
            ?>
        </div>
        <div id="body-container">
