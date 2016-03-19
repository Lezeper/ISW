<?php include("header.php"); ?>

    <form method="post" action="process-page.php">
        <p><label for="u_name">username:</label></p>
        <p><input type="text" name="u_name" value=""></p>

        <p><label for="u_pass">password:</label></p>
        <p><input type="password" name="u_pass" value=""></p>
        <div style="text-align: center">
            <p><input type="submit" name="go" value="Login"></p>
        </div>
    </form>
    <p><strong><?php if(isset($error)){echo $error;}  ?></strong></p>

<?php include("footer.php"); ?>