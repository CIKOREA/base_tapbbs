<script src="{FRONTEND_THIRD_PARTY}Slides-SlidesJS-3/source/jquery.slides.min.js"></script>

<!-- SlidesJS CSS -->
<style type="text/css">
    #slides {
        display: none
    }

    #slides .slidesjs-navigation {
        margin-top:3px;
    }

    #slides .slidesjs-previous {
        margin-right: 5px;
        float: left;
    }

    #slides .slidesjs-next {
        margin-right: 5px;
        float: left;
    }

    .slidesjs-pagination {
        margin: 6px 0 0;
        float: right;
        list-style: none;
    }

    .slidesjs-pagination li {
        float: left;
        margin: 0 1px;
    }

    .slidesjs-pagination li a {
        display: block;
        width: 13px;
        height: 0;
        padding-top: 13px;
        background-image: url({FRONTEND_THIRD_PARTY}Slides-SlidesJS-3/examples/standard/img/pagination.png);
        background-position: 0 0;
        float: left;
        overflow: hidden;
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
        background-position: 0 -13px
    }

    .slidesjs-pagination li a:hover {
        background-position: 0 -26px
    }

    #slides a:link,
    #slides a:visited {
        color: #333
    }

    #slides a:hover,
    #slides a:active {
        color: #9e2020
    }

    .navbar {
        overflow: hidden
    }

    #slides {
        display: none
    }

    .container_slides {
        margin: 0 auto
    }

        /* For tablets & smart phones */
    @media (max-width: 767px) {
        .container_slides {
            width: auto
        }
    }

        /* For smartphones */
    @media (max-width: 480px) {
        .container_slides {
            width: auto
        }
    }

        /* For smaller displays like laptops */
    @media (min-width: 768px) and (max-width: 979px) {
        .container_slides {
            width: 724px
        }
    }

        /* For larger displays */
    @media (min-width: 1200px) {
        .container_slides {
            width: 1170px
        }
    }
</style>

<div class="bbs_title">
    <b>{view->title}</b>
</div>
<div class="bbs_info">
    {view->print_name}

    {? IS_USER_LOGIN === TRUE && view->user_idx != USER_INFO_idx}
        <a href="{BASE_URL}user/send_message?receiver={view->user_idx}" data-rel="dialog" data-transition="flip">
            <img src="{FRONTEND_COMMON}img/icon/message.gif" width="11" height="11" alt="message" />
            {lang.message}
        </a>
        <a class="cursor" data-icon="plus" onclick="add_friend({view->user_idx}, {SETTING_ajax_timeout});">
            <img src="{FRONTEND_COMMON}img/icon/friend.gif" width="11" height="11" alt="friend" />
            {lang.add_friend}
        </a>
    {/}

    <br>
    {lang.write_time} : {view->print_insert_date}
    {? view->print_update_date !== ''}
        {lang.update_time} : {view->print_update_date}
    {/}
    <br>
</div>
<div class="bbs_contents">
    {? view->avatar_used === TRUE}
        <div class="right">
            <img src="{BASE_URL}avatars/{view->user_id}.gif" width="{SETTING_avatar_limit_image_size_width}" height="{SETTING_avatar_limit_image_size_height}" alt="{view->print_name}" />
        </div>
    {/}
    {view->contents}

    <div class="clear"></div>

    {? images.size_ == 1}
        <br />
        <img src="{thumbs[0]}" onclick="window.open('{images[0]}');" />
    {: images.size_ > 1}
        <div id="container_slides">
            <div id="slides">
            {@ images}
                <img src="{thumbs[.key_]}" onclick="window.open('{.value_}');" />
            {/}
                <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
                <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
            </div>
        </div>

        <script type="text/javascript">
            $(function() {
                $('#slides').slidesjs({
                    width: 940,
                    height: 528,
                    navigation: false
                });
            });
        </script>
    {/}
</div>

{? IS_USER_LOGIN === TRUE}
    <div data-role="footer" data-theme="c" align="center">
        <div style="height:2px"></div>
        {? BBS_SETTING_bbs_vote_article_used == 1 && view->user_idx != USER_INFO_idx}
            <a id="btn_vote_article" data-icon="check" onclick="vote('article', '{bbs_id}', {view->idx}, {SETTING_ajax_timeout});">{lang.vote}</a>
        {/}
        <a data-icon="plus" onclick="scrap('{bbs_id}', {view->idx}, {SETTING_ajax_timeout});">{lang.scrap}</a>
        <div style="height:2px"></div>
    </div>
{/}

{? print_tags != ''}
<div class="bbs_tags">
    {lang.tags}&nbsp;:&nbsp;
    {print_tags}
</div>
{/}

{? urls.size_ > 0}
    <div class="bbs_urls">
        {lang.urls}<br>
        {@urls}
            {urls->print_url}<br>
        {/}
    </div>
{/}

{? files.size_ > 0}
    <div class="bbs_files">
    {lang.files}<br>
    {@files}
        {files->print}<br>
    {/}
    </div>
{/}

