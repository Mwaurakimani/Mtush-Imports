//render items on the fly
/* jshint shadow:true */

//show and hide overlay
function toggle_overlay() {
    var elem = getbyid('overlaymain');
    var elem = $(elem);
    var display = elem.css("display");

    if (display == 'none') {
        elem.css({ "display": "block" });
        elem.animate({ opacity: "1" }, 500);
    } else {
        elem.animate({ opacity: "0" }, 500, function() {
            elem.css({ "display": "none" });
        });
    }

}

function renderContent(content_name, set = null) {
    var elem = event.currentTarget;
    var elem = $(elem);
    var parent;


    if (content_name == 'Dashboard') {
        var parent = elem.parent();

    } else if (content_name == 'moderator') {
        var parent = elem.parent().parent();
        var arr1 = parent.find(".presssidedbtn");
        $('.dashboardbtn').removeClass("active_btn");

        selectmanager('moderator', set);

        arr1.each(function() {
            $(this).removeClass("active_btn");
        });

        elem.addClass('active_btn');
        return;
    } else {
        var parent = elem.parent().parent();
        $('.dashboardbtn').removeClass("active_btn");
    }

    var arr1 = parent.find(".presssidedbtn");

    arr1.each(function() {
        $(this).removeClass("active_btn");
    });

    elem.addClass('active_btn');

    if (content_name != undefined) {
        var path = "Res/Xml/" + content_name + ".php";
        $.ajax({
                method: "POST",
                url: path,
            })
            .done(function(content) {
                document.getElementById('content').innerHTML = content;

            });
    }
}

//render product arrow rotation
function openelem() {
    var elem = event.currentTarget;
    var elem = $(elem);
    var child = elem.find("span");
    var open = elem.data("open");
    var shorten = elem.parent().parent();

    if (open) {
        child.addClass("open_sub_product");
        shorten.css({
            "height": "50px"
        });
    } else {
        child.removeClass("open_sub_product");
        shorten.css({
            "height": "450px",
        });
    }
    elem.data("open", !open);
}

function render_sku() {
    var elem = event.currentTarget;
    var elem = $(elem);
    var child = elem.find("span");
    var open = elem.data("open");
    var shorten = elem.parent().parent().find(".sku_panel");

    if (open) {
        child.addClass("open_sub_product");
        shorten.animate({ height: "hide" }, 500);
    } else {
        child.removeClass("open_sub_product");
        shorten.animate({ height: "show" }, 500);
    }
    elem.data("open", !open);
}

function openleftpan(x) {
    var elem = event.currentTarget;
    var elem = $(elem);
    var child = elem.find("span");
    var open = elem.data("open");
    var shorten = elem.parent().parent();

    var height = x + "px";


    if (open) {
        child.addClass("open_sub_product");
        shorten.css({
            "height": "50px",
        });
    } else {
        child.removeClass("open_sub_product");
        shorten.css({
            "height": height,
        });
    }
    elem.data("open", !open);

}

//render the sku panel
function set_prod_propertirs() {
    var elemclick = event.target;
    elemclick = $(elemclick);
    var elem = event.currentTarget;
    elem = $(elem);
    var arr_elem = elem.find("ul");

    arr_elem.each(function() {
        $(this).removeClass("active");
    });
    if (elemclick.is("ul")) {
        elemclick.addClass("active");
        var action = elemclick.text();

        var target_elem = getbyid(action);
        target_elem = $(target_elem);
        target_elem.parent().find(">div").each(function() {
            $(this).css({ "display": "none" });
        });

        target_elem.css({ "display": "block" });

    }
}

//dropdown more content from price
function add_more() {
    var elem = event.currentTarget;
    elem = $(elem);
    var parent = elem.parent();
    var target = parent.find('.content_area');
    var setHeight = target.data('height');
    var toggle = target.data('toggle');

    if (toggle) {
        parent.css({ "height": "25px" });

    } else {
        parent.css({ "height": "150px" });
    }
    toggle = !toggle;

    target.data('toggle', toggle);
}

//trigger reall upload button
function trigger_upload() {
    var elem = getbyid('real_upload');
    elem.click();

    //ref to post.js pass val
}



