//main site start
//hide left navigation
function toggle_left_navigation() {
    var navi = document.getElementById('hidenavi');
    var content = document.getElementById('content');
    var width = $(window).width();

    var mini = $(navi).data('mini');

    if (!mini) {
        var newWidth = width - 200 + 150;
        navi.style.width = '50px';

        content.style.width = newWidth + "px";

        var height = $("#content").height();
        $('#hidenav').fadeOut();
        $('.navhidden').fadeOut('fast');
        $('#shownav').fadeIn();
    } else {
        var newWidth = width - 200;
        navi.style.width = '200px';

        content.style.width = newWidth + "px";

        var height = $("#content").height();
        $('#hidenav').fadeIn(900);
        $('#shownav').fadeOut(900);
        $('.navhidden').fadeIn(1100);
    }

    $(navi).data('mini', !mini);
}

//toggle account view
function toggleAccount() {
    $(".dropper").fadeToggle();
}
//main site end



//dashboard start
//show dates
function showdates() {
    var date1 = document.getElementById('datepicker1').value;
    var date2 = document.getElementById('datepicker2').value;

    console.log("date one is " + date1);
    console.log("date one is " + date2);
}
//draw graphs
function drawmap() {
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['May', 'Jun', 'Jul', 'Aug', 'Oct', 'Nov'],
            datasets: [{
                label: ['sales'],
                data: [500000, 200000, 600000, 30000, 1000000, 800000],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
}

function dashboard_callback(content) {
    $(".dropper").fadeOut();

    $('#datepicker1').datepicker({
        uiLibrary: 'bootstrap4'
    });

    $('#datepicker2').datepicker({
        uiLibrary: 'bootstrap4'
    });

    drawmap();
}




//Catalog start
function catalog_callback(content) {
    document.getElementsByClassName('filter_pannel')[0].style.display = "none";


}

function category_callback(content, elem) {
    document.getElementsByClassName(elem)[0].innerHTML = content;
    document.getElementsByClassName('filter_pannel')[0].style.display = "none";
    render_parent_select();
    reset_variance();
}

function tags_callback(content, elem) {
    document.getElementsByClassName(elem)[0].innerHTML = content;
    document.getElementsByClassName('filter_pannel')[0].style.display = "none";
    reset_variance();
}

function attributes_callback(content, elem) {
    document.getElementsByClassName(elem)[0].innerHTML = content;
    document.getElementsByClassName('filter_pannel')[0].style.display = "none";
    reset_variance();
}

function select_attr() {
    var elem = $(event.target);
    var text = elem.text();
    var selected = $(event.currentTarget).parent().find('.selected');

    selected.append("<p><span>x</span>" + text + "</p>");
}

function add_product_variance(action) {
    var name = $('input[name="name"]').val();

    var slung = $('input[name="slung"]').val();
    var parent = $('#category_parent option:selected').text();
    var description = $('textarea[name="description"]').val();

    if (name == "undefined" || (name.trim()) == "") {
        alert("Name required");
        return
    } else if (parent == name) {
        alert("Cannot have parent as same Category");
        return
    } else {
        var values = {
            'name': name,
            'slung': slung,
            '_parent': parent,
            'description': description
        };
        values = JSON.stringify(values);
        var func;

        if (action == "adding_category") {
            func = add_category_call_back;
        } else if (action == "adding_attributes") {
            func = add_attributes_call_back
        } else if (action == "adding_tag") {
            func = add_tags_call_back;
        } else if (action == "adding_attributes_val") {
            func = add_addattribute_val_call_back;
        } else {
            return;
        }

        send_to_handler(action, values, func);
    }
    $('input[name="name"]').val("");
    $('input[name="slung"]').val("");
    $('#category_parent option[value="None"]').prop("selected", "selected");
    $('textarea[name="description"]').val("");
}

function add_category_call_back(data) {


    var result = JSON.parse(data);

    var responce = result[0];



    if (responce == true) {
        var update = $("#Add_variance").text();

        if (update == "Add") {
            var uuid = result[1][0]['UUID']
            var name = result[1][0]['cat_name'];
            var decription = result[1][0]['cat_description'];
            var parent = result[1][0]['cat_parent'];

            if (decription == undefined || decription == null || decription == " ") {
                decription = " ";
            }

            var text = ' \
                <tr data-id=' + uuid + ' onclick="select_variance(\'category\')">  \
                    <td>  \
                        <label class="c_container">  \
                            <input type="checkbox" onchange="changing(event)">  \
                            <span class="checkmark"></span>  \
                        </label>  \
                    </td>  \
                    <td>' + name + '</td>  \
                    <td>' + decription + '</td>  \
                    <td>' + parent + '</td>  \
                </tr >  \
                ';

            $("table tbody").prepend(text);
            render_parent_select();
        } else {
            loadform('category', 'splashboard');
        }
    } else {
        console.log("error");
    }
}

function add_attributes_call_back(data) {
    var result = JSON.parse(data);
    var responce = result[0];

    if (responce == true) {

        var update = $("#Add_variance").text();

        if (update == "Add") {
            var uuid = result[1][0]['UUID']
            var name = result[1][0]['att_name'];
            var decription = result[1][0]['att_description'];




            if (decription == "undefined" || decription == null || decription == " ") {
                decription = " ";
            }

            var text = ' \
                <tr data-id=' + uuid + ' onclick="select_variance(\'attribute\')">  \
                    <td>  \
                        <label class="c_container">  \
                            <input type="checkbox" onchange="changing(event)">  \
                            <span class="checkmark"></span>  \
                        </label>  \
                    </td>  \
                    <td>' + name + '</td>  \
                    <td>' + decription + '</td>  \
                    <td>' + 5 + '</td>  \
                </tr >  \
                ';

            $("table tbody").prepend(text);

        } else {
            loadform('attributes', 'splashboard');
        }

    } else {
        console.log("error");
    }
}

function add_addattribute_val_call_back(data) {

    var result = JSON.parse(data);
    var responce = result[0];


    if (responce == true) {

        var update = $("#Add_variance").text();

        if (update == "Add") {
            var uuid = result[1][0]['UUID']
            var name = result[1][0]['value_name'];
            var decription = result[1][0]['value_slung'];




            if (decription == "undefined" || decription == null || decription == " ") {
                decription = " ";
            }

            var text = ' \
                <tr data-id=' + uuid + ' onclick="select_variance(\'attribute_val\')">  \
                    <td>  \
                        <label class="c_container">  \
                            <input type="checkbox" onchange="changing(event)">  \
                            <span class="checkmark"></span>  \
                        </label>  \
                    </td>  \
                    <td>' + name + '</td>  \
                    <td>' + decription + '</td>  \
                    <td>' + 5 + '</td>  \
                </tr >  \
                ';

            $("table tbody").prepend(text);

        } else {
            add_this_value();
        }

    } else {
        console.log("error");
    }
}

function open_product_attribute(data) {
    var action = "set_var";
    var data = data;

    send_to_handler(action, data);

    Attribute_value_ID = data;



    var call_back = call_back;


    loadform('product_attributes', 'splashboard', call_back);

    function call_back(content, elem) {
        document.getElementsByClassName(elem)[0].innerHTML = content;
        document.getElementsByClassName('filter_pannel')[0].style.display = "none";
        reset_variance();
    }

}

function add_tags_call_back(data) {
    var result = JSON.parse(data);
    var responce = result[0];



    if (responce == true) {

        var update = $("#Add_variance").text();

        if (update == "Add") {
            var uuid = result[1][0]['UUID']
            var name = result[1][0]['tag_name'];
            var decription = result[1][0]['tag_description'];

            if (decription == "undefined" || decription == null || decription == " ") {
                decription = " ";
            }

            var text = ' \
               <tr data-id=' + uuid + ' onclick="select_variance(\'tag\')">  \
                    <td>  \
                        <label class="c_container">  \
                            <input type="checkbox" onchange="changing(event)">  \
                            <span class="checkmark"></span>  \
                        </label>  \
                    </td>  \
                    <td>' + name + '</td>  \
                    <td>' + decription + '</td>  \
                    <td>' + 5 + '</td>  \
                </tr >  \
                ';

            $("table tbody").prepend(text);
        } else {
            loadform('tags', 'splashboard');
        }

    } else {
        console.log("error");
    }
}

function render_parent_select() {
    var data = "";
    console.log("actionn  set");

    send_to_handler("render_parent_select", data, selec_call_back);
}

function selec_call_back(data) {
    var elem = $("#category_parent").html(data);
}

function select_variance(table) {
    var elem = $(event.currentTarget);
    var id = elem.data("id");


    var values = {
        'id': id,
        'table': table
    };


    $("#Add_variance").text("Update");
    send_to_handler("select_variance", values, select_variance_callback);
}

function select_variance_callback(data) {

    var receive = JSON.parse(data);

    if (receive[0] == true) {
        if ('cat_name' in receive[1][0]) {

            var select = receive[1][0]["cat_parent"];


            $('input[name="name"]').val(receive[1][0]['cat_name']);
            $('input[name="slung"]').val(receive[1][0]['cat_slung']);
            $('textarea[name="description"]').val(receive[1][0]['cat_description']);

            var exist = $("#category_parent option[value=" + select + "]").length > 0;

            if (exist) {
                $('#category_parent').val(select);
            } else {
                $('#category_parent').val("None");
            }
        } else if ('tag_name' in receive[1][0]) {

            $('input[name="name"]').val(receive[1][0]['tag_name']);
            $('input[name="slung"]').val(receive[1][0]['tag_slung']);
            $('textarea[name="description"]').val(receive[1][0]['tag_description']);

        } else if ('att_name' in receive[1][0]) {

            $('input[name="name"]').val(receive[1][0]['att_name']);
            $('input[name="slung"]').val(receive[1][0]['att_slung']);
            $('textarea[name="description"]').val(receive[1][0]['att_description']);

        } else if ('value_name' in receive[1][0]) {

            $('input[name="name"]').val(receive[1][0]['value_name']);
            $('input[name="slung"]').val(receive[1][0]['value_slung']);
            $('textarea[name="description"]').val(receive[1][0]['value_description']);

        } else {
            console.log("none");
        }
    }
}

function variance_mass_action(form) {
    var sub_action = ($("#mass_action_apply").find(":selected").text());
    var action = "bulk_apply";
    var elem_arr = $("#right_cat_description tbody tr td label input:checked");
    var data = [
        sub_action, form, ["null"]
    ];

    if (elem_arr.length !== 0) {
        elem_arr.each(function(index) {
            var parent = $(this).parent().parent().parent();
            var id = parent.data("id");
            data[2][index] = id;
        });

        send_to_handler(action, data, apply_on_category);
        if (form == "Category") {
            loadform('category', 'splashboard');
        } else if (form == "tag") {
            loadform('tags', 'splashboard');
        } else if (form == "attribute_val") {
            loadform('product_attributes', 'splashboard', call_back);

            function call_back(content, elem) {
                document.getElementsByClassName(elem)[0].innerHTML = content;
                document.getElementsByClassName('filter_pannel')[0].style.display = "none";
                reset_variance();
            }

        } else {
            loadform('attributes', 'splashboard');
        }
    }




    function apply_on_category(data) {

        var receive = JSON.parse(data);

        var error = receive['errors'];
        var statement = receive["statement"];
        var Successfuly = receive["succesful"];
        var unsuccesful = receive["unsuccesful"];

        Successfuly.forEach(function(entry) {
            var elements = document.querySelectorAll('[data-id="' + entry + '"]');
            elem = $(elements).fadeOut();
        });

        if (error) {
            alert("Not all items were deleted Succesfuly");
        }
    }
}

function get_all_tags() {
    var elem = event.target;
    elem = $(elem);
    var value = elem.val();

    var empty = isEmpty(value);

    if (!empty) {
        var tables = [
            "tags",
        ]

        var ref = value;

        var fields = [
            "name",
            "slung"
        ]

        var meta_set = {
            caller_id: "add_prod_tag",
            action: "search_tag",
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
            var render_elem = $('#tag_helper');

            // console.log(responce);


            var status = responce['status'];

            if (status === true) {
                render_elem.fadeIn("fast");

                var arr = responce['results'][0];
                render_elem.html("");

                arr.forEach(function(entry) {
                    var htmlval = render_elem.html();
                    var fun = `onclick = add_to_tag('${entry[1]}') data-name ='${entry[2]}'`;
                    //content
                    var cont = `<p ${fun}>${entry[2]}</p>`;
                    render_elem.html(htmlval + cont);
                });

            } else {
                render_elem.html("<p>No Suggestion</p>");
            }


        }
    } else {
        hide_tagselect();
    }
}

function add_to_tag(data) {
    event.stopPropagation();
    //functions when tag is added

    console.log(data);

    elem = $(event.target);

    var text = $(elem).data("name");

    var render_elem = $('#tag_helper');
    render_elem.html("");

    var inputval = $('#add_prod_tag');
    inputval.val("");

    var select = $('#tag_select');
    var htmlval = select.html();
    var fun = `onclick = remove_tag('${data}')`;

    var cont = `<p><span ${fun} data-id='${data}' >x</span>${text}</p>`;

    select.html(cont + htmlval);

}



function remove_tag(data) {
    console.log(data);
}

function add_tag(id) {
    event.stopPropagation();
    //functions when tag is not added

    var value = $("#add_prod_tag").val();

    if (value == "undefined" || (value.trim()) == "") {
        alert("Name required");
        return
    } else {
        var ref = $("#tag_helper").children();


        if (ref.length > 0 && ($(ref[0]).text() != "No Suggestion")) {
            ref.each(function(item) {
                var telem = $(ref[item]);

                if (telem.text() === value) {
                    $(event.target).data("name", telem.data("name"));
                    telem.click();
                    $(event.target).data("name", "");
                }
            });
        } else {
            console.log("going here");

            var values = {
                'name': value,
                'slung': "",
                '_parent': "",
                'description': ""
            };
            values = JSON.stringify(values);

            send_to_handler("adding_tag", values, call_back);

            function call_back(data) {
                var result = JSON.parse(data);

                if (result[0] == true) {
                    var arr = result[1];

                    var name = arr[0]['tag_name'];
                    var id = arr[0]['UUID'];

                    var render_elem = $('#tag_helper');
                    render_elem.html("");

                    var inputval = $('#add_prod_tag');
                    inputval.val("");

                    var select = $('#tag_select');
                    var htmlval = select.html();

                    var fun = `onclick = remove_tag('${id}')`;

                    var cont = `<p><span ${fun} >x</span>${name}</p>`;

                    select.html(cont + htmlval);

                } else {
                    alert("Error adding value Contuct Admin");
                }


            }
        }







    }
}

function search_attribute() {
    var value = $(event.currentTarget).val();

    var empty = isEmpty(value);

    if (!empty) {
        var tables = [
            "attributes",
        ]

        var ref = value;

        var fields = [
            "name",
        ]

        var meta_set = {
            caller_id: "add_product_attribute",
            action: "search_attribute",
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
            var render_elem = $('#attribute_sudgestions');


            var status = responce['status'];

            if (status === true) {
                render_elem.fadeIn("fast");

                var arr = responce['results'][0];
                render_elem.html("");

                arr.forEach(function(entry) {
                    var htmlval = render_elem.html();
                    var fun = `onclick = add_to_attributes('${entry[1]}') data-name ='${entry[2]}'`;
                    //content
                    var cont = `<p ${fun}>${entry[2]}</p>`;
                    render_elem.html(htmlval + cont);
                });

            } else {
                render_elem.html("<p>No Suggestion</p>");
            }


        }
    } else {
        hide_attributeselect();
    }
}

function add_to_attributes(data) {
    attribute_set_add_ID = data;
    $("#add_product_attribute").val($(event.target).text());
}

function confirm_add_attribute() {
    var att = $("#add_product_attribute").val();
    $("#add_product_attribute").val("");

    send_to_handler("assign_attribute", attribute_set_add_ID, call_back);

    function call_back(data) {
        var elem1 = $(data);
        (elem1).insertAfter("#ref_add_att");
    }
    attribute_set_add_ID = "";

}




//display qill content
function getall() {
    window.delta = quill.getContents();

    var p = document.getElementById("con");

    p.innerHTML = window.delta;
}
//catalog end


//managers start
function adduser_callback(content, elem) {
    document.getElementsByClassName(elem)[0].innerHTML = content;
}

function selectmanager(form, set) {
    var elem = event.currentTarget;
    if (isEmpty(set)) {
        var email = $(elem).data('email');

        $.post("Res/Handlers/metahandlers.php", {
                email: email,
                action: "open_manager"
            })
            .done(function(data) {
                loadform('users', 'splashboard');
            });
    } else {
        var email = set;
        $.post("Res/Handlers/metahandlers.php", {
                email: email,
                action: "open_manager"
            })
            .done(function(data) {
                loadform(form, 'content', call_back);
                return;
            });

        function call_back(msg, item) {
            document.getElementsByClassName(item)[0].innerHTML = msg;
            return;
        }
    }
}

function addnewUser() {
    $.post("Res/Handlers/metahandlers.php", {
            action: "newuser"
        })
        .done(function(data) {
            loadform('users', 'splashboard');
        });
}

function pass_user() {
    var F_name = getbyid("F_name");
    F_name = F_name.value;
    var L_name = getbyid("L_name");
    L_name = L_name.value;
    var O_name = getbyid("O_name");
    O_name = O_name.value;
    var Gender = getbyid("Gender");
    Gender = Gender.value;
    var U_name = getbyid("U_name");
    U_name = U_name.value;
    var Email = getbyid("Email");
    Email = Email.value;
    var P_Number = getbyid("P_Number");
    P_Number = P_Number.value;
    var Address = getbyid("Address");
    Address = Address.value;
    var Role = getbyid("Role");
    Role = Role.value;
    var Status = getbyid("Status");
    Status = Status.value;
    var UserID = getbyid("UID");
    UserID = UserID.value;


    $.post("Res/Handlers/adduserhandler.php", {
            F_name: F_name,
            L_name: L_name,
            O_name: O_name,
            Gender: Gender,
            U_name: U_name,
            Email: Email,
            P_Number: P_Number,
            Address: Address,
            Role: Role,
            Status: Status,
            UserID: UserID
        })
        .done(function(data) {
            if (data == 'sucessful') {
                loadform('users', 'splashboard');
            }
            alert("Updated Successfuly")
        });

}



//suppliers
function load_file() {
    elem = $(event.target);
    var filename = elem.val().replace(/C:\\fakepath\\/i, '');
    $("#vendor_image_name").html(filename);

}

function load_file() {
    var elem = $(event.target);
    var output = document.getElementById('vendor_id_img');


    if (event.target.files && event.target.files[0]) {
        var filename = elem.val().replace(/C:\\fakepath\\/i, '');
        $("#vendor_image_name").html(filename);


        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }
};

function update_vendor() {
    var name = getbyid("V_name");
    name = name.value;

    var city1 = getbyid("V_city1");
    city1 = city1.value;

    var Address1 = getbyid("V_Address1");
    Address1 = Address1.value;

    var city2 = getbyid("V_city2");
    city2 = city2.value;

    var Address2 = getbyid("V_Address2");
    Address2 = Address2.value;

    var POBox = getbyid("postal_code");
    POBox = POBox.value;

    var contact_name = getbyid("contact_name");
    contact_name = contact_name.value;

    var contact_title = getbyid("contact_title");
    contact_title = contact_title.value;

    var Phone = getbyid("Phone");
    Phone = Phone.value;

    var Email = getbyid("Email");
    Email = Email.value;

    var website = getbyid("website");
    website = website.value;

    var Notes = getbyid("Notes");
    Notes = Notes.value;

    $.post("Res/Handlers/addsupplier.php", {
            name: name,
            city1: city1,
            Address1: Address1,
            city2: city2,
            Address2: Address2,
            POBox: POBox,
            contact_name: contact_name,
            contact_title: contact_title,
            Phone: Phone,
            Email: Email,
            website: website,
            Notes: Notes,
        })
        .done(function(data) {
            var id = data[1][0]['UUID'];

            send_to_handler("set_vendor", id, call_back);

            function call_back(msg) {
                if (data[0] == true) {
                    alert("Updated Succesfuly");
                } else {
                    alert("Update Unsuccesful");
                    loadform('vendors', 'splashboard');
                }
            }
        });

}

function vendor_callback(content, elem) {
    document.getElementsByClassName(elem)[0].innerHTML = content;
    document.getElementsByClassName('filter_pannel')[0].style.display = "none";
}

function new_vendor() {


    send_to_handler("reset_vendor", "hi", call_back);

    function call_back(data) {
        loadform('vendors', 'splashboard');
        alert("Logo feature is not active");
    }
}

function open_vendor(data) {


    send_to_handler("set_vendor", data, call_back);

    function call_back(data) {
        loadform('vendors', 'splashboard');
        alert("Logo feature is not active");
    }
}

function pass_moderator() {
    var currentPassword = $("input[name=currentPassword]").val();
    var newPassword = $("input[name=newPassword]").val();
    var confirmPassword = $("input[name=confirmPassword]").val();

    var empty = isEmptyAllowSpace(currentPassword);
    var empty1 = isEmptyAllowSpace(newPassword);
    var empty2 = isEmptyAllowSpace(confirmPassword);

    if (empty || empty1 || empty2) {
        console.log("Input fields were empty or had white spaces.Please avoid using spacebar for password");
    } else {
        if (newPassword !== confirmPassword) {
            alert("Passwords do not match");
        } else {
            //password has passed all tests
            //not empty
            //the new and confirm passwords match
            //pass to server for verification
            Email

            var email = $("input[name=Email]").val();
            myData = {
                email: email,
                currentPassword: currentPassword,
                newPassword: newPassword,
                confirmPassword: confirmPassword
            }

            myData = JSON.stringify(myData);

            send_to_handler("change_password", myData, update_user);

            function update_user(responce) {
                console.log(responce);
            }

        }
    }

}

function product_bulk_function() {
    var selector = $("#product_bulk_option");
    var option = selector.find("option:selected").val();

    //get all check"ed items
    var parent = $(".salesListdash2");
    var allCheckBoxes = parent.find("input[type='checkbox']");
    var products_filter = [];

    allCheckBoxes.each(function(index, element) {
        if ($(element).attr('id') == "main_checker") {
            return true;
        } else {
            if ($(element).is(':checked')) {
                var elemParent = $(element).parent().parent().parent();
                var elemID = elemParent.data("id");
                products_filter.push(elemID);
            }
        }
    });
    var data = [
        option,
        products_filter
    ];

    data = JSON.stringify(data);


    products_action("bulk_products_action", data, call_back);

    function call_back(data) {
        console.log(data);

        if ((data == true) || (data === 1)) {
            alert("Action successful");
            renderContent('Catalog');
        } else {
            alert("Action Failed");
        }
    }
}

function filterProducts() {
    var selector = $(event.currentTarget);
    var option = selector.find('option:selected').text();

    products_action("filter_table", option, call_back);

    function call_back(data) {
        $('.salesListdash2').html(data);
    }
}