<div class="bbs_info">
    <ul>
    {? BBS_SETTING_bbs_category_used == 1 && view->category_name}
        <li>{lang.category} : {view->category_name}</li>
    {/}

    {? BBS_SETTING_bbs_comment_used == 1}
        <li>{lang.comment} : {view->comment_count}</li>
    {/}

    {? BBS_SETTING_bbs_vote_article_used == 1}
        <li>{lang.vote} : <span id=""vote_article">{view->vote_count}</span></li>
    {/}
        <li>{lang.scrap} : <span id="scrap">{view->scrap_count}</span></li>
        <li>{lang.hit} : {view->hit}</li>
    </ul>
</div>

<!--
	//이전글 다음글
	//이동후에는 해당글의 페이지를 알 수 없어서 목록으로 가면 1페이지로 간다.
	//물론 알아낼 수는 있지만, 그로 인한 쿼리를 날리기에는 부담이..
	if($view->is_notice == 0 && ($pre_next->idx_pre OR $pre_next->idx_next))
-->
{? view->is_notice == 0 && (pre_next->is_exists_next === TRUE || pre_next->is_exists_pre === TRUE)}
    <ul data-role="listview">
        {? pre_next->is_exists_next === TRUE}
            <li data-icon='arrow-u'>
                <a href="{BASE_URL}bbs/view/{bbs_id}?idx={pre_next->idx_next}&amp;view_category={view_category}&amp;lists_style={lists_style}" data-ajax="false">{lang.article_next} : {pre_next->title_next}
                {? pre_next->comment_count_next > 0}
                    <span class="comment_count">({pre_next->comment_count_next})</span>
                {/}
                </a>
            </li>
        {/}

        {? pre_next->is_exists_pre === TRUE}
            <li data-icon='arrow-d'>
                <a href="{BASE_URL}bbs/view/{bbs_id}?idx={pre_next->idx_pre}&amp;view_category={view_category}&amp;lists_style={lists_style}" data-ajax="false">{lang.article_pre} : {pre_next->title_pre}
                {? pre_next->comment_count_pre > 0}
                    <span class="comment_count">({pre_next->comment_count_pre})</span>
                {/}
                </a>
            </li>
        {/}
    </ul>
{/}

<div class="ui-body ui-body-b">
{? allowed_list.write_article === TRUE && IS_USER_LOGIN === TRUE && view->user_idx == USER_INFO_idx}
    <fieldset class="ui-grid-a">
        <div class="ui-block-a">
            <button type="button" data-theme="d" data-icon="gear" onclick="location.href='{BASE_URL}bbs/modify/{bbs_id}?page={page}&amp;idx={idx}&amp;view_category={view_category}&amp;lists_style={lists_style}';">{lang.update}/{lang.delete}</button>
        </div>
        <div class="ui-block-b">
            <button type="button" data-theme="c" data-icon="back" onclick="location.href='{BASE_URL}bbs/lists/{bbs_id}?page={page}&amp;view_category={view_category}&amp;lists_style={lists_style}';">{lang.lists}</button>
        </div>
    </fieldset>
{:}
    <button type="button" data-theme="c" data-icon="back" onclick="location.href='{BASE_URL}bbs/lists/{bbs_id}?page={page}&amp;view_category={view_category}&amp;lists_style={lists_style}';">{lang.lists}</button>
{/}

</div>

