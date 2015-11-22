{USER_name_print}<br />
{lang.point} : {USER_INFO_point}{SETTING_point_unit}<br />
<a href = "javascript:void(0): onclick = "location.href='{BASE_URL}user/logout/';">{lang.btn_logout}</a><br />
<a href = "javascript:void(0): onclick = "location.href='{BASE_URL}user/modify/';">{lang.menu_user_modify}</a><br />
<a href = "javascript:void(0): onclick = "location.href='{BASE_URL}user/point/';">{lang.menu_user_point}</a><br />
<a href = "javascript:void(0): onclick = "location.href='{BASE_URL}user/scrap/';">{lang.menu_user_scrap}</a><br />
<a href = "javascript:void(0): onclick = "location.href='{BASE_URL}user/message/';">{lang.menu_user_message}</a><br />
<a href = "javascript:void(0): onclick = "location.href='{BASE_URL}user/friend/';">{lang.menu_user_friend}</a><br />
{? IS_ADMIN === TRUE}<a href = "javascript:void(0);" onclick = "window.open('{BASE_URL}admin/setting');">{lang.btn_admin}</a>{/}