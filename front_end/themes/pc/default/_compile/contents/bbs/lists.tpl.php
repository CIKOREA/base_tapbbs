<?php /* Template_ 2.2.7 2015/11/23 00:40:49 /cloud9/workspace/cikorea/front_end/themes/pc/default/_template/contents/bbs/lists.tpl 000005326 */ 
$TPL_category_1=empty($TPL_VAR["category"])||!is_array($TPL_VAR["category"])?0:count($TPL_VAR["category"]);
$TPL_lists_1=empty($TPL_VAR["lists"])||!is_array($TPL_VAR["lists"])?0:count($TPL_VAR["lists"]);?>
<div class="row-fluid">
    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title"><?php echo $TPL_VAR["BBS_SETTING_bbs_name"]?></div>
<?php if($TPL_VAR["rss_allow"]==TRUE){?>
            <div class="buttons">
                <a href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/rss/<?php echo $TPL_VAR["bbs_id"]?>" target="_blank" class="btn btn-small btn-inverse">RSS</a>
            </div>
<?php }?>
    </div>
</div>
<div class="clearfix"></div>

<div class="btn-toolbar">

<?php if($TPL_VAR["is_use_category"]===TRUE){?>
    <input type = "hidden" name = "lists_style" id = "lists_style" value = "<?php echo $TPL_VAR["lists_style"]?>" />
    <select name="category" id="view_category">
        <option value="">== <?php echo $TPL_VAR["lang"]["select"]?> ==</option>
<?php if($TPL_category_1){foreach($TPL_VAR["category"] as $TPL_V1){?>
        <option value="<?php echo $TPL_V1->idx?>" <?php echo $TPL_V1->selected?>><?php echo $TPL_V1->category_name?></option>
<?php }}?>
    </select>
<?php }?>

  <div class="btn-group right" style = "margin-bottom:20px">
    <a class="btn btn-info" href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/lists/<?php echo $TPL_VAR["bbs_id"]?>?page=<?php echo $TPL_VAR["page"]?>&view_category=<?php echo $TPL_VAR["view_category"]?>&lists_style="><i class="icon-align-justify"></i></a>
    <a class="btn" href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/lists/<?php echo $TPL_VAR["bbs_id"]?>?page=<?php echo $TPL_VAR["page"]?>&view_category=<?php echo $TPL_VAR["view_category"]?>&lists_style=webzine"><i class="icon-th-list"></i></a>
    <a class="btn" href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/lists/<?php echo $TPL_VAR["bbs_id"]?>?page=<?php echo $TPL_VAR["page"]?>&view_category=<?php echo $TPL_VAR["view_category"]?>&lists_style=gallery"><i class="icon-th-large"></i></a>
  </div>
</div>

<table class="data-table">
<colgroup>
<col width="40" />
<?php if($TPL_VAR["is_use_category"]==true){?>
    <col width="110" />
<?php }?>
<col />
<col width="120" />
<col width="120" />
<col width="60" />
</colgroup>
<thead>
<tr>
    <th>No</th>
<?php if($TPL_VAR["is_use_category"]==true){?>
    <th><?php echo $TPL_VAR["lang"]["category"]?></th>
<?php }?>
    <th><?php echo $TPL_VAR["lang"]["title"]?></th>
    <th><?php echo $TPL_VAR["lang"]["writer"]?></th>
    <th><?php echo $TPL_VAR["lang"]["write_time"]?></th>
    <th><?php echo $TPL_VAR["lang"]["hit"]?></th>
</tr>
</thead>

<?php if($TPL_lists_1){foreach($TPL_VAR["lists"] as $TPL_V1){?>
    <tr>
        <td><?php echo $TPL_V1->idx?></td>
<?php if($TPL_VAR["is_use_category"]==true){?>
        <td><?php if($TPL_V1->category_name){?><?php echo $TPL_V1->category_name?><?php }else{?><?php echo $TPL_VAR["lang"]["none"]?><?php }?></td>
<?php }?>
        <td>
            <a href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/view/<?php echo $TPL_VAR["bbs_id"]?>?idx=<?php echo $TPL_V1->idx?>&amp;page=<?php echo $TPL_VAR["page"]?>&amp;view_category=<?php echo $TPL_VAR["view_category"]?>&amp;lists_style=<?php echo $TPL_VAR["lists_style"]?>"><?php echo $TPL_V1->print_title?></a>
<?php if($TPL_V1->comment_count> 0){?>
                <span class="comment_count">(<?php echo $TPL_V1->comment_count?>)</span>
<?php }?>

<?php if($TPL_V1->new_article_icon!=''){?>
                <img src="<?php echo $TPL_VAR["BASE_URL"]?><?php echo $TPL_V1->new_article_icon?>" width = "16" height = "11" alt = "new" />
<?php }?>

<?php if($TPL_V1->is_notice== 1){?>
                <img src = "<?php echo $TPL_VAR["FRONTEND_COMMON"]?>img/icon/notice.gif" width = "29" height = "11" alt = "<?php echo $TPL_VAR["lang"]["is_notice"]?>" />
<?php }?>

<?php if($TPL_V1->is_secret== 1){?>
                <img src = "<?php echo $TPL_VAR["FRONTEND_COMMON"]?>img/icon/secret.gif" width = "15" height = "11" alt = "<?php echo $TPL_VAR["lang"]["is_secret"]?>" />
<?php }?>
        </td>
        <td><?php echo $TPL_V1->print_name?></td>
        <td><?php echo $TPL_V1->print_insert_date?></td>
        <td><?php echo $TPL_V1->hit?></td>
    </tr>
<?php }}else{?>
    <tr>
        <td colspan="6"><?php echo $TPL_VAR["lang"]["none"]?></td>
    </tr>
<?php }?>

</table>

<div class="row-fluid">
<?php if($TPL_VAR["pagination"]!==''){?>
        <div class="pull-left pagination">
            <ul>
                <?php echo $TPL_VAR["pagination"]?>

            </ul>
        </div>
<?php }?>

<?php if($TPL_VAR["allowed_list"]["write_article"]===TRUE){?>
    <div class="pull-right btn-group">
        <a href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/write/<?php echo $TPL_VAR["bbs_id"]?>?view_category=<?php echo $TPL_VAR["view_category"]?>&lists_style=<?php echo $TPL_VAR["lists_style"]?>" class="btn btn-small btn-info"><?php echo $TPL_VAR["lang"]["write"]?></a>
    </div>
<?php }?>
</div>
<div class="clearfix"></div>

<?php echo $TPL_VAR["BBS_SETTING_bbs_etc1"]?>