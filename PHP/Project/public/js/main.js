var settingsModalOpen = false;
var clientMsgsForTimeout = [];

if(typeof(localStorage) !== "undefined") {
	var clientString = localStorage.getItem("client");
	if(typeof(clientString)==="string") {
		var newClientObject = JSON.parse(clientString);
		for(var i in newClientObject) {
			client[i] = newClientObject[i];
		}
	}
}

if(typeof(Object.observe)!=="undefined") {
	Object.observe(client, function(changes) {
		wsSendStrings(["client", changes[0].name, client[changes[0].name]]);
		localStorage.setItem("client",JSON.stringify(client));
		console.log(changes);
	});
} else if(typeof(client.watch)!=="undefined") { //Firefox (NO Observe)
	client.watch("userid", function(id, oldval, newval) {
		observeInfo(id, newval);
	});
	client.watch("pp", function(id, oldval, newval) {
		observeInfo(id, newval);
	});

	client.watch("nn", function(id, oldval, newval) {
		observeInfo(id, newval);
	});

	client.watch("mg", function(id, oldval, newval) {
		observeInfo(id, newval);
	});

	function observeInfo(name, newValue) {
		wsSendStrings(["client", name, newValue]);
		localStorage.setItem("client",JSON.stringify(client));
		console.log(name,newValue);
	}
}

function writeToChat(clientID,clientName,text) {
	clientID= clientID.replace(/<\/?[^>]+(>|$)/g, "");
	clientName = clientName.replace(/<\/?[^>]+(>|$)/g, "");
	text = text.replace(/<\/?[^>]+(>|$)/g, "");
	text = text.linkify();
	$("#chatContent").append('<div><a href=\'fans.php?name='+clientID+'\'><b>'+clientID+'</a>('+clientName+'): </b>'+text+'</div>');
	var objDiv = document.getElementById("chatContent");

	objDiv.scrollTop = objDiv.scrollHeight;
}
function sendToVote(clientID, getVote) {
	clientID= clientID.replace(/<\/?[^>]+(>|$)/g, "");
}

$(document).ready(function() {
	$.material.init();

	/*---------------------------------------------------
		--- Settings UI Functions ---
	---------------------------------------------------*/

	$(".onlyIfMicInputIsOn").hide();

	function chatSend(text) {
		text = $.trim(text);
		if(text!=="") {
			wsSendStrings(["chat",text]);
			writeToChat(client.userid,client.nn,text);
			$("#chatInput").val("");
		}
	}

	function voteSend(text) {
		text = $.trim(text);
		if(text!==""){
			wsSendStrings(["vote" ,text]);
			sendToVote(client.userid,getVote);
		}
	}

	$( "#chatInput" ).keyup(function( event ) {
		if ( event.which == 13 ) {
		    event.preventDefault();
		    chatSend($("#chatInput").val());
		}
	});
	for(var i=0;i<commonBitRates.length;i++) {
		if(commonBitRates[i] <= 16) {
			var s = "";
			if(commonBitRates[i] == myBitRate)
				s='selected="selected"';
			$("#bitrateSelect").append('<option '+s+' value="'+commonBitRates[i]+'">'+commonBitRates[i]+'</option>');
		}
	}
	$("#bitrateSelect").change(function() {
		myBitRate = parseInt($( "#bitrateSelect option:selected" ).val());
	});

	for(var i=0;i<commonSampleRates.length;i++) {
		if(commonSampleRates[i] < 20000) {
			var s = "";
			if(commonSampleRates[i] == mySampleRate)
				s='selected="selected"';
			$("#sampleRateSelect").append('<option '+s+' value="'+commonSampleRates[i]+'">'+commonSampleRates[i]+'kHz</option>');
		}
	}
	$("#sampleRateSelect").change(function() {
		mySampleRate = parseInt($( "#sampleRateSelect option:selected" ).val());
	});

	$('#settingsModal').on('hidden.bs.modal', function (e) {
	  	settingsModalOpen = false;
	})

	$('#settingsModal').on('shown.bs.modal', function (e) {
	  	settingsModalOpen = true;
	  	$("#minGainSlider").val(  Math.pow(client.mg, 1/4)*100 );
	})

});

if(!String.linkify) {
    String.prototype.linkify = function() {

        // http://, https://, ftp://
        var urlPattern = /\b(?:https?|ftp):\/\/[a-z0-9-+&@#\/%?=~_|!:,.;]*[a-z0-9-+&@#\/%=~_|]/gim;

        // www. sans http:// or https://
        var pseudoUrlPattern = /(^|[^\/])(www\.[\S]+(\b|$))/gim;

        // Email addresses
        var emailAddressPattern = /[\w.]+@[a-zA-Z_-]+?(?:\.[a-zA-Z]{2,6})+/gim;

        return this
            .replace(urlPattern, '<a target="#" href="$&">$&</a>')
            .replace(pseudoUrlPattern, '$1<a target="#" href="http://$2">$2</a>')
            .replace(emailAddressPattern, '<a target="#" href="mailto:$&">$&</a>');
    };
}
