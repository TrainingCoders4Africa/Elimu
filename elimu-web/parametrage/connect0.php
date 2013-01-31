<?php
$serveur = mysql_connect ("localhost","root","");
if (!$serveur)
{
die ('Non connecté : ' . mysql_error());
}

$db_exemple1 = mysql_select_db('db_sen2i_intranet', $serveur);
if (!$db_exemple1)
{
die ('Impossible d\'utiliser la base : ' . mysql_error());
}
?>