<?php /* Template_ 2.2.7 2015/11/23 00:40:49 /cloud9/workspace/cikorea/front_end/themes/pc/default/_template/contents/bbs/view.tpl 000018464 */ 
$TPL_images_1=empty($TPL_VAR["images"])||!is_array($TPL_VAR["images"])?0:count($TPL_VAR["images"]);
$TPL_urls_1=empty($TPL_VAR["urls"])||!is_array($TPL_VAR["urls"])?0:count($TPL_VAR["urls"]);
$TPL_files_1=empty($TPL_VAR["files"])||!is_array($TPL_VAR["files"])?0:count($TPL_VAR["files"]);
$TPL_lists_comment_1=empty($TPL_VAR["lists_comment"])||!is_array($TPL_VAR["lists_comment"])?0:count($TPL_VAR["lists_comment"]);?>
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

<script src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>jquery.bxslider/jquery.bxslider.min.js"></script>
<script src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<link rel="stylesheet" href="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>jquery.bxslider/jquery.bxslider.css" type="text/css" />

<style type="text/css">

.bx-wrapper .bx-controls-direction a {
z-index: 1000;
}

</style>

<script type="text/javascript">
    $(document).ready(function() {

        $('.slider1').bxSlider({
            slideWidth: 150,
            minSlides: 2,
            maxSlides: 5,
            slideMargin: 10
        });

        $("a#open_fancybox").fancybox();
    });
</script>

<table class="data-table">
<colgroup>
<col width="100"/>
<col />
<col width="100" />
<col />
</colgroup>
<tbody>
<tr>
    <th><?php echo $TPL_VAR["lang"]["title"]?></th>
    <td colspan="3"><?php echo $TPL_VAR["view"]->title?></td>
</tr>
<?php if($TPL_VAR["BBS_SETTING_bbs_category_used"]== 1&&$TPL_VAR["view"]->category_name){?>
<tr>
    <th><?php echo $TPL_VAR["lang"]["category"]?></th>
    <td colspan="3"><?php echo $TPL_VAR["view"]->category_name?></td>
</tr>
<?php }?>
<tr>
    <th><?php echo $TPL_VAR["lang"]["writer"]?></th>
    <td>
        <?php echo $TPL_VAR["view"]->print_name?>

<?php if($TPL_VAR["IS_USER_LOGIN"]===TRUE&&$TPL_VAR["view"]->user_idx!=$TPL_VAR["USER_INFO_idx"]){?>
            &nbsp;|&nbsp;
            <i class="icon-user"></i> <a href="#" onclick="add_friend(<?php echo $TPL_VAR["view"]->user_idx?>, <?php echo $TPL_VAR["SETTING_ajax_timeout"]?>)"><?php echo $TPL_VAR["lang"]["add_friend"]?></a>
            <i class="icon-envelope"></i> <a href="#send_message" title="<?php echo $TPL_VAR["view"]->print_name?>" role="friends" data-toggle="modal" idx="<?php echo $TPL_VAR["view"]->user_idx?>"><?php echo $TPL_VAR["lang"]["message"]?></a></span>
<?php }?>
    </td>
    <th><?php echo $TPL_VAR["lang"]["write_time"]?></th>
    <td><?php echo $TPL_VAR["view"]->print_insert_date?></td>
</tr>
<tr>
    <td colspan="4" class="text-right">
<?php if($TPL_VAR["BBS_SETTING_bbs_comment_used"]== 1){?>
            <span><?php echo $TPL_VAR["lang"]["comment"]?> : <?php echo $TPL_VAR["view"]->comment_count?></span>
<?php }?>

<?php if($TPL_VAR["BBS_SETTING_bbs_vote_article_used"]== 1){?>
            <span><?php echo $TPL_VAR["lang"]["vote"]?> : </span><span id="vote_article"><?php echo $TPL_VAR["view"]->vote_count?></span>
<?php }?>
        <span><?php echo $TPL_VAR["lang"]["scrap"]?> : </span><span id="scrap"><?php echo $TPL_VAR["view"]->scrap_count?></span>
        <span><?php echo $TPL_VAR["lang"]["hit"]?> : <?php echo $TPL_VAR["view"]->hit?></span>
    </td>
</tr>
<tr>
    <td colspan="4" style="word-break: break-all;">
