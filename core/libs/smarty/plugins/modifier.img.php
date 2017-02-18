<?php
function smarty_modifier_img($id,$tpl){
	$img = r::g('M_img')->getImg($id,$tpl);
	return $img['src'];
}
?>