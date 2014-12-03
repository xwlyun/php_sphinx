<?php
/*
*获取常规分页代码
@sql，（可以传取总数的sql，count(*) as total，也可以直接传总数）
@page，当前是第几页
@limit，每页显示多少条数据
@param，页面本身所带的其他参数
*/
function getPage($sql,$page,$limit,$param=null)
{
	if(is_numeric($sql))
	{
		$total = $sql;
	}
	else if($sql)
	{
		$total = $this->getOne($sql);
	}
	else
	{
		return '';
	}
	if($total <= $limit)
	{
		return '';
	}

	$total_page = ceil($total/$limit);
	$start_page = $page>3?$page-3:1;
	$end_page = $page+5<$total_page?($page+5):$total_page;

	$html = "<div class=\"page clearfix\"> <a href=\"?page=1{$param}\" target=\"_self\">首页</a>";
	for($pg=$start_page;$pg<=$end_page;$pg++)
	{
		if($page==$pg)
		{
			$html.=" <span class=\"cur\">{$pg}</span> ";
		}
		else
		{
			$html.=" <a href=\"?page={$pg}{$param}\" target=\"_self\">{$pg}</a> ";
		}
	}
	$npage = $page+1;
	if($npage<=$total_page)
	{
		$html .= "<a href=\"?page={$npage}{$param}\" target=\"_self\">下一页</a> ";
	}
	//$html.="<a href=\"?page={$total_page}{$param}\" target=\"_self\">末页</a> ";
	$html .= '</div>';
	return $html;
}

function redirect($back_url){
	echo "<script>window.location.href = '{$back_url}';</script>";
	exit;
}