<?php if($TPL_VAR["view"]->avatar_used===TRUE){?>
            <div class = "right avatar">
                <img src = "<?php echo $TPL_VAR["BASE_URL"]?>avatars/<?php echo $TPL_VAR["view"]->user_id?>.gif" width = "<?php echo $TPL_VAR["SETTING_avatar_limit_image_size_width"]?>" height = "<?php echo $TPL_VAR["SETTING_avatar_limit_image_size_height"]?>" alt = "<?php echo $TPL_VAR["view"]->print_name?>" />
            </div>
<?php }?>
        <?php echo $TPL_VAR["view"]->contents?>


        <div style="clear:both"></div>

<?php if($TPL_images_1== 1){?>
            <br />
            <img src = "<?php echo $TPL_VAR["thumbs"][ 0]?>" onclick = "window.open('<?php echo $TPL_VAR["images"][ 0]?>');" />
<?php }elseif($TPL_images_1> 1){?>
            <div class="slider1">
<?php if($TPL_images_1){foreach($TPL_VAR["images"] as $TPL_K1=>$TPL_V1){?>
                <div class="slide"><a id = "open_fancybox" href="<?php echo $TPL_V1?>" title=""><img alt="" src="<?php echo $TPL_VAR["thumbs"][$TPL_K1]?>" /></a></div>
<?php }}?>
            </div>
<?php }?>
    </td>
</tr>
<?php if($TPL_VAR["IS_USER_LOGIN"]===TRUE){?>
<tr>
    <td colspan="4" class="text-right">
<?php if($TPL_VAR["BBS_SETTING_bbs_vote_article_used"]== 1&&$TPL_VAR["view"]->user_idx!=$TPL_VAR["USER_INFO_idx"]){?>
            <button type="button" id="btn_vote_article" class="btn btn-small btn-inverse" onclick="vote('article', '<?php echo $TPL_VAR["bbs_id"]?>', <?php echo $TPL_VAR["view"]->idx?>, <?php echo $TPL_VAR["SETTING_ajax_timeout"]?>);"><i class="icon-thumbs-up icon-white"></i>&nbsp;<?php echo $TPL_VAR["lang"]["vote"]?></button>
<?php }?>
        <button type="button" class="btn btn-small btn-warning" onclick="scrap('<?php echo $TPL_VAR["bbs_id"]?>', <?php echo $TPL_VAR["view"]->idx?>, <?php echo $TPL_VAR["SETTING_ajax_timeout"]?>);"><i class="icon-share-alt icon-white"></i>&nbsp;<?php echo $TPL_VAR["lang"]["scrap"]?></button>
    </td>
</tr>
<?php }?>

<?php if($TPL_VAR["print_tags"]!=''){?>
    <tr>
        <th><?php echo $TPL_VAR["lang"]["tags"]?></th>
        <td colspan="3"><?php echo $TPL_VAR["print_tags"]?></td>
    </tr>
<?php }?>

<?php if($TPL_urls_1> 0){?>
    <tr>
        <th><?php echo $TPL_VAR["lang"]["urls"]?></th>
        <td colspan="3">
<?php if($TPL_urls_1){foreach($TPL_VAR["urls"] as $TPL_V1){?>
                <?php echo $TPL_V1->print_url?><br>
<?php }}?>
        </td>
    </tr>
<?php }?>

<?php if($TPL_files_1> 0){?>
    <tr>
        <th><?php echo $TPL_VAR["lang"]["files"]?></th>
        <td colspan="3">
<?php if($TPL_files_1){foreach($TPL_VAR["files"] as $TPL_V1){?>
                <?php echo $TPL_V1->print?><br>
<?php }}?>
        </td>
    </tr>
<?php }?>

