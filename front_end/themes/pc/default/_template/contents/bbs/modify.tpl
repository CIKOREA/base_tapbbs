{? validation_message != ''}
    <script type = "text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
    <script type = "text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}

<link rel="stylesheet" type="text/css" href="{FRONTEND_THIRD_PARTY}bootstrap-tagsinput/bootstrap-tagsinput.css" />

<div class="row-fluid">
    <div class="contents_title_container text-left">
        <span class="divider">|</span>
        <div class="title">{BBS_SETTING_bbs_name}</div>
        {? rss_allow == TRUE}
        <div class="buttons">
            <a href="{BASE_URL}bbs/rss/{bbs_id}" target="_blank" class="btn btn-small btn-inverse">RSS</a>
        </div>
        {/}
    </div>
</div>
<div class="clearfix"></div>

<form method = "post" name = "modify_form" id = "modify_form" action = "{BASE_URL}bbs/modify/{bbs_id}" data-ajax="false" onsubmit = "return (form_null_check('modify_form', '{form_null_check}') && form_minimum_check('modify_form', '{form_minimum_check}'));">
    <input type = "hidden" name = "bbs_id" id = "bbs_id" value = "{bbs_id}" />
    <input type = "hidden" name = "idx" id = "idx" value = "{idx}" />
    <input type = "hidden" name = "page" id = "page" value = "{page}" />
    <input type = "hidden" name = "upload_files" id = "upload_files" value = "" />
    <input type = "hidden" name="wysiwyg_files" id="wysiwyg_files" value = "{wysiwyg_files}" />
    <input type = "hidden" name = "view_category" id = "view_category" value = "{view_category}" />
    <input type = "hidden" name = "lists_style" id = "lists_style" value = "{lists_style}" />

    <table class="data-table">
    <colgroup>
        <col width="100" />
        <col />
    </colgroup>
    <tbody>
    <tr>
        <th>{lang.title}</th>
        <td>
            <input type = "text" name="title" id="title" value = "{value_list.title}" maxlength = "255" class="input-block-level" />
        </td>
    </tr>
    {? is_use_category === TRUE}
    <tr>
        <th>{lang.category}</th>
        <td>
                <select name="category" id="category">
                    <option value="">== {lang.select} ==</option>
                    {@ category}
                    <option value="{category->idx}" {category->selected}>{category->category_name}</option>
                    {/}
                </select>
        </td>
    </tr>
    {/}
    <tr>
        <td colspan="2">
            <textarea name="contents" id="contents" rows="10" style="width:98%">{? value_list.contents !== ''}{value_list.contents}{:}{BBS_SETTING_bbs_textarea_contents}{/}</textarea>
        </td>
    </tr>
    <tr>
        <th>{lang.is_secret}</th>
        <td><input type="checkbox" name="is_secret" id="is_secret" class="custom" value = "1" {checkbox_list.is_secret}></td>
    </tr>
    {? IS_ADMIN === TRUE}
        <tr>
            <th>{lang.is_notice}</th>
            <td><input type="checkbox" name="is_notice" id="is_notice" class="custom" value = "1" {checkbox_list.is_notice}></td>
        </tr>
    {/}

    {? BBS_SETTING_bbs_tags_used == 1}
        <tr>
            <th>{lang.tags}</th>
            <td>
                {@ tags}
                    <!--<input type = "text" name="tags[]" id="tags" value = "{.value_}" maxlength = "64"><br />-->
                {/}

                <style>
                    .bootstrap-tagsinput { margin-bottom: 0px; }
                </style>
                <input type="text" id="tags_pc" name="tags_pc" value="{= join(',', tags)}" data-role="tagsinput" placeholder="↙" /> ({lang.max} : {BBS_SETTING_bbs_tags_limit_count})
                <script>
                    $(document).ready(function(){
                        $('#tags_pc').tagsinput({
                            maxTags: {BBS_SETTING_bbs_tags_limit_count}
                            , maxChars: 64
                            , confirmKeys: [13, 44]
                        });
                    });
                </script>
            </td>
        </tr>
    {/}

    {? BBS_SETTING_bbs_urls_used == 1}
        <tr>
            <th>{lang.urls}</th>
            <td>
                {@ urls}
                    <input type = "text" name="urls[]" id="tags" value = "{.value_}" maxlength = "255"><br />
                {/}
            </td>
        </tr>
    {/}

    {? BBS_SETTING_bbs_upload_used == 1 && allowed_list.upload === TRUE}
    <tr>
        <th>{lang.files}</th>
        <td>
            <div class = "uploaded_files">
                {@files}
                    {files->original_filename}
                    <input type = "checkbox" name = "delete_file[]" id = "delete_file_{files->idx}" value = "{files->idx}" data-role = "none" /> <label for="delete_file_{files->idx}" style="display:inline">{lang.delete}</label><br />
                {/}
            </div>
            <div id="file-uploader"></div>
            <noscript>
                <p>Please enable JavaScript to use file uploader.</p>
            </noscript>
        </td>
    </tr>
    {/}
    </tbody>
    </table>

    <div class="pull-right">
        <button type="button" class="btn btn-small btn-success" onclick = "confirm_really('modify_form');">{lang.update}</button>
        <a href="javascript:void(0)" class="btn btn-small" onclick = "history.go(-1);">{lang.cancel}</a>
        <button type = "button" class="btn btn-small btn-danger" value = "{lang.delete}" onclick = "confirm_really('delete_form');">{lang.delete}</button>
    </div>
</form>

<form method = "post" name = "delete_form" id = "delete_form" action = "{BASE_URL}bbs/delete/{bbs_id}">
    <input type = "hidden" name = "idx" id = "idx" value = "{idx}" />
    <input type = "hidden" name = "view_category" id = "view_category" value = "{view_category}" />
    <input type = "hidden" name = "lists_style" id = "lists_style" value = "{lists_style}" />
</form>

<script type = "text/javascript">
    //성공카운트
    var success_cnt = 0;

    function createUploader()
    {
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader'),
            action: '{BASE_URL}bbs/upload_file/{bbs_id}',
            allowedExtensions:['{= join('\',\'', upload_allowed_extension)}'],
            maxConnections:3,
            onComplete: function(id, fileName, responseJSON)
            {
                if(responseJSON.success == true)
                {
                    $('#upload_files').val($('#upload_files').val()+base64_encode(rawurlencode(fileName))+':'+responseJSON.real_file_name+'|');
                    $('.qq-upload-list').show();
                    success_cnt++;
                }

                //업로드 허용 카운트
                if(success_cnt >= '{BBS_SETTING_bbs_upload_limit_count}')
                {
                    jAlert('{lang.upload_file_allow_cnt} : {BBS_SETTING_bbs_upload_limit_count}', lang['alert']);
                    $('.qq-upload-button').css('display', 'none');
                }
            },
            messages: {
                typeError: lang['upload_file_error_extension']+"\n§extensions§",
                sizeError: "§file§ is too large, maximum file size is §sizeLimit§.",
                minSizeError: "§file§ is too small, minimum file size is §minSizeLimit§.",
                emptyError: "§file§ is empty, please select files again without it.",
                onLeave: lang['upload_file_being']
            },
            debug: false
        });
    }

    // in your app create uploader as soon as the DOM is ready
    // don't wait for the window to load
    window.onload = createUploader;
</script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#contents').ckeditor({
        customConfig : "{FRONTEND_THIRD_PARTY}ckeditor/config_contents.js"
    });
});
</script>
<script type="text/javascript" src="{FRONTEND_THIRD_PARTY}bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>