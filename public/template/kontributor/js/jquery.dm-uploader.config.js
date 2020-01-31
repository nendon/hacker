$(function(){
  /*
   * For the sake keeping the code clean and the examples simple this file
   * contains only the plugin configuration & callbacks.
   * 
   * UI functions ui_* can be located in: demo-ui.js
   */

    $('#drop-area').dmUploader({ //
      url: 'backend-php/upload.php',
      maxFileSize: 10000000, // 10 Mega 
      onDragEnter: function(){
        // Happens when dragging something over the DnD area
        this.addClass('active');
      },
      onDragLeave: function(){
        // Happens when dragging something OUT of the DnD area
        this.removeClass('active');
      },
      onInit: function(){
        // Plugin is ready to use
        console.log('Uploader initialized :)', 'info')
        var title = $(this).data('title');
        ui_add_log(title, 'Uploader initialized :)', 'info');
      },
      onComplete: function(){
        // All files in the queue are processed (success or error)
        var title = $(this).data('title');
        ui_add_log(title, 'All pending tranfers finished');
      },
      onNewFile: function(id, file){
        // When a new file is added using the file selector or the DnD area
        var no = $(this).data('no');
        var title = $(this).data('title');
        ui_add_log(title, 'New file added #' + id);
        ui_multi_add_file(no, id, file);

        // var template = $('#files-template').text();
        // template = template.replace('%%filename%%', file.name);
      
        // template = $(template);
        // template.prop('id', 'uploaderFile' + id);
        // template.data('file-id', id);
      
        // $('#file'+no).find('li.empty').fadeOut(); // remove the 'no files yet'
        // $('#file'+no).prepend(template);

        // console.log(template);
      },
      onBeforeUpload: function(id){
        // about tho start uploading a file
        var title = $(this).data('title');
        ui_add_log(title, 'Starting the upload of #' + id);
        ui_multi_update_file_status(id, 'uploading', 'Uploading...');
        ui_multi_update_file_progress(id, 0, '', true);
      },
      onUploadCanceled: function(id) {
        // Happens when a file is directly canceled by the user.
        ui_multi_update_file_status(id, 'warning', 'Canceled by User');
        ui_multi_update_file_progress(id, 0, 'warning', false);
      },
      onUploadProgress: function(id, percent){
        // Updating file progress
        ui_multi_update_file_progress(id, percent);
      },
      onUploadSuccess: function(id, data){
        // A file was successfully uploaded
        var title = $(this).data('title');
        ui_add_log(title, 'Server Response for file #' + id + ': ' + JSON.stringify(data));
        ui_add_log(title, 'Upload of file #' + id + ' COMPLETED', 'success');
        ui_multi_update_file_status(id, 'success', 'Upload Complete');
        ui_multi_update_file_progress(id, 100, 'success', false);
      },
      onUploadError: function(id, xhr, status, message){
        ui_multi_update_file_status(id, 'danger', message);
        ui_multi_update_file_progress(id, 0, 'danger', false);  
      },
      onFallbackMode: function(){
        // When the browser doesn't support this plugin :(
          var title = $(this).data('title');
        ui_add_log(title, 'Plugin cant be used here, running Fallback callback', 'danger');
      },
      onFileSizeError: function(file){
        var title = $(this).data('title');
        ui_add_log(title, 'File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
      }
    });
});