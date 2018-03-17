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

$colname_anggotasearch = "-1";
if (isset($_POST['search'])) {
  $colname_anggotasearch = $_POST['search'];
}
mysql_select_db($database_connection, $connection);
$query_anggotasearch = sprintf("SELECT * FROM anggota WHERE id_anggota LIKE %s", GetSQLValueString("%" . $colname_anggotasearch . "%", "text"));
$anggotasearch = mysql_query($query_anggotasearch, $connection) or die(mysql_error());
$row_anggotasearch = mysql_fetch_assoc($anggotasearch);
$totalRows_anggotasearch = mysql_num_rows($anggotasearch);
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
	<div style="padding: 30px;overflow-x:auto">


<form id="form1" name="form1" method="post" action="anggota-search.php">
          <input style="inline-block" id="search" type="text" name="search" id="search"  /> 
          <input id="button-search" type="submit" name="button" id="button" value="Submit" />
        </form><br>

		<table>
		<tr>
    <th>id anggota</th>
    <th>nama</th>
    <th>alamat</th>
    <th>tgl lahir</th>
    <th>tmpt lahir</th>
    <th>jenis kelamin</th>
    <th>status</th>
    <th>no telp</th>
    <th>keterangan</th>
    <th colspan="2">Action</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_anggotasearch['id_anggota']; ?></td>
      <td><?php echo $row_anggotasearch['nama']; ?></td>
      <td><?php echo $row_anggotasearch['alamat']; ?></td>
      <td><?php echo $row_anggotasearch['tgl_lahir']; ?></td>
      <td><?php echo $row_anggotasearch['tmp_lahir']; ?></td>
      <td><?php echo $row_anggotasearch['j_kel']; ?></td>
      <td><?php echo $row_anggotasearch['status']; ?></td>
      <td><?php echo $row_anggotasearch['no_telp']; ?></td>
      <td><?php echo $row_anggotasearch['ket']; ?></td>
      <td><a class="btn-tab edit" href="anggota-plus.php?id_anggota=<?php echo $row_anggota['id_anggota']; ?>"></a></td>
	  <td><a class="btn-tab delete" href="anggota-delete.php?id_anggota=<?php echo $row_anggota['id_anggota']; ?>"></a></td>
    </tr>
    <?php } while ($row_anggotasearch = mysql_fetch_assoc($anggotasearch)); ?>
</table>
		</table>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($anggotasearch);
?>