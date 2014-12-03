<?php
include_once('inc/global.php');

$nav = 'edit';
$id = isset($_GET['id'])?intval($_GET['id']):0;

$ms = new Mysqls();
$data = array();
if($id){
	$sql = "select * from `posts` where `id`={$id} limit 1";
	$data = $ms->getRow($sql);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>edit</title>
<?php include_once('global/meta.php');?>
</head>
<body>
<div class="main">
	<?php include_once('global/nav.php');?>
	<div class="mcontent">
		<form action="sub/edit_sub.php" method="post">
			<table class="tablist" width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
					<td width="100px">
						<?php echo $id?'edit':'add';?>
					</td>
					<td></td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>title</td>
					<td><input type="text" name="title" value="<?php echo $data['title'];?>"/></td>
				</tr>
				<tr>
					<td>content</td>
					<td><input type="text" name="content" size="80" value="<?php echo $data['content'];?>"/></td>
				</tr>
				<tr>
					<td>user_id</td>
					<td><input type="text" name="user_id" value="<?php echo $data['user_id'];?>"/></td>
				</tr>
				<tr>
					<td>created</td>
					<td><input type="text" name="created" value="<?php echo $data['created'];?>"/></td>
				</tr>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="2">
						<input type="submit" value="ok"/>
						<a href="<?php echo $_SERVER['HTTP_REFERER'];?>" target="_self"><input type="button" value="cancel"/></a>
						<input type="hidden" name="id" value="<?php echo $id;?>"/>
					</td>
				</tr>
				</tfoot>
			</table>
		</form>
	</div>
</div>
</body>
</html>