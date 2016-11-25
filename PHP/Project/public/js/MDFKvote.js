$(function() {
  window.data = [{name: "like", vote: 0},
                {name: "dislike", vote: 0}];

  window.pubnub = PUBNUB.init({
      channel: "Vote",
      publish_key: "pub-c-2b2bead5-cf5f-447d-b8a8-cbab838c6336",
      subscribe_key: "sub-c-56e9d448-b316-11e6-b6b9-0619f8945a4f"
  });

  pubnub.subscribe({
    channel: "Vote",
    message: increment
  });

  function sendData(msg) {
    pubnub.publish({
        channel: "Vote",
        message: msg
    });
  }
  var like_vote=0,
      dislike_vote=0;
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
  function draw(data) {
    var bars = d3.select(".container")
      .selectAll(".bar-wrapper")
      .data(data);

    var fan = svg.select(".fans").selectAll("path.fan")
      .data(pie(data));

    fan.enter()
      .insert("path")
      .style("fill", function (d) {return d.data.color;})
      .attr("class", "fan");


    var barEnter = bars.enter()
      .append("div")
      .attr("class", "bar-wrapper")
    barEnter.append("button")
      .text(function(d) { return "Vote "+ d.name; })
      .attr("class", "vote-btn btn-default btn-primary")
      .on("click", function(d) {
        sendData(d.name);
      });
    barEnter.append("div")
      .attr("class", "bar")
      .style("width", function (d) {
        return (d.vote*10)+15 + "px";
      })
      .text(function(d) { return d.vote });
    bars.selectAll("div")
      .text(function(d) { return d.vote })
      .style("width", function (d) {
        return (d.vote*10)+15 + "px";
      });
    bars.exit()
      .remove()
  };

  function increment(msg) {
    for (var i=0; i<window.data.length; i++) {
      var el = window.data[i];
      if (el.name == msg) {
        el.vote += 1;
      }
    }
    draw(data);
  }

  function init_votes() {
    pubnub.history({
      channel: 'Vote',
      start: 0,
      callback: function(msg) {
        var vote_history = msg[0];
        for (var i=0; i<vote_history.length; i++) {
          increment(vote_history[i]);
        }
      }
    });
  }

  init_votes();
  draw(data);
});
function setZero() {
  window.data = [{name: "like", vote: 0},
                {name: "dislike", vote: 0}];
}
