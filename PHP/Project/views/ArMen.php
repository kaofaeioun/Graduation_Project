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
			function sendData(msg) {
			  pubnub.publish({
			      channel: "Vote2",
			      message: msg
			  });
			}

			/* Body插入svg g標籤*/
			var svg = d3.select("body .circle_area")
				.append("svg")
				.attr("id","circleSvg")
				.append("g");
			/*設定長寬、圓半徑*/
			var width = 200,
					height = 200,
					radius = 100;
			/*D3內建layout Pie套件，並輸入資料。*/
			var pie = d3.layout.pie()
				.sort(null)
				.value(function(d) {return d.vote;});
			/*D3內建svg Arc套件，並輸入內外圓半徑*/
			var arc = d3.svg.arc()
				.outerRadius(radius * 1)
				.innerRadius(radius * 0.75);

			svg.append("g")
				.attr("class", "fans");
			svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

			var key = function(d){ return d.name; };
			function draw(data) {
		    var bars = d3.select(".circle_area")
		      .selectAll(".bar-wrapper")
		      .data(data);
		    var barEnter = bars
		      .enter()
		      .append("div")
		      .attr("class", "bar-wrapper")
		    barEnter.append("div")
		      .attr("id", function (d) {return d.name;})
		      .attr("class", "")
		      .on("click", function(d) {
		        sendData(d.name);
		      });
		    bars.exit()
		      .remove();

		    var fan = svg.select(".fans").selectAll("path.fan")
		      .data(pie(data));
		    var fanEnter = fan.enter()
		      .insert("path")
		      .style("fill", function (d) {return d.data.color;})
		      .attr("class", "fan");

		    fan.transition().duration(1000)
		      .attrTween("d", function(d){
		        this._current = this._current || d;
		        var interpolate = d3.interpolate(this._current, d);
		        this._current = interpolate(10);
		        return function(t) {
		          return arc(interpolate(t));
		        };
		      })
		    fan.exit()
		      .remove();
		    };
			function datareset(msg){
				for (var i = 0; i<window.data.length; i++){
					var el = window.data[i];
					if (el.name === msg && el.vote !== 0){
						el.vote--;
						console.log(el.name+":"+el.vote);
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
			draw(data);
		});
		</script>
</body>
</html>
