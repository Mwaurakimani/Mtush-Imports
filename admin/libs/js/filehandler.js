$(".select_file").on('submit', (function(e) {

    console.log("logging");

    // $.ajax({
    //     url: "ajaxupload.php",
    //     type: "POST",
    //     data: new FormData(this),
    //     contentType: false,
    //     cache: false,
    //     processData: false,
    //     beforeSend: function() {
    //         //$("#preview").fadeOut();
    //         $("#err").fadeOut();
    //     },
    //     success: function(data) {
    //         if (data == 'invalid') {
    //             // invalid file format.
    //             $("#err").html("Invalid File !").fadeIn();
    //         } else {
    //             // view uploaded file.
    //             $("#preview").html(data).fadeIn();
    //             $("#form")[0].reset();
    //         }
    //     },
    //     error: function(e) {
    //         $("#err").html(e).fadeIn();
    //     }
    // });
}));

function send_file() {
    var elem = $(event.currentTarget);

    var input = elem.find(".mediai");

    if (!input.val()) {
        alert("No file selected");
        return;
    }


    $.ajax({
        url: "Res/Handlers/file_handler.php",
        type: "POST",
        enctype: 'multipart/form-data',
        data: new FormData(elem[0]),
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function(request) {
            return;
        },
        success: function(data) {

            if (data[0] == true) {
                var count = data[1].length;

                if (count > 1) {
                    $('#showProdImg').attr('src', data[1][0]);
                    elem.fadeOut();
                    $('.product_primary_image').fadeIn();

                    elem[0].reset();
                } else {
                    $('#showProdImg').attr('src', data[1][0]);
                    elem.fadeOut();
                    $('.product_primary_image').fadeIn();

                    elem[0].reset();
                }
            } else {

            }


            return false;
        },
        xhr: function() {
            //Get XmlHttpRequest object
            var xhr = $.ajaxSettings.xhr();
            //Set onprogress event handler
            xhr.upload.onprogress = function(data) {
                var perc = Math.round((data.loaded / data.total) * 100);
                console.log(perc);

                elem.find(".progress-bar").text(perc + '%');
                elem.find(".progress-bar").css('width', perc + '%');
            };
            return xhr;
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });

    return false;
}

function file_selected() {
    var ele = $(event.currentTarget);

    if (ele.val() == '') {
        ele.siblings(".progress_bar").css('display', 'none');
    } else {
        ele.siblings(".progress_bar").css('display', 'flex');
    }

}