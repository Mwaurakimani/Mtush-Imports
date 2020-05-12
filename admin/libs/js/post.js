function loadform(form_name, elem, fun) {
    var form_name;

    $.ajax({
            method: "POST",
            url: "Res/Xml/Forms/" + form_name + ".php",
        })
        .done(function(msg) {
            if (fun != undefined) {
                fun(msg, elem);
                return;
            } else {
                if (form_name == 'product') {
                    product_callback(msg, elem);
                }
                if (form_name == 'users') {
                    adduser_callback(msg, elem);
                }
                if (form_name == 'category') {
                    category_callback(msg, elem);
                }
                if (form_name == 'tags') {
                    tags_callback(msg, elem);
                }
                if (form_name == 'attributes') {
                    attributes_callback(msg, elem);
                }
                if (form_name == 'product_attributes') {
                    fun(msg, elem);
                    reset_variance();
                }
                if (form_name == 'vendors') {
                    vendor_callback(msg, elem);
                } else {
                    return;
                }
            }

        });
}

function logout() {

    $.post("Res/Handlers/metahandlers.php", {
            action: "logout"
        })
        .done(function(data) {
            window.location.href = root;
        });

}

function send_to_handler(action, data, add_item_call_back) {
    $.post("Res/Handlers/metahandlers.php", {
            action: action,
            data: data
        })
        .done(function(data) {
            if (add_item_call_back != undefined) {
                add_item_call_back(data);
            }
        });
}

function upload_file(url, data) {

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        success: function(msg) {
            upload_callback(msg);
        }
    });
}

function search_instance(data, call_back) {
    $.post("Res/Handlers/search_handler.php", {
            data: data
        })
        .done(function(data) {
            if (call_back != undefined) {
                call_back(data);
            }
        });
}

function products_action(action, data, add_item_call_back) {
    $.post("Res/Handlers/product_handler.php", {
            action: action,
            data: data
        })
        .done(function(msg) {
            if (add_item_call_back != undefined) {
                add_item_call_back(msg);
            }
        });

}