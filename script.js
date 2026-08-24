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
    let uname = form.username,
        pwd = form.password,
        cpwd = form.cpassword,
        fullname = form.fullname,
        email = form.email,
        agree = form.agree;

    let ele_arr = [uname, pwd, cpwd, fullname, email, agree];  // Array of input elements
    ele_arr.forEach(item => {
        if (item == undefined) return;  // Skip if element is not present in the form
        let span = document.createElement("span");  // Create a span element
        span.classList.add("error");                // Add error class to span element 
        item.parentNode.append(span);
    });

    form.addEventListener("submit", function (e) {
        // console.log(uname);
        if (uname != undefined) {
            if (uname.value == '') {
                uname.nextElementSibling.innerText = "Username is mandatory.";
                e.preventDefault(); //Stops submission of form
            }
        }
        if (pwd != undefined && pwd.value == '') {
            pwd.nextElementSibling.innerText = "Password is mandatory.";
            e.preventDefault(); //Stops submission of form
            // alert("Password is mandatory.");
        }
        if (cpwd != undefined && cpwd.value == '') {
            cpwd.nextElementSibling.innerText = "Confirm Password is mandatory.";
            e.preventDefault(); //Stops submission of form
            // alert("Confirm Password is mandatory.");
        }
        if (fullname != undefined && fullname.value == '') {
            fullname.nextElementSibling.innerText = "Full Name is mandatory.";
            e.preventDefault(); //Stops submission of form
            // alert("Full Name is mandatory.");
        }
        if (email != undefined && email.value == '') {
            email.nextElementSibling.innerText = "E-mail is mandatory.";
            e.preventDefault(); //Stops submission of form
            // alert("E-mail is mandatory.");
        }
        if (agree != undefined && !agree.checked) {
            agree.nextElementSibling.innerText = "You must agree to the terms and conditions.";
            e.preventDefault(); //Stops submission of form
            // alert("You must agree to the terms and conditions.");
        }
    });

} else {
    console.log("Oops! form not found.");
}
