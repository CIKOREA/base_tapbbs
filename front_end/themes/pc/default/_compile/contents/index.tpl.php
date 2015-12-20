<?php /* Template_ 2.2.7 2015/11/23 00:40:49 /cloud9/workspace/cikorea/front_end/themes/pc/default/_template/contents/index.tpl 000008940 */ 
$TPL_community_1=empty($TPL_VAR["community"])||!is_array($TPL_VAR["community"])?0:count($TPL_VAR["community"]);
$TPL_gallery_1=empty($TPL_VAR["gallery"])||!is_array($TPL_VAR["gallery"])?0:count($TPL_VAR["gallery"]);
$TPL_onedayonememo_1=empty($TPL_VAR["onedayonememo"])||!is_array($TPL_VAR["onedayonememo"])?0:count($TPL_VAR["onedayonememo"]);
$TPL_recently_comment_1=empty($TPL_VAR["recently_comment"])||!is_array($TPL_VAR["recently_comment"])?0:count($TPL_VAR["recently_comment"]);?>
<?php if($TPL_VAR["need_update_password"]){?>
<script type = "text/javascript">
    jAlert('<?php echo $TPL_VAR["need_update_password"]?>', lang['alert'], function(r) { if(r) {} });
</script>
<?php }?>

<div style = "height:12px;"></div>

<div>
    <div style = "width:49%;margin-right:0px" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th><a href = "<?php echo $TPL_VAR["BASE_URL"]?>bbs/lists/community?lists_style=<?php echo $TPL_VAR["community_bbs_lists_style"]?>"><i class="icon-list-alt"></i>&nbsp;<?php echo $TPL_VAR["community_bbs_name"]?></a></th>
            </tr>
            </thead>
            <tbody>
<?php if($TPL_community_1){foreach($TPL_VAR["community"] as $TPL_V1){?>
            <tr>
                <td style="word-break: break-all;">
                    <a href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/view/<?php echo $TPL_V1->bbs_id?>?idx=<?php echo $TPL_V1->idx?>&lists_style=<?php echo $TPL_VAR["community_bbs_lists_style"]?>">
<?php if($TPL_V1->new_article_icon){?>
                        <img src = "<?php echo $TPL_VAR["BASE_URL"]?><?php echo $TPL_V1->new_article_icon?>" width = "16" height = "11" alt = "new" />
<?php }?><?php echo $TPL_V1->title?>

<?php if($TPL_V1->comment_count> 0){?>
                        <span class="comment_count">(<?php echo $TPL_V1->comment_count?>)</span>
<?php }?>
                        <br />
                    <?php echo $TPL_V1->name?> | <?php echo $TPL_V1->timestamp?>

<?php if($TPL_V1->category_name){?>
                        <br />
                    <?php echo $TPL_VAR["lang"]["category"]?> : <?php echo $TPL_V1->category_name?>

<?php }?>
                    </a>
                </td>
            </tr>
<?php }}?>
            </tbody>
        </table>
    </div>
    <div style = "width:2%;margin-right:0px" class = "left">&nbsp;</div>
    <div style = "width:49%;margin-right:0px" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th><a href = "<?php echo $TPL_VAR["BASE_URL"]?>bbs/lists/gallery?lists_style=<?php echo $TPL_VAR["gallery_bbs_lists_style"]?>"><i class = "icon-camera"></i>&nbsp;<?php echo $TPL_VAR["gallery_bbs_name"]?></a></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="padding-left:15px;padding-right:15px;">
                    <script src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>jquery.bxslider/jquery.bxslider.min.js"></script>

                    <link rel="stylesheet" href="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>jquery.bxslider/jquery.bxslider.css" type="text/css" />

                    <style type="text/css">

                        .bx-wrapper {
                            margin:0 auto 26px !important;
                        }
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

                        });
                    </script>

