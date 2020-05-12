var quill;
var quill2;

var template = {
    draft: false,
    name: "Luis Viton HAnd bag",
    short_description: "This is the short description",
    product_type: "Singel",
    Details: {
        general: {
            Regular_price: 5000,
            Sale_price: 3000,
            start_data: "",
            end_date: ""
        },

        inventory: {
            SKU: "LV_PK_000001",
            vendor: "",
            Stock_Quantity: 10,
            Low_stock_threshhold: 3,
            Sold_alone: "yes"
        },

        link: {
            upsell: "null",
            Crosssell: "null"
        },

        attributes: "null",

        sub_details: {
            Condition: "Good",
            pricecat: "Packed in 45Kg bag",
            Packaging: "No estimeated pieces",
            estimated_count: '',
            cardDescription: ''

        }
    },
    long_description: "This is the long description",

    Settings: {
        status: 0,
        Visibility: "Shop1",
        Editable: 0
    },
}

function product_callback(content, elem, p) {
    document.getElementsByClassName(elem)[0].innerHTML = content;
    document.getElementsByClassName('filter_pannel')[0].style.display = "none";

    //quill 1
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['blockquote', 'code-block'],

        [{
            'header': 1
        }, {
            'header': 2
        }], // custom button values

        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],

        [{
            'script': 'sub'
        }, {
            'script': 'super'
        }], // superscript/subscript

        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }], // outdent/indent

        [{
            'direction': 'rtl'
        }], // text direction

        [{
            'size': ['small', false, 'large', 'huge']
        }], // custom dropdown

        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme

        [{
            'font': []
        }],
        [{
            'align': []
        }],

        ['clean'], // remove formatting button

        ['link', 'image', 'video', ]

    ];
    quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions,
            imageResize: {
                displaySize: true
            }
        },

        theme: 'snow'
    });

    quill.on('selection-change', function(range, oldRange, source) {
        if (range === null && oldRange !== null) {
            $("#editor").parent().css({ "border": "none" });
        } else if (range !== null && oldRange === null)
            $("#editor").parent().css({ "border": "solid red 2px" });
    });


    //quill 2
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
        ['blockquote', 'code-block'],

        [{
            'header': 1
        }, {
            'header': 2
        }], // custom button values

        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],

        [{
            'script': 'sub'
        }, {
            'script': 'super'
        }], // superscript/subscript

        [{
            'indent': '-1'
        }, {
            'indent': '+1'
        }], // outdent/indent

        [{
            'direction': 'rtl'
        }], // text direction

        [{
            'size': ['small', false, 'large', 'huge']
        }], // custom dropdown

        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],

        [{
            'color': []
        }, {
            'background': []
        }], // dropdown with defaults from theme

        [{
            'font': []
        }],
        [{
            'align': []
        }],

        ['clean'], // remove formatting button

        ['link', 'image', 'video', ]

    ];
    quill2 = new Quill('#editor2', {
        modules: {
            toolbar: toolbarOptions,
            imageResize: {
                displaySize: true
            }
        },
        theme: 'snow'
    });

    quill2.on('selection-change', function(range, oldRange, source) {
        if (range === null && oldRange !== null) {
            $("#editor2").parent().css({ "border": "none" });
        } else if (range !== null && oldRange === null)
            $("#editor2").parent().css({ "border": "solid red 2px" });
    });

    if (p) {
        var resp = JSON.parse(p);

        if (resp[0] == true) {

            //set quill1 and quil2
            var short_description = JSON.parse(resp[1][0]['Short_description']);
            var long_description = JSON.parse(resp[1][0]['long_description']);
            quill.setContents(short_description['ops']);
            quill2.setContents(long_description['ops']);

            //set product type
            var product_type = resp[1][0]['Product_type'];
            var all_options = $('#product_type_select').find("option");

            all_options.each(function(index, item) {
                item.removeAttribute("selected");
            });

            var select_type = $('#product_type_select').find("option[value='" + product_type + "']");
            select_type.attr("selected", "selected");


            //set status
            var product_type = resp[1][0]['Product_type'];
            var all_options = $('#product_type_select').find("option");

            all_options.each(function(index, item) {
                item.removeAttribute("selected");
            });

            var select_type = $('#product_type_select').find("option[value='" + product_type + "']");
            select_type.attr("selected", "selected");



        } else {
            console.log(false);
            return;
        }
    }
}

