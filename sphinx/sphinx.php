<?php
include_once('inc/global.php');

$nav = 'sphinx';
$page = isset($_GET['page'])?intval($_GET['page']):1;
$limit = 10;
$start = ($page-1)*$limit;

$ms = new Mysqls();
$sql = "select * from `sph_delta` limit {$start},{$limit}";
$data = $ms->getRows($sql);

$sql = "select count(*) from `sph_delta` limit 1";
$total = $ms->getOne($sql);
$pager = getPage($total,$page,$limit,$param);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sphinx</title>
<?php include_once('global/meta.php');?>
</head>
<body>
<div class="main">
	<?php include_once('global/nav.php');?>
	<div class="mcontent">
		<table class="tablist" width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<td>table</td>
				<td>max_id</td>
				<td>updated</td>
				<td></td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($data as $row){ ?>
				<tr>
					<td><?php echo $row['table'];?></td>
					<td><?php echo $row['max_id'];?></td>
					<td><?php echo $row['updated'];?></td>
					<td></td>
				</tr>
			<?php } ?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="3"><?php echo $pager;?></td>
			</tr>
			</tfoot>
		</table>
	</div>
</div>
</body>
</html>