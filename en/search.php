<?php include("header.php");

if(!empty($_POST['sub-search-key']) || !empty($_GET['search-key']))
{
    if(!empty($_GET['search-key']))
    {
        $search_key = $_GET['search-key'];
        $type = $_GET['search-type'];
    }else{
        $search_key = $_POST['search-key'];
        $type = $_POST['search-type'];
    }
    $check_anige = false;

    if($type == 'score_title'){
        $sql = "select score_title, anige_id, singer, composer, arranger from scores where score_title like '%$search_key%'";
    }else if($type == 'anige_title'){
        $sql = "select anige_title, id, anige_year, anige_month, anige_roma from anige where anige_title like '%$search_key%'";
        $check_anige = true;
    }else if($type == 'singer'){
        $sql = "select singer, anige_id, composer, arranger, score_title from scores where singer like '%$search_key%'";
    }else if($type == 'composer'){
        $sql = "select composer, anige_id, singer, arranger, score_title from scores where composer like '%$search_key%'";
    }else if($type == 'arranger'){
        $sql = "select arranger, anige_id, score_title, singer, composer from scores where arranger like '%$search_key%'";
    }else if($type == 'musician'){
        $sql = "select arranger, anige_id, score_title, singer, composer from scores where (strings like '%$search_key%'
                OR mixing like '%$search_key%' OR drummer like '%$search_key%' OR bassist like '%$search_key%'
                OR guitarist like '%$search_key%' OR other_staff like '%$search_key%')";
    }

    $query = mysql_query($sql); ?>


    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.5/css/jquery.dataTables.min.css">
    <script src="http://cdn.datatables.net/1.10.5/js/jquery.dataTables.min.js"></script>

    <table id="scores_info_table">
        <thead>
        <tr>
            <th>Date</th><th>Song Title</th><th>From</th><th>Singer</th><th>Composer</th><th>Arranger</th>
        </tr>
        </thead>
            <?php
            if(!$check_anige){
            while($rs = mysql_fetch_array($query)){
                $sql1 = "select anige_year, anige_month, anige_title, anige_roma from anige where id = '".$rs['anige_id']."' limit 1";
                $query1 = mysql_query($sql1);
                while($rs1 = mysql_fetch_array($query1)){
            ?>
                <tr>
                    <td><?=$rs1['anige_year']?>-<?=$rs1['anige_month']?></td><td><a href="scores.php?id=<?=$rs['id']?>"><?=$rs['score_title']?></a></td>
                    <td><?=$rs1['anige_title']?> (<?=$rs1['anige_roma']?>)</td><td><?=$rs['singer']?></td><td><?=$rs['composer']?></td><td><?=$rs['arranger']?></td>
                </tr>
                <?php }?>
            <?php }?>
        <?php }else{
                while($rs = mysql_fetch_array($query)){
                $sql1 = "select score_title, singer, composer, arranger,id from scores where anige_id = '".$rs['id']."'";
                $query1 = mysql_query($sql1);
                while($rs1 = mysql_fetch_array($query1)){?>
                    <tr>
                        <td><?=$rs['anige_year']?>-<?=$rs['anige_month']?></td><td><a href="scores.php?id=<?=$rs1['id']?>"><?=$rs1['score_title']?></a></td>
                        <td><?=$rs['anige_title']?> (<?=$rs['anige_roma']?>)</td><td><?=$rs1['singer']?></td><td><?=$rs1['composer']?></td><td><?=$rs1['arranger']?></td>
                    </tr>
                <?php }?>
            <?php }?>
        <?php }?>
    </table>
<?php }?>

<?php include("footer.php");?>