<?php if($TPL_VAR["view"]->is_notice== 0&&($TPL_VAR["pre_next"]->is_exists_next===TRUE||$TPL_VAR["pre_next"]->is_exists_pre===TRUE)){?>
<?php if($TPL_VAR["pre_next"]->is_exists_next===TRUE){?>
        <tr>
            <th><i class="icon-arrow-right"></i>&nbsp;<?php echo $TPL_VAR["lang"]["article_next"]?></th>
            <td colspan="3">
                <a href = "<?php echo $TPL_VAR["BASE_URL"]?>bbs/view/<?php echo $TPL_VAR["bbs_id"]?>?idx=<?php echo $TPL_VAR["pre_next"]->idx_next?>&amp;view_category=<?php echo $TPL_VAR["view_category"]?>&amp;lists_style=<?php echo $TPL_VAR["lists_style"]?>"><?php echo $TPL_VAR["pre_next"]->title_next?>

<?php if($TPL_VAR["pre_next"]->comment_count_next> 0){?>
                        <span class="comment_count">(<?php echo $TPL_VAR["pre_next"]->comment_count_next?>)</span>
<?php }?>
                </a>
            </td>
        </tr>
<?php }?>

<?php if($TPL_VAR["pre_next"]->is_exists_pre===TRUE){?>
        <tr>
            <th><i class="icon-arrow-left"></i>&nbsp;<?php echo $TPL_VAR["lang"]["article_pre"]?></th>
            <td colspan="3">
                <a href = "<?php echo $TPL_VAR["BASE_URL"]?>bbs/view/<?php echo $TPL_VAR["bbs_id"]?>?idx=<?php echo $TPL_VAR["pre_next"]->idx_pre?>&amp;view_category=<?php echo $TPL_VAR["view_category"]?>&amp;lists_style=<?php echo $TPL_VAR["lists_style"]?>"><?php echo $TPL_VAR["pre_next"]->title_pre?>

<?php if($TPL_VAR["pre_next"]->comment_count_pre> 0){?>
                        <span class="comment_count">(<?php echo $TPL_VAR["pre_next"]->comment_count_pre?>)</span>
<?php }?>
                </a>
            </td>
        </tr>
<?php }?>
<?php }?>
    <tr>
        <td colspan="4">
            <div class="pull-right">
<?php if($TPL_VAR["allowed_list"]["write_article"]===TRUE){?>
                    <a href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/write/<?php echo $TPL_VAR["bbs_id"]?>?view_category=<?php echo $TPL_VAR["view_category"]?>&amp;lists_style=<?php echo $TPL_VAR["lists_style"]?>" class="btn btn-small"><?php echo $TPL_VAR["lang"]["write"]?></a>
<?php }?>
                <a href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/lists/<?php echo $TPL_VAR["bbs_id"]?>?page=<?php echo $TPL_VAR["page"]?>&amp;view_category=<?php echo $TPL_VAR["view_category"]?>&amp;lists_style=<?php echo $TPL_VAR["lists_style"]?>"  class="btn btn-small"><?php echo $TPL_VAR["lang"]["lists"]?></a>
<?php if($TPL_VAR["allowed_list"]["write_article"]===TRUE&&$TPL_VAR["IS_USER_LOGIN"]===TRUE&&$TPL_VAR["view"]->user_idx==$TPL_VAR["USER_INFO_idx"]){?>
                    <a href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/modify/<?php echo $TPL_VAR["bbs_id"]?>?page=<?php echo $TPL_VAR["page"]?>&amp;idx=<?php echo $TPL_VAR["idx"]?>&amp;view_category=<?php echo $TPL_VAR["view_category"]?>&amp;lists_style=<?php echo $TPL_VAR["lists_style"]?>" class="btn btn-small btn-danger"><?php echo $TPL_VAR["lang"]["update"]?>/<?php echo $TPL_VAR["lang"]["delete"]?></a>
<?php }?>
            </div>
        </td>
    </tr>
</tbody>
</table>

