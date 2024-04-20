var viewAddress = document.querySelector(".view_address");
var editAddress = document.getElementById("edit_address");
var showEdit = document.querySelector(".showEdit");

document.addEventListener("DOMContentLoaded", function() {
    showEdit.addEventListener("click", function(event) {
        event.preventDefault();
        if (viewAddress.style.display == "none"){
            viewAddress.style.display = "block";
            editAddress.style.display = "none";
        } else{
            viewAddress.style.display = "none";
            editAddress.style.display = "block";
        }
    })
})

var showAddNewAddress = document.getElementById("add-new-address");
var addAddressDiv = document.getElementById("add_address");

document.addEventListener("DOMContentLoaded", function() {
    showAddNewAddress.addEventListener("click", function(event){
        event.preventDefault;
        if (addAddressDiv.style.display == "none"){
            addAddressDiv.style.display = "block";
        } else{
            addAddressDiv.style.display = "none";
        }
    })
})
