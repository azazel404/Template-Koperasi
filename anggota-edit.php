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
  $updateSQL = sprintf("UPDATE anggota SET nama=%s, alamat=%s, tgl_lahir=%s, tmp_lahir=%s, j_kel=%s, status=%s, no_telp=%s, ket=%s WHERE id_anggota=%s",
                       GetSQLValueString($_POST['nama'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['tgl_lahir'], "date"),
                       GetSQLValueString($_POST['tmp_lahir'], "text"),
                       GetSQLValueString($_POST['j_kel'], "text"),
                       GetSQLValueString($_POST['status'], "text"),
                       GetSQLValueString($_POST['no_telp'], "text"),
                       GetSQLValueString($_POST['ket'], "text"),
                       GetSQLValueString($_POST['id_anggota'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "anggota.php?id_anggota=" . $row_anggotaedit['id_anggota'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_anggotaedit = "-1";
if (isset($_GET['id_anggota'])) {
  $colname_anggotaedit = $_GET['id_anggota'];
}
mysql_select_db($database_connection, $connection);
$query_anggotaedit = sprintf("SELECT * FROM anggota WHERE id_anggota = %s", GetSQLValueString($colname_anggotaedit, "text"));
$anggotaedit = mysql_query($query_anggotaedit, $connection) or die(mysql_error());
$row_anggotaedit = mysql_fetch_assoc($anggotaedit);
$totalRows_anggotaedit = mysql_num_rows($anggotaedit);
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
		<li><a href="">Log Out</a></li>
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
  <?php echo $row_anggotaedit['id_anggota']; ?></td>
    <input type="text" name="nama" value="<?php echo htmlentities($row_anggotaedit['nama'], ENT_COMPAT, 'utf-8'); ?>" size="32" />    <input type="text" name="alamat" value="<?php echo htmlentities($row_anggotaedit['alamat'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="tgl_lahir" value="<?php echo htmlentities($row_anggotaedit['tgl_lahir'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="tmp_lahir" value="<?php echo htmlentities($row_anggotaedit['tmp_lahir'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="j_kel" value="<?php echo htmlentities($row_anggotaedit['j_kel'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="status" value="<?php echo htmlentities($row_anggotaedit['status'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
   <input type="text" name="no_telp" value="<?php echo htmlentities($row_anggotaedit['no_telp'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="ket" value="<?php echo htmlentities($row_anggotaedit['ket'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="submit" value="Update record" /></td>
   
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_anggota" value="<?php echo $row_anggotaedit['id_anggota']; ?>" />
</form>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($anggotaedit);
?>