<?php if($TPL_lists_comment_1> 0&&$TPL_VAR["BBS_SETTING_bbs_comment_used"]== 1){?>
    <div style="margin-top:30px">
        <h4><?php echo $TPL_VAR["lang"]["comment"]?></h4>

<?php if($TPL_VAR["allowed_list"]["view_comment"]===TRUE){?>

        <table class="data-table">
	<colgroup>
        <col />
	<col width="100" />
	<col width="100" />
	</colgroup>

<?php if($TPL_lists_comment_1){foreach($TPL_VAR["lists_comment"] as $TPL_V1){?>
                <tr>
                    <td style="word-break: break-all;">
                        <div id="comment_<?php echo $TPL_V1->idx?>_modify"></div>
                        <div id="comment_<?php echo $TPL_V1->idx?>" class="comment_contents">
<?php if($TPL_V1->new_comment_icon){?>
                                <img src = "<?php echo $TPL_VAR["BASE_URL"]?><?php echo $TPL_V1->new_comment_icon?>" width="16" height="11" alt="new" />
<?php }?><?php echo $TPL_V1->comment?>

                        </div>
                        <ul class="unstyled right">
                            <li><?php echo $TPL_V1->print_name?> <?php if($TPL_VAR["IS_USER_LOGIN"]===TRUE&&$TPL_V1->user_idx!=$TPL_VAR["USER_INFO_idx"]){?><i class="icon-user"></i> <a href="#" onclick="add_friend(<?php echo $TPL_VAR["view"]->user_idx?>, <?php echo $TPL_VAR["SETTING_ajax_timeout"]?>)"><?php echo $TPL_VAR["lang"]["add_friend"]?></a> <i class="icon-envelope"></i> <a href="#send_message" title="<?php echo $TPL_V1->print_name?>" role="friends" data-toggle="modal" idx="<?php echo $TPL_V1->user_idx?>"><?php echo $TPL_VAR["lang"]["message"]?></a></span><?php }?><?php if($TPL_VAR["IS_USER_LOGIN"]===TRUE&&$TPL_V1->user_idx==$TPL_VAR["USER_INFO_idx"]){?><button type="button" id="btn_modify_comment_form_<?php echo $TPL_V1->idx?>" class="btn btn-small" onclick="set_modify_comment_form('<?php echo $TPL_VAR["bbs_id"]?>', <?php echo $TPL_V1->idx?>, <?php echo $TPL_VAR["SETTING_ajax_timeout"]?>);"><?php echo $TPL_VAR["lang"]["update"]?> / <?php echo $TPL_VAR["lang"]["delete"]?></button><?php }?></li>
                            <li><span class="label label-success"><?php echo $TPL_VAR["lang"]["write_time"]?></span>&nbsp;<?php echo $TPL_V1->print_insert_date?><?php if($TPL_V1->print_update_date!==''){?>&nbsp;<span class="label label-success"><?php echo $TPL_VAR["lang"]["update_time"]?></span>&nbsp;<?php echo $TPL_V1->print_update_date?><?php }?>&nbsp;<span class="label label-inverse"><?php echo $TPL_VAR["lang"]["vote"]?></span>&nbsp;<span id="vote_comment_<?php echo $TPL_V1->idx?>"><?php echo $TPL_V1->vote_count?></span></li>
                        </ul>
                    </td>
                </tr>
<?php }}else{?>
                <tr>
                    <td><?php echo $TPL_VAR["lang"]["none"]?></td>
                </tr>
<?php }?>

<?php if($TPL_VAR["comment_pagination"]!==''){?>
            <tr>
                <td>
                    <div class="text-center pagination">
                        <ul>
                            <?php echo $TPL_VAR["comment_pagination"]?>

                        </ul>
                    </div>
                </td>
            </tr>
<?php }?>
        </tbody>
        </table>
<?php }?>
    </div>
<?php }?>

<?php if($TPL_VAR["BBS_SETTING_bbs_comment_used"]== 1&&$TPL_VAR["allowed_list"]["write_comment"]===TRUE){?>
    <div style="margin-top:30px">
        <h4><?php echo $TPL_VAR["lang"]["write_comment"]?></h4>
        <div id="write_comment_div">
            <form method="post" name="write_comment_form" id="write_comment_form">
                <input type="hidden" name="bbs_id" id="bbs_id" value="<?php echo $TPL_VAR["bbs_id"]?>" />
                <input type="hidden" name="article_idx" id="article_idx" value="<?php echo $TPL_VAR["idx"]?>" />
                <textarea id="comment" name="comment"><?php echo $TPL_VAR["BBS_SETTING_bbs_textarea_comment"]?></textarea><br>
                <button type="button" class="btn btn-success" onclick="write_comment('<?php echo $TPL_VAR["bbs_id"]?>', '<?php echo $TPL_VAR["BASE_URL"]?>bbs/view/<?php echo $TPL_VAR["bbs_id"]?>?idx=<?php echo $TPL_VAR["idx"]?>&amp;page=<?php echo $TPL_VAR["page"]?>&amp;hit=not&amp;view_category=<?php echo $TPL_VAR["view_category"]?>&amp;lists_style=<?php echo $TPL_VAR["lists_style"]?>', <?php echo $TPL_VAR["SETTING_ajax_timeout"]?>);"><?php echo $TPL_VAR["lang"]["write_comment"]?></button>
            </form>
        </div>
    </div>

	<script type="text/javascript" src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>ckeditor/config_comment.js"></script>
	<script type="text/javascript" src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>ckeditor/adapters/jquery.js"></script>
	<script type="text/javascript">
	$('#comment').ckeditor({
        customConfig : "<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>ckeditor/config_comment.js"
    });
	</script>
<?php }?>

