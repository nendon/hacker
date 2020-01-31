$(document).ready(function() {

    $('.menu-icon').click(function(event) {
        $('#sidebar').toggleClass('sidebar-expand');
        console.log('clicked');


    });

    $('#sidebar ul li').click(function(event) {
        $('#sidebar ul li').removeClass('icon-active')
        $(this).addClass('icon-active')

    });


    $('.header-menu .has-dropdown').on('click', function(event) {
        var _this = $(this).children('.dropdown-container');

        if (_this.css('display').toLowerCase() !== 'block') {
            $('.header-menu .dropdown-container').hide()
            _this.show()
        } else {
            _this.hide()
        }


    });

    $(document).click(function() {
        $('.dropdown-container').hide();
        $('#sidebar').removeClass('sidebar-expand');
    });

    $('.header-menu .has-dropdown, #sidebar').click(function(e) {
        e.stopPropagation();
    });

});

$(document).ready(function() {
    $('.tab-btn-container a').click(function(a) {
        var tab = $(this).attr('id');
        $('.tab-btn-container a').css({
            'background-color': '#ededed'
        })
        $(this).css({
            'background-color': '#f8f8f8'
        })

        $('.tab-content > div').css('display', 'none');
        $('#' + $(this).attr('id') + '-content').css('display', 'block');
    });

    $('.pro p').click(function() {
        $(this).css({
            'color': '#FFF',
            'background-color': '#2ecc71',
            'border': 'none'
        })
        $('.premium p').css({
            'color': '#339bd5',
            'background-color': 'transparent',
            'border': '2px solid #339bd5'
        })
        $('#pricing-table tbody tr td:nth-child(3)').css('background-color', 'transparent');
        $('#pricing-table tbody tr td:nth-child(2)').css('background-color', 'rgba(46, 204, 113,.1)');
    });

    $('.premium p').click(function() {
        $(this).css({
            'color': '#FFF',
            'background-color': '#2ecc71',
            'border': 'none'
        })
        $('.pro p').css({
            'color': '#339bd5',
            'background-color': 'transparent',
            'border': '2px solid #339bd5'
        })
        $('#pricing-table tbody tr td:nth-child(2)').css('background-color', 'transparent');
        $('#pricing-table tbody tr td:nth-child(3)').css('background-color', 'rgba(46, 204, 113,.1)');
    });
});

var generateDuration = function(seconds) {
        var secondsInAMinute = 60;
        var secondsInAnHour = 60 * secondsInAMinute;
        var secondsInADay = 24 * secondsInAnHour;

        // extract days
        var days = Math.floor(seconds / secondsInADay);

        // extract hours
        var hourSeconds = seconds % secondsInADay;
        var hours = Math.floor(hourSeconds / secondsInAnHour);

        // extract minutes
        var minuteSeconds = hourSeconds % secondsInAnHour;
        var minutes = Math.floor(minuteSeconds / secondsInAMinute);

        // extract the remaining seconds
        var remainingSeconds = minuteSeconds % secondsInAMinute;
        var seconds = Math.ceil(remainingSeconds);

        var d = (days > 0) ? days + ':' : '';
        var h = (hours > 0) ? (hours <= 9 ? '0' + hours : hours) + ':' : '00:';
        var m = (minutes > 0) ? (minutes <= 9 ? '0' + minutes : minutes) + ':' : '00:';
        var s = (seconds > 0) ? (seconds <= 9 ? '0' + seconds : seconds) : '00';

        return d + h + m + s;
    }
    //Pake dropipy.js untuk file uploadnya
    /* $('.dropify').dropify({
        messages: {
            'default': 'Tambahkan Cover Standar 750x422 pixels; .jpg .jpeg .png<br>Drag & Drop Cover disini',
            'replace': 'Drag & drop or click untuk mengganti Cover',
            'remove':  'Hapus',
            'error':   'Maaf, sepertinya sesuatu yang salah telah terjadi.'
        }
    }); */

$('#BuatCourse-show').click(function() {
    $('#rowBuatCourse').slideDown(500);
});
$('#BuatCourse-hide').click(function() {
    $('#rowBuatCourse').slideUp(500);
})

// Pake dropipy.js untuk file uploadnya
/* $('.dropify').dropify({
    messages: {
        'default': 'All files should be at least 720p and less than 4.0 GB.<br> Drag & Drop disini',
        'replace': 'Drag & drop or click untuk mengganti Cover',
        'remove': 'Hapus',
        'error': 'Maaf, sepertinya sesuatu yang salah telah terjadi.'
    }
}); */
/* $('#drop-area').dmUploader({ //
    url: '',
    maxFileSize: 300000000, // 3 Megs 
    onDragEnter: function() {
        // Happens when dragging something over the DnD area
        this.addClass('active');
    },
    onDragLeave: function() {
        // Happens when dragging something OUT of the DnD area
        this.removeClass('active');
    },
    onInit: function() {
        // Plugin is ready to use
        ui_add_log('Penguin initialized :)', 'info');
    },
    onComplete: function() {
        // All files in the queue are processed (success or error)
        ui_add_log('All pending tranfers finished');
    },
    onNewFile: function(id, file) {
        // When a new file is added using the file selector or the DnD area
        ui_add_log('New file added #' + id);
        ui_multi_add_file(id, file);
    },
    onBeforeUpload: function(id) {
        // about tho start uploading a file
        ui_add_log('Starting the upload of #' + id);
        ui_multi_update_file_progress(id, 0, '', true);
        ui_multi_update_file_status(id, 'uploading', 'Uploading...');
    },
    onUploadProgress: function(id, percent) {
        // Updating file progress
        ui_multi_update_file_progress(id, percent);
    },
    onUploadSuccess: function(id, data) {
        // A file was successfully uploaded
        ui_add_log('Server Response for file #' + id + ': ' + JSON.stringify(data));
        ui_add_log('Upload of file #' + id + ' COMPLETED', 'success');
        ui_multi_update_file_status(id, 'success', 'Upload Complete');
        ui_multi_update_file_progress(id, 100, 'success', false);
    },
    onUploadError: function(id, xhr, status, message) {
        // Happens when an upload error happens
        ui_multi_update_file_status(id, 'danger', message);
        ui_multi_update_file_progress(id, 0, 'danger', false);
    },
    onFallbackMode: function() {
        // When the browser doesn't support this plugin :(
        ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
    },
    onFileSizeError: function(file) {
        ui_add_log('File \'' + file.name + '\' cannot be added: size excess limit', 'danger');
    }
  });
*/
  

