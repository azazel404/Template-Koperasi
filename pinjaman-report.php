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
$query_Recordset1 = "SELECT * FROM pinjaman";
$Recordset1 = mysql_query($query_Recordset1, $connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Koperasi</title>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
.img {
    display: block;
    margin: auto;
    width: 250px;
    height: 250px;
}
</style>

</head>
<body>
<img class="img" src="img/logo-koperasi.png" alt="logo koperasi">
<h1 style="text-align:center">Koperasi Site</h1>
<div style="margin-top:80px">
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
    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
</body>
</html>
</div>
<?php
mysql_free_result($Recordset1);
?>
