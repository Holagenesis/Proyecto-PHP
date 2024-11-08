const navItems = document.querySelector('.nav_items');
const openNavbtn = document.querySelector('#open_nav');
const closeNavbtn = document.querySelector('#close_nav');

const openNav = () => {
    navItems.style.display = 'flex';
    openNavbtn.style.display = 'none';
    closeNavbtn.style.display = 'inline-block';
}

const closeNav = () => {
    navItems.style.display = 'none';
    openNavbtn.style.display = 'inline-block';
    closeNavbtn.style.display = 'none';
}

openNavbtn.addEventListener('click', openNav);
closeNavbtn.addEventListener('click', closeNav);



const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector('#show_sidebar-btn');
const hideSidebarBtn = document.querySelector('#hide_sidebar-btn');

const showsidebar = () => {
    sidebar.style.left = '0';
    showSidebarBtn.style.display = 'none';
    hideSidebarBtn.style.display = 'inline-block';
}

const hidesidebar = () => {
    sidebar.style.left = '-100%';
    showSidebarBtn.style.display = 'inline-block';
    hideSidebarBtn.style.display = 'none';
}


showSidebarBtn.addEventListener('click',showsidebar);
hideSidebarBtn.addEventListener('click',hidesidebar);
