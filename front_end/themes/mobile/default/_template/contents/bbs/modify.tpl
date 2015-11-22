{? validation_message != ''}
<script type = "text/javascript">jAlert('{validation_message}', lang['alert']);</script>
{/}

{? result_msg != ''}
<script type = "text/javascript">jAlert('{result_msg}', lang['alert']);</script>
{/}
<form method = "post" name = "modify_form" id = "modify_form" action = "{BASE_URL}bbs/modify/{bbs_id}" data-ajax="false" onsubmit = "return (form_null_check('modify_form', '{form_null_check}') && form_minimum_check('modify_form', '{form_minimum_check}'));">
<input type = "hidden" name = "bbs_id" id = "bbs_id" value = "{bbs_id}" />
<input type = "hidden" name = "idx" id = "idx" value = "{idx}" />
<input type = "hidden" name = "page" id = "page" value = "{page}" />
<input type = "hidden" name = "upload_files" id = "upload_files" value = "" />
<input type = "hidden" name = "view_category" id = "view_category" value = "{view_category}" />
<input type = "hidden" name = "lists_style" id = "lists_style" value = "{lists_style}" />
<div id = "modify_div" align = "center">
	▼ {lang.title}
    <input type = "text" name = "title" id = "title" value = "{value_list.title}" maxlength = "255" />
    {? is_use_category === TRUE}
        <select name="category" id="category">
            <option value="">== {lang.select} ==</option>
            {@ category}
            <option value="{category->idx}" {category->selected}>{category->category_name}</option>
            {/}
        </select>
    {/}

	▼ {lang.contents}
    <textarea name = "contents" id = "contents">{? value_list.contents !== ''}{value_list.contents}{:}{BBS_SETTING_bbs_textarea_contents}{/}</textarea>

    {? BBS_SETTING_bbs_tags_used == 1}
    <div id = "write_toggle_div">
        <div data-role="collapsible" data-collapsed="{tags_collapsed}" data-theme="c" data-content-theme="c">
            <h3>{lang.tags}</h3>
            {@ tags}
                <input type = "text" name = "tags[]" id = "tags" value = "{.value_}" maxlength = "64" />
            {/}
        </div>
    </div>
    {/}

    {? BBS_SETTING_bbs_urls_used == 1}
    <div id = "write_toggle_div">
        <div data-role="collapsible" data-collapsed="{urls_collapsed}" data-theme="c" data-content-theme="c">
            <h3>{lang.urls}</h3>
            {@ urls}
                <input type = "text" name = "urls[]" id = "urls" value = "{.value_}" maxlength = "255" />
            {/}
        </div>
    </div>
    {/}

    <div class = "uploaded_files">
        {@files}
            {files->original_filename}
            <input type = "checkbox" name = "delete_file[]" id = "delete_file_{files->idx}" value = "{files->idx}" data-role = "none" /> <label for="delete_file_{files->idx}">{lang.delete}</label><br />
        {/}
	</div>

    <div class = "uploaded_files"></div>
    {? BBS_SETTING_bbs_upload_used == 1 && allowed_list.upload === TRUE && BBS_SETTING_bbs_upload_limit_count > files.size_ }
    <div id="file-uploader">
        <noscript>
            <p>Please enable JavaScript to use file uploader.</p>
            <!-- or put a simple form for upload here -->
        </noscript>
    </div>
    {/}

	<div id = "modify_checkbox_div">
        <input type="checkbox" name="is_secret" id="is_secret" class="custom" value = "1" {checkbox_list.is_secret} />
        <label for="is_secret">{lang.is_secret}</label>
        {? IS_ADMIN === TRUE}
            <input type="checkbox" name="is_notice" id="is_notice" class="custom" value = "1" {checkbox_list.is_notice} />
            <label for="is_notice">{lang.is_notice}</label>
        {/}
	</div>
</div>
<div class="ui-body ui-body-b">
<fieldset class="ui-grid-b">
    {? view->update_by_mobile == 'possible'}
		<div class="ui-block-a"><button type="button" data-theme="e" onclick="confirm_really('modify_form');">{lang.update}</button></div>
    {:}
        <div class="ui-block-a"><button type="button" data-theme="e" onclick="confirm_really('modify_form');" disabled="disabled">{lang.update} (PC)</button></div>
    {/}
		<div class="ui-block-b"><button type="button" data-theme="c" onclick="history.go(-1);">{lang.cancel}</button></div>
		<div class="ui-block-c"><button type="button" data-theme="d" onclick="confirm_really('delete_form');">{lang.delete}</button></div>
</fieldset>
</div>
</form>

<form method = "post" name = "delete_form" id = "delete_form" action = "{BASE_URL}bbs/delete/{bbs_id}" data-ajax="false">
<input type = "hidden" name = "idx" id = "idx" value = "{idx}" />
<input type = "hidden" name = "view_category" id = "view_category" value = "{view_category}" />
<input type = "hidden" name = "lists_style" id = "lists_style" value = "{lists_style}" />
</form>

<script type = "text/javascript">
	//성공카운트
	var success_cnt = {files_count};

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
								//$('#upload_files').val($('#upload_files').val()+rawurlencode(str_replace([':','|'],'',fileName))+':'+responseJSON.real_file_name+'|');
								$('#upload_files').val($('#upload_files').val()+base64_encode(rawurlencode(fileName))+':'+responseJSON.real_file_name+'|');
                                $('.qq-upload-list').show();
								success_cnt++;
							}

							//업로드 허용 카운트
							if(success_cnt >= {BBS_SETTING_bbs_upload_limit_count})
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
			/*
			showMessage: function(message){
				jAlert(message, lang['alert']);
			},
			*/
			debug: true
		});
	}

	// in your app create uploader as soon as the DOM is ready
	// don't wait for the window to load
	window.onload = createUploader;
</script>