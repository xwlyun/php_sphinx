<?php
include_once('inc/global.php');

$nav = 'index';
$search = isset($_GET['search'])?trim($_GET['search']):'';
$param .= "&search={$search}";
$page = isset($_GET['page'])?intval($_GET['page']):1;
$limit = 10;

$ms = new Mysqls();

$data = array();
$pager = '';
if($search){
	// 创建Sphinx的客户端接口对象
	$cl = new SphinxClient();

	// 设置连接Sphinx主机名与端口
	$cl->SetServer(SP_HOST,SP_PORT);

	// 设定搜索模式,SPH_MATCH_ALL,SPH_MATCH_ANY,SPH_MATCH_BOOLEAN,SPH_MATCH_EXTENDED,SPH_MATCH_PHRASE
	$cl->SetMatchMode(SPH_MATCH_ANY);

	// 分组，当前排序方法本组中的最佳匹配数据
//	$cl->SetGroupBy('user_id', SPH_GROUPBY_ATTR, '@id desc');

	// 设定排序方法,SPH_SORT_RELEVANCE,SPH_SORT_ATTR_DESC,SPH_SORT_ATTR_ASC,SPH_SORT_TIME_SEGMENTS,SPH_SORT_EXTENDED
	$cl->SetSortMode(SPH_SORT_EXTENDED, '@id desc');

	// 相当于mysql的limit
	$cl->SetLimits(($page-1)*$limit,$limit);

	// 查询关键字，$index是索引名称，当等于*时表查询所有索引，注意主索引和增量索引
	$result = $cl->Query($search);
//	$result = $cl->Query($search,'idx_main');	// 只查idx_main主索引
//	$result = $cl->Query($search,'*');
//	$result = $cl->Query($search,'idx_merge');	// 只查idx_merge更新索引
//	$result = $cl->Query($search,"idx_main idx_merge");	// 查询主索引&更新索引，测试更新索引中的sql_query_killlist是否生效

	$total = $result['total_found'];
	if($total){

		$matches = $result['matches'];
		foreach($matches as $k=>$v){
			$id = $k;
			$sql = "select * from `posts` where `id`={$id} limit 1";
			$data[] = $ms->getRow($sql);
		}

		$pager = getPage($total,$page,$limit,$param);
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>index</title>
<?php include_once('global/meta.php');?>
</head>
<body>
<div class="main">
	<?php include_once('global/nav.php');?>
	<div class="position">
		<form action="" method="get" target="_self">
			search:<input type="text" name="search" value="<?php echo $search;?>"/>
			<input type="submit" value="search"/>
		</form>
	</div>
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