<!DOCTYPE html>
<html lang="en">
<head>
	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
	<link rel="stylesheet" href="CSS/battle_channel_1.css">
	<link rel="stylesheet" href="CSS/all.css">

</head>
<body>
		<div class="circle_area">
			<div class="circle_1" id="circle"></div>
			<div class="circle_2" id="CountDown"></div>
			<script src="http://d3js.org/d3.v3.min.js"></script>
			<script type="text/javascript" src="./js/ArMen.js"></script>
		</div>
		<script>
						$(document).ready(function(){
							$("#Like").click(function(){
								$("#Like").fadeOut();
								$("#Dislike").fadeOut();
							});
							$("#Dislike").click(function(){
								$("#Like").fadeOut();
								$("#Dislike").fadeOut();
							});
						});
		</script>
		<script type="text/javascript">
		$(function() {
			function datareset(msg){
				for (var i = 0; i<window.data.length; i++){
					var el = window.data[i];
					if (el.name == msg && el.vote !== 0){
						el.vote--;
					}
				}
			}
			function resetvotes(){
				pubnub.history({
					channel:"Vote2",
					start:0,
					callback: function(msg) {
						var vote_history = msg[0];
						for (var i = 0; i < vote_history.length; i++) {
							datareset(vote_history[i]);
						}
					}
				});
			}
			resetvotes();
		});
		</script>
</body>
</html>
