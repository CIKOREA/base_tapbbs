<?php /* Template_ 2.2.7 2014/10/07 01:58:58 D:\-=WEBDEVELOP=-\zzanlab\cikorea_migration\front_end\themes\pc\default\_template\contents\user\outlogin_before_login.tpl 000001653 */ ?>
<div style="margin:10px 0px 0px 0px;">

<form style="margin:0px;" name="outlogin_form" id="outlogin_form" method="post" action="<?php echo $TPL_VAR["BASE_URL"]?>user/login" onsubmit="return form_null_check('outlogin_form', 'outlogin_user_id^<?php echo $TPL_VAR["lang"]["user_id"]?>|outlogin_password^<?php echo $TPL_VAR["lang"]["password"]?>');">
    <input type="hidden" name="referer" id="outlogin_referer" value="<?php echo $GLOBALS["_GET"]['referer']?>" />
    <input type="text" name="user_id" id="outlogin_user_id" value="" placeholder="<?php echo $TPL_VAR["lang"]["user_id"]?>" class="input-block-level" />
    <input type="password" name="password" id="outlogin_password" value="" placeholder="<?php echo $TPL_VAR["lang"]["password"]?>" class="input-block-level" />
    <label class="checkbox"><input type="checkbox" name="keep_login" id="outlogin_keep_login" value="on" /> <?php echo $TPL_VAR["lang"]["btn_keep_login"]?></label>
    <input type="submit" value="<?php echo $TPL_VAR["lang"]["btn_login"]?>" class="btn btn-success btn-small" />
    <input type="button" value="<?php echo $TPL_VAR["lang"]["btn_join"]?>" onclick="location.href='<?php echo $TPL_VAR["BASE_URL"]?>user/join';" class="btn btn-primary btn-small" />
    <br />
    <input type="button" value="<?php echo $TPL_VAR["lang"]["btn_find_password"]?>" onclick="location.href='<?php echo $TPL_VAR["BASE_URL"]?>user/find_password';" class="btn btn-link btn-small" />
</form>

</div>