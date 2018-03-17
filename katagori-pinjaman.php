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

mysql_select_db($database_connection, $connection);
$query_kgtrpinjaman = "SELECT * FROM katagori_pinjaman";
$kgtrpinjaman = mysql_query($query_kgtrpinjaman, $connection) or die(mysql_error());
$row_kgtrpinjaman = mysql_fetch_assoc($kgtrpinjaman);
$totalRows_kgtrpinjaman = mysql_num_rows($kgtrpinjaman);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Koperasi</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<a class="btn-fix plus cardh" href="katagori-pinjaman-plus.php"></a>
<a class="btn-print print cardh" href="katagori-pinjaman-report.php"></a>	
	
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
		<h1>Dasboard</h1><br>

               
<form id="form1" name="form1" method="post" action="katagori-pinjaman-search.php">
          <input style="inline-block" id="search" type="text" name="search" id="search"  /> 
          <input id="button-search" type="submit" name="button" id="button" value="Submit" />
        </form><br>

		<table>
			<tr>
				<th>id katagori pinjaman</th>
   				 <th>nama pinjaman</th>
				<th colspan="2">Action</th>
			</tr>
            <?php do { ?>
			<tr>
				<td><?php echo $row_kgtrpinjaman['id_katagori_pinjaman']; ?></td>
      			<td><?php echo $row_kgtrpinjaman['nama_pinjaman']; ?></td>
				<td><a class="btn-tab edit" href="katagori-pinjaman-edit.php?id_katagori_pinjaman=<?php echo $row_kgtrpinjaman['id_katagori_pinjaman']; ?>"></a></td>
				<td><a class="btn-tab delete" href="katagori-pinjaman-delete.php?id_katagori_pinjaman=<?php echo $row_kgtrpinjaman['id_katagori_pinjaman']; ?>"></a></td>
			</tr>
            <?php } while ($row_kgtrpinjaman = mysql_fetch_assoc($kgtrpinjaman)); ?>
		</table>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($kgtrpinjaman);
?>