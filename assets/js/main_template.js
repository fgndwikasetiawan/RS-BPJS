var sidebar = true;
$(function(){
    resize();
    $('#menubutton').on('click', toggleSidebar);
});

$(window).resize(resize);

function resize() {
    var height = window.innerHeight;
    var width = window.innerWidth;
    $('#page-wrapper').css('min-height', height + 'px');
    $('#page-wrapper').css('min-width', (width - (sidebar ? 250 : 30)) + 'px');
    $('#menubutton').css('top', (height/2 - 40) + 'px');
}

function toggleSidebar() {
    if (sidebar) {
        hideSidebar();
    }
    else {
        showSidebar();
    }
    $('#menubutton').toggleClass('fa-rotate-180');
    sidebar = !sidebar;
}

function hideSidebar() {
    var width = window.innerWidth;
    $('#sidebar').css('left', '-250px')
    $('#page-wrapper').css('left', '30px');
    $('#page-wrapper').css('min-width', (width - 30) + 'px');
}

function showSidebar() {
    var width = window.innerWidth;
    $('#sidebar').css('left', '0');
    $('#page-wrapper').css('left', '250px');
    $('#page-wrapper').css('min-width', (width - 250) + 'px');
}