function passed_val(f) {
    var elem = event.currentTarget;
    var value = elem.value;

    if (value) {
        var file = elem.files;
        var name = elem.files[0].name;
        elem = $(elem);
        elem = elem.parent().find('p');
        elem.text(name);

        var formData = new FormData();
        formData.append('file', $('#real_upload')[0].files[0]);

        /* 
        
        upload_file('url_handler','form_data','callbcak');
        
        */
        var url = 'Res/Handlers/file_handler.php';
        var data = formData;
        upload_file(url, data);
    } else {
        elem = $(elem);
        elem = elem.parent().find('p');
        elem.text("No file chosen");
    }
}

function upload_callback(data) {

    console.log(data);


    // var rem1 = getbyid("real_upload");
    // var rem2 = getbyid("img_upload");
    // var rem3 = getbyid("img_tag");
    // var show = document.getElementsByClassName('img_Display')[0].style.display = "block";

    // rem1.style.display = "none";
    // rem2.style.display = "none";
    // rem3.style.display = "none";



    // var img_disp = getbyid('img_disp');
    // img_disp = $(img_disp);
    // name = "Res/Images/products/" + data;
    // img_disp.attr("src", name);
}

function changing() {
    event.stopPropagation();
    var elem = event.currentTarget;
    var ref = $(elem).prop('checked');

    var parenttbl = $(elem).parent().parent().parent().parent().parent();

    var check_array = parenttbl.find("input[type=checkbox]");

    var first = check_array[0];

    var ref1 = $(first).prop('checked');



    var status = [];

    check_array.each(function() {
        if ($(this).is($(first))) {

        } else {
            var ref2 = $(this).prop('checked');
            if (!ref2) {
                status.push("false");
            } else {
                status.push("true");
            }
        }
    });


    if ($.inArray("false", status) >= 0) {
        $(first).prop('checked', false);
    } else {
        $(first).prop('checked', true);
    }
}

function checkall() {
    var elem = event.currentTarget;
    var parenttbl = $(elem).parent().parent().parent().parent().parent();

    var check_array = parenttbl.find("input[type=checkbox]");
    var ref = $(elem).prop('checked');

    check_array.each(function() {
        $(this).prop('checked', ref);
    });
}

function minimize_attribute(v) {
    var target_elem;
    var elem = $(event.currentTarget);
    if (v === 'all') {
        var target_elem = elem.parent();
    } else {
        var target_elem = elem.parent().parent().parent();
    }

    var toggle = target_elem.data('toggle');



    if (toggle === true) {
        target_elem.find(".attribute_body").animate({ height: "show" }, 500, function() {
            $(this).css({ 'display': 'flex' });
        });

    } else {
        target_elem.find(".attribute_body").animate({ height: "hide" }, 500);
    }

    toggle = !toggle;

    target_elem.data('toggle', toggle);
}

function add_att() {
    var elem = $(event.currentTarget);
    var target = elem.parent();
    var content_disp = target.find('ul');
    target.css({
        "border": "solid 2px red",
    });
    content_disp.animate({ height: "show" }, 500);

}

function att_blurred() {
    var elem = $(event.currentTarget);
    var target = elem.parent();
    var content_disp = target.find('ul');
    target.css({
        "border": "solid 1px rgb(163, 163, 163)"
    });
    content_disp.animate({ height: "hide" }, 500);

    elem.val("");
}

//render the tag_select
function hide_tagselect(fun) {
    var select = $('#tag_helper');

    select.html("");
}

function hide_attributeselect(fun) {
    var select = $('#attribute_sudgestions');

    select.html("");
}

function hide_attribute_val_helper(fun) {
    var select = $('#att_select_helpre');

    select.html("");
}

function hide_vendor_helper(fun) {
    var select = $('#vendor_sadgestion');

    select.html("");
}



function Setup_attributes() {
    toggle_overlay();
}

function focus_on_input() {
    var elem = event.currentTarget;
    elem = $(elem);
    elem.parent().find('input').focus();
}

function show_image_edit() {
    console.log("edit image");
}

function toggle_password() {
    var show = "Res/Images/SystemImages/show.png";
    var hide = "Res/Images/SystemImages/hide.png";
    var elem = $(event.currentTarget);
    var input = elem.parent().find("input");

    if (input.length) {
        var type = input.attr("type");

        if (type == "password") {
            input.attr("type", "text");
            elem.find("img").attr("src", show)
        } else {
            input.attr("type", "password");
            elem.find("img").attr("src", hide)
        }
    }
}