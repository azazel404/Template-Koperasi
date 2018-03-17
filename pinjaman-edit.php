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
  $updateSQL = sprintf("UPDATE pinjaman SET nama_pinjaman=%s, id_anggota=%s, besar_pinjaman=%s, tgl_pengajuan_pinjaman=%s, tgl_acc_peminjam=%s, tgl_pinjaman=%s, tgl_pelunasan=%s, id_angsuran=%s, ket=%s WHERE id_pinjaman=%s",
                       GetSQLValueString($_POST['nama_pinjaman'], "int"),
                       GetSQLValueString($_POST['id_anggota'], "int"),
                       GetSQLValueString($_POST['besar_pinjaman'], "int"),
                       GetSQLValueString($_POST['tgl_pengajuan_pinjaman'], "date"),
                       GetSQLValueString($_POST['tgl_acc_peminjam'], "date"),
                       GetSQLValueString($_POST['tgl_pinjaman'], "date"),
                       GetSQLValueString($_POST['tgl_pelunasan'], "int"),
                       GetSQLValueString($_POST['id_angsuran'], "int"),
                       GetSQLValueString($_POST['ket'], "int"),
                       GetSQLValueString($_POST['id_pinjaman'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "pinjaman.php?id_pinjaman=" . $row_Recordset1['id_pinjaman'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id_pinjaman'])) {
  $colname_Recordset1 = $_GET['id_pinjaman'];
}
mysql_select_db($database_connection, $connection);
$query_Recordset1 = sprintf("SELECT * FROM pinjaman WHERE id_pinjaman = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
  
   <?php echo $row_Recordset1['id_pinjaman']; ?>
    <input type="text" name="nama_pinjaman" value="<?php echo htmlentities($row_Recordset1['nama_pinjaman'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
 <input type="text" name="id_anggota" value="<?php echo htmlentities($row_Recordset1['id_anggota'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="besar_pinjaman" value="<?php echo htmlentities($row_Recordset1['besar_pinjaman'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
  <input type="text" name="tgl_pengajuan_pinjaman" value="<?php echo htmlentities($row_Recordset1['tgl_pengajuan_pinjaman'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="tgl_acc_peminjam" value="<?php echo htmlentities($row_Recordset1['tgl_acc_peminjam'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="tgl_pinjaman" value="<?php echo htmlentities($row_Recordset1['tgl_pinjaman'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
   <input type="text" name="tgl_pelunasan" value="<?php echo htmlentities($row_Recordset1['tgl_pelunasan'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="id_angsuran" value="<?php echo htmlentities($row_Recordset1['id_angsuran'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
    <input type="text" name="ket" value="<?php echo htmlentities($row_Recordset1['ket'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
   <input type="submit" value="Update record" />
  
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_pinjaman" value="<?php echo $row_Recordset1['id_pinjaman']; ?>" />
</form>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>