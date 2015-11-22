<div style="margin:5px 0px 5px 0px;">
{USER_name_print}{? IS_ADMIN === TRUE} <a class="btn btn-danger btn-mini" href="javascript:void(0);" onclick="window.open('{BASE_URL}admin/setting');">ADMIN</a>{/}<br />
{lang.point} : {USER_INFO_point}{SETTING_point_unit}

<br />

<a href="javascript:void(0);" onclick="location.href='{BASE_URL}user/point/';" class="btn btn-link btn-mini">{lang.menu_user_point}</a> <a href="javascript:void(0);" onclick="location.href='{BASE_URL}user/friend/';" class="btn btn-link btn-mini">{lang.menu_user_friend}</a> <a href="javascript:void(0);" onclick="location.href='{BASE_URL}user/scrap/';" class="btn btn-link btn-mini">{lang.menu_user_scrap}</a>

<br />

<a href="javascript:void(0);" onclick="location.href='{BASE_URL}user/message/';" class="btn btn-info btn-mini">{lang.menu_user_message}</a> <a href="javascript:void(0);" onclick="location.href='{BASE_URL}user/modify/';" class="btn btn-success btn-mini">{lang.menu_user_modify}</a> <a href="javascript:void(0);" onclick="location.href='{BASE_URL}user/logout/';" class="btn btn-inverse btn-mini">{lang.btn_logout}</a>


</div>
