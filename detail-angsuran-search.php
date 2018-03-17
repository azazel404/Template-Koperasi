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

$colname_detilangsuransearch = "-1";
if (isset($_POST['search'])) {
  $colname_detilangsuransearch = $_POST['search'];
}
mysql_select_db($database_connection, $connection);
$query_detilangsuransearch = sprintf("SELECT * FROM detail_angsuran WHERE id_angsuran LIKE %s", GetSQLValueString("%" . $colname_detilangsuransearch . "%", "text"));
$detilangsuransearch = mysql_query($query_detilangsuransearch, $connection) or die(mysql_error());
$row_detilangsuransearch = mysql_fetch_assoc($detilangsuransearch);
$totalRows_detilangsuransearch = mysql_num_rows($detilangsuransearch);
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


<form id="form1" name="form1" method="post" action="detail-angsuran-search.php">
          <input style="inline-block" id="search" type="text" name="search" id="search"  /> 
          <input id="button-search" type="submit" name="button" id="button" value="Submit" />
        </form>

		<table>
			<tr>
				<th>id angsuran</th>
                <th>tgl jatuh_tempo</th>
                <th>besar angsuran</th>
                <th>ket</th>
                <th colspan="2">Action</th>
			</tr>
             <?php do { ?>
			<tr>
				 <td><?php echo $row_detilangsuransearch['id_angsuran']; ?></td>
                  <td><?php echo $row_detilangsuransearch['tgl_jatuh_tempo']; ?></td>
                  <td><?php echo $row_detilangsuransearch['besar_angsuran']; ?></td>
                  <td><?php echo $row_detilangsuransearch['ket']; ?></td>
                  <td><a class="btn-tab edit" href=""></a></td>
				          <td><a class="btn-tab delete" href=""></a></td>
			</tr>
            <?php } while ($row_detilangsuransearch = mysql_fetch_assoc($detilangsuransearch)); ?>
		</table>
	</div>
</div>
</body>
</html>
<?php
mysql_free_result($detilangsuransearch);
?>