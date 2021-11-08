/**
 * Show Navbar
 * @param toggleId
 * @param navId
 * @param bodyId
 * @param headerId
 */
const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId)

    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
            // show navbar
            nav.classList.toggle('showHeader');
            // change icon
            toggle.classList.toggle('bx-x');
            // add padding to body
            bodypd.classList.toggle('body-pd');
            // add padding to header
            headerpd.classList.toggle('body-pd');
        })
    }
}
showNavbar('header-toggle','nav-bar','body-pd','header');

// Link Active
const linkColor = document.querySelectorAll('.nav__link');
function colorLink(){
    if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'));
        this.classList.add('active');
    }
}
linkColor.forEach(l=> l.addEventListener('click', colorLink));


// Manage Navbar
let collapse__link = document.getElementById("collapse__link");
collapse__link.addEventListener("click", function () {
    const collapseMenu = this.nextElementSibling;
    collapseMenu.classList.toggle('showCollapse');
    const rotate = collapseMenu.previousElementSibling;
    rotate.classList.toggle('rotate');
});

