<?php
include_once('inc/global.php');

$nav = 'list';
$page = isset($_GET['page'])?intval($_GET['page']):1;
$limit = 10;
$start = ($page-1)*$limit;

$ms = new Mysqls();
$sql = "select * from `posts` order by `id` desc limit {$start},{$limit}";
$data = $ms->getRows($sql);

$sql = "select count(*) from `posts` limit 1";
$total = $ms->getOne($sql);
$pager = getPage($total,$page,$limit,$param);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>list</title>
<?php include_once('global/meta.php');?>
</head>
<body>
<div class="main">
	<?php include_once('global/nav.php');?>
	<div class="mcontent">
		<table class="tablist" width="100%" border="0" cellspacing="0" cellpadding="0">
			<thead>
			<tr>
				<td width="50px">id</td>
				<td width="160px">title</td>
				<td width="400px">content</td>
				<td width="50px">user_id</td>
				<td width="130px">created</td>
				<td width="130px">updated</td>
				<td></td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($data as $row){ ?>
				<tr>
					<td><?php echo $row['id'];?></td>
					<td><?php echo $row['title'];?></td>
					<td><?php echo $row['content'];?></td>
					<td><?php echo $row['user_id'];?></td>
					<td><?php echo $row['created'];?></td>
					<td><?php echo $row['updated'];?></td>
					<td>
						<a href="edit.php?id=<?php echo $row['id'];?>" target="_self">edit</a>
					</td>
				</tr>
			<?php } ?>
			</tbody>
			<tfoot>
			<tr>
				<td colspan="7"><?php echo $pager;?></td>
			</tr>
			</tfoot>
		</table>
	</div>
</div>
</body>
</html>