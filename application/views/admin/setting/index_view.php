<?php
	//폼검증 에러 표출
	if(validation_errors())
	{
		echo '<script type = "text/javascript">jAlert(\''.str_replace("\n", '', validation_errors()).'\', lang[\'alert\']);</script>';
	}

	//실패 에러
	if(isset($result_msg) == TRUE && $result_msg !== '') 
	{
		echo '<script type = "text/javascript">jAlert(\''.$result_msg.'\', lang[\'alert\']);</script>';
	}
?>

<form method = "post" name = "admin_setting_form" id = "admin_setting_form" action = "<?php echo BASE_URL; ?>admin/setting">

<fieldset>
	<legend><?php echo lang('basic_config_setting'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- 아이폰 계열 홈 화면 아이콘 경로 -->
			<tr>
				<th align = "left"><?php echo lang($setting['apple_touch_icon_path']['parameter']); ?></th>
				<td><input type = "text" name = "<?php echo $setting['apple_touch_icon_path']['parameter']; ?>" id = "<?php echo $setting['apple_touch_icon_path']['parameter']; ?>" value = "<?php echo $setting['apple_touch_icon_path']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['apple_touch_icon_path']['name']; ?><br />
				<?php echo $setting['apple_touch_icon_path']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['apple_touch_icon_path']['idx']; ?>)" /></td>
			</tr>
			<tr>
				<td colspan = "4" style = "color:#ff6600;"><?php echo lang('change_img_path_msg'); ?></td>
			</tr>
			<!-- 아이폰 계열 홈 화면 아이콘 광택 제거 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang($setting['apple_touch_icon_precomposed']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['apple_touch_icon_precomposed']['parameter']; ?>" id = "<?php echo $setting['apple_touch_icon_precomposed']['parameter']; ?>_0" value = "0" <?php if($setting['apple_touch_icon_precomposed']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['apple_touch_icon_precomposed']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['apple_touch_icon_precomposed']['parameter']; ?>" id = "<?php echo $setting['apple_touch_icon_precomposed']['parameter']; ?>_1" value = "1" <?php if($setting['apple_touch_icon_precomposed']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['apple_touch_icon_precomposed']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['apple_touch_icon_precomposed']['name']; ?><br />
				<?php echo $setting['apple_touch_icon_precomposed']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['apple_touch_icon_precomposed']['idx']; ?>)" /></td>
			</tr>
			<!-- 파비콘 경로 -->
			<tr>
				<th align = "left"><?php echo lang($setting['favicon_path']['parameter']); ?></th>
				<td><input type = "text" name = "<?php echo $setting['favicon_path']['parameter']; ?>" id = "<?php echo $setting['favicon_path']['parameter']; ?>" value = "<?php echo $setting['favicon_path']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['favicon_path']['name']; ?><br />
				<?php echo $setting['favicon_path']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['favicon_path']['idx']; ?>)" /></td>
			</tr>
            <tr>
                <td colspan = "4" style = "color:#ff6600;"><?php echo lang('change_img_path_msg'); ?></td>
            </tr>
			<!-- 브라우저 타이틀 타입 (0 :픽스, 1:유동) MOBILE -->
			<tr >
				<th align = "left"><?php echo lang($setting['browser_title_type']['parameter']); ?> [MOBILE]</th>
				<td><input type = "radio" name = "<?php echo $setting['browser_title_type']['parameter']; ?>" id = "<?php echo $setting['browser_title_type']['parameter']; ?>_0" value = "0" <?php if($setting['browser_title_type']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['browser_title_type']['parameter']; ?>_0"><?php echo lang('fix'); ?></label> <input type = "radio" name = "<?php echo $setting['browser_title_type']['parameter']; ?>" id = "<?php echo $setting['browser_title_type']['parameter']; ?>_1" value = "1" <?php if($setting['browser_title_type']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['browser_title_type']['parameter']; ?>_1"><?php echo lang('nofix'); ?></label></td>
				<td><?php echo $setting['browser_title_type']['name']; ?><br />
				<?php echo $setting['browser_title_type']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['browser_title_type']['idx']; ?>)" /></td>
			</tr>
			<!-- 브라우저 타이블 픽스 내용 MOBILE-->
			<tr id = "titlefix_mobile">
				<th align = "left"><?php echo lang($setting['browser_title_fix_value']['parameter']); ?> [MOBILE]</th>
				<td><input type = "text" name = "<?php echo $setting['browser_title_fix_value']['parameter']; ?>" id = "<?php echo $setting['browser_title_fix_value']['parameter']; ?>" value = "<?php echo $setting['browser_title_fix_value']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['browser_title_fix_value']['name']; ?><br />
				<?php echo $setting['browser_title_fix_value']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['browser_title_fix_value']['idx']; ?>)" /></td>
			</tr>
			<!-- 브라우저 타이틀 타입 (0 :픽스, 1:유동) PC -->
			<tr >
				<th align = "left"><?php echo lang($setting['browser_title_type']['parameter']); ?> [PC]</th>
				<td><input type = "radio" name = "<?php echo $setting['browser_title_type_pc']['parameter']; ?>" id = "<?php echo $setting['browser_title_type_pc']['parameter']; ?>_0" value = "0" <?php if($setting['browser_title_type_pc']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['browser_title_type_pc']['parameter']; ?>_0"><?php echo lang('fix'); ?></label> <input type = "radio" name = "<?php echo $setting['browser_title_type_pc']['parameter']; ?>" id = "<?php echo $setting['browser_title_type_pc']['parameter']; ?>_1" value = "1" <?php if($setting['browser_title_type_pc']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['browser_title_type_pc']['parameter']; ?>_1"><?php echo lang('nofix'); ?></label></td>
				<td><?php echo $setting['browser_title_type_pc']['name']; ?><br />
				<?php echo $setting['browser_title_type_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['browser_title_type_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 브라우저 타이블 픽스 내용 PC -->
			<tr id = 'titlefix_pc'>
				<th align = "left"><?php echo lang($setting['browser_title_fix_value']['parameter']); ?> [PC]</th>
				<td><input type = "text" name = "<?php echo $setting['browser_title_fix_value_pc']['parameter']; ?>" id = "<?php echo $setting['browser_title_fix_value_pc']['parameter']; ?>" value = "<?php echo $setting['browser_title_fix_value_pc']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['browser_title_fix_value_pc']['name']; ?><br />
				<?php echo $setting['browser_title_fix_value_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['browser_title_fix_value_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- date 함수 타입 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['datetime_type']['parameter']); ?> (<a href = "http://www.php.net/manual/en/function.date.php" target = "_blank">php.net</a>) [MOBILE]</th>
				<td><input type = "text" name = "<?php echo $setting['datetime_type']['parameter']; ?>" id = "<?php echo $setting['datetime_type']['parameter']; ?>" value = "<?php echo $setting['datetime_type']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['datetime_type']['name']; ?><br />
				<?php echo $setting['datetime_type']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['datetime_type']['idx']; ?>)" /></td>
			</tr>
			<!-- date 함수 타입 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['datetime_type']['parameter']); ?> (<a href = "http://www.php.net/manual/en/function.date.php" target = "_blank">php.net</a>) [PC]</th>
				<td><input type = "text" name = "<?php echo $setting['datetime_type_pc']['parameter']; ?>" id = "<?php echo $setting['datetime_type_pc']['parameter']; ?>" value = "<?php echo $setting['datetime_type_pc']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['datetime_type_pc']['name']; ?><br />
				<?php echo $setting['datetime_type_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['datetime_type_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 기본 타임존 -->
			<tr>
				<th align = "left" colspan = "2"><?php echo lang($setting['default_timezone']['parameter']); ?></th>
				<td rowspan = "2"><?php echo $setting['default_timezone']['name']; ?><br />
				<?php echo $setting['default_timezone']['client_ip']; ?></td>
				<td rowspan = "2"><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['default_timezone']['idx']; ?>)" /></td>
			</tr>
			<tr>
				<td colspan = "2"><?php echo timezone_menu($setting['default_timezone']['value']); ?></td>
			</tr>
			<!-- 포인트 단위 -->
			<tr>
				<th align = "left"><?php echo lang($setting['point_unit']['parameter']); ?></th>
				<td><input type = "text" name = "<?php echo $setting['point_unit']['parameter']; ?>" id = "<?php echo $setting['point_unit']['parameter']; ?>" value = "<?php echo $setting['point_unit']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['point_unit']['name']; ?><br />
				<?php echo $setting['point_unit']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['point_unit']['idx']; ?>)" /></td>
			</tr>
			<!-- 자동 새로고침 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang($setting['reload_time_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['reload_time_used']['parameter']; ?>" id = "<?php echo $setting['reload_time_used']['parameter']; ?>_0" value = "0" <?php if($setting['reload_time_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['reload_time_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['reload_time_used']['parameter']; ?>" id = "<?php echo $setting['reload_time_used']['parameter']; ?>_1" value = "1" <?php if($setting['reload_time_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['reload_time_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['reload_time_used']['name']; ?><br />
				<?php echo $setting['reload_time_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['reload_time_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 자동 새로고침 시간 (초) -->
			<tr>
				<th align = "left"><?php echo lang($setting['reload_time_value']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['reload_time_value']['parameter']; ?>" id = "<?php echo $setting['reload_time_value']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 60 ; $i++)
					{
						?>
						<option value = "<?php echo $i*60; ?>" <?php if($i*60 == $setting['reload_time_value']['value']) echo 'selected="selected"'; ?>><?php echo $i*60; ?> (<?php echo $i; ?><?php echo lang('minute'); ?>)</option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['reload_time_value']['name']; ?><br />
				<?php echo $setting['reload_time_value']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['reload_time_value']['idx']; ?>)" /></td>
			</tr>
			<!-- 글자수 자른 후 사용할 문자 -->
			<tr>
				<th align = "left"><?php echo lang($setting['string_after_cut_length']['parameter']); ?></th>
				<td><input type = "text" name = "<?php echo $setting['string_after_cut_length']['parameter']; ?>" id = "<?php echo $setting['string_after_cut_length']['parameter']; ?>" value = "<?php echo $setting['string_after_cut_length']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['string_after_cut_length']['name']; ?><br />
				<?php echo $setting['string_after_cut_length']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['string_after_cut_length']['idx']; ?>)" /></td>
			</tr>
		</tbody>
	</table>
</fieldset> 

<fieldset>
	<legend><?php echo lang('basic_config_connect'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- 접근 IP 내역 저장일 -->
			<tr>
				<th align = "left"><?php echo lang($setting['access_client_ip_save_day']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['access_client_ip_save_day']['parameter']; ?>" id = "<?php echo $setting['access_client_ip_save_day']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['access_client_ip_save_day']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['access_client_ip_save_day']['name']; ?><br />
				<?php echo $setting['access_client_ip_save_day']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['access_client_ip_save_day']['idx']; ?>)" /></td>
			</tr>
			<!-- 접근 IP 내역 저장 텀 (초) -->
			<tr>
				<th align = "left"><?php echo lang($setting['access_client_ip_save_term']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['access_client_ip_save_term']['parameter']; ?>" id = "<?php echo $setting['access_client_ip_save_term']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 60 ; $i++)
					{
						?>
						<option value = "<?php echo $i*60; ?>" <?php if($i*60 == $setting['access_client_ip_save_term']['value']) echo 'selected="selected"'; ?>><?php echo $i*60; ?> (<?php echo $i; ?><?php echo lang('minute'); ?>)</option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['access_client_ip_save_term']['name']; ?><br />
				<?php echo $setting['access_client_ip_save_term']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['access_client_ip_save_term']['idx']; ?>)" /></td>
			</tr>
			<!-- 차단된 IP에 보여줄 내용 -->
			<tr>
				<th align = "left"><?php echo lang($setting['block_client_ip_contents']['parameter']); ?></th>
				<td><textarea name = "<?php echo $setting['block_client_ip_contents']['parameter']; ?>" id = "<?php echo $setting['block_client_ip_contents']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo $setting['block_client_ip_contents']['value']; ?></textarea></td>
				<td><?php echo $setting['block_client_ip_contents']['name']; ?><br />
				<?php echo $setting['block_client_ip_contents']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['block_client_ip_contents']['idx']; ?>)" /></td>
			</tr>
			<!-- AJAX 타임아웃 -->
			<tr>
				<th align = "left"><?php echo lang($setting['ajax_timeout']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['ajax_timeout']['parameter']; ?>" id = "<?php echo $setting['ajax_timeout']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i*10; ?>" <?php if($i*10 == $setting['ajax_timeout']['value']) echo 'selected="selected"'; ?>><?php echo $i*10; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['ajax_timeout']['name']; ?><br />
				<?php echo $setting['ajax_timeout']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['ajax_timeout']['idx']; ?>)" /></td>
			</tr>
			<!-- 비밀번호 변경 안내 사용 여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang($setting['need_update_password_delay_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['need_update_password_delay_used']['parameter']; ?>" id = "<?php echo $setting['need_update_password_delay_used']['parameter']; ?>_0" value = "0" <?php if($setting['need_update_password_delay_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['need_update_password_delay_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['need_update_password_delay_used']['parameter']; ?>" id = "<?php echo $setting['need_update_password_delay_used']['parameter']; ?>_1" value = "1" <?php if($setting['need_update_password_delay_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['need_update_password_delay_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['need_update_password_delay_used']['name']; ?><br />
				<?php echo $setting['need_update_password_delay_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['need_update_password_delay_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 비밀번호 변경 안내 날짜 간격 (일) -->
			<tr>
				<th align = "left"><?php echo lang($setting['need_update_password_delay_value']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['need_update_password_delay_value']['parameter']; ?>" id = "<?php echo $setting['need_update_password_delay_value']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i*30; ?>" <?php if($i*30 == $setting['need_update_password_delay_value']['value']) echo 'selected="selected"'; ?>><?php echo $i*30; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['need_update_password_delay_value']['name']; ?><br />
				<?php echo $setting['need_update_password_delay_value']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['need_update_password_delay_value']['idx']; ?>)" /></td>
			</tr>
			<!-- 사이트 차단 여부 (0:오픈, 1:차단) -->
			<tr>
				<th align = "left"><?php echo lang($setting['site_block_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['site_block_used']['parameter']; ?>" id = "<?php echo $setting['site_block_used']['parameter']; ?>_0" value = "0" <?php if($setting['site_block_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['site_block_used']['parameter']; ?>_0"><?php echo lang('open'); ?></label> <input type = "radio" name = "<?php echo $setting['site_block_used']['parameter']; ?>" id = "<?php echo $setting['site_block_used']['parameter']; ?>_1" value = "1" <?php if($setting['site_block_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['site_block_used']['parameter']; ?>_1"><?php echo lang('block'); ?></label></td>
				<td><?php echo $setting['site_block_used']['name']; ?><br />
				<?php echo $setting['site_block_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['site_block_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 사이트 차단시 보여줄 내용 -->
			<tr>
				<th align = "left"><?php echo lang($setting['site_block_contents']['parameter']); ?></th>
				<td><textarea name = "<?php echo $setting['site_block_contents']['parameter']; ?>" id = "<?php echo $setting['site_block_contents']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo $setting['site_block_contents']['value']; ?></textarea></td>
				<td><?php echo $setting['site_block_contents']['name']; ?><br />
				<?php echo $setting['site_block_contents']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['site_block_contents']['idx']; ?>)" /></td>
			</tr>
		</tbody>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo lang('basic_config_board'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- CAPTCHA 유효시간 (초) -->
			<tr>
				<th align = "left"><?php echo lang($setting['captcha_timeout']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['captcha_timeout']['parameter']; ?>" id = "<?php echo $setting['captcha_timeout']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 5 ; $i++)
					{
						?>
						<option value = "<?php echo $i*3600; ?>" <?php if($i*3600 == $setting['captcha_timeout']['value']) echo 'selected="selected"'; ?>><?php echo $i*3600; ?> (<?php echo $i; ?><?php echo lang('hour'); ?>)</option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['captcha_timeout']['name']; ?><br />
				<?php echo $setting['captcha_timeout']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['captcha_timeout']['idx']; ?>)" /></td>
			</tr>
			<!-- 게시판 첨부파일 개인별 총 허용 용량 사용 여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang($setting['bbs_upload_limit_user_capacity_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['bbs_upload_limit_user_capacity_used']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_limit_user_capacity_used']['parameter']; ?>_0" value = "0" <?php if($setting['bbs_upload_limit_user_capacity_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_upload_limit_user_capacity_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['bbs_upload_limit_user_capacity_used']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_limit_user_capacity_used']['parameter']; ?>_1" value = "1" <?php if($setting['bbs_upload_limit_user_capacity_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['bbs_upload_limit_user_capacity_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['bbs_upload_limit_user_capacity_used']['name']; ?><br />
				<?php echo $setting['bbs_upload_limit_user_capacity_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_upload_limit_user_capacity_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 게시판 첨부파일 개인별 총 허용 용량 (byte) -->
			<tr>
				<th align = "left"><?php echo lang($setting['bbs_upload_limit_user_capacity']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['bbs_upload_limit_user_capacity']['parameter']; ?>" id = "<?php echo $setting['bbs_upload_limit_user_capacity']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 50 ; $i++)
					{
						?>
						<option value = "<?php echo $i*1024*1024*10; ?>" <?php if($i*1024*1024*10 == $setting['bbs_upload_limit_user_capacity']['value']) echo 'selected="selected"'; ?>><?php echo $i*1024*1024*10; ?> (<?php echo byte_format($i*1024*1024*10); ?>)</option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['bbs_upload_limit_user_capacity']['name']; ?><br />
				<?php echo $setting['bbs_upload_limit_user_capacity']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['bbs_upload_limit_user_capacity']['idx']; ?>)" /></td>
			</tr>
			<!-- 최근댓글 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['recently_comment_count']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['recently_comment_count']['parameter']; ?>" id = "<?php echo $setting['recently_comment_count']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['recently_comment_count']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['recently_comment_count']['name']; ?><br />
				<?php echo $setting['recently_comment_count']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['recently_comment_count']['idx']; ?>)" /></td>
			</tr>
			<!-- 최근댓글 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['recently_comment_count']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['recently_comment_count_pc']['parameter']; ?>" id = "<?php echo $setting['recently_comment_count_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 10 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['recently_comment_count_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['recently_comment_count_pc']['name']; ?><br />
				<?php echo $setting['recently_comment_count_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['recently_comment_count_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 최근댓글 자를 글자수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['cut_length_recently_comment']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['cut_length_recently_comment']['parameter']; ?>" id = "<?php echo $setting['cut_length_recently_comment']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['cut_length_recently_comment']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['cut_length_recently_comment']['name']; ?><br />
				<?php echo $setting['cut_length_recently_comment']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['cut_length_recently_comment']['idx']; ?>)" /></td>
			</tr>
			<!-- 최근댓글 자를 글자수 PC-->
			<tr>
				<th align = "left"><?php echo lang($setting['cut_length_recently_comment']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['cut_length_recently_comment_pc']['parameter']; ?>" id = "<?php echo $setting['cut_length_recently_comment_pc']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['cut_length_recently_comment_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['cut_length_recently_comment_pc']['name']; ?><br />
				<?php echo $setting['cut_length_recently_comment_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['cut_length_recently_comment_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [검색] 한페이지에서 보여줄 리스트 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_search']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_list_search']['parameter']; ?>" id = "<?php echo $setting['count_list_search']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_search']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_search']['name']; ?><br />
				<?php echo $setting['count_list_search']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_search']['idx']; ?>)" /></td>
			</tr>
			<!-- [검색] 한페이지에서 보여줄 리스트 갯수 PC-->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_search']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_list_search_pc']['parameter']; ?>" id = "<?php echo $setting['count_list_search_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_search_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_search_pc']['name']; ?><br />
				<?php echo $setting['count_list_search_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_search_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [검색] 리스트 하단 페이지 수 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_search']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_page_search']['parameter']; ?>" id = "<?php echo $setting['count_page_search']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_search']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_search']['name']; ?><br />
				<?php echo $setting['count_page_search']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_search']['idx']; ?>)" /></td>
			</tr>
			<!-- [검색] 리스트 하단 페이지 수 갯수 PC-->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_search']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_page_search_pc']['parameter']; ?>" id = "<?php echo $setting['count_page_search_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_search_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_search_pc']['name']; ?><br />
				<?php echo $setting['count_page_search_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_search_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [검색] 리스트 제목 자를 글자수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['cut_length_title_search']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['cut_length_title_search']['parameter']; ?>" id = "<?php echo $setting['cut_length_title_search']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['cut_length_title_search']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['cut_length_title_search']['name']; ?><br />
				<?php echo $setting['cut_length_title_search']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['cut_length_title_search']['idx']; ?>)" /></td>
			</tr>
			<!-- [검색] 리스트 제목 자를 글자수 PC-->
			<tr>
				<th align = "left"><?php echo lang($setting['cut_length_title_search']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['cut_length_title_search_pc']['parameter']; ?>" id = "<?php echo $setting['cut_length_title_search_pc']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['cut_length_title_search_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['cut_length_title_search_pc']['name']; ?><br />
				<?php echo $setting['cut_length_title_search_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['cut_length_title_search_pc']['idx']; ?>)" /></td>
			</tr>
		</tbody>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo lang('basic_config_mypage'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- [포인트내역] 한페이지에서 보여줄 리스트 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_point']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_list_point']['parameter']; ?>" id = "<?php echo $setting['count_list_point']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_point']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_point']['name']; ?><br />
				<?php echo $setting['count_list_point']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_point']['idx']; ?>)" /></td>
			</tr>
			<!-- [포인트내역] 한페이지에서 보여줄 리스트 갯수 PC-->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_point']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_list_point_pc']['parameter']; ?>" id = "<?php echo $setting['count_list_point_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_point_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_point_pc']['name']; ?><br />
				<?php echo $setting['count_list_point_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_point_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [포인트내역] 리스트 하단 페이지 수 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_point']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_page_point']['parameter']; ?>" id = "<?php echo $setting['count_page_point']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_point']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_point']['name']; ?><br />
				<?php echo $setting['count_page_point']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_point']['idx']; ?>)" /></td>
			</tr>
			<!-- [포인트내역] 리스트 하단 페이지 수 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_point']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_page_point_pc']['parameter']; ?>" id = "<?php echo $setting['count_page_point_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_point_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_point_pc']['name']; ?><br />
				<?php echo $setting['count_page_point_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_point_pc']['idx']; ?>)" /></td>
			</tr>
			</tr>	
			<!-- [스크랩] 한페이지에서 보여줄 리스트 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_scrap']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_list_scrap']['parameter']; ?>" id = "<?php echo $setting['count_list_scrap']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_scrap']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_scrap']['name']; ?><br />
				<?php echo $setting['count_list_scrap']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_scrap']['idx']; ?>)" /></td>
			</tr>
			<!-- [스크랩] 한페이지에서 보여줄 리스트 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_scrap']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_list_scrap_pc']['parameter']; ?>" id = "<?php echo $setting['count_list_scrap_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_scrap_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_scrap_pc']['name']; ?><br />
				<?php echo $setting['count_list_scrap_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_scrap_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [스크랩] 리스트 하단 페이지 수 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_scrap']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_page_scrap']['parameter']; ?>" id = "<?php echo $setting['count_page_scrap']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_scrap']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_scrap']['name']; ?><br />
				<?php echo $setting['count_page_scrap']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_scrap']['idx']; ?>)" /></td>
			</tr>
			<!-- [스크랩] 리스트 하단 페이지 수 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_scrap']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_page_scrap_pc']['parameter']; ?>" id = "<?php echo $setting['count_page_scrap_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_scrap_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_scrap_pc']['name']; ?><br />
				<?php echo $setting['count_page_scrap_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_scrap_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [스크랩] 리스트 제목 자를 글자수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['cut_length_title_scrap']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['cut_length_title_scrap']['parameter']; ?>" id = "<?php echo $setting['cut_length_title_scrap']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['cut_length_title_scrap']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['cut_length_title_scrap']['name']; ?><br />
				<?php echo $setting['cut_length_title_scrap']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['cut_length_title_scrap']['idx']; ?>)" /></td>
			</tr>
			<!-- [스크랩] 리스트 제목 자를 글자수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['cut_length_title_scrap']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['cut_length_title_scrap_pc']['parameter']; ?>" id = "<?php echo $setting['cut_length_title_scrap_pc']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['cut_length_title_scrap_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['cut_length_title_scrap_pc']['name']; ?><br />
				<?php echo $setting['cut_length_title_scrap_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['cut_length_title_scrap_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [메시지] 한페이지에서 보여줄 리스트 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_message']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_list_message']['parameter']; ?>" id = "<?php echo $setting['count_list_message']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_message']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_message']['name']; ?><br />
				<?php echo $setting['count_list_message']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_message']['idx']; ?>)" /></td>
			</tr>
			<!-- [메시지] 한페이지에서 보여줄 리스트 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_message']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_list_message_pc']['parameter']; ?>" id = "<?php echo $setting['count_list_message_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_message_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_message_pc']['name']; ?><br />
				<?php echo $setting['count_list_message_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_message_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [메시지] 리스트 하단 페이지 수 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_message']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_page_message']['parameter']; ?>" id = "<?php echo $setting['count_page_message']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_message']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_message']['name']; ?><br />
				<?php echo $setting['count_page_message']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_message']['idx']; ?>)" /></td>
			</tr>
			<!-- [메시지] 리스트 하단 페이지 수 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_message']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_page_message_pc']['parameter']; ?>" id = "<?php echo $setting['count_page_message_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_message_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_message_pc']['name']; ?><br />
				<?php echo $setting['count_page_message_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_message_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [메시지] 리스트 제목 자를 글자수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['cut_length_title_message']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['cut_length_title_message']['parameter']; ?>" id = "<?php echo $setting['cut_length_title_message']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['cut_length_title_message']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['cut_length_title_message']['name']; ?><br />
				<?php echo $setting['cut_length_title_message']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['cut_length_title_message']['idx']; ?>)" /></td>
			</tr>
			<!-- [메시지] 리스트 제목 자를 글자수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['cut_length_title_message']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['cut_length_title_message_pc']['parameter']; ?>" id = "<?php echo $setting['cut_length_title_message_pc']['parameter']; ?>">
				<?php
					for($i = 0 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['cut_length_title_message_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['cut_length_title_message_pc']['name']; ?><br />
				<?php echo $setting['cut_length_title_message_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['cut_length_title_message_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [친구관리] 한페이지에서 보여줄 리스트 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_friend']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_list_friend']['parameter']; ?>" id = "<?php echo $setting['count_list_friend']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_friend']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_friend']['name']; ?><br />
				<?php echo $setting['count_list_friend']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_friend']['idx']; ?>)" /></td>
			</tr>
			<!-- [친구관리] 한페이지에서 보여줄 리스트 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_list_friend']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_list_friend_pc']['parameter']; ?>" id = "<?php echo $setting['count_list_friend_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_list_friend_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['count_list_friend_pc']['name']; ?><br />
				<?php echo $setting['count_list_friend_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_list_friend_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- [친구관리] 리스트 하단 페이지 수 갯수 MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_friend']['parameter']); ?> [MOBILE]</th>
				<td><select name = "<?php echo $setting['count_page_friend']['parameter']; ?>" id = "<?php echo $setting['count_page_friend']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_friend']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_friend']['name']; ?><br />
				<?php echo $setting['count_page_friend']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_search']['idx']; ?>)" /></td>
			</tr>
			<!-- [친구관리] 리스트 하단 페이지 수 갯수 PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['count_page_friend']['parameter']); ?> [PC]</th>
				<td><select name = "<?php echo $setting['count_page_friend_pc']['parameter']; ?>" id = "<?php echo $setting['count_page_friend_pc']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['count_page_friend_pc']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select> (3? => << < <u>1 2 3</u> <b>4</b> <u>5 6 7</u> > >>)</td>
				<td><?php echo $setting['count_page_friend_pc']['name']; ?><br />
				<?php echo $setting['count_page_friend_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['count_page_search_pc']['idx']; ?>)" /></td>
			</tr>
		</tbody>
	</table>
</fieldset>

<fieldset>
	<legend><?php echo lang('basic_config_member'); ?></legend>
	<table class="data-table">
		<colgroup>
			<col width = "40%" />
			<col width = "35%" />
			<col width = "15%" />
			<col width = "15%" />
		</colgroup>
		<tbody>
			<tr>
				<th><?php echo lang('parameter'); ?></th>
				<th><?php echo lang('value'); ?></th>
				<th><?php echo lang('exec_user'); ?></th>
				<th><?php echo lang('revision'); ?></th>
			</tr>
			<!-- 가입 기본 그룹 -->
			<tr>
				<th align = "left"><?php echo lang($setting['default_group_idx']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['default_group_idx']['parameter']; ?>" id = "<?php echo $setting['default_group_idx']['parameter']; ?>">
				<?php
					foreach($users_group as $k=>$v)
					{
						?>
						<option value = "<?php echo $v->idx; ?>" <?php if($v->idx == $setting['default_group_idx']['value']) echo 'selected="selected"'; ?>><?php echo $v->group_name; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['default_group_idx']['name']; ?><br />
				<?php echo $setting['default_group_idx']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['default_group_idx']['idx']; ?>)" /></td>
			</tr>
			<!-- 아바타 사용여부 (1:사용, 0:미사용) MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['avatar_used']['parameter']); ?> [MOBILE]</th>
				<td><input type = "radio" name = "<?php echo $setting['avatar_used']['parameter']; ?>" id = "<?php echo $setting['avatar_used']['parameter']; ?>_0" value = "0" <?php if($setting['avatar_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['avatar_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['avatar_used']['parameter']; ?>" id = "<?php echo $setting['avatar_used']['parameter']; ?>_1" value = "1" <?php if($setting['avatar_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['avatar_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['avatar_used']['name']; ?><br />
				<?php echo $setting['avatar_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['avatar_used']['idx']; ?>)" /></td>
			</tr>
			<!-- 아바타 사용여부 (1:사용, 0:미사용) PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['avatar_used']['parameter']); ?> [PC]</th>
				<td><input type = "radio" name = "<?php echo $setting['avatar_used_pc']['parameter']; ?>" id = "<?php echo $setting['avatar_used_pc']['parameter']; ?>_0" value = "0" <?php if($setting['avatar_used_pc']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['avatar_used_pc']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['avatar_used_pc']['parameter']; ?>" id = "<?php echo $setting['avatar_used_pc']['parameter']; ?>_1" value = "1" <?php if($setting['avatar_used_pc']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['avatar_used_pc']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['avatar_used_pc']['name']; ?><br />
				<?php echo $setting['avatar_used_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['avatar_used_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 아바타 이미지 파일 용량 (byte) -->
			<tr>
				<th align = "left"><?php echo lang($setting['avatar_limit_capacity']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['avatar_limit_capacity']['parameter']; ?>" id = "<?php echo $setting['avatar_limit_capacity']['parameter']; ?>">
				<?php
					$min = min(5, floor(FILE_UPLOAD_MAX_SIZE / 1024 / 1024));
	
					for($i = 1 ; $i <= $min ; $i++)
					{
						?>
						<option value = "<?php echo $i*1024*1024; ?>" <?php if($i*1024*1024 == $setting['avatar_limit_capacity']['value']) echo 'selected="selected"'; ?>><?php echo $i*1024*1024; ?> (<?php echo byte_format($i*1024*1024); ?>)</option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['avatar_limit_capacity']['name']; ?><br />
				<?php echo $setting['avatar_limit_capacity']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['avatar_limit_capacity']['idx']; ?>)" /></td>
			</tr>
			<!-- 아바타 이미지 사이즈 제한 (가로px) -->
			<tr>
				<th align = "left"><?php echo lang($setting['avatar_limit_image_size_width']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['avatar_limit_image_size_width']['parameter']; ?>" id = "<?php echo $setting['avatar_limit_image_size_width']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['avatar_limit_image_size_width']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['avatar_limit_image_size_width']['name']; ?><br />
				<?php echo $setting['avatar_limit_image_size_width']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['avatar_limit_image_size_width']['idx']; ?>)" /></td>
			</tr>
			<!-- 아바타 이미지 사이즈 제한 (세로px) -->
			<tr>
				<th align = "left"><?php echo lang($setting['avatar_limit_image_size_height']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['avatar_limit_image_size_height']['parameter']; ?>" id = "<?php echo $setting['avatar_limit_image_size_height']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 100 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['avatar_limit_image_size_height']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['avatar_limit_image_size_height']['name']; ?><br />
				<?php echo $setting['avatar_limit_image_size_height']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['avatar_limit_image_size_height']['idx']; ?>)" /></td>
			</tr>
			<!-- 비밀번호 찾기 메일 제목 -->
			<tr>
				<th align = "left"><?php echo lang($setting['new_password_mail_title']['parameter']); ?></th>
				<td><input type = "text" name = "<?php echo $setting['new_password_mail_title']['parameter']; ?>" id = "<?php echo $setting['new_password_mail_title']['parameter']; ?>" value = "<?php echo $setting['new_password_mail_title']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['new_password_mail_title']['name']; ?><br />
				<?php echo $setting['new_password_mail_title']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['new_password_mail_title']['idx']; ?>)" /></td>
			</tr>
			<!-- 비밀번호 찾기 메일 내용 -->
			<tr>
				<th align = "left"><?php echo lang($setting['new_password_mail_contents']['parameter']); ?></th>
				<td><textarea name = "<?php echo $setting['new_password_mail_contents']['parameter']; ?>" id = "<?php echo $setting['new_password_mail_contents']['parameter']; ?>" class = "text" style = "width:90%" rows = "10"><?php echo $setting['new_password_mail_contents']['value']; ?></textarea></td>
				<td><?php echo $setting['new_password_mail_contents']['name']; ?><br />
				<?php echo $setting['new_password_mail_contents']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['new_password_mail_contents']['idx']; ?>)" /></td>
			</tr>
			<!-- 임시 비밀번호 유효시간 (초) -->
			<tr>
				<th align = "left"><?php echo lang($setting['new_password_timeout']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['new_password_timeout']['parameter']; ?>" id = "<?php echo $setting['new_password_timeout']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 5 ; $i++)
					{
						?>
						<option value = "<?php echo $i*3600; ?>" <?php if($i*3600 == $setting['new_password_timeout']['value']) echo 'selected="selected"'; ?>><?php echo $i*3600; ?> (<?php echo $i; ?><?php echo lang('hour'); ?>)</option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['new_password_timeout']['name']; ?><br />
				<?php echo $setting['new_password_timeout']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['new_password_timeout']['idx']; ?>)" /></td>
			</tr>
			<!-- 회원 ID 최대 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang($setting['user_id_length_maximum']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['user_id_length_maximum']['parameter']; ?>" id = "<?php echo $setting['user_id_length_maximum']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 32 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['user_id_length_maximum']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['user_id_length_maximum']['name']; ?><br />
				<?php echo $setting['user_id_length_maximum']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['user_id_length_maximum']['idx']; ?>)" /></td>
			</tr>
			<!-- 회원 ID 최소 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang($setting['user_id_length_minimum']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['user_id_length_minimum']['parameter']; ?>" id = "<?php echo $setting['user_id_length_minimum']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 32 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['user_id_length_minimum']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['user_id_length_minimum']['name']; ?><br />
				<?php echo $setting['user_id_length_minimum']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['user_id_length_minimum']['idx']; ?>)" /></td>
			</tr>
			<!-- 회원 이름 최대 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang($setting['user_name_length_maximum']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['user_name_length_maximum']['parameter']; ?>" id = "<?php echo $setting['user_name_length_maximum']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 16 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['user_name_length_maximum']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['user_name_length_maximum']['name']; ?><br />
				<?php echo $setting['user_name_length_maximum']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['user_name_length_maximum']['idx']; ?>)" /></td>
			</tr>
			<!-- 회원 이름 최소 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang($setting['user_name_length_minimum']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['user_name_length_minimum']['parameter']; ?>" id = "<?php echo $setting['user_name_length_minimum']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 16 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['user_name_length_minimum']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['user_name_length_minimum']['name']; ?><br />
				<?php echo $setting['user_name_length_minimum']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['user_name_length_minimum']['idx']; ?>)" /></td>
			</tr>
			<!-- 회원 닉네임 최대 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang($setting['user_nickname_length_maximum']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['user_nickname_length_maximum']['parameter']; ?>" id = "<?php echo $setting['user_nickname_length_maximum']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 16 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['user_nickname_length_maximum']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['user_nickname_length_maximum']['name']; ?><br />
				<?php echo $setting['user_nickname_length_maximum']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['user_nickname_length_maximum']['idx']; ?>)" /></td>
			</tr>
			<!-- 회원 닉네임 최소 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang($setting['user_nickname_length_minimum']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['user_nickname_length_minimum']['parameter']; ?>" id = "<?php echo $setting['user_nickname_length_minimum']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 16 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['user_nickname_length_minimum']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['user_nickname_length_minimum']['name']; ?><br />
				<?php echo $setting['user_nickname_length_minimum']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['user_nickname_length_minimum']['idx']; ?>)" /></td>
			</tr>
			<!-- 회원 비번 최대 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang($setting['user_password_length_maximum']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['user_password_length_maximum']['parameter']; ?>" id = "<?php echo $setting['user_password_length_maximum']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 16 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['user_password_length_maximum']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['user_password_length_maximum']['name']; ?><br />
				<?php echo $setting['user_password_length_maximum']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['user_password_length_maximum']['idx']; ?>)" /></td>
			</tr>
			<!-- 회원 비번 최소 글자 수 -->
			<tr>
				<th align = "left"><?php echo lang($setting['user_password_length_minimum']['parameter']); ?></th>
				<td><select name = "<?php echo $setting['user_password_length_minimum']['parameter']; ?>" id = "<?php echo $setting['user_password_length_minimum']['parameter']; ?>">
				<?php
					for($i = 1 ; $i <= 16 ; $i++)
					{
						?>
						<option value = "<?php echo $i; ?>" <?php if($i == $setting['user_password_length_minimum']['value']) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
						<?php
					}
				?>
				</select></td>
				<td><?php echo $setting['user_password_length_minimum']['name']; ?><br />
				<?php echo $setting['user_password_length_minimum']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['user_password_length_minimum']['idx']; ?>)" /></td>
			</tr>
			<!-- 이름 표출 형태 ({user_id},{nickname},{name} 조합) MOBILE -->
			<tr>
				<th align = "left"><?php echo lang($setting['view_name_type']['parameter']); ?> [MOBILE]</th>
				<td><input type = "text" name = "<?php echo $setting['view_name_type']['parameter']; ?>" id = "<?php echo $setting['view_name_type']['parameter']; ?>" value = "<?php echo $setting['view_name_type']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['view_name_type']['name']; ?><br />
				<?php echo $setting['view_name_type']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['view_name_type']['idx']; ?>)" /></td>
			</tr>
			<!-- 이름 표출 형태 ({user_id},{nickname},{name} 조합) PC -->
			<tr>
				<th align = "left"><?php echo lang($setting['view_name_type']['parameter']); ?> [PC]</th>
				<td><input type = "text" name = "<?php echo $setting['view_name_type_pc']['parameter']; ?>" id = "<?php echo $setting['view_name_type_pc']['parameter']; ?>" value = "<?php echo $setting['view_name_type_pc']['value']; ?>" class = "text" /></td>
				<td><?php echo $setting['view_name_type_pc']['name']; ?><br />
				<?php echo $setting['view_name_type_pc']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['view_name_type_pc']['idx']; ?>)" /></td>
			</tr>
			<!-- 회원가입 사용여부 (0:미사용, 1:사용) -->
			<tr>
				<th align = "left"><?php echo lang($setting['join_used']['parameter']); ?></th>
				<td><input type = "radio" name = "<?php echo $setting['join_used']['parameter']; ?>" id = "<?php echo $setting['join_used']['parameter']; ?>_0" value = "0" <?php if($setting['join_used']['value'] == 0) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['join_used']['parameter']; ?>_0"><?php echo lang('is_used_0'); ?></label> <input type = "radio" name = "<?php echo $setting['join_used']['parameter']; ?>" id = "<?php echo $setting['join_used']['parameter']; ?>_1" value = "1" <?php if($setting['join_used']['value'] == 1) echo 'checked="checked"'; ?> /><label for="<?php echo $setting['join_used']['parameter']; ?>_1"><?php echo lang('is_used_1'); ?></label></td>
				<td><?php echo $setting['join_used']['name']; ?><br />
				<?php echo $setting['join_used']['client_ip']; ?></td>
				<td><input type = "button" value = "<?php echo lang('revision'); ?>" class="button" onclick = "setting_revision(<?php echo $setting['join_used']['idx']; ?>)" /></td>
			</tr>
		</tbody>
	</table>
</fieldset>

<table class="data-table">
	<tbody>
		<tr>
			<td><div align = "center"><input type = "submit" value = "<?php echo lang('update'); ?>" class = "button" /></div></td>
		</tr>
	</tbody>
</table>
</form>
