//自動padding置中 
function PicAutoMid() {
	var img_width = document.getElementById("userimg").width;
	var img_height = document.getElementById("userimg").height;

	if (img_width > img_height){
		var img_padding = (200-img_height)/2;
		$(document).ready(function(){
			$('.profile_pic').css("padding-top",img_padding);
			$('.profile_pic').css("padding-bottom",img_padding);
		});
	}	
	else if (img_width < img_height){
		var img_padding = (200-img_width)/2;
		$(document).ready(function(){
			$('.profile_pic').css("padding-left",img_padding);
			$('.profile_pic').css("padding-right",img_padding);
		});
	}
}
// END

//清除padding 
function ErasePadding(){
	$(document).ready(function(){
		$('.profile_pic').css("padding","0px");
	});
}
// END 