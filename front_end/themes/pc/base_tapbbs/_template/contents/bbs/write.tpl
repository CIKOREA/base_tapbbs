<script src="{FRONTEND_THIRD_PARTY}jquery.bxslider/jquery.bxslider.min.js"></script>
<script src="{FRONTEND_THIRD_PARTY}jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.pack.js"></script>

<link rel="stylesheet" href="{FRONTEND_THIRD_PARTY}jquery.fancybox-1.3.4/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<link rel="stylesheet" href="{FRONTEND_THIRD_PARTY}jquery.bxslider/jquery.bxslider.css" type="text/css" />

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

<section id="blog">
    <div class="container">
        <div>
            <h2><i class="fa fa-users"></i> {BBS_SETTING_bbs_name}</h2>

            <table class="bbs_table">
                <colgroup>
                    <col width="100"/>
                    <col />
                    <col width="100" />
                    <col />
                </colgroup>
                <tbody>
                {? BBS_SETTING_bbs_category_used == 1 && view->category_name}
                    <tr>
                        <th>{lang.category}</th>
                        <td colspan="3">{view->category_name}</td>
                    </tr>
                {/}
                <tr>
                    <th>{lang.title}</th>
                    <td colspan="3">{view->title}</td>
                </tr>
                {? BBS_SETTING_bbs_category_used == 1 && view->category_name}
                    <tr>
                        <th>{lang.category}</th>
                        <td colspan="3">{view->category_name}</td>
                    </tr>
                {/}
                <tr>
                    <th>{lang.writer}</th>
                    <td>
                        {view->print_name}
                        {? IS_USER_LOGIN === TRUE && view->user_idx != USER_INFO_idx}
                            &nbsp;|&nbsp;
                            <i class="icon-user"></i> <a href="#" onclick="add_friend({view->user_idx}, {SETTING_ajax_timeout})">{lang.add_friend}</a>
                            <i class="icon-envelope"></i> <a href="#send_message" title="{view->print_name}" role="friends" data-toggle="modal" idx="{view->user_idx}">{lang.message}</a></span>
                        {/}
                    </td>
                    <th>{lang.write_time}</th>
                    <td>{view->print_insert_date}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">
                        {? BBS_SETTING_bbs_comment_used == 1}
                            <span>{lang.comment} : {view->comment_count}</span>
                        {/}

                        {? BBS_SETTING_bbs_vote_article_used == 1}
                            <span>{lang.vote} : </span><span id="vote_article">{view->vote_count}</span>
                        {/}
                        <span>{lang.scrap} : </span><span id="scrap">{view->scrap_count}</span>
                        <span>{lang.hit} : {view->hit}</span>
                        {? rss_allow == TRUE}
                            <span class="rss"><a href="{BASE_URL}bbs/rss/{bbs_id}" target="_blank">RSS</a></span>
                        {/}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="" class="contents">
                        {? view->avatar_used === TRUE}
                            <div class = "right avatar">
                                <img src = "{BASE_URL}avatars/{view->user_id}.gif" width = "{SETTING_avatar_limit_image_size_width}" height = "{SETTING_avatar_limit_image_size_height}" alt = "{view->print_name}" />
                            </div>
                        {/}
                        {view->contents}

                        <div style="clear:both"></div>

                        {? images.size_ == 1}
                            <br />
                            <img src = "{thumbs[0]}" onclick = "window.open('{images[0]}');" />
                        {: images.size_ > 1}
                            <div class="slider1">
                                {@ images}
                                <div class="slide"><a id = "open_fancybox" href="{.value_}" title=""><img alt="" src="{thumbs[.key_]}" /></a></div>
                                {/}
                            </div>
                        {/}
                    </td>
                </tr>
                {? IS_USER_LOGIN === TRUE}
                <tr>
                    <td colspan="4" class="text-right">
                        {? BBS_SETTING_bbs_vote_article_used == 1 && view->user_idx != USER_INFO_idx}
                            <button type="button" id="btn_vote_article" class="btn btn-small btn-inverse" onclick="vote('article', '<!--{bbs_id}-->', {view->idx}, <!--{SETTING_ajax_timeout}-->);"><i class="icon-thumbs-up icon-white"></i>&nbsp;{lang.vote}</button>
                        {/}
                        <button type="button" class="btn btn-small btn-warning" onclick="scrap('<!--{bbs_id}-->', <!--{view->idx}-->, <!--{SETTING_ajax_timeout}-->);"><i class="icon-share-alt icon-white"></i>&nbsp;{lang.scrap}</button>
                    </td>
                </tr>
                {/}

                {? print_tags != ''}
                    <tr>
                        <th>{lang.tags}</th>
                        <td colspan="3">{print_tags}</td>
                    </tr>
                {/}

                {? urls.size_ > 0}
                    <tr>
                        <th>{lang.urls}</th>
                        <td colspan="3">
                            {@urls}
                            {urls->print_url}<br>
                            {/}
                        </td>
                    </tr>
                {/}

                {? files.size_ > 0}
                    <tr>
                        <th>{lang.files}</th>
                        <td colspan="3">
                            {@files}
                                {files->print}<br>
                            {/}
                        </td>
                    </tr>
                {/}

                {? view->is_notice == 0 && (pre_next->is_exists_next === TRUE || pre_next->is_exists_pre === TRUE)}
                    {? pre_next->is_exists_next === TRUE}
                        <tr>
                            <th><i class="icon-arrow-right"></i>&nbsp;{lang.article_next}</th>
                            <td colspan="3">
                                <a href = "{BASE_URL}bbs/view/{bbs_id}?idx={pre_next->idx_next}&amp;view_category={view_category}&amp;lists_style={lists_style}">{pre_next->title_next}
                                    {? pre_next->comment_count_next > 0}
                                        <span class="comment_count">({pre_next->comment_count_next})</span>
                                    {/}
                                </a>
                            </td>
                        </tr>
                    {/}

                    {? pre_next->is_exists_pre === TRUE}
                        <tr>
                            <th><i class="icon-arrow-left"></i>&nbsp;{lang.article_pre}</th>
                            <td colspan="3">
                                <a href = "{BASE_URL}bbs/view/{bbs_id}?idx={pre_next->idx_pre}&amp;view_category={view_category}&amp;lists_style={lists_style}">{pre_next->title_pre}
                                    {? pre_next->comment_count_pre > 0}
                                        <span class="comment_count">({pre_next->comment_count_pre})</span>
                                    {/}
                                </a>
                            </td>
                        </tr>
                    {/}
                {/}
                <tr>
                    <td colspan="4">
                        <div class="pull-right btn-group" role="group">
                            {? allowed_list.write_article === TRUE}
                                <a href="{BASE_URL}bbs/write/{bbs_id}?view_category={view_category}&amp;lists_style={lists_style}" class="btn btn-info">{lang.write}</a>
                            {/}
                            <a href="{BASE_URL}bbs/lists/{bbs_id}?page={page}&amp;view_category={view_category}&amp;lists_style={lists_style}"  class="btn btn-default">{lang.lists}</a>
                            {? allowed_list.write_article === TRUE && IS_USER_LOGIN === TRUE && view->user_idx == USER_INFO_idx}
                                <a href="{BASE_URL}bbs/modify/{bbs_id}?page={page}&amp;idx={idx}&amp;view_category={view_category}&amp;lists_style={lists_style}" class="btn btn-danger">{lang.update}/{lang.delete}</a>
                            {/}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    {? BBS_SETTING_bbs_comment_used == 1}
        <div class="container" style="margin-top:50px">
            <h3>{lang.comment}</h3>

            {? allowed_list.view_comment === TRUE}

                <table class="bbs_table">
                <colgroup>
                    <col />
                </colgroup>

                {@ lists_comment}
                    <tr>
                        <td style="word-break: break-all;">
                            <div style="float:left">
                                <span class="comment_name">{lists_comment->print_name}</span>
                                {? lists_comment->new_comment_icon}
                                    <img src = "{BASE_URL}{lists_comment->new_comment_icon}" width="16" height="11" alt="new" />
                                {/}
                                /
                                <span>{lists_comment->print_insert_date}</span> /
                                <span>{lang.vote}</span>
                                <span id="vote_comment_{lists_comment->idx}">{lists_comment->vote_count}</span>
                            </div>
                            <div style="float:right">
                                {? IS_USER_LOGIN === TRUE && lists_comment->user_idx != USER_INFO_idx}
                                    <i class="icon-user"></i> <a href="#" onclick="add_friend({view->user_idx}, {SETTING_ajax_timeout})">{lang.add_friend}</a>
                                    <i class="icon-envelope"></i> <a href="#send_message" title="{lists_comment->print_name}" role="friends" data-toggle="modal" idx="{lists_comment->user_idx}">{lang.message}</a></span>
                                {/}
                                {? IS_USER_LOGIN === TRUE && lists_comment->user_idx == USER_INFO_idx}
                                    <a href="javascript:;" id="btn_modify_comment_form_{lists_comment->idx}" class="comment_modify_delete" onclick="set_modify_comment_form('{bbs_id}', {lists_comment->idx}, {SETTING_ajax_timeout});">{lang.update} / {lang.delete}</a>
                                {/}
                            </div>
                            <div style="clear:both"></div>
                            <div id="comment_{lists_comment->idx}_modify"></div>
                            <div id="comment_{lists_comment->idx}" class="comment_contents">
                                {lists_comment->comment}
                            </div>
                        </td>
                    </tr>
                {:}
                    <tr>
                        <td>{lang.none}</td>
                    </tr>
                {/}

                {? comment_pagination !== ''}
                    <tr>
                        <td>
                            <ul class="pagination">
                                {comment_pagination}
                            </ul>
                        </td>
                    </tr>
                {/}

                <tr>
                    <td>
                        {? BBS_SETTING_bbs_comment_used == 1 && allowed_list.write_comment === TRUE}
                            <h4>{lang.write_comment}</h4>
                            <div id="write_comment_div">
                                <form method="post" name="write_comment_form" id="write_comment_form">
                                    <input type="hidden" name="bbs_id" id="bbs_id" value="{bbs_id}" />
                                    <input type="hidden" name="article_idx" id="article_idx" value="{idx}" />
                                    <textarea id="comment" name="comment">{BBS_SETTING_bbs_textarea_comment}</textarea>
                                    <div class="pull-right" style="margin-top:5px">
                                        <button type="button" class="btn btn-success" onclick="write_comment('{bbs_id}', '{BASE_URL}bbs/view/{bbs_id}?idx={idx}&amp;page={page}&amp;hit=not&amp;view_category={view_category}&amp;lists_style={lists_style}', {SETTING_ajax_timeout});">{lang.write_comment}</button>
                                    </div>
                                </form>
                            </div>

                            <script type="text/javascript" src="{FRONTEND_THIRD_PARTY}ckeditor/ckeditor.js"></script>
                            <script type="text/javascript" src="{FRONTEND_THIRD_PARTY}ckeditor/config_comment.js"></script>
                            <script type="text/javascript" src="{FRONTEND_THIRD_PARTY}ckeditor/adapters/jquery.js"></script>
                            <script type="text/javascript">
                                $('#comment').ckeditor({
                                    customConfig : "{FRONTEND_THIRD_PARTY}ckeditor/config_comment.js"
                                });
                            </script>
                        {/}
                    </td>
                </tr>
                </tbody>
                </table>
            {/}
        </div>
    {/}


    <div id="hidden_modify_comment_div" style="display:none">
        <div id="modify_comment_div" style="margin-top:10px">
            <form method="post" name="modify_comment_form" id="modify_comment_form" style="margin:0">
                <input type="hidden" name="bbs_id" id="bbs_id" value="{bbs_id}" />
                <input type="hidden" name="idx" id="idx" value="" />
                <input type="hidden" name="article_idx" id="article_idx" value="{idx}" />
                <textarea id="comment" name="comment" rows="7" style="width:100%"></textarea>
            </form>
        </div>
        <div class="pull-right btn-group comment_btn" role="group">
            <a href="javascript:;" class="btn btn-warning" onclick="modify_comment('modify', '{bbs_id}', '{BASE_URL}bbs/view/{bbs_id}?idx={idx}&amp;page={page}&amp;hit=not', {SETTING_ajax_timeout});">{lang.modify}</a>
            <a href="javascript:;" class="btn" onclick="remove_modify_comment_form($('#hidden_modify_comment_div #idx').val());">{lang.cancel}</a>
            <a href="javascript:;" class="btn btn-danger" onclick="modify_comment('delete', '{bbs_id}', '{BASE_URL}bbs/view/{bbs_id}?idx={idx}&amp;page={page}&amp;hit=not', {SETTING_ajax_timeout});">{lang.delete}</a>
        </div>
        <div class="clearfix"></div>
    </div>

    <div id="hidden_vote_article" style = "display:none">
        <form method="post" name="vote_article_form" id="vote_article_form">
            <input type="hidden" name="bbs_id" id="bbs_id" value="{bbs_id}" />
            <input type="hidden" name="idx" id="idx" value="{idx}" />
            <input type="hidden" name="type" id="type" value="article" />
        </form>
    </div>

    <div id="hidden_vote_comment" style = "display:none">
        <form method="post" name="vote_comment_form" id="vote_comment_form">
            <input type="hidden" name="bbs_id" id="bbs_id" value="{bbs_id}" />
            <input type="hidden" name="idx" id="idx" value="" />
            <input type="hidden" name="type" id="type" value="comment" />
        </form>
    </div>

    <div id="send_message" class="modal hide fade">
        <form method="post" name="send_message_form" id="send_message_form" data-ajax="false" style="margin-bottom:0px">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>{lang.message}</h3>
            </div>
            <div class="modal-body">
                TO : <span id="print_receiver_name"></span>
                <input type="hidden" name="receiver" id="receiver" value="" />
                <p><div align="center"><textarea name="contents" id="contents" rows="5" class="span6"></textarea></div></p>
            </div>
            <div class="modal-footer">
                <a href="#" id="btn_close" class="btn" data-dismiss="modal" aria-hidden="true">{lang.close}</a>
                <a href="#" class="btn btn-primary" onclick="send_message_exec({SETTING_ajax_timeout});">{lang.send}</a>
            </div>
        </form>
    </div>
</section>