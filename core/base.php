<?
include('config.php');
//����������� � ���� ������  
$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
mysql_select_db($dbname, $dbcnx);
?>