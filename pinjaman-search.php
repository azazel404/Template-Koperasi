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

$colname_Recordset1 = "-1";
if (isset($_POST['search'])) {
  $colname_Recordset1 = $_POST['search'];
}
mysql_select_db($database_connection, $connection);
$query_Recordset1 = sprintf("SELECT * FROM pinjaman WHERE id_pinjaman LIKE %s", GetSQLValueString("%" . $colname_Recordset1 . "%", "text"));
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
<a class="btn-fix plus cardh" href=""></a>
<a class="btn-print print cardh" href=""></a>	
	
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

<form id="form1" name="form1" method="post" action="pinjaman-search.php">
          <input style="inline-block" id="search" type="text" name="search" id="search"  /> 
          <input id="button-search" type="submit" name="button" id="button" value="Submit" />
        </form><br>

    

		<table>
			<tr>
				        <th>id pinjaman</th>
                <th>nama pinjaman</th>
                <th>id anggota</th>
                <th>besar pinjaman</th>
                <th>tgl pengajuan pinjaman</th>
                <th>tgl acc peminjam</th>
                <th>tgl pinjaman</th>
                <th>tgl pelunasan</th>
                <th>id angsuran</th>
                <th>ket</th>
				<th colspan="2">Action</th>
			</tr>
            <?php do { ?>
			<tr>
				<td><?php echo $row_Recordset1['id_pinjaman']; ?></td>
      <td><?php echo $row_Recordset1['nama_pinjaman']; ?></td>
      <td><?php echo $row_Recordset1['id_anggota']; ?></td>
      <td><?php echo $row_Recordset1['besar_pinjaman']; ?></td>
      <td><?php echo $row_Recordset1['tgl_pengajuan_pinjaman']; ?></td>
      <td><?php echo $row_Recordset1['tgl_acc_peminjam']; ?></td>
      <td><?php echo $row_Recordset1['tgl_pinjaman']; ?></td>
      <td><?php echo $row_Recordset1['tgl_pelunasan']; ?></td>
      <td><?php echo $row_Recordset1['id_angsuran']; ?></td>
      <td><?php echo $row_Recordset1['ket']; ?></td>
				<td><a class="btn-tab edit" href=""></a></td>
				<td><a class="btn-tab delete" href=""></a></td>
			</tr>
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>

		</table>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>