<?php if($TPL_VAR["gallery"]){?>
                    <div class="slider1">
<?php if($TPL_gallery_1){foreach($TPL_VAR["gallery"] as $TPL_V1){?>
                        <div class="slide"><a href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/view/<?php echo $TPL_V1->bbs_id?>?idx=<?php echo $TPL_V1->idx?>&lists_style=<?php echo $TPL_VAR["gallery_bbs_lists_style"]?>"><img alt="" src="<?php echo $TPL_V1->image?>" /></a></div>
<?php }}?>
                    </div>
<?php }?>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div style = "width:49%;margin-right:0px; clear:both;" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th><a href="<?php echo $TPL_VAR["BASE_URL"]?>plugin/onedayonememo/lists"><i class = "icon-check"></i>&nbsp;<?php echo $TPL_VAR["lang"]["plugin_onedayonememo"]?></a></th>
            </tr>
            </thead>
            <tbody>
<?php if($TPL_onedayonememo_1){foreach($TPL_VAR["onedayonememo"] as $TPL_V1){?>
            <tr>
                <td style="word-break: break-all;">
<?php if($TPL_V1["new_article_icon"]){?>
                    <img src = "<?php echo $TPL_V1["new_article_icon"]?>" width = "16" height = "11" alt = "new" />
<?php }?><?php echo $TPL_V1["contents"]?>

                <br />
                <?php echo $TPL_V1["name"]?> | <?php echo $TPL_V1["timestamp"]?>

                </td>
            </tr>
<?php }}?>
            </tbody>
        </table>
    </div>
    <div style = "width:2%;margin-right:0px" class = "left">&nbsp;</div>
    <div style = "width:49%;margin-right:0px" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th><i class = "icon-upload"></i>&nbsp;<?php echo $TPL_VAR["lang"]["recently_comment"]?></th>
            </tr>
            </thead>
            <tbody>
<?php if($TPL_recently_comment_1){foreach($TPL_VAR["recently_comment"] as $TPL_K1=>$TPL_V1){?>
            <tr>
                <td style="word-break: break-all;">
                    <a href="<?php echo $TPL_VAR["BASE_URL"]?>bbs/view/<?php echo $TPL_V1["bbs_id"]?>?idx=<?php echo $TPL_V1["article_idx"]?>&amp;page_comment=<?php echo $TPL_VAR["recently_comment_page"][$TPL_K1]?>" data-ajax="false">
<?php if($TPL_V1["new_comment_icon"]!=''){?>
                        <img src = "<?php echo $TPL_V1["new_comment_icon"]?>" width = "16" height = "11" alt = "new" />
<?php }?><?php echo $TPL_V1["comment"]?>

                    <br />
                    <?php echo $TPL_V1["print_name"]?> | <?php echo $TPL_V1["print_date"]?>

                    </a>
                </td>
            </tr>
<?php }}?>
            </tbody>
        </table>
    </div>
    <div style = "width:49%;margin-right:0px; clear:both;" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th>Google News</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="word-break: break-all;"><a id = "feed_google_1" href="" target = "_blank" data-ajax="false"></a></td>
            </tr>
            <tr>
                <td style="word-break: break-all;"><a id = "feed_google_2" href="" target = "_blank" data-ajax="false"></a></td>
            </tr>
            <tr>
                <td style="word-break: break-all;"><a id = "feed_google_3" href="" target = "_blank" data-ajax="false"></a></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div style = "width:2%;margin-right:0px" class = "left">&nbsp;</div>
    <div style = "width:49%;margin-right:0px" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th>Daum News</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="word-break: break-all;"><a id = "feed_daum_1" href="" target = "_blank" data-ajax="false"></a></td>
            </tr>
            <tr>
                <td style="word-break: break-all;"><a id = "feed_daum_2" href="" target = "_blank" data-ajax="false"></a></td>
            </tr>
            <tr>
                <td style="word-break: break-all;"><a id = "feed_daum_3" href="" target = "_blank" data-ajax="false"></a></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>jquery.jgfeed-min.js"></script>
<script type = "text/javascript" src = "<?php echo $TPL_VAR["FRONTEND_COMMON"]?>js/feed_google.js"></script>
<script type = "text/javascript" src = "<?php echo $TPL_VAR["FRONTEND_COMMON"]?>js/feed_daum.js"></script>