<div>
    <div class="widget">
        <ol class="widget-list" id="clicks-tab">
            <?php
            $sql = "select * from cover where score_id=$thisID ORDER BY id ASC ";
            $query = mysql_query($sql);

            $cout = 0;
            $page = 1;
            while($rs = mysql_fetch_array($query)){$cout++; ?>
                <li class="p<?php if($cout%5 != 0){echo $page;}else{echo $page++;} ?>" style="display: none;">
                    <!--<a href="editComments.php?del=<?php echo $rs['id']?>">|Delete|</a>-->
                    <div style="float: right; margin:5px 5px 0 0">#<?=$cout ?></div>
                    <a href="<?=$rs['link']?>" class="widget-list-link" style="font-size: 15px;text-shadow: 1px 1px 0 #fff;">

                            <?=$rs['title'] ?><br>
                            User: <?=$rs['username'] ?><br>
                        <img src="<?=$rs['image']?>">

                        <?=$rs['description']?>

                        <div style="height: 15px">
                            <span style="font-size: 13px; float: right;" ><?=$rs['published'] ?></span>
                        </div>
                    </a>
                </li>
            <?php }?>
        </ol>

        <ul class="widget-tabs">
            <li class="widget-tab">
                <a href="#clicks-tab" class="widget-tab-link"><img src="../img/video-chat.png" width="20" height="20"> Cover Video </a>
            </li>
        </ul>
    </div>
</div>
