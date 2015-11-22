{? need_update_password}
<script type = "text/javascript">
    jAlert('<!--{need_update_password}-->', lang['alert'], function(r) { if(r) {} });
</script>
{/}

<div style = "height:12px;"></div>

<div>
    <div style = "width:49%;margin-right:0px" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th><a href = "{BASE_URL}bbs/lists/community?lists_style={community_bbs_lists_style}"><i class="icon-list-alt"></i>&nbsp;{community_bbs_name}</a></th>
            </tr>
            </thead>
            <tbody>
            {@ community }
            <tr>
                <td style="word-break: break-all;">
                    <a href="{BASE_URL}bbs/view/{community->bbs_id}?idx={community->idx}&lists_style={community_bbs_lists_style}">
                    {? community->new_article_icon}
                        <img src = "{BASE_URL}{community->new_article_icon}" width = "16" height = "11" alt = "new" />
                    {/}{community->title}
                    {? community->comment_count > 0}
                        <span class="comment_count">({community->comment_count})</span>
                    {/}
                        <br />
                    {community->name} | {community->timestamp}
                    {? community->category_name}
                        <br />
                    {lang.category} : {community->category_name}
                    {/}
                    </a>
                </td>
            </tr>
            {/}
            </tbody>
        </table>
    </div>
    <div style = "width:2%;margin-right:0px" class = "left">&nbsp;</div>
    <div style = "width:49%;margin-right:0px" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th><a href = "{BASE_URL}bbs/lists/gallery?lists_style={gallery_bbs_lists_style}"><i class = "icon-camera"></i>&nbsp;{gallery_bbs_name}</a></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td style="padding-left:15px;padding-right:15px;">
                    <script src="{FRONTEND_THIRD_PARTY}jquery.bxslider/jquery.bxslider.min.js"></script>

                    <link rel="stylesheet" href="{FRONTEND_THIRD_PARTY}jquery.bxslider/jquery.bxslider.css" type="text/css" />

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

                    {? gallery}
                    <div class="slider1">
                    {@ gallery}
                        <div class="slide"><a href="{BASE_URL}bbs/view/{gallery->bbs_id}?idx={gallery->idx}&lists_style={gallery_bbs_lists_style}"><img alt="" src="{gallery->image}" /></a></div>
                    {/}
                    </div>
                    {/}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div style = "width:49%;margin-right:0px; clear:both;" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th><a href="{BASE_URL}plugin/onedayonememo/lists"><i class = "icon-check"></i>&nbsp;{lang.plugin_onedayonememo}</a></th>
            </tr>
            </thead>
            <tbody>
            {@ onedayonememo}
            <tr>
                <td style="word-break: break-all;">
                {? .new_article_icon}
                    <img src = "{.new_article_icon}" width = "16" height = "11" alt = "new" />
                {/}{.contents}
                <br />
                {.name} | {.timestamp}
                </td>
            </tr>
            {/}
            </tbody>
        </table>
    </div>
    <div style = "width:2%;margin-right:0px" class = "left">&nbsp;</div>
    <div style = "width:49%;margin-right:0px" class = "left">
        <table class="data-table">
            <thead>
            <tr>
                <th><i class = "icon-upload"></i>&nbsp;{lang.recently_comment}</th>
            </tr>
            </thead>
            <tbody>
            {@ recently_comment}
            <tr>
                <td style="word-break: break-all;">
                    <a href="{BASE_URL}bbs/view/{.bbs_id}?idx={.article_idx}&amp;page_comment={recently_comment_page[.key_]}" data-ajax="false">
                    {? .new_comment_icon != ''}
                        <img src = "{.new_comment_icon}" width = "16" height = "11" alt = "new" />
                    {/}{.comment}
                    <br />
                    {.print_name} | {.print_date}
                    </a>
                </td>
            </tr>
            {/}
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

<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}jquery.jgfeed-min.js"></script>
<script type = "text/javascript" src = "{FRONTEND_COMMON}js/feed_google.js"></script>
<script type = "text/javascript" src = "{FRONTEND_COMMON}js/feed_daum.js"></script>