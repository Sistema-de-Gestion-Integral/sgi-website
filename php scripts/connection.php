<?php
$connection = new mysqli("localhost", "sgi_db_user", "SGIDB24!!", "sgi-system");
if ($connection->connect_error) {
    die('Error : (' . $connection->connect_error . ')');
}