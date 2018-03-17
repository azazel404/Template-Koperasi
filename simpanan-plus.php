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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO simpanan (id_simpanan, nm_simpanan, id_anggota, tgl_simpanan, besar_simpanan, ket) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_simpanan'], "text"),
                       GetSQLValueString($_POST['nm_simpanan'], "text"),
                       GetSQLValueString($_POST['id_anggota'], "text"),
                       GetSQLValueString($_POST['tgl_simpanan'], "date"),
                       GetSQLValueString($_POST['besar_simpanan'], "text"),
                       GetSQLValueString($_POST['ket'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  $insertGoTo = "simpanan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
		<form  class="admin-edit" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
 <input type="text" name="id_simpanan" value="" size="32" placeholder="id simpanan" />
   <input type="text" name="nm_simpanan" value="" size="32" placeholder="nama simpanan" />
    <input type="text" name="id_anggota" value="" size="32" placeholder="id anggota" />
   <input type="text" name="tgl_simpanan" value="" size="32" placeholder="tanggal simpanan" />
    <input type="text" name="besar_simpanan" value="" size="32" placeholder="besar simpanan" />
   <input type="text" name="ket" value="" size="32" placeholder="keterangan" />
    <input type="submit" value="Insert record" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
		</table>
	</div>
</div>
</body>
</html>