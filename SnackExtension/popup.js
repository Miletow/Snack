'use strict';


var popupWindowConfig = {
  menubar: false,
  location: false,
  resizable: true,
  scrollbars: false,
  status: false
};

String.prototype.replaceAll = function(target, replacement) {
  return this.split(target).join(replacement);
};

var url =  "http://localhost/Snack";
var tabLink;
var tabTitle;
function Swag(){
chrome.tabs.getSelected(null,function(tab) {
 /* var str = tab.url;
  var new_string = str.replaceAll("/", "");
 var new_string = new_string.replace("https", "");
 var new_string = new_string.replaceAll(":", "");
 var final_string = new_string.replace("http", "");*/
    tabLink = tab.url; 
    tabTitle = tab.title;
  buttonClick();
}); 
}

chrome.browserAction.onClicked.addListener(Swag);

 function buttonClick() {


  const features = Object.keys(popupWindowConfig).map(key => `${key}=${popupWindowConfig[key] ? 'yes' : 'no'}`).join(',')
  window.open(url, '_gmailpopup', features)

}

//chrome.browserAction.setBadgeText({text: 'Snack'});


/*    contextMenu    */

var menuItem = {
    "id": "Snack",
    "title": "Snack", 
    "contexts": ["page"]
};
chrome.contextMenus.create(menuItem);
chrome.contextMenus.onClicked.addListener(Swag);


 
chrome.extension.onRequest.addListener(function(request, sender)
{
 //alert("Background script has received a message from contentscript:");

 returnMessage(tabTitle +"," + tabLink);
});



function returnMessage(messageToReturn)
{
 chrome.tabs.getSelected(null, function(tab) {
  var joinedMessage = messageToReturn; 
 // alert("Background script is sending a message to contentscript:'" + joinedMessage +"'");
  chrome.tabs.sendMessage(tab.id, {message: joinedMessage});
 });
}


/*
document.getElementById('clickme').addEventListener('click', Swag);
document.getElementById('clickme2').addEventListener('click', buttonClick);
*/

