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
var close_c = document.getElementById("close-c");
var close_d = document.getElementById("close-d");
var update_btn = document.getElementById("update");
var print_btn = document.getElementById("print-tmima");
var promote_btn = document.getElementById("promote-tmima");
var mathites_table = document.getElementById("mathites-all");
var epilogi = document.getElementById('tmima');
var choice;

var page_url = document.getElementById("page").value;
var messages_area = document.getElementById("messages-area");

var message_response = messages_area.innerText; 

if (message_response.length > 0) {
    setTimeout(function(){
        messages_area.style.display="none";
        window.location = page_url;
    }, 1500);
}

mathites_table.style.display = "none";


/*
 *
 * FETCH INITIAL DATA
 */

epilogi.addEventListener('change', fetch_initial_data);

function fetch_initial_data() {
    
choice = epilogi.value;
get_request(url_init, "admin-data-mathites", choice);
}



/*
 *
 *EVENT LISTENERS
 */

update_btn.addEventListener('click', update_mathitis);
promote_btn.addEventListener('click', promote_mathites);
close_a.addEventListener('click', close_print_mathites);
close_b.addEventListener('click', close_print_mathites);
close_c.addEventListener('click', close_edit_mathitis);
close_d.addEventListener('click', close_edit_mathitis);


/*
 *
 * OBJECT CONSTRUCTOR
 */

function Mathitis(id, student_email, firstname, lastname, fathername,
                  mothername, phone, tmima, created ) {
    
    this.id = id;
    this.student_email = student_email;
    this.firstname = firstname;
    this.lastname = lastname;
    this.fathername = fathername;
    this.mothername = mothername;
    this.phone = phone;
    this.tmima = tmima;
    this.created = created;
}




/*
 *
 * AJAX GET REQUEST
 */

function get_request(url, action, choice) {
    
    var req = new XMLHttpRequest();
    page = document.getElementById("page");
    page = page.value;
    url += "?data-action=" + action + "&page=" + page + "&tmima=" + choice;
    
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
 * ALL MATHITES TEMPLATE CREATION
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
        mathitis = new Mathitis(data[i].id,
                                data[i].student_email,
                                data[i].firstname,
                                data[i].lastname,
                                data[i].fathername,
                                data[i].mothername,
                                data[i].phone,
                                data[i].tmima,
                                data[i].created);
        
        template += '<div class="article">' +
                   '<div class="tools">' +
                   '<a class="a-tools b"><i class="fas fa-edit"></i></a>' +
                   '<a class="a-tools c"><i class="fas fa-trash-alt"></i></a>' +
                   '</div>' +
                   '<p class="clear"></p>' +
                   '<h2>' + mathitis.lastname + " " + mathitis.firstname+ '</h2>' +
                   '<p class="math-label-b">Τμήμα: <span class="math-timi">' + fix_tmima(mathitis.tmima) + '</span></p>' +
                   '<p class="math-label">Πατρώνυμο: <span class="math-timi">' + mathitis.fathername + '</span></p>' +
                   '<p class="math-label-b">Μητρώνυμο: <span class="math-timi">' + mathitis.mothername + '</span></p>' +
                   '<p class="math-label">Τηλέφωνο: <span class="math-timi">' + mathitis.phone + '</span></p>' +
                   '<p class="math-label-b">Email: <span class="math-timi">' + mathitis.student_email + '</span></p>' +
                   '</div>';
      
      if (template !== undefined || template != '') {
      container.innerHTML = template;
      print_btn.disabled = false;
      promote_btn.disabled = false;
      } 
    }
      
      print_btn.addEventListener('click', show_print_version(data));
      buttons_edit = document.querySelectorAll("div.tools a.b");
      buttons_del = document.querySelectorAll("div.tools a.c");
        
       for (b = 0; b < buttons_edit.length; b++) {
        edit_btn = buttons_edit[b];
        edit_btn.addEventListener('click', edit_single_mathitis(data[b]));
        }
        
        for (c = 0; c < buttons_del.length; c++) {
        del_btn = buttons_del[c];
        del_btn.addEventListener('click', delete_single_mathitis(data[c]));
        }
        
}




/*
 *
 * EKTUPWSI MATHITWN TEMPLATE CREATION
 */


function show_print_version(data) {

var i;
var row;
return function(){
container.style.display = "none";
container_single.style.display = "block";
mathites_table.style.display = "block";
mathites_table.innerHTML = '<tr class="warning">' +
                           '<td>Επώνυμο</td>' +
                           '<td>Όνομα</td>' +
                           '<td>Πατρώνυμο</td>' +
                           '<td>Μητρώνυμο</td>' +
                           '<td>Τηλέφωνο</td>' +
                           '</tr>';


for (i = 0; i < data.length; i++) {

row = document.createElement("tr");
row.innerHTML = "<td>" + data[i].lastname + "</td>" +
                "<td>" + data[i].firstname + "</td>" +
                "<td>" + data[i].fathername + "</td>" +
                "<td>" + data[i].mothername + "</td>" +
                "<td>" + data[i].phone + "</td>";
mathites_table.appendChild(row);
}
};
}


/*
 *
 * SINGLE MATHITIS UPDATE TEMPLATE CREATION
 */

function edit_single_mathitis(mathitis){
  
return function(){

container.style.display = "none";
container_edit.style.display = "block";

var lastname = document.getElementById("lastname").value = mathitis.lastname;
var firstname = document.getElementById("firstname").value = mathitis.firstname;
var fathername = document.getElementById("fathername").value = mathitis.fathername;
var mothername = document.getElementById("mothername").value = mathitis.mothername;
var phone = document.getElementById("phone").value = mathitis.phone;
var tmima = document.getElementById("tmima-b").value = mathitis.tmima;
var student_email = document.getElementById("student-email").value = mathitis.student_email;
var action = document.getElementById("action").value = "au2";
var page = document.getElementById("page").value = "view-mathites.php"; 

 };
}



/*
 *
 * DELETE MATHITIS
 */

function delete_single_mathitis(mathitis) {
   
   return function(){
    
   var request = {id : mathitis.id,
                  action : "ad2",
                  page : "view-mathites.php"};
    
   post_request(url_init, request); 
    
   };
}



/*
 *
 * UPDATE MATHITIS
 */

function update_mathitis() {
 
var lastname = document.getElementById("lastname").value;
var firstname = document.getElementById("firstname").value;
var fathername = document.getElementById("fathername").value;
var mothername = document.getElementById("mothername").value;
var phone = document.getElementById("phone").value;
var tmima = document.getElementById("tmima-b").value;
var student_email = document.getElementById("student-email").value;
var action = document.getElementById("action").value;
var page = document.getElementById("page").value;

var request = {id : mathitis.id,
               student_email : student_email,
               firstname : firstname,
               lastname : lastname,
               fathername : fathername,
               mothername : mothername,
               phone : phone,
               tmima : tmima,
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

function close_print_mathites() {

container_single.style.display = "none";
container.style.display = "block";    
}

function close_edit_mathitis() {

container_edit.style.display = "none";
container.style.display = "block";    
}


function promote_mathites() {
    
  var prompt = confirm("Η Ενέργεια αυτή θα προάγει τους μαθητές του Τμήματος στην επόμενη Τάξη. Είστε" +
                       "σίγουροι ότι θέλετε να συνεχίστετε?");
  if (prompt == true) {
    var request = {tmima : choice, 
                   action : "apr2",
                   page : "view-mathites.php"};
    
   post_request(url_init, request);
  } else {
    
  }
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


