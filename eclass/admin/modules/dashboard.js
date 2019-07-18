/*
 *
 * INITIALIZE VARIABLES
 */

var url_init = "http://localhost/gumnasio/Gumnasio/App/Controllers/reception.php";
var base_url = "http://localhost/gumnasio/eclass/admin/";
var page = document.getElementById("page");
var container = document.getElementById("template-holder");
var container_single = document.getElementById("template-single-holder");
var container_edit = document.getElementById("template-edit-holder");
var loading = document.getElementById("loading");
var update_btn = document.getElementById("update");
var close_a = document.getElementById("close-a");
var close_b = document.getElementById("close-b");
var close_c = document.getElementById("close-c");
var close_d = document.getElementById("close-d");
var anartisi;
var i;

var page_url = document.getElementById("page").value;
var messages_area = document.getElementById("messages-area");

var message_response = messages_area.innerText; 

if (message_response.length > 0) {
    setTimeout(function(){
        messages_area.style.display="none";
        window.location = page_url;
    }, 1500);
}

/*
 *
 * FETCH INITIAL DATA
 */

get_request(url_init, "admin-data-dashboard");



/*
 *
 * EVENT LISTENERS
 */

update_btn.addEventListener('click', update_anartisi);
close_a.addEventListener('click', close_single_anartisi);
close_b.addEventListener('click', close_single_anartisi);
close_c.addEventListener('click', close_edit_anartisi);
close_d.addEventListener('click', close_edit_anartisi);



/*
 *
 * OBJECT CONSTRUCTOR
 */

function Anartisi(id, title, tmima, type, content_init, content, url,
                  sender_email, mathima, receiver, created ) {
    
    this.id = id;
    this.title = title;
    this.tmima = tmima;
    this.type = type;
    this.content_init = content_init;
    this.content = content;
    this.url = url;
    this.sender_email = sender_email;
    this.mathima = mathima;
    this.receiver = receiver;
    this.created = created;
}




/*
 *
 * AJAX GET REQUEST
 */

function get_request(url, action) {
    
    var req = new XMLHttpRequest();
    url += "?data-action=" + action + "&page=" + page_url;
    
    req.onreadystatechange = function(){
        
        if(req.readyState == 3) {
          loading.style.display = "block;";
          loading.style.display.innerHTML = "Please Wait. Loading...";
        }else if(req.readyState == 4) {
          if (req.status == 200) {
          var data_received = JSON.parse(req.responseText);  
          show_template(data_received);
          }
          
          if (req.status == 404) {
            loading.style.display = "block";
            loading.innerHTML = "File Not Found";
          }
          
        }
    };
    
    req.open('GET', url, true);
    req.send();
}




/*
 *
 * AJAX POST REQUEST
 */

function post_request(url, data) {
    
    var req = new XMLHttpRequest();
    
    req.onreadystatechange = function(){
        
        if(req.readyState == 3) {
          loading.style.display = "block;";
          loading.style.display.innerHTML = "Please Wait. Loading...";
        }else if(req.readyState == 4) {
          if (req.status == 200) {
          var message = JSON.parse(req.responseText);  
          show_response(message);
          }
          
          if (req.status == 404) {
            loading.style.display = "block";
            loading.innerHTML = "File Not Found";
          }
          
        }
    };
    
    req.open('POST', url, true);
    req.setRequestHeader("Content-type", "application/json; ");
    req.send(JSON.stringify(data));
}




/*
 *
 * ALL ANARTISEIS TEMPLATE CREATION
 */

function show_template(data) {
    
    var template = '';
    var buttons_read;
    var buttons_edit;
    var buttons_del;
    var buttons_read_bottom;
    var read_btn;
    var edit_btn;
    var del_btn;
    var read_btn_bottom;
    var a;
    var b;
    var c;
    var d;
    
    for (i = 0; i < data.length; i++) {
        anartisi = new Anartisi(data[i].id,
                                data[i].title,
                                data[i].tmima,
                                data[i].type,
                                data[i].content_init,
                                data[i].content,
                                data[i].url,
                                data[i].sender_email,
                                data[i].mathima_id,
                                data[i].receiver_email,
                                data[i].created);
        
        template += '<div class="article">' +
                   '<div class="tools">' +
                   '<a class="a-tools a"><i class="fas fa-book-reader"></i></a>' +
                   '<a class="a-tools b"><i class="fas fa-edit"></i></a>' +
                   '<a class="a-tools c"><i class="fas fa-trash-alt"></i></a>' +
                   '</div>' +
                   '<p class="clear"></p>' +
                   '<h2><i class="fab fa-spotify"></i>&nbsp;' + anartisi.title + '</h2>' +
                   '<h3 class="cat">Κατηγορία: ' + fix_type(anartisi.type) + '</h3>' +
                   '<h3 class="dte">Ημερομηνία Ανάρτησης: ' + anartisi.created+ '</h3>' +
                   '<p>' + anartisi.content_init + '</p>' +
                   '<p><a class="more">Περισσότερα</a></p>' +
                   '<p class="clear"></p>' +
                   '</div>';
      
      if (template !== undefined || template != '') {
      container.innerHTML = template;
      } 
    }
    
      buttons_read = document.querySelectorAll("div.tools a.a");
      buttons_edit = document.querySelectorAll("div.tools a.b");
      buttons_del = document.querySelectorAll("div.tools a.c");
      buttons_read_bottom = document.querySelectorAll("div.article p a.more");
      
       for (a = 0; a < buttons_read.length; a++) {
        read_btn = buttons_read[a];
        read_btn.addEventListener('click', show_single_anartisi(data[a]));
       }
        
       for (b = 0; b < buttons_edit.length; b++) {
        edit_btn = buttons_edit[b];
        edit_btn.addEventListener('click', edit_single_anartisi(data[b]));
        }
        
        for (c = 0; c < buttons_del.length; c++) {
        del_btn = buttons_del[c];
        del_btn.addEventListener('click', delete_single_anartisi(data[c]));
        }
        
        for (d = 0; d < buttons_read_bottom.length; d++) {
        read_btn_bottom = buttons_read_bottom[d];
        read_btn_bottom.addEventListener('click', show_single_anartisi(data[d]));
        }
}