<div id="hidden_modify_comment_div" style="display:none">
    <div id="modify_comment_div">
        <form method="post" name="modify_comment_form" id="modify_comment_form" style="margin:0">
            <input type="hidden" name="bbs_id" id="bbs_id" value="<?php echo $TPL_VAR["bbs_id"]?>" />
            <input type="hidden" name="idx" id="idx" value="" />
            <input type="hidden" name="article_idx" id="article_idx" value="<?php echo $TPL_VAR["idx"]?>" />
            <textarea id="comment" name="comment" rows="7" style="width:100%"></textarea>
        </form>
    </div>
    <div class="pull-right comment_btn">
        <button type="button" class="btn btn-mini btn-warning" onclick="modify_comment('modify', '<?php echo $TPL_VAR["bbs_id"]?>', '<?php echo $TPL_VAR["BASE_URL"]?>bbs/view/<?php echo $TPL_VAR["bbs_id"]?>?idx=<?php echo $TPL_VAR["idx"]?>&amp;page=<?php echo $TPL_VAR["page"]?>&amp;hit=not', <?php echo $TPL_VAR["SETTING_ajax_timeout"]?>);"><?php echo $TPL_VAR["lang"]["modify"]?></button>
        <button type="button" class="btn btn-mini btn" onclick="remove_modify_comment_form($('#hidden_modify_comment_div #idx').val());"><?php echo $TPL_VAR["lang"]["cancel"]?></button>
        <button type="button" class="btn btn-mini btn-danger" onclick="modify_comment('delete', '<?php echo $TPL_VAR["bbs_id"]?>', '<?php echo $TPL_VAR["BASE_URL"]?>bbs/view/<?php echo $TPL_VAR["bbs_id"]?>?idx=<?php echo $TPL_VAR["idx"]?>&amp;page=<?php echo $TPL_VAR["page"]?>&amp;hit=not', <?php echo $TPL_VAR["SETTING_ajax_timeout"]?>);"><?php echo $TPL_VAR["lang"]["delete"]?></button>
    </div>
    <div class="clearfix"></div>
</div>

<div id="hidden_vote_article" style = "display:none">
    <form method="post" name="vote_article_form" id="vote_article_form">
        <input type="hidden" name="bbs_id" id="bbs_id" value="<?php echo $TPL_VAR["bbs_id"]?>" />
        <input type="hidden" name="idx" id="idx" value="<?php echo $TPL_VAR["idx"]?>" />
        <input type="hidden" name="type" id="type" value="article" />
    </form>
</div>

<div id="hidden_vote_comment" style = "display:none">
    <form method="post" name="vote_comment_form" id="vote_comment_form">
        <input type="hidden" name="bbs_id" id="bbs_id" value="<?php echo $TPL_VAR["bbs_id"]?>" />
        <input type="hidden" name="idx" id="idx" value="" />
        <input type="hidden" name="type" id="type" value="comment" />
    </form>
</div>

<div id="send_message" class="modal hide fade">
    <form method="post" name="send_message_form" id="send_message_form" data-ajax="false" style="margin-bottom:0px">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3><?php echo $TPL_VAR["lang"]["message"]?></h3>
        </div>
        <div class="modal-body">
            TO : <span id="print_receiver_name"></span>
            <input type="hidden" name="receiver" id="receiver" value="" />
            <p><div align="center"><textarea name="contents" id="contents" rows="5" class="span6"></textarea></div></p>
        </div>
        <div class="modal-footer">
            <a href="#" id="btn_close" class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $TPL_VAR["lang"]["close"]?></a>
            <a href="#" class="btn btn-primary" onclick="send_message_exec(<?php echo $TPL_VAR["SETTING_ajax_timeout"]?>);"><?php echo $TPL_VAR["lang"]["send"]?></a>
        </div>
    </form>
</div>