<?php
    @mysql_connect("127.0.0.1:3306", "root", "") or die ("Oops! Connect ERROR!");
    @mysql_select_db("test")or die ("db ERROR!");
    mysql_set_charset("utf8");