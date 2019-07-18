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
var close_a = document.getElementById("close-a");
var close_b = document.getElementById("close-b");
var close_c = document.getElementById("close-c");
var close_d = document.getElementById("close-d");
var update_btn = document.getElementById("update");
var table_single = document.getElementById("mathites");
var table_edit = document.getElementById("mathites-edit");

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

get_request(url_init, "admin-data-mathimata");



/*
 *
 *EVENT LISTENERS
 */

update_btn.addEventListener('click', update_mathima);
close_a.addEventListener('click', close_single_mathima);
close_b.addEventListener('click', close_single_mathima);
close_c.addEventListener('click', close_edit_mathima);
close_d.addEventListener('click', close_edit_mathima);


/*
 *
 * OBJECT CONSTRUCTOR
 */

function Mathima(id, title, tmima, taksi, teacher_email, teacher_firstname, teacher_lastname, student_firstname,
                 student_lastname, student_fathername, student_email, created ) {
    
    this.id = id;
    this.title = title;
    this.tmima = tmima;
    this.taksi = taksi;
    this.teacher_email = teacher_email;
    this.teacher_firstname = teacher_firstname;
    this.teacher_lastname = teacher_lastname;
    this.student_firstname = student_firstname;
    this.student_lastname = student_lastname;
    this.student_fathername = student_fathername;
    this.student_email = student_email;
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
 * ALL MATHIMATA TEMPLATE CREATION
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
        mathima = new Mathima(data[i].id,
                                data[i].title,
                                data[i].tmima,
                                data[i].tmima[0],
                                data[i].teacher_email,
                                data[i].teacher_firstname,
                                data[i].teacher_lastname,
                                data[i].student_firstname,
                                data[i].student_lastname,
                                data[i].student_fathername,
                                data[i].student_email,
                                data[i].created);
        
        template += '<div class="menu-option">' +
                    '<div class="math-tools">' +
                    '<a class="a-tools a"><i class="fas fa-book-reader"></i></a>' +
                    '<a class="a-tools b"><i class="fas fa-edit"></i></a>' +
                    '<a class="a-tools c"><i class="fas fa-trash-alt"></i></a>' +
                    '</div>' +
                    '<p class="clear"></p>' +
                    '<h2>' + mathima.title + '</h2>' +
                    '<p class="math-label">Τάξη: <span class="math-timi">' + fix_taksi(mathima.taksi) + '</span></p>' +
                    '<p class="math-label-b">Τμήμα: <span class="math-timi">' + fix_tmima(mathima.tmima) + '</span></p>' +
                    '<p class="math-label">Καθηγητής/τρια: <span class="math-timi">' + mathima.teacher_firstname + " " + mathima.teacher_lastname +'</span></p>' +
                    '<p class="math-label-b">Μαθητές:' +
                    '<a class="more">Προβολή' +
                    '</a>' +
                    '</p>' +
                    '</div>';
      
      if (template !== undefined || template != '') {
      container.innerHTML = template;
      } 
    }
    
      buttons_read = document.querySelectorAll("div.math-tools a.a");
      buttons_edit = document.querySelectorAll("div.math-tools a.b");
      buttons_del = document.querySelectorAll("div.math-tools a.c");
      buttons_read_bottom = document.querySelectorAll("div.menu-option p a.more");
      
       for (a = 0; a < buttons_read.length; a++) {
        read_btn = buttons_read[a];
        read_btn.addEventListener('click', show_single_mathima(data[a], data));
       }
        
       for (b = 0; b < buttons_edit.length; b++) {
        edit_btn = buttons_edit[b];
        edit_btn.addEventListener('click', edit_single_mathima(data[b]));
        }
        
        for (c = 0; c < buttons_del.length; c++) {
        del_btn = buttons_del[c];
        del_btn.addEventListener('click', delete_single_mathima(data[c]));
        }
        
        for (d = 0; d < buttons_read_bottom.length; d++) {
        read_btn_bottom = buttons_read_bottom[d];
        read_btn_bottom.addEventListener('click', show_single_mathima(data[d], data));
        }
}



/*
 *
 * SINGLE MATHIMA TEMPLATE CREATION
 */

function show_single_mathima(mathima, data){

return function(){
var i;
var row;
container.style.display = "none";
container_single.style.display = "block";

var mathima_title = document.getElementById("mathima-title");
var mathima_taksi = document.getElementById("mathima-taksi");
var mathima_tmima = document.getElementById("mathima-tmima");
var mathima_teacher = document.getElementById("teacher-fullname"); 

mathima_title.innerHTML = mathima.title;
mathima_taksi.innerHTML = "Τάξη: " + fix_taksi(mathima.tmima[0]);
mathima_tmima.innerHTML = "Τμήμα: " + fix_tmima(mathima.tmima);
mathima_teacher.innerHTML = "Καθηγητής: " + mathima.teacher_firstname + " " + mathima.teacher_lastname;

table_single.style.display = "block";
table_single.innerHTML = '<tr class="warning">' +
                           '<td>Επώνυμο</td>' +
                           '<td>Όνομα</td>' +
                           '<td>Πατρώνυμο</td>' +
                           '</tr>';


for (i = 0; i < data.length; i++) {

row = document.createElement("tr");
row.innerHTML = "<td>" + data[i].lastname + "</td>" +
                "<td>" + data[i].firstname + "</td>" +
                "<td>" + data[i].fathername + "</td>";
            
table_single.appendChild(row);
}
};
}



/*
 *
 * SINGLE MATHIMA UPDATE TEMPLATE CREATION
 */

function edit_single_mathima(mathima){
  
return function(){

container.style.display = "none";
container_edit.style.display = "block"; 
    
 };
}



/*
 *
 * DELETE MATHIMA
 */

function delete_single_mathima(mathima) {
   
   return function(){
    
   var request = {id : mathima.id,
                  action : "ad1",
                  page : "view-mathimata.php"};
    
   post_request(url_init, request); 
    
   };
}



/*
 *
 * UPDATE MATHIMA
 */

function update_mathima() {
 
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

function close_single_mathima() {

container_single.style.display = "none";
container.style.display = "block";    
}

function close_edit_mathima() {

container_edit.style.display = "none";
container.style.display = "block";    
}

function fix_tmima(value) {
    
    var tmima = value;
    switch (tmima) {
        case 'A1':
            tmima = 'Α1';
            break;
            case 'A2':
            tmima = 'Α2';
            break;
            case 'A3':
            tmima = 'Α3';
            break;
            case 'A4':
            tmima = 'Α4';
            break;
            case 'B1':
            tmima = 'Β1';
            break;
            case 'B2':
            tmima = 'Β2';
            break;
            case 'B3':
            tmima = 'Β3';
            break;
            case 'B4':
            tmima = 'Β4';
            break;
            case 'C1':
            tmima = 'Γ1';
            break;
            case 'C2':
            tmima = 'Γ2';
            break;
            case 'C3':
            tmima = 'Γ3';
            break;
            case 'C4':
            tmima = 'Γ4';
            break;
            default:
            break;
    }
    
    return tmima;
}


function fix_taksi(value) {
    
    var tmima = value;
    switch (tmima) {
        case 'A':
            tmima = 'Α';
            break;
            case 'B':
            tmima = 'Β';
            break;
            case 'C':
            tmima = 'Γ';
            break;
            default:
            break;
    }
    
    return tmima;
}






