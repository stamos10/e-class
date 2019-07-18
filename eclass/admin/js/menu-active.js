var i = 0;
var link_href;
window.onload = activeUrl;

function activeUrl() {

var current_page = (window.location.toString()).trim();
var active_url = document.querySelectorAll("ul.assist-menu li a.link");

for (i = 0; i < active_url.length; i++) {
  link_href = active_url[i].getAttribute("href");
  if ((link_href.toString()).trim() == current_page) {
    
     active_url[i].classList.add("assist-menu-active");
  }
}
}