<?php /* Template_ 2.2.7 2015/11/23 00:40:49 /cloud9/workspace/cikorea/front_end/themes/pc/default/_template/contents/bbs/modify.tpl 000010534 */ 
$TPL_category_1=empty($TPL_VAR["category"])||!is_array($TPL_VAR["category"])?0:count($TPL_VAR["category"]);
$TPL_tags_1=empty($TPL_VAR["tags"])||!is_array($TPL_VAR["tags"])?0:count($TPL_VAR["tags"]);
$TPL_urls_1=empty($TPL_VAR["urls"])||!is_array($TPL_VAR["urls"])?0:count($TPL_VAR["urls"]);
$TPL_files_1=empty($TPL_VAR["files"])||!is_array($TPL_VAR["files"])?0:count($TPL_VAR["files"]);?>
<?php if($TPL_VAR["validation_message"]!=''){?>
    <script type = "text/javascript">jAlert('<?php echo $TPL_VAR["validation_message"]?>', lang['alert']);</script>
<?php }?>

<?php if($TPL_VAR["result_msg"]!=''){?>
    <script type = "text/javascript">jAlert('<?php echo $TPL_VAR["result_msg"]?>', lang['alert']);</script>
<?php }?>

<link rel="stylesheet" type="text/css" href="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>bootstrap-tagsinput/bootstrap-tagsinput.css" />

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

<form method = "post" name = "modify_form" id = "modify_form" action = "<?php echo $TPL_VAR["BASE_URL"]?>bbs/modify/<?php echo $TPL_VAR["bbs_id"]?>" data-ajax="false" onsubmit = "return (form_null_check('modify_form', '<?php echo $TPL_VAR["form_null_check"]?>') && form_minimum_check('modify_form', '<?php echo $TPL_VAR["form_minimum_check"]?>'));">
    <input type = "hidden" name = "bbs_id" id = "bbs_id" value = "<?php echo $TPL_VAR["bbs_id"]?>" />
    <input type = "hidden" name = "idx" id = "idx" value = "<?php echo $TPL_VAR["idx"]?>" />
    <input type = "hidden" name = "page" id = "page" value = "<?php echo $TPL_VAR["page"]?>" />
    <input type = "hidden" name = "upload_files" id = "upload_files" value = "" />
    <input type = "hidden" name="wysiwyg_files" id="wysiwyg_files" value = "<?php echo $TPL_VAR["wysiwyg_files"]?>" />
    <input type = "hidden" name = "view_category" id = "view_category" value = "<?php echo $TPL_VAR["view_category"]?>" />
    <input type = "hidden" name = "lists_style" id = "lists_style" value = "<?php echo $TPL_VAR["lists_style"]?>" />

    <table class="data-table">
    <colgroup>
        <col width="100" />
        <col />
    </colgroup>
    <tbody>
    <tr>
        <th><?php echo $TPL_VAR["lang"]["title"]?></th>
        <td>
            <input type = "text" name="title" id="title" value = "<?php echo $TPL_VAR["value_list"]["title"]?>" maxlength = "255" class="input-block-level" />
        </td>
    </tr>
<?php if($TPL_VAR["is_use_category"]===TRUE){?>
    <tr>
        <th><?php echo $TPL_VAR["lang"]["category"]?></th>
        <td>
                <select name="category" id="category">
                    <option value="">== <?php echo $TPL_VAR["lang"]["select"]?> ==</option>
<?php if($TPL_category_1){foreach($TPL_VAR["category"] as $TPL_V1){?>
                    <option value="<?php echo $TPL_V1->idx?>" <?php echo $TPL_V1->selected?>><?php echo $TPL_V1->category_name?></option>
<?php }}?>
                </select>
        </td>
    </tr>
<?php }?>
    <tr>
        <td colspan="2">
            <textarea name="contents" id="contents" rows="10" style="width:98%"><?php if($TPL_VAR["value_list"]["contents"]!==''){?><?php echo $TPL_VAR["value_list"]["contents"]?><?php }else{?><?php echo $TPL_VAR["BBS_SETTING_bbs_textarea_contents"]?><?php }?></textarea>
        </td>
    </tr>
    <tr>
        <th><?php echo $TPL_VAR["lang"]["is_secret"]?></th>
        <td><input type="checkbox" name="is_secret" id="is_secret" class="custom" value = "1" <?php echo $TPL_VAR["checkbox_list"]["is_secret"]?>></td>
    </tr>
<?php if($TPL_VAR["IS_ADMIN"]===TRUE){?>
        <tr>
            <th><?php echo $TPL_VAR["lang"]["is_notice"]?></th>
            <td><input type="checkbox" name="is_notice" id="is_notice" class="custom" value = "1" <?php echo $TPL_VAR["checkbox_list"]["is_notice"]?>></td>
        </tr>
<?php }?>

