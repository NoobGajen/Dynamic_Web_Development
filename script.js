/**
 * JS Selectors
 * - document
 *      .getElementById("idname")               // ID Selector
 *      .getElementsByClassName("classname")    // Class Selector
 *      .getElementsByTagName("tagname")        // Tag Selector
 *      .querySelector("cssselector")           // CSS Selector
 *      .querySelectorAll("cssselector")        // CSS Selector
 *      .form_name  or  .form_name.filed_name   // Form Selector
 */

let form = document.user_form;

if (form != undefined) {
    // console.log(form);
    form.addEventListener("submit", function (e) {
        let uname = document.user_form.username;
        // console.log(uname);

        if (uname.value == '') {
            uname.nextElementSibling.innerText = "Username is mandatory.";
            e.preventDefault(); //Stops submission of form
            // alert("Username is mandatory.");
        }
    });

} else {
    console.log("Oops! form not found.");
}
