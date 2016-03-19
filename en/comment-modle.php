<div style="float: left; width: 100%">
    <div class="widget">
        <ol class="widget-list" id="clicks-tab">
            <?php $sql = "select * from comments where score_id='$thisID' ORDER BY id ASC ";
            $query = mysql_query($sql);

            $cout = 0;
            $page = 1;
            while($rs = mysql_fetch_array($query)){$cout++; ?>
                <li class="p<?php if($cout%5 != 0){echo $page;}else{echo $page++;} ?>" style="display: none;">
                    <!--<a href="editComments.php?del=<?php echo $rs['id']?>">|Delete|</a>-->
                    <div class="comment-number">#<?=$cout ?></div>
                    <a class="widget-list-link">
                        <p class="comment-content"><?=$rs['contents']?><br>
                        <div style="width: 100%; height: 10px;">
                            <span class="comment-date-name"><?=$rs['date'] ?></span>
                            <span class="comment-date-name" style="margin-right: 20px;" >user:<?=$rs['username'] ?></span>
                        </div>
                    </a>
                </li>
            <?php }?>
        </ol>

        <ul class="widget-tabs">
            <li class="widget-tab">
                <a href="#clicks-tab" class="widget-tab-link"><img src="../img/c_icon.png" width="20" height="20"> Comments</a>
            </li>
        </ul>
    </div>

    <div style="float: right; margin-top: 10px">
        <?php for($i=1;$i<=$page;$i++){?>
            <input type="button" value="<?=$i ?>" onclick="changePage(<?=$i ?>)">
        <?php }?>
    </div>
</div>

<br style="clear:both;" />
<input type="button" id="new-comment-button" value="Add a comment">
<br style="clear:both;" />
<div class="left-widget">
    <form id="new-comment-form" action="editComments.php?oid=<?php echo $_GET['id']?>" method="post">

        Username<br><input type="text" name="title" style="width: 50%"><br>
        Contents<br><textarea rows="5" cols="50" name="con" style="width: 100%"></textarea><br>

        <input type="hidden" name="thisID" value="<?php echo $thisID;?>">
        <input type="submit" name="sub" value="submit" style="margin-top: 5px;">
    </form>
</div>

<br style="clear:both;" />












