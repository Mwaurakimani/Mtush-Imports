//select elemnt by ID
function getbyid(e) {
    return document.getElementById(e);
}

function not_available() {
    alert("This Feature is not Available")
}

function reset_variance() {
    data = "";
    $('#Add_variance').text('Add');
    send_to_handler("reset_variance", data);
}

function isEmpty(str) {
    if (typeof str == 'undefined' || !str || str.length === 0 || str === "" || !/[^\s]/.test(str) || /^\s*$/.test(str) || str.replace(/\s/g, "") === "") {
        return true;
    } else {
        return false;
    }
}

function isEmptyAllowSpace(str) {
    if (typeof str == 'undefined' || !str || str.length === 0 || str === "") {
        return true;
    } else {
        return false;
    }
}

function add_this_value() {
    open_product_attribute(Attribute_value_ID);
}