{? lists_comment.size_ > 0 && BBS_SETTING_bbs_comment_used == 1}
    <ul data-role="listview">
        <li data-role="list-divider">{lang.comment}</li>
    </ul>


    {? allowed_list.view_comment === TRUE}
        {@ lists_comment}
                <div id="comment_{lists_comment->idx}_modify" class="{lists_comment->even_class}"></div>
                <div id="comment_{lists_comment->idx}" class="comment_contents {lists_comment->even_class}">
                    {lists_comment->comment}
                </div>
                <div class="comment_info {lists_comment->even_class}">
                    {? lists_comment->new_comment_icon}
                    <img src="{BASE_URL}{lists_comment->new_comment_icon}" width="16" height="11" alt="new" />&nbsp;
                    {/}
                    {lists_comment->print_name}
                    {? IS_USER_LOGIN === TRUE && lists_comment->user_idx == USER_INFO_idx}
                        <a class="cursor" id="btn_modify_comment_form_{lists_comment->idx}>" onclick="set_modify_comment_form('{bbs_id}', {lists_comment->idx}, {SETTING_ajax_timeout});">
                            <img src= "{FRONTEND_COMMON}img/icon/gear.gif" width="11" height="11" alt="{lang.update}/{lang.delete}" />
                            {lang.update}/{lang.delete}
                        </a><br>
                    {/}

                    {? IS_USER_LOGIN === TRUE && lists_comment->user_idx != USER_INFO_idx}
                        <span id="btn_vote_comment_{lists_comment->idx}"><a class="cursor" onclick="vote('comment', '{bbs_id}', {lists_comment->idx}, {SETTING_ajax_timeout});">
                            <img src= "{FRONTEND_COMMON}img/icon/vote.gif" width="11" height="11" alt="{lang.vote}" />{lang.vote}</a>
                            <a href="{BASE_URL}user/send_message?receiver={lists_comment->user_idx}" data-rel="dialog" data-transition="flip">
                                <img src="{FRONTEND_COMMON}/img/icon/message.gif" width="11" height="11" alt="message" />{lang.message}
                            </a>
                            <a class="cursor" data-icon="plus" onclick="add_friend({lists_comment->user_idx}, {SETTING_ajax_timeout});">
                                <img src="{FRONTEND_COMMON}img/icon/friend.gif" width="11" height="11" alt="friend" />{lang.add_friend}
                            </a>
                            <br>
                        </span>
                    {/}
                    {lang.write_time} : {lists_comment->print_insert_date}
                    {? lists_comment->print_update_date !== ''}
                        {lang.update_time} : {lists_comment->print_update_date}
                    {/}

                    {? BBS_SETTING_bbs_vote_comment_used == 1}
                        {lang.vote} : <span id="vote_comment_{lists_comment->idx}">{lists_comment->vote_count}</span>
                    {/}
                </div>
        {/}
        {? comment_pagination !== ''}
            <div data-role="footer" data-theme="d" align="center">
                <div data-role="controlgroup" data-type="horizontal" style="margin-top:7px;margin-bottom:7px">
                    {comment_pagination}
                </div>
            </div>
        {/}
    {/}
{/}

{? BBS_SETTING_bbs_comment_used == 1 && allowed_list.write_comment === TRUE}
    <div id="write_comment_div" align="center">
        <form method="post" name="write_comment_form" id="write_comment_form" data-ajax="false">
            <input type="hidden" name="bbs_id" id="bbs_id" value="{bbs_id}" />
            <input type="hidden" name="article_idx" id="article_idx" value="{idx}" />
            <textarea id="comment" name="comment">{BBS_SETTING_bbs_textarea_comment}</textarea>
            <button type="button" data-theme="e" data-icon="plus" onclick="write_comment('{bbs_id}', '{BASE_URL}bbs/view/{bbs_id}?idx={idx}&amp;page={page}&amp;hit=not&amp;view_category={view_category}&amp;lists_style={lists_style}', {SETTING_ajax_timeout});">{lang.write_comment}</button>
        </form>
    </div>
{/}

<div id="hidden_modify_comment_div" style="display:none">
    <div id="modify_comment_div" align="center">
        <form method="post" name="modify_comment_form" id="modify_comment_form" data-ajax="false">
            <input type="hidden" name="bbs_id" id="bbs_id" value="{bbs_id}" />
            <input type="hidden" name="idx" id="idx" value="" />
            <input type="hidden" name="article_idx" id="article_idx" value="{idx}" />
            <textarea id="comment" name="comment"></textarea>
        </form>
    </div>
    <div class="ui-body ui-body-b">
        <fieldset class="ui-grid-b">
            <div class="ui-block-a"><button type="button" data-theme="e" id="btn_modify_comment" onclick="modify_comment('modify', '{bbs_id}', '{BASE_URL}bbs/view/{bbs_id}?idx={idx}&amp;page={page}&amp;hit=not', {SETTING_ajax_timeout});">{lang.modify}</button></div>
            <div class="ui-block-b"><button type="button" data-theme="c" onclick="remove_modify_comment_form($('#hidden_modify_comment_div #idx').val());">{lang.cancel}</button></div>
            <div class="ui-block-c"><button type="button" data-theme="d" onclick="modify_comment('delete', '{bbs_id}', '{BASE_URL}bbs/view/{bbs_id}?idx={idx}&amp;page={page}&amp;hit=not', {SETTING_ajax_timeout});">{lang.delete}</button></div>
        </fieldset>
    </div>
</div>

<div id="hidden_vote_article" style="display:none">
    <form method="post" name="vote_article_form" id="vote_article_form" data-ajax="false">
        <input type="hidden" name="bbs_id" id="bbs_id" value="{bbs_id}" />
        <input type="hidden" name="idx" id="idx" value="{idx}" />
        <input type="hidden" name="type" id="type" value="article" />
    </form>
</div>

<div id="hidden_vote_comment" style="display:none">
    <form method="post" name="vote_comment_form" id="vote_comment_form" data-ajax="false">
        <input type="hidden" name="bbs_id" id="bbs_id" value="{bbs_id}" />
        <input type="hidden" name="idx" id="idx" value="" />
        <input type="hidden" name="type" id="type" value="comment" />
    </form>
</div>

<!-- 이미지태그로 사이즈 조절 limit : 500px -->
<!-- css 로 처리 -->
<!-- <script type="text/javascript" src="{BASE_URL}JAVASCRIPTs/auto_img_tags_resize.js"></script> -->