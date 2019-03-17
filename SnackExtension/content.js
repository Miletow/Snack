
if (window == top) {
  doKeyPress();
 //window.addEventListener('keyup', doKeyPress, false);
}
 
function doKeyPress(e){

  //alert("Contentscript is sending a message to background script:");
  chrome.extension.sendRequest({message: ""});
 
}

var url;
var arr;
chrome.runtime.onMessage.addListener(
 function(request, sender) {
  //alert("Contentscript has received a message from background script: '" + request.message + "'");
  message = request.message;
   arr = message.split(",");

  Tibiaisniceletmeplay();
  });

function Tibiaisniceletmeplay(){
var TheTitle = arr[0];
var TheUrl = arr[1];

//setTimeout(function (){
// find the fiends in your login form
var TitleField = document.getElementById('Title');
var UrlField = document.getElementById('Url');

// fill in your username and password
TitleField.value = TheTitle;
UrlField.value = TheUrl;

var changeEvent = document.createEvent("HTMLEvents");
changeEvent.initEvent("change", true, true);
document.getElementsByName("name1")[0].dispatchEvent(changeEvent);

var changeEvent2 = document.createEvent("HTMLEvents");
changeEvent2.initEvent("change", true, true);
document.getElementsByName("name2")[0].dispatchEvent(changeEvent2);
//$("#myInput").change();
//}, 1000); 
/*
 setTimeout(function (){

var loginForm = document.getElementById('UrlForm');
loginForm.submit();

  // Something you want delayed.

}, 1000); 
*/
}