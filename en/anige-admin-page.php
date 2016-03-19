<?php include("header.php");?>
<script>
    function check() {
        return confirm("Do you want to delete anige?");
    }
</script>
<?php include("admin-panel.php");?>


<?php $sql="select * from anige";
$query = mysql_query($sql);
while($rs=mysql_fetch_array($query)){?>
<form action="process-page.php" method="post" >
    <h1>Check Posted Anige</h1>
    <label for="title">Title: </label>
    <input type="text" id="title" name="title" value="<?=$rs['anige_title']?>">
    <label for="roma">Roma: </label>
    <input type="text" name="roma-title" value="<?=$rs['anige_roma']?>">
    <label for="year">Year: </label>
    <input type="text" name="year" value="<?=$rs['anige_year']?>">
    <label for="month">Month: </label>
    <input type="text" name="month" value="<?=$rs['anige_month']?>">

    <div style="text-align: center">
        <input type="hidden" name="anige-id" value="<?=$rs['id']?>">
        <input type="submit" name="update-anige" value="Edit">
    </div>

    <input type="submit" name="del-anige" value="Delete">
</form>
    <hr class="style-one">
<?php }?>
<?php include("footer.php");?>


