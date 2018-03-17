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
  $updateSQL = sprintf("UPDATE katagori_pinjaman SET nama_pinjaman=%s WHERE id_katagori_pinjaman=%s",
                       GetSQLValueString($_POST['nama_pinjaman'], "text"),
                       GetSQLValueString($_POST['id_katagori_pinjaman'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "katagori-pinjaman.php?id_katagori_pinjaman=" . $row_kgtrpinjamanedit['id_katagori_pinjaman'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_kgtrpinjamanedit = "-1";
if (isset($_GET['id_katagori_pinjaman'])) {
  $colname_kgtrpinjamanedit = $_GET['id_katagori_pinjaman'];
}
mysql_select_db($database_connection, $connection);
$query_kgtrpinjamanedit = sprintf("SELECT * FROM katagori_pinjaman WHERE id_katagori_pinjaman = %s", GetSQLValueString($colname_kgtrpinjamanedit, "text"));
$kgtrpinjamanedit = mysql_query($query_kgtrpinjamanedit, $connection) or die(mysql_error());
$row_kgtrpinjamanedit = mysql_fetch_assoc($kgtrpinjamanedit);
$totalRows_kgtrpinjamanedit = mysql_num_rows($kgtrpinjamanedit);
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
  <?php echo $row_kgtrpinjamanedit['id_katagori_pinjaman']; ?></td>
  <input type="text" name="nama_pinjaman" value="<?php echo htmlentities($row_kgtrpinjamanedit['nama_pinjaman'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    <input type="submit" value="Update record" /></td>
    
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_katagori_pinjaman" value="<?php echo $row_kgtrpinjamanedit['id_katagori_pinjaman']; ?>" />
</form>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($kgtrpinjamanedit);
?>