<strong><?php echo lang('install_minimum_requirements'); ?></strong>

<table class = "data-table">
    <colgroup>
        <col width = "30%" />
        <col width = "50%" />
        <col width = "20%" />
    </colgroup>
    <tbody>
        <tr>
            <th></th>
            <th><?php echo lang('install_version'); ?></th>
            <th><?php echo lang('install_status'); ?></th>
        </tr>
        <tr>
            <th>PHP</th>
            <td><?php echo $php_version; ?></td>
            <td><?php echo $php_version_usable ? 'O' : '<b>X</b>'; ?></td>
        </tr>
        <tr>
            <th>Curl</th>
            <td><?php echo $curl_version; ?></td>
            <td><?php echo $curl_usable ? 'O' : '<b>X</b>'; ?></td>
        </tr>
        <tr>
            <th>GD</th>
            <td><?php echo $gd_version; ?></td>
            <td><?php echo $gd_usable ? 'O' : '<b>X</b>'; ?></td>
        </tr>
        <tr>
            <th>Timezone</th>
            <td><?php echo $timezone; ?></td>
            <td><?php echo $timezone_usable ? 'O' : '<b>X</b>'; ?></td>
        </tr>
        <tr>
            <th>mbstring</th>
            <td>-</td>
            <td><?php echo $mbstring_usable ? 'O' : '<b>X</b>'; ?></td>
        </tr>
    </tbody>
</table>

<strong><?php echo lang('install_path_permission'); ?></strong>

<table class = "data-table">
    <colgroup>
        <col width = "70%" />
        <col width = "15%" />
        <col width = "10%" />
    </colgroup>
    <tbody>
        <tr>
            <th><?php echo lang('install_path'); ?></th>
            <th><?php echo lang('install_require_permission'); ?></th>
            <th><?php echo lang('install_status'); ?></th>
        </tr>
        <?php
            foreach($chmod['result'] as $k=>$v)
            {
                ?>
        <tr>
            <th><?php echo $v['path']; ?></th>
            <th>0777</th>
            <td><?php echo $v['status'] == TRUE ? 'O' : 'X'; ?></td>
        </tr>
                <?php
            }
        ?>
    </tbody>
</table>

<strong>DB</strong>

<form method = "post" name = "test_db_form" id = "test_db_form" action = "<?php echo BASE_URL; ?>admin/install/tapbbs">
<input type = "hidden" name = "test_db_result" id = "test_db_result" value = "" />
<input type = "hidden" name = "check_default" id = "check_default" value = "<?php echo $check_default; ?>" />
<table class = "data-table">
    <colgroup>
        <col width = "30%" />
        <col width = "*" />
    </colgroup>
    <tbody>
        <tr>
            <th>Hostname</th>
            <td><input type = "text" class = "text" name = "hostname" id = "hostname" value = "localhost" /></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><input type = "text" class = "text" name = "username" id = "username" value = "" /></td>
        </tr>
        <tr>
            <th>Password</th>
            <td><input type = "text" class = "text" name = "password" id = "password" value = "" /></td>
        </tr>
        <tr>
            <th>Database</th>
            <td><input type = "text" class = "text" name = "database" id = "database" value = "" /></td>
        </tr>
        <tr>
            <th>Port</th>
            <td><input type = "text" class = "text" name = "port" id = "port" value = "3306" /></td>
        </tr>
        <tr>
            <th>Engine</th>
            <td><label><input type = "radio" name = "engine" id = "engine" value = "MYISAM" checked = "checked" /> MYISAM</label> <span id = "innodb" style = "display:none"><label><input type = "radio" name = "engine" id = "engine" value = "INNODB" /> INNODB</label></span></td>
        </tr>
        <tr>
            <th>Trigger</th>
            <td><span id = "trigger_usable"><?php echo lang('install_trigger_basic_msg'); ?></span></td>
        </tr>
        <tr>
            <th colspan = "2"><div align = "center"><input type = "button" class = "button" value = "<?php echo lang('install_test_db_connect'); ?>" onclick = "test_db('<?php echo BASE_URL; ?>')" /></div></th>
        </tr>
        <tr id = "admin_account" style = "display:none;">
        		<th><?php echo lang('install_admin_account'); ?></th>
        		<td>ID : <input type = "text" class = "text" name = "admin_id" id = "admin_id" value = "admin" style = "width:200px" /> PW : <input type = "text" class = "text" name = "admin_pw" id = "admin_pw" value = "111" style = "width:200px" /></td>
        </tr>
        <tr id = "submit" style = "display:none;">
            <th colspan = "2"><div align = "center"><input type = "submit" class = "button" value = "<?php echo lang('install'); ?>" /></div></th>
        </tr>
    </tbody>
</table>
</form>

※ <?php echo lang('back_door_msg');