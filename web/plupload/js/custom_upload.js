/**
 * object container of files to send
 */
 var plupload_json_files = new Array();

/**
 * delete temporal empty row from file list table
 */
 function plupload_del_temp_row()
 {
	if ($('#plupload_temp_row').length > 0) { $('#plupload_temp_row').remove(); }
 }

/**
 * delete row from file list table
 */
 function plupload_del_file_row(actual_element)
 {
 	// update files to send
	plupload_upd_json_files(plupload_get_file_id(actual_element.id));

	// delete row
	actual_element.parentNode.parentNode.parentNode.deleteRow(actual_element.parentNode.parentNode.rowIndex);
 }

/**
 * update final list of uploaded files to move
 */
 function plupload_upd_json_files(file_id)
 {
	var j = 0;
	var upd_json  = '';
	var upd_array = new Array();

	for (var i=0; i<plupload_json_files.length; i++) {
		if (plupload_json_files[i].unique_key != file_id) {
			upd_array[j] = new Object();
			upd_array[j].unique_key  = plupload_json_files[i].unique_key;
			upd_array[j].unique_name = plupload_json_files[i].unique_name;
			upd_array[j].former_name = plupload_json_files[i].former_name;
			upd_array[j].file_type   = plupload_json_files[i].file_type;
			j++;
		}
	}
	plupload_json_files = upd_array;

	if (plupload_json_files.length > 0) {
		upd_json = $.toJSON(plupload_json_files);
	}
	$('#plupload_hidden_files').val(upd_json);
 }

/**
 * return only file name
 */
 function plupload_get_file_id(tag_file_name)
 {
	var parts = tag_file_name.split('_'); return parts[0];
 }

/**
 * return file extension
 */
 function plupload_get_file_type(str_file_name)
 {
	var parts = str_file_name.split('.'); return parts[parts.length-1];
 }

/**
 * return flag for file type restriction (is applicable)
 */
 function checkFilterRestriction(files, filters)
 {
 	if (filters) {
 		var a_filter = filters.split(',');

 		for (var i in files) {
 			var f_good = 0;
 			var f_type = plupload_get_file_type(files[i].name);

 			for (var j=0; j<a_filter.length; j++) {
 				if (a_filter[j] == f_type) { f_good = 1; }
 			}
 			if (f_good == 0) { return 0; }
 		}
 	}
 	return 1;
 }
 
/**
 * execute when page is ready
 */
 $(document).ready(function()
 {
 	var path_folder = $('#plupload_get_folder').val();
 	var custom_size = $('#plupload_max_size').val();
 	var add_filters = $('#plupload_filters').val();

	var uploader = new plupload.Uploader({
		runtimes      : 'html5,flash',
		browse_button : 'plupload_pick_file',
		max_file_size : custom_size + 'mb',
		unique_names  : true,
		url           : path_folder + 'loader/upload.php',
		flash_swf_url : path_folder + 'js/plupload.flash.swf'
	});
	//
	if (add_filters) {
		uploader.settings.filters = [{title : "Filtros", extensions : add_filters}];
	}
	//
	uploader.bind('FilesAdded', function(up, files) {
		if (checkFilterRestriction(files, add_filters) == 1) {
			plupload_del_temp_row();

			var obj_cell  = '';
			var obj_table = document.getElementById('plupload_tb_list');
			

			for (var i in files) {
                var obj_row   = obj_table.insertRow(obj_table.rows.length);
				obj_cell = obj_row.insertCell(0); obj_cell.style.width = '300px'; obj_cell.innerHTML = files[i].name;
				obj_cell = obj_row.insertCell(1); obj_cell.style.width = '100px'; obj_cell.innerHTML = plupload.formatSize(files[i].size);
	
				obj_cell = obj_row.insertCell(2);
				obj_cell.style.width = '50px';
				obj_cell.className = 'plupload_center';
				obj_cell.innerHTML = '<strong id="plupload_show_percent_'+ files[i].id +'"></strong>';
	
				obj_cell = obj_row.insertCell(3);
				obj_cell.style.width = '110px';
				obj_cell.className = 'plupload_center';
				obj_cell.innerHTML = '<div id="plupload_show_progress_'+ files[i].id +'" class="plupload_bar">procesando</div>';
	
				obj_cell = obj_row.insertCell(4);
				obj_cell.style.width = '40px';
				obj_cell.className = 'plupload_center';
				obj_cell.id = 'plupload_del_this_' + files[i].id;
	
				setTimeout(function() { up.start(); }, 500);
			}	
		} else {
			jAlert('El tipo de archivo no es válido', 'Error tipo de archivo');
		}
	});
	//
	uploader.bind('UploadProgress', function(up, file) {
		$('#plupload_show_percent_'+file.id).html  (file.percent + '%');
		$('#plupload_show_progress_'+file.id).width(file.percent + 'px');
	});
	//
	uploader.bind('UploadFile', function(up, file) {
		$('#plupload_show_progress_'+file.id).html('');
  });
	//
  uploader.bind('FileUploaded', function(up, file) {
  	// add file to json array
  	var index = plupload_json_files.length;
  	var file_type = plupload_get_file_type(file.name);

		plupload_json_files[index] = new Object();
		plupload_json_files[index].unique_key  = file.id;
		plupload_json_files[index].unique_name = file.id + '.' + file_type;
		plupload_json_files[index].former_name = file.name;
		plupload_json_files[index].file_type   = file_type;

		$('#plupload_hidden_files').val($.toJSON(plupload_json_files));

		// show file remove icon
		var img_tag = '<img src="'+ path_folder + 'css/del_this.png' +'" class="plupload_del_img" title="Eliminar" id="'+file.id+'_tag" onclick="plupload_del_file_row(this);" />';

		$('#plupload_del_this_'+file.id).html(img_tag);
	});
	//
	uploader.init();
});