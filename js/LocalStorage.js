function loadShortCuts(){
if (typeof(Storage)!== "undefined") {
	if(localStorage.getItem("setUp") == "true"){
		buildShortcuts();
	}else{
		establishLocalStore();
		buildShortcuts();
	}
	
} else {
   noStoreAvail();
   document.getElementById("settings").style.display = "none";
}
}

function noStoreAvail(){
	//build shortcuts
	addShortcut("Youtube","https://www.youtube.com");
	addShortcut("Gitlab","https://gitlab.cas.mcmaster.ca");
	addShortcut("Github","https://github.com");
	addShortcut("Gmail","https://mail.google.com");
	addShortcut("Facebook","https://www.facebook.com");
	addShortcut("Avenue","http://avenue.mcmaster.ca");
	addShortcut("Mosaic","https://epprd.mcmaster.ca/psp/prepprd/?cmd=login");
	addShortcut("OscarPlus","https://www.oscarplusmcmaster.ca/home.htm");
	addShortcut("Weather","https://www.theweathernetwork.com/ca/weather/ontario/hamilton");
	addShortcut("Linkedin","https://www.linkedin.com");
	addShortcut("Mega","https://mega.nz");
	addShortcut("Dropbox","https://www.dropbox.com");
	addShortcut("GoogleDrive","https://drive.google.com/drive/my-drive");
	addShortcut("Bitly","http://bitly.com");
}

function addShortcut(shortName,shortURL){
	var parent = document.getElementById("shortcut");
	var shortcutlink = document.createElement("a");
	shortcutlink.href = shortURL;
	var shortcut = new Image();
   	shortcut.width = "10%";
   	var srcStr = ("./Icons/"+shortName+".png");
   	shortcut.src = srcStr;
   		
   	shortcut.className += "shortcut";
   	shortcutlink.appendChild(shortcut);
   	parent.appendChild(shortcutlink);

}

function establishLocalStore(){
	localStorage.setItem("NumPos","14");
	localStorage.setItem("setUp", "true");

	localStorage.setItem("ShortcutValue1", "true");
	localStorage.setItem("ShortcutName1", "Youtube");
	localStorage.setItem("ShortcutURL1", "https://www.youtube.com");

	localStorage.setItem("ShortcutValue2", "true");
	localStorage.setItem("ShortcutName2", "Gitlab");
	localStorage.setItem("ShortcutURL2", "https://gitlab.cas.mcmaster.ca");

	localStorage.setItem("ShortcutValue3", "true");
	localStorage.setItem("ShortcutName3", "Github");
	localStorage.setItem("ShortcutURL3", "https://github.com");

	localStorage.setItem("ShortcutValue4", "true");
	localStorage.setItem("ShortcutName4", "Gmail");
	localStorage.setItem("ShortcutURL4", "https://mail.google.com");

	localStorage.setItem("ShortcutValue5", "true");
	localStorage.setItem("ShortcutName5", "Facebook");
	localStorage.setItem("ShortcutURL5", "https://www.facebook.com");

	localStorage.setItem("ShortcutValue6", "true");
	localStorage.setItem("ShortcutName6", "Avenue");
	localStorage.setItem("ShortcutURL6", "http://avenue.mcmaster.ca");

	localStorage.setItem("ShortcutValue7", "true");
	localStorage.setItem("ShortcutName7", "Mosaic");
	localStorage.setItem("ShortcutURL7", "https://epprd.mcmaster.ca/psp/prepprd/?cmd=login");

	localStorage.setItem("ShortcutValue8", "true");
	localStorage.setItem("ShortcutName8", "OscarPlus");
	localStorage.setItem("ShortcutURL8", "https://www.oscarplusmcmaster.ca/home.htm");

	localStorage.setItem("ShortcutValue9", "true");
	localStorage.setItem("ShortcutName9", "Weather");
	localStorage.setItem("ShortcutURL9", "https://www.theweathernetwork.com/ca/weather/ontario/hamilton");

	localStorage.setItem("ShortcutValue10", "true");
	localStorage.setItem("ShortcutName10", "Linkedin");
	localStorage.setItem("ShortcutURL10", "https://www.linkedin.com");

	localStorage.setItem("ShortcutValue11", "true");
	localStorage.setItem("ShortcutName11", "Mega");
	localStorage.setItem("ShortcutURL11", "https://mega.nz");

	localStorage.setItem("ShortcutValue12", "true");
	localStorage.setItem("ShortcutName12", "Dropbox");
	localStorage.setItem("ShortcutURL12", "https://www.dropbox.com");

	localStorage.setItem("ShortcutValue13", "true");
	localStorage.setItem("ShortcutName13", "GoogleDrive");
	localStorage.setItem("ShortcutURL13", "https://drive.google.com/drive/my-drive");

	localStorage.setItem("ShortcutValue14", "true");
	localStorage.setItem("ShortcutName14", "Bitly");
	localStorage.setItem("ShortcutURL14", "http://bitly.com");
}

function buildShortcuts(){
	var mystore = localStorage;
	var numLinks = parseInt(mystore.getItem("NumPos"),10);

	//build shortcuts
	var parent = document.getElementById("shortcut");
	for (i = 1; i < (numLinks+1); i++){

		console.log("addShortcut(\""+mystore.getItem("ShortcutName"+i)+"\",\""+mystore.getItem("ShortcutURL"+i)+"\"\);");

		if ((mystore.getItem("ShortcutValue"+i) != "true")){
			continue;
		}
		var shortcutlink = document.createElement("a");
		shortcutlink.href = mystore.getItem("ShortcutURL"+i);
		var shortcut = new Image();
   		shortcut.width = "10%";
   		var srcStr = ("./Icons/"+mystore.getItem("ShortcutName"+i)+".png");
   		shortcut.src = srcStr;
   		
   		shortcut.className += "shortcut";
   		shortcutlink.appendChild(shortcut);
   		parent.appendChild(shortcutlink);
	}
}

function buildEdit(){
	var mystore = localStorage;
	var numLinks = parseInt(mystore.getItem("NumPos"),10);
	

	//<input type="checkbox" id="test5" checked="checked" />
    //<label for="test5">Red

	//build shortcuts
	var parent = document.getElementById("shortcutEdit");
	for (i = 1; i < (numLinks+1); i++){
		var breaker = document.createElement("br");
		var shortcutlink = document.createElement("input");
		shortcutlink.setAttribute('type',"checkbox");
		shortcutlink.setAttribute('id',""+i);
		shortcutlink.checked = (mystore.getItem("ShortcutValue"+i) == "true");
		var shortcutLabel = document.createElement("label");
		shortcutLabel.setAttribute('for',""+i);
		shortcutLabel.innerHTML = mystore.getItem("ShortcutName"+i);
		parent.appendChild(shortcutlink);
   		parent.appendChild(shortcutLabel);
   		parent.appendChild(breaker);
	}
}

function saveShortcuts(){
	var mystore = localStorage;
	var numLinks = parseInt(mystore.getItem("NumPos"),10);
	for (i = 1; i < (numLinks+1); i++){
		var tmp =  document.getElementById(""+i);
		mystore.setItem("ShortcutValue"+i,tmp.checked);
	}
	location.reload();
}

  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('#modal1').modal();
  });

  function launchModal(){
  	$('#modal1').modal();
  }