<?php if($TPL_VAR["BBS_SETTING_bbs_tags_used"]== 1){?>
        <tr>
            <th><?php echo $TPL_VAR["lang"]["tags"]?></th>
            <td>
<?php if($TPL_tags_1){foreach($TPL_VAR["tags"] as $TPL_V1){?>
                    <!--<input type = "text" name="tags[]" id="tags" value = "<?php echo $TPL_V1?>" maxlength = "64"><br />-->
<?php }}?>

                <style>
                    .bootstrap-tagsinput { margin-bottom: 0px; }
                </style>
                <input type="text" id="tags_pc" name="tags_pc" value="<?php echo join(',',$TPL_VAR["tags"])?>" data-role="tagsinput" placeholder="↙" /> (<?php echo $TPL_VAR["lang"]["max"]?> : <?php echo $TPL_VAR["BBS_SETTING_bbs_tags_limit_count"]?>)
                <script>
                    $(document).ready(function(){
                        $('#tags_pc').tagsinput({
                            maxTags: <?php echo $TPL_VAR["BBS_SETTING_bbs_tags_limit_count"]?>

                            , maxChars: 64
                            , confirmKeys: [13, 44]
                        });
                    });
                </script>
            </td>
        </tr>
<?php }?>

<?php if($TPL_VAR["BBS_SETTING_bbs_urls_used"]== 1){?>
        <tr>
            <th><?php echo $TPL_VAR["lang"]["urls"]?></th>
            <td>
<?php if($TPL_urls_1){foreach($TPL_VAR["urls"] as $TPL_V1){?>
                    <input type = "text" name="urls[]" id="tags" value = "<?php echo $TPL_V1?>" maxlength = "255"><br />
<?php }}?>
            </td>
        </tr>
<?php }?>

<?php if($TPL_VAR["BBS_SETTING_bbs_upload_used"]== 1&&$TPL_VAR["allowed_list"]["upload"]===TRUE){?>
    <tr>
        <th><?php echo $TPL_VAR["lang"]["files"]?></th>
        <td>
            <div class = "uploaded_files">
<?php if($TPL_files_1){foreach($TPL_VAR["files"] as $TPL_V1){?>
                    <?php echo $TPL_V1->original_filename?>

                    <input type = "checkbox" name = "delete_file[]" id = "delete_file_<?php echo $TPL_V1->idx?>" value = "<?php echo $TPL_V1->idx?>" data-role = "none" /> <label for="delete_file_<?php echo $TPL_V1->idx?>" style="display:inline"><?php echo $TPL_VAR["lang"]["delete"]?></label><br />
<?php }}?>
            </div>
            <div id="file-uploader"></div>
            <noscript>
                <p>Please enable JavaScript to use file uploader.</p>
            </noscript>
        </td>
    </tr>
<?php }?>
    </tbody>
    </table>

    <div class="pull-right">
        <button type="button" class="btn btn-small btn-success" onclick = "confirm_really('modify_form');"><?php echo $TPL_VAR["lang"]["update"]?></button>
        <a href="javascript:void(0)" class="btn btn-small" onclick = "history.go(-1);"><?php echo $TPL_VAR["lang"]["cancel"]?></a>
        <button type = "button" class="btn btn-small btn-danger" value = "<?php echo $TPL_VAR["lang"]["delete"]?>" onclick = "confirm_really('delete_form');"><?php echo $TPL_VAR["lang"]["delete"]?></button>
    </div>
</form>

<form method = "post" name = "delete_form" id = "delete_form" action = "<?php echo $TPL_VAR["BASE_URL"]?>bbs/delete/<?php echo $TPL_VAR["bbs_id"]?>">
    <input type = "hidden" name = "idx" id = "idx" value = "<?php echo $TPL_VAR["idx"]?>" />
    <input type = "hidden" name = "view_category" id = "view_category" value = "<?php echo $TPL_VAR["view_category"]?>" />
    <input type = "hidden" name = "lists_style" id = "lists_style" value = "<?php echo $TPL_VAR["lists_style"]?>" />
</form>

<script type = "text/javascript">
    //성공카운트
    var success_cnt = 0;

    function createUploader()
    {
        var uploader = new qq.FileUploader({
            element: document.getElementById('file-uploader'),
            action: '<?php echo $TPL_VAR["BASE_URL"]?>bbs/upload_file/<?php echo $TPL_VAR["bbs_id"]?>',
            allowedExtensions:['<?php echo join('\',\'',$TPL_VAR["upload_allowed_extension"])?>'],
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
                if(success_cnt >= '<?php echo $TPL_VAR["BBS_SETTING_bbs_upload_limit_count"]?>')
                {
                    jAlert('<?php echo $TPL_VAR["lang"]["upload_file_allow_cnt"]?> : <?php echo $TPL_VAR["BBS_SETTING_bbs_upload_limit_count"]?>', lang['alert']);
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
<script type="text/javascript" src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#contents').ckeditor({
        customConfig : "<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>ckeditor/config_contents.js"
    });
});
</script>
<script type="text/javascript" src="<?php echo $TPL_VAR["FRONTEND_THIRD_PARTY"]?>bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>