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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE angsuran SET id_katagori=%s, id_anggota=%s, tgl_pembayaran=%s, angsuran_ke=%s, besar_angsuran=%s, ket=%s WHERE id_angsuran=%s",
                       GetSQLValueString($_POST['id_katagori'], "text"),
                       GetSQLValueString($_POST['id_anggota'], "text"),
                       GetSQLValueString($_POST['tgl_pembayaran'], "date"),
                       GetSQLValueString($_POST['angsuran_ke'], "text"),
                       GetSQLValueString($_POST['besar_angsuran'], "text"),
                       GetSQLValueString($_POST['ket'], "text"),
                       GetSQLValueString($_POST['id_angsuran'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "angsuran.php?id_angsuran=" . $row_angsuranedit['id_angsuran'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_angsuranedit = "-1";
if (isset($_GET['id_angsuran'])) {
  $colname_angsuranedit = $_GET['id_angsuran'];
}
mysql_select_db($database_connection, $connection);
$query_angsuranedit = sprintf("SELECT * FROM angsuran WHERE id_angsuran = %s", GetSQLValueString($colname_angsuranedit, "text"));
$angsuranedit = mysql_query($query_angsuranedit, $connection) or die(mysql_error());
$row_angsuranedit = mysql_fetch_assoc($angsuranedit);
$totalRows_angsuranedit = mysql_num_rows($angsuranedit);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Koperasi</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>	
	
<nav class="nav">
		<ul>
		<li style="float: left;"><a style="cursor: default;" href=""><b>Koperasi</b> site</a></li>
		<li><a href="<?php echo $logoutAction ?>">Log Out</a></li>
		<li><a href="admin.php">Home</a></li>
		</ul>	
</nav>


	
<div class="sidebar">
<br><br>
	<h1>Admin Panel</h1><br>
		<a href="anggota.php">Anggota</a>
		<a href="angsuran.php">Angsuran</a>
		<a href="detail-angsuran.php">Detail Angsuran</a>
		<a href="katagori-pinjaman.php">Katagori Pinjaman</a>
		<a href="petugas-koperasi.php">Petugas Koperasi</a>
		<a href="pinjaman.php">Pinjaman</a>
		<a href="simpanan.php">Simpanan</a>

</div>

<div class="content">
	<div style="padding: 30px;">

        <form class="admin-edit" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <?php echo $row_angsuranedit['id_angsuran']; ?>
    <input type="text" name="id_katagori" value="<?php echo htmlentities($row_angsuranedit['id_katagori'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
   <input type="text" name="id_anggota" value="<?php echo htmlentities($row_angsuranedit['id_anggota'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
   <input type="text" name="tgl_pembayaran" value="<?php echo htmlentities($row_angsuranedit['tgl_pembayaran'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="angsuran_ke" value="<?php echo htmlentities($row_angsuranedit['angsuran_ke'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="besar_angsuran" value="<?php echo htmlentities($row_angsuranedit['besar_angsuran'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="ket" value="<?php echo htmlentities($row_angsuranedit['ket'], ENT_COMPAT, 'utf-8'); ?>" size="32" /><input type="submit" value="Update record" />
   
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_angsuran" value="<?php echo $row_angsuranedit['id_angsuran']; ?>" />
</form>
	</div>
</div>
</body>
</html>