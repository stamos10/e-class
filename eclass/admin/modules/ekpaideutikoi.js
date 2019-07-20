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
var close_a = document.getElementById("close-a");
var close_b = document.getElementById("close-b");
var update_btn = document.getElementById("update");

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

get_request(url_init, "admin-data-ekpaideutikoi");




/*
 *
 *EVENT LISTENERS
 */

update_btn.addEventListener('click', update_ekpaideutikos);
close_a.addEventListener('click', close_edit_ekpaideutikos);
close_b.addEventListener('click', close_edit_ekpaideutikos);


/*
 *
 * OBJECT CONSTRUCTOR
 */

function Ekpaideutikos(id, email, lastname, firstname, eidikotita, created ) {
    
    this.id = id;
    this.email = email;
    this.firstname = firstname;
    this.lastname = lastname;
    this.eidikotita = eidikotita;
    this.created = created;
}




/*
 *
 * AJAX GET REQUEST
 */

function get_request(url, action) {
    
    var req = new XMLHttpRequest();
    page = document.getElementById("page");
    page = page.value;
    url += "?data-action=" + action + "&page=" + page;
    
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
 * ALL EKPAIDEUTIKOI TEMPLATE CREATION
 */

function show_template(data) {
    
    var template = '';
    var buttons_edit;
    var buttons_del;
    var edit_btn;
    var del_btn;
    var b;
    var c;
    
    container.innerHTML = "";
    
    for (i = 0; i < data.length; i++) {
        ekpaideutikos = new Ekpaideutikos(data[i].id,
                                data[i].email,
                                data[i].firstname,
                                data[i].lastname,
                                data[i].eidikotita,
                                data[i].created);
        
        template += '<div class="article">' +
                   '<div class="tools">' +
                   '<a class="a-tools b"><i class="fas fa-edit"></i></a>' +
                   '<a class="a-tools c"><i class="fas fa-trash-alt"></i></a>' +
                   '</div>' +
                   '<p class="clear"></p>' +
                   '<h2>' + ekpaideutikos.lastname + " " + ekpaideutikos.firstname+ '</h2>' +
                   '<p class="math-label-b">Email: <span class="math-timi">' + ekpaideutikos.email + '</span></p>' +
                   '<p class="math-label">Ειδικότητα: <span class="math-timi">' + ekpaideutikos.eidikotita + '</span></p>' +
                   '<p class="math-label-b">Ημερομηνία Δημιουργίας: <span class="math-timi">' + ekpaideutikos.created + '</span></p>' +
                   '</div>';
      
      if (template !== undefined || template != '') {
      container.innerHTML = template;
      } 
    }
      
      buttons_edit = document.querySelectorAll("div.tools a.b");
      buttons_del = document.querySelectorAll("div.tools a.c");
        
       for (b = 0; b < buttons_edit.length; b++) {
        edit_btn = buttons_edit[b];
        edit_btn.addEventListener('click', edit_single_ekpaideutikos(data[b]));
        }
        
        for (c = 0; c < buttons_del.length; c++) {
        del_btn = buttons_del[c];
        del_btn.addEventListener('click', delete_single_ekpaideutikos(data[c]));
        }
        
}



/*
 *
 * SINGLE EKPAIDEUTIKOS UPDATE TEMPLATE CREATION
 */

function edit_single_ekpaideutikos(ekpaideutikos){
  
return function(){

container.style.display = "none";
container_edit.style.display = "block";

var lastname = document.getElementById("lastname").value = ekpaideutikos.lastname;
var firstname = document.getElementById("firstname").value = ekpaideutikos.firstname;
var email = document.getElementById("email").value = ekpaideutikos.email;
var eidikotita = document.getElementById("eidikotita").value = ekpaideutikos.eidikotita;
var id = document.getElementById("ekpaideutikos-id").value = ekpaideutikos.id;
var action = document.getElementById("action").value = "au3";
var page = document.getElementById("page").value = "view-ekpaideutikoi.php";

 };
}



/*
 *
 * DELETE EKPAIDEUTIKOS
 */

function delete_single_ekpaideutikos(ekpaideutikos) {
   
   return function(){
    
   var request = {email : ekpaideutikos.email,
                  action : "ad3",
                  page : "view-ekpaideutikoi.php"};
    
   post_request(url_init, request); 
    
   };
}



/*
 *
 * UPDATE EKPAIDEUTIKOS
 */

function update_ekpaideutikos() {

var lastname = document.getElementById("lastname").value;
var firstname = document.getElementById("firstname").value;
var email = document.getElementById("email").value;
var eidikotita = document.getElementById("eidikotita").value;
var id = document.getElementById("ekpaideutikos-id").value; 
var action = document.getElementById("action").value;
var page = document.getElementById("page").value; 

var request = {id : ekpaideutikos.id,
               email : email,
               firstname : firstname,
               lastname : lastname,
               eidikotita : eidikotita,
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

function close_edit_ekpaideutikos() {

container_edit.style.display = "none";
container.style.display = "block";    
}

