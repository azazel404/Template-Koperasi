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
$query_detilangsuran = "SELECT * FROM detail_angsuran";
$detilangsuran = mysql_query($query_detilangsuran, $connection) or die(mysql_error());
$row_detilangsuran = mysql_fetch_assoc($detilangsuran);
$totalRows_detilangsuran = mysql_num_rows($detilangsuran);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Koperasi</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<a class="btn-fix plus cardh" href="detail-angsuran-plus.php"></a>
<a class="btn-print print cardh" href="detail-angsuran-report.php"></a>	
	
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

        <form id="form1" name="form1" method="post" action="detail-angsuran-search.php">
          <input style="inline-block" id="search" type="text" name="search" id="search"  /> 
          <input id="button-search" type="submit" name="button" id="button" value="Submit" />
        </form><br>

		<table>
			<tr>
				    <th>id angsuran</th>
                    <th>tgl jatuh tempo</th>
                    <th>besar angsuran</th>
                    <th>keterangan</th>
				<th colspan="2">Action</th>
			</tr>
             <?php do { ?>
			<tr>
				<td><?php echo $row_detilangsuran['id_angsuran']; ?></td>
              <td><?php echo $row_detilangsuran['tgl_jatuh_tempo']; ?></td>
              <td><?php echo $row_detilangsuran['besar_angsuran']; ?></td>
              <td><?php echo $row_detilangsuran['ket']; ?></td>
				<td><a class="btn-tab edit" href="detail-angsuran-edit.php?id_angsuran=<?php echo $row_detilangsuran['id_angsuran']; ?>"></a></td>
				<td><a class="btn-tab delete" href="detail-angsuran-delete.php?id_angsuran=<?php echo $row_detilangsuran['id_angsuran']; ?>"></a></td>
			</tr>
            <?php } while ($row_detilangsuran = mysql_fetch_assoc($detilangsuran)); ?>
		</table>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($detilangsuran);
?>