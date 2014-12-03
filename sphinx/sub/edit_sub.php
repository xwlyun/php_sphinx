<?php
include_once("../inc/global.php");

$id = isset($_POST['id'])?intval($_POST['id']):0;
$title = isset($_POST['title'])?$_POST['title']:'';
$content = isset($_POST['content'])?$_POST['content']:'';
$user_id = isset($_POST['user_id'])?intval($_POST['user_id']):0;
$created = isset($_POST['created'])?$_POST['created']:date('Y-m-d H:i:s');

$created = $created?$created:date('Y-m-d H:i:s');
$updated = date('Y-m-d H:i:s');

$ms = new Mysqls();

if($id){
	$condition = "`id`={$id}";
	$update_arr = array(
		'title'		=>	$title,
		'content'	=>	$content,
		'user_id'	=>	$user_id,
		'created'	=>	$created,
		'updated'	=>	$updated,
	);
	$ms->update('posts',$condition,$update_arr);
}else{
	$insert_arr = array(
		'title'		=>	$title,
		'content'	=>	$content,
		'user_id'	=>	$user_id,
		'created'	=>	$created,
		'updated'	=>	$updated,
	);
	$ms->insert('posts',$insert_arr);
}

redirect('../list.php');
die();