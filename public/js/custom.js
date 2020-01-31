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


    // //Upload Library
    $('.upload').click(function() {
        var uploader = new plupload.Uploader({
            browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
            url: $('#browse').attr('url'),
            multi_selection: false,
            multipart_params: {},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            file_data_name: 'file',

            //only resize on browser not on android

        });

        uploader.init();

        uploader.bind('FilesAdded', function(up, files) {

            uploader.start();
            var html = '';
            plupload.each(files, function(file) {

                // html += '<li id="' + file.id + '" class="file_uploading"> ' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';

            });
            // document.getElementById('filelist').innerHTML += html;

        });

        uploader.bind('UploadProgress', function(up, file) {
            // document.getElementById('submit').setAttribute("disabled", true);
            //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            document.getElementById('file_progress').innerHTML = '<span class="text-warning"> Uploading ' + file.percent + "%</span>";
        });

        uploader.bind('Error', function(up, err) {
            document.getElementById('file_progress').innerHTML += "\nError #" + err.code + ": " + err.message;
        });
        uploader.bind('FileUploaded', function(up, file) {
            // $(file.id).removeClass('loading_small');
            // document.getElementById(file.id).getElementsByTagName('span')[0].className = "fa fa-check";
            // document.getElementById(file.id).className = "upload_success";

            document.getElementById('file_progress').innerHTML = '<span> <i class="fa fa-check text-success"></i> Upload Success </span>';
            //Jquery(file.id).css({color : "#18930B"});


        });

        uploader.bind('UploadComplete', function(up, file) {


        });

    });
});