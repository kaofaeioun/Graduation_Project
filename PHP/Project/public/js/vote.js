var like_vote,
    dislike_vote;
$.getJSON("js/vote.json", function(data){
  like_vote = data.like_vote;
  dislike_vote = data.dislike_vote;
});

var total_vote,like_R,dislike_R;

function CountLikeVote() {
  return like_R = like_vote / total_vote;
};
function CountDislikeVote() {
  return dislike_R = dislike_vote / total_vote;
};
/* Body插入svg g標籤*/
var svg = d3.select("body .board")
  .append("svg")
  .append("g");
/*設定長寬、圓半徑*/
var width = 200,
    height = 200,
    radius = 100;
/*D3內建layout Pie套件，並輸入資料。*/
var pie = d3.layout.pie()
  .sort(null)
  .value(function(d) {return d.value;});
/*D3內建svg Arc套件，並輸入內外圓半徑*/
var arc = d3.svg.arc()
  .outerRadius(radius * 1)
  .innerRadius(radius * 0.75);

svg.append("g")
  .attr("class", "fans");
svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

var key = function(d){ return d.data.label; };

d3.select("#like").on("click", function(){
    like_vote = like_vote + 1;
    Votes(CountLikeVote());
});
d3.select("#dislike").on("click", function(){
    dislike_vote = dislike_vote + 1;
    Votes(CountDislikeVote());
});

function Votes(data) {
  total_vote = like_vote + dislike_vote;
  var dataset = [
        {label:"Dislike", value:CountDislikeVote(), color:"#ED1B2E"},
        {label:"Like", value:CountLikeVote(), color:"#376FFF"}
      ];
  var fan = svg.select(".fans").selectAll("path.fan")
    .data(pie(dataset));

  fan.enter()
    .insert("path")
    .style("fill", function (d) {return d.data.color;})
    .attr("class", "fan");

  fan.transition().duration(1000)
    .attrTween("d", function(d) {
      this._current = this._current || d;
      var interpolate = d3.interpolate(this._current, d);
      this._current = interpolate(10);
      return function(t) {
        return arc(interpolate(t));
      };
    })

    fan.exit()
    .remove();
}
