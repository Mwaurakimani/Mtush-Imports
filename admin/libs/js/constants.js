const root = "http://admin.local";
var selected_catagory;

var Product_buffe = {
    name: ""
};

var Attribute_value_ID = "";
var attribute_set_add_ID = "";
var component1 = `
    <div class="element_add_attribute">
         <div class="selection">
            <input id="add_product_attribute" type="text" onkeyup="search_attribute()" onblur="setTimeout(hide_attributeselect, 1000)">
            <div class="sudgestion" id="attribute_sudgestions">

            </div>
        </div>
        <button onclick="confirm_add_attribute()">Add</button>
    </div>
`

function search_att_val(var1) {
    var value = $(event.currentTarget).val();
    var el = $(event.currentTarget).parent().find("#att_select_helpre");



    var empty = isEmpty(value);

    if (!empty) {
        var tables = [
            "attributes_values",
        ]

        var ref = [
            value,
            var1
        ]

        var fields = [
            "name",
        ]

        var meta_set = {
            caller_id: "add_product_attribute",
            action: "search_val_by_ref",
            unique: false
        }

        data = [
            tables,
            ref,
            fields,
            meta_set
        ]

        search_instance(data, call_back);

        function call_back(data) {
            // var responce = data;

            var responce = JSON.parse(data);


            var render_elem = el;


            var status = responce['status'];

            if (status === true) {
                render_elem.fadeIn("fast");

                var arr = responce['results'][0];
                render_elem.html("");

                arr.forEach(function(entry) {
                    var htmlval = render_elem.html();
                    var fun = `onclick = add_attr_val('${entry[1]}') data-name ='${entry[2]}'`;
                    //content
                    var cont = `<li ${fun}>${entry[2]}</li>`;
                    render_elem.html(htmlval + cont);
                });

            } else {
                render_elem.html("<li>No Suggestion</li>");
            }


        }
    } else {
        hide_attribute_val_helper();
    }
}

function add_attr_val(data) {
    event.stopPropagation();
    //functions when tag is added

    elem = $(event.target);
    var select = $(event.target).parent().parent().find("#att_selected");
    var render_elem = elem.parent();
    var text = $(elem).data("name");

    hide_attribute_val_helper();
    render_elem.html("");


    var htmlval = select.html();
    var fun = `onclick = remove_val('${data}')`;

    var cont = `<p><span ${fun} data-id='${data}' >x</span>${text}</p>`;

    select.html(cont + htmlval);
}


function show_vendors() {
    var value = $(event.currentTarget).val();
    var el = $(event.currentTarget).parent().find("#vendor_sadgestion");
    var el2 = el.find("ul");


    var empty = isEmpty(value);

    if (!empty) {
        var tables = [
            "vendors",
        ]

        var ref = value;

        var fields = [
            "name",
        ]

        var meta_set = {
            caller_id: "vendor_sadgestion",
            action: "search_vendor",
            unique: false
        }

        data = [
            tables,
            ref,
            fields,
            meta_set
        ]

        search_instance(data, call_back);

        function call_back(msg) {


            var responce = JSON.parse(msg);

            var render_elem = el;

            var write_elem = el2;


            var status = responce['status'];

            if (status === true) {
                render_elem.fadeIn("fast");

                var arr = responce['results'][0];
                write_elem.html("");

                arr.forEach(function(entry) {

                    var htmlval = write_elem.html();
                    var fun = `onclick = set_vendor_name('${entry[1]}') data-name ='${entry[2]}'`;
                    //content
                    var cont = `<li ${fun}>${entry[2]}</li>`;
                    write_elem.html(htmlval + cont);

                });

            } else {
                render_elem.fadeIn("fast");
                write_elem.html("<li>No Suggestion</li>");
            }

        }
    } else {
        el.fadeOut("fast");
    }
}

function set_vendor_name(uuid) {
    var el = $(event.currentTarget);
    var name = el.data("name");
    $('input[name ="vendor"]').val(name);
    $('input[name ="vendor"]').attr("data-id", uuid);

    template['Details']['inventory']['vendor'] = $('input[name ="vendor"]').data("id");

    el.parent().html("");

}