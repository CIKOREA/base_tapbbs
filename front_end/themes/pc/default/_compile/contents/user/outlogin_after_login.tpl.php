<?php /* Template_ 2.2.7 2015/11/23 00:40:49 /cloud9/workspace/cikorea/front_end/themes/pc/default/_template/contents/user/outlogin_after_login.tpl 000001730 */ ?>
<div style="margin:5px 0px 5px 0px;">
<?php echo $TPL_VAR["USER_name_print"]?><?php if($TPL_VAR["IS_ADMIN"]===TRUE){?> <a class="btn btn-danger btn-mini" href="javascript:void(0);" onclick="window.open('<?php echo $TPL_VAR["BASE_URL"]?>admin/setting');">ADMIN</a><?php }?><br />
<?php echo $TPL_VAR["lang"]["point"]?> : <?php echo $TPL_VAR["USER_INFO_point"]?><?php echo $TPL_VAR["SETTING_point_unit"]?>


<br />

<a href="javascript:void(0);" onclick="location.href='<?php echo $TPL_VAR["BASE_URL"]?>user/point/';" class="btn btn-link btn-mini"><?php echo $TPL_VAR["lang"]["menu_user_point"]?></a> <a href="javascript:void(0);" onclick="location.href='<?php echo $TPL_VAR["BASE_URL"]?>user/friend/';" class="btn btn-link btn-mini"><?php echo $TPL_VAR["lang"]["menu_user_friend"]?></a> <a href="javascript:void(0);" onclick="location.href='<?php echo $TPL_VAR["BASE_URL"]?>user/scrap/';" class="btn btn-link btn-mini"><?php echo $TPL_VAR["lang"]["menu_user_scrap"]?></a>

<br />

<a href="javascript:void(0);" onclick="location.href='<?php echo $TPL_VAR["BASE_URL"]?>user/message/';" class="btn btn-info btn-mini"><?php echo $TPL_VAR["lang"]["menu_user_message"]?></a> <a href="javascript:void(0);" onclick="location.href='<?php echo $TPL_VAR["BASE_URL"]?>user/modify/';" class="btn btn-success btn-mini"><?php echo $TPL_VAR["lang"]["menu_user_modify"]?></a> <a href="javascript:void(0);" onclick="location.href='<?php echo $TPL_VAR["BASE_URL"]?>user/logout/';" class="btn btn-inverse btn-mini"><?php echo $TPL_VAR["lang"]["btn_logout"]?></a>


</div>