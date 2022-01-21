//for mobile nav bar
function togglemenu()
{
    document.querySelector('#menu').classList.toggle('opened');
    document.querySelector('#menu-top').classList.toggle('opened');
}
document.querySelector ('.mobile-menu-icon').addEventListener('click',togglemenu);