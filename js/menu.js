//menu constructor
function menu(allitems,thisitem,startstate){ 
  callname= "gl"+thisitem;
  divname="subglobal"+thisitem;  
  this.numberofmenuitems = allitems;
  this.caller = document.getElementById(callname);
  this.thediv = document.getElementById(divname);
  this.thediv.style.visibility = startstate;
}

//menu methods
function ehandler(event,theobj){
  for (var i=1; i<= theobj.numberofmenuitems; i++){
    var shutdiv =eval( "menuitem"+i+".thediv");
    shutdiv.style.visibility="hidden";
  }
  theobj.thediv.style.visibility="visible";
}
				
function closesubnav(event){
  if ((event.clientY <48)||(event.clientY > 107)){
    for (var i=1; i<= numofitems; i++){
      var shutdiv =eval('menuitem'+i+'.thediv');
      shutdiv.style.visibility='hidden';
    }
  }
}

function tick() {
    var hours, minutes, seconds, ap;
    var intHours, intMinutes, intSeconds;
    var today;
	
	today = new Date();
    intHours = today.getHours();
    intMinutes = today.getMinutes();
    intSeconds = today.getSeconds();

   intHours = intHours
   hours = intHours + ":";
   ap = "";

   if (intMinutes < 10) {
      minutes = "0"+intMinutes+":";
   } else {
      minutes = intMinutes+":";
   }

   if (intSeconds < 10) {
      seconds = "0"+intSeconds+" ";
   } else {
      seconds = intSeconds+" ";
   } 

   timeString = "  "+hours+minutes+seconds+ap;

   Clock.innerHTML = timeString;

   window.setTimeout("tick();", 100);
}