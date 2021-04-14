const baseUrl = "https://getbootstrapadmin.com/remark/material/";

var styles =`
global/css/bootstrap.min.css
global/css/bootstrap-extend.min.css
base/assets/css/site.min.css
global/css/skintools.min.css
global/vendor/animsition/animsition.min.css
global/vendor/asscrollable/asScrollable.min.css
global/vendor/switchery/switchery.min.css
global/vendor/switchery/switchery.min.css
global/vendor/slidepanel/slidePanel.min.css
global/vendor/flag-icon-css/flag-icon.min.css
global/vendor/waves/waves.min.css
global/vendor/chartist/chartist.min.css
global/vendor/jvectormap/jquery-jvectormap.min.css
global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.css
base/assets/examples/css/dashboard/v1.min.css
global/fonts/material-design/material-design.min.css
global/fonts/brand-icons/brand-icons.min.css
`.trim().split("\n");


let scripts=`
base/assets/js/Plugin/skintools.min.js
global/vendor/breakpoints/breakpoints.min.js
global/vendor/babel-external-helpers/babel-external-helpers.js
global/vendor/jquery/jquery.min.js
global/vendor/popper-js/umd/popper.min.js
global/vendor/bootstrap/bootstrap.min.js
global/vendor/animsition/animsition.min.js
global/vendor/mousewheel/jquery.mousewheel.min.js
global/vendor/asscrollbar/jquery-asScrollbar.min.js
global/vendor/asscrollable/jquery-asScrollable.min.js
global/vendor/ashoverscroll/jquery-asHoverScroll.min.js
global/vendor/waves/waves.min.js
global/vendor/switchery/switchery.min.js
global/vendor/intro-js/intro.min.js
global/vendor/screenfull/screenfull.min.js
global/vendor/slidepanel/jquery-slidePanel.min.js
global/vendor/chartist/chartist.min.js
global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.min.js
global/vendor/jvectormap/jquery-jvectormap.min.js
global/vendor/jvectormap/maps/jquery-jvectormap-world-mill-en.js
global/vendor/matchheight/jquery.matchHeight-min.js
global/vendor/peity/jquery.peity.min.js
global/js/State.min.js
global/js/Component.min.js
global/js/Plugin.min.js
global/js/Base.min.js
global/js/Config.min.js
base/assets/js/Section/Menubar.min.js
base/assets/js/Section/GridMenu.min.js
base/assets/js/Section/Sidebar.min.js
base/assets/js/Section/PageAside.min.js
base/assets/js/Plugin/menu.min.js
global/js/config/colors.min.js
base/assets/js/config/tour.min.js
base/assets/js/Site.min.js
global/js/Plugin/asscrollable.min.js
global/js/Plugin/slidepanel.min.js
global/js/Plugin/switchery.min.js
global/js/Plugin/matchheight.min.js
global/js/Plugin/jvectormap.min.js
global/js/Plugin/peity.min.js
base/assets/examples/js/dashboard/v1.min.js
`.trim().split("\n");

let jsonScripts = JSON.stringify(styles);

console.log(jsonScripts);


[...document.forms].map((item) => { item.onsubmit = (e) => { return false }});