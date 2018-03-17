<?php require_once('Connections/connection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

if ((isset($_GET['id_katagori_pinjaman'])) && ($_GET['id_katagori_pinjaman'] != "")) {
  $deleteSQL = sprintf("DELETE FROM katagori_pinjaman WHERE id_katagori_pinjaman=%s",
                       GetSQLValueString($_GET['id_katagori_pinjaman'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($deleteSQL, $connection) or die(mysql_error());

  $deleteGoTo = "katagori-pinjaman.php?id_katagori_pinjaman=" . $row_kgtrpinjamandelete['id_katagori_pinjaman'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_kgtrpinjamandelete = "-1";
if (isset($_GET['id_katagori_pinjaman'])) {
  $colname_kgtrpinjamandelete = $_GET['id_katagori_pinjaman'];
}
mysql_select_db($database_connection, $connection);
$query_kgtrpinjamandelete = sprintf("SELECT * FROM katagori_pinjaman WHERE id_katagori_pinjaman = %s", GetSQLValueString($colname_kgtrpinjamandelete, "text"));
$kgtrpinjamandelete = mysql_query($query_kgtrpinjamandelete, $connection) or die(mysql_error());
$row_kgtrpinjamandelete = mysql_fetch_assoc($kgtrpinjamandelete);
$totalRows_kgtrpinjamandelete = mysql_num_rows($kgtrpinjamandelete);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
mysql_free_result($kgtrpinjamandelete);
?>
