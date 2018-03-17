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
$query_petugaskoperasi = "SELECT * FROM petugas_koperasi";
$petugaskoperasi = mysql_query($query_petugaskoperasi, $connection) or die(mysql_error());
$row_petugaskoperasi = mysql_fetch_assoc($petugaskoperasi);
$totalRows_petugaskoperasi = mysql_num_rows($petugaskoperasi);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Koperasi</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<a class="btn-fix plus cardh" href="petugas-koperasi-plus.php"></a>
<a class="btn-print print cardh" href="petugas-koperasi-report.php"></a>	
	
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
	<div style="padding: 30px;overflow-x:auto">
		<h1>Dasboard</h1><br>

<form id="form1" name="form1" method="post" action="petugas-koperasi-search.php">
          <input style="inline-block" id="search" type="text" name="search" id="search"  /> 
          <input id="button-search" type="submit" name="button" id="button" value="Submit" />
        </form><br>

		<table>
			<tr>
				<th>id petugas</th>
                <th>nama</th>
                <th>alamat</th>
                <th>ket</th>
				<th colspan="2"></th>
			</tr>
            <?php do { ?>
			<tr>
				 <td><?php echo $row_petugaskoperasi['id_petugas']; ?></td>
      <td><?php echo $row_petugaskoperasi['nama']; ?></td>
      <td><?php echo $row_petugaskoperasi['alamat']; ?></td>
      <td><?php echo $row_petugaskoperasi['ket']; ?></td>
				<td><a class="btn-tab edit" href="petugas-koperasi-edit.php?id_petugas=<?php echo $row_petugaskoperasi['id_petugas']; ?>"></a></td>
				<td><a class="btn-tab delete" href="petugas-koperasi-delete.php?id_petugas=<?php echo $row_petugaskoperasi['id_petugas']; ?>"></a></td>
			</tr>
            <?php } while ($row_petugaskoperasi = mysql_fetch_assoc($petugaskoperasi)); ?>
		</table>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($petugaskoperasi);
?>