/*
 *
 * SINGLE ANARTISI TEMPLATE CREATION
 */

function show_single_anartisi(anartisi){
 
return function(){
 
container.style.display = "none";
container_single.style.display = "block";

var title = document.getElementById("article-title");
var type = document.getElementById("article-type");
var sender = document.getElementById("article-sender");
var today = document.getElementById("article-date");
var content = document.getElementById("article-content");

content.innerHTML = anartisi.content; 

title.innerHTML = anartisi.title;
type.innerHTML = "Κατηγορία: " + fix_type(anartisi.type);
sender.innerHTML = "Αναρτήθηκε από: " + fix_sender(anartisi.sender_email);
today.innerHTML = "Ημερομηνία Ανάρτησης: " + anartisi.created;
content.innerHTML = content.innerText;

};
}


/*
 *
 * SINGLE ANARTISI UPDATE TEMPLATE CREATION
 */

function edit_single_anartisi(anartisi){
  
 return function(){ 
  
container.style.display = "none";
container_edit.style.display = "block";

var content_proxeiro = document.getElementById("cont-pro");
var title = document.getElementById("title").value = anartisi.title;
var tmima = document.getElementById("tmima").value = anartisi.tmima;
var content_init = document.getElementById("content-init").value = anartisi.content_init;
var content = document.getElementById("content");
content_proxeiro.innerHTML = anartisi.content;
content_proxeiro.innerHTML = content_proxeiro.innerText;
var sender_email = document.getElementById("sender-email").value = anartisi.sender_email;
var action = document.getElementById("action").value = "au0";
var page = document.getElementById("page").value = "dashboard.php";               

 };
}

/*
 *
 * DELETE ANARTISI
 */

function delete_single_anartisi(anartisi) {
   
   return function(){
    
   var request = {id : anartisi.id,
                  action : "ad0",
                  page : "dashboard.php"};
    
   post_request(url_init, request); 
    
   };
}



/*
 *
 * UPDATE ANARTISI
 */

function update_anartisi() {
 
var title = document.getElementById("title").value;
var tmima = document.getElementById("tmima").value;
var content_init = document.getElementById("content-init").value;
var content = tinyMCE.activeEditor.getContent();
var sender_email = document.getElementById("sender-email").value;
var action = document.getElementById("action").value;
var page = document.getElementById("page").value;

var request = {id : anartisi.id,
               title : title,
               tmima : tmima,
               content_init : content_init,
               content : content,
               sender_email : sender_email,
               action : action,
               page : page};
    
post_request(url_init, request);
}




/*
 *
 * POST REQUEST RESPONSE TEMPLATE
 */

function show_response(data) {

 if (data.status == "0") {
    
    window.location= base_url + page_url + "?message=" + data.message;
 }else if (data.status == "1") {
    
    window.location= base_url + page_url + "?error=" + data.message;
   
 }   
}



/*
 *
 * FUNCTIONS
 */

function close_single_anartisi() {

container_single.style.display = "none";
container.style.display = "block";    
}

function close_edit_anartisi() {

container_edit.style.display = "none";
container.style.display = "block";    
}

function fix_type(value) {
    
    var corrected_value;
    switch (value) {
        case 'Anakoinwsi':
        corrected_value = "Ανακοίνωση";
        break;
        default:
        corrected_value = value;
        break;
    }
    
    return corrected_value;
}

function fix_sender(value) {
    
    var corrected_value;
    switch (value) {
        case 'admin':
        corrected_value = "Διαχειριστής";
        break;
        default:
        crrected_value = value;
        break;
    }
    
    return corrected_value;
}