function update_product(template, quill, quill2) {
    template['name'] = $("input[name='product_name']").val();

    template['short_description'] = quill.getContents();

    template['product_type'] = $("select[name='product_type'] option:selected").text();

    template['Details']['general']['Regular_price'] = $("input[name='Regular_price']").val();

    template['Details']['general']['Sale_price'] = $("input[name='Sale_price']").val();

    template['Details']['general']['start_data'] = $("input[name='st_data']").val();

    template['Details']['general']['end_date'] = $("input[name='end_data']").val();

    template['Details']['inventory']['SKU'] = $("input[name='SKU_val']").val();

    template['Details']['inventory']['id'] = $("input[name='SKU_val']").data('id');


    if (isEmpty($("input[name='vendor']").val())) {
        $("input[name='vendor']").val("");
        template['Details']['inventory']['vendor'] = "";
        console.log(true);
    } else {
        template['Details']['inventory']['vendor'] = $("input[name='vendor']").data('id');
        console.log(false);

    }

    template['Details']['inventory']['Stock_Quantity'] = $("input[name='Stock_Quantity']").val();

    template['Details']['inventory']['Low_stock_threshhold'] = $("input[name='Low_stock_threshhold']").val();

    template['Details']['inventory']['Sold_alone'] = $("select[name='Sold_alone'] option:selected").text();

    template['long_description'] = quill2.getContents();

    template['Settings']['status'] = $("select[name='product_active'] option:selected").val();

    template['Settings']['Visibility'] = $("select[name='Product_visibility'] option:selected").val();

    template['Settings']['Editable'] = $("select[name='eneable_edit'] option:selected").val();



    template['Details']['sub_details']['Condition'] = $("input[name='Condition']").val();

    template['Details']['sub_details']['Packaging'] = $("input[name='Packaging']").val();

    template['Details']['sub_details']['pricecat'] = $("input[name='pricecat']").val();

    template['Details']['sub_details']['estimated_count'] = $("input[name='Estimate']").val();

    template['Details']['sub_details']['cardDescription'] = $("textarea[name='cardDescription']").val();



    if (isEmpty(template['name']) ||
        isEmpty(template['product_type']) ||
        isEmpty(template['Details']['general']['Regular_price']) ||
        isEmpty(template['Details']['inventory']['Stock_Quantity'])) {

        alert("Some required fields were empty");
    } else {

        template = JSON.stringify(template);


        products_action("add_product", template, call_back);

        function call_back(data) {
            console.log(data);
        }
    }

}

function open_product(data) {
    if (data == "") {
        send_to_handler("reset_product", data, call_back);

        function call_back(msg) {
            loadform('product', 'splashboard')
        }
    } else {
        send_to_handler("set_roduct", data, call_back);

        function call_back(msg) {

            products_action("get_product", data, call_back2)

            function call_back2(msg2) {
                var responce = JSON.parse(msg2);

                if (responce[0] == true) {
                    loadform('product', 'splashboard', call_back3);

                    function call_back3(msg_, elem) {
                        product_callback(msg_, elem, msg2);

                    }
                } else {
                    alert("cannot open product");
                    return;
                }

            }
        }
    }
}

function set_product_category() {
    var elem = $(event.target);

    if ($(elem).is(':checkbox')) {
        var parent = elem.parent().parent();

        var cat_id = parent.data("id");



        var if_checked = elem.is(":checked");



        if (if_checked) {
            products_action("adding_product_category", cat_id, add_cat);
        } else {
            products_action("removing_product_category", cat_id, removed_cat);
        }

    }

    function add_cat(res) {

    }

    function removed_cat(res) {


    }
}