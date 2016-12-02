  window.data = [{
      name: "Dislike",
      vote: 0,
      color: "#ED1B2E"
  }, {
      name: "Like",
      vote: 0,
      color: "#376FFF"
  }];

  window.pubnub = PUBNUB.init({
      channel: "Vote2",
      publish_key: "pub-c-019c8058-40e6-4ac2-ac9a-5fc148e8a9f4",
      subscribe_key: "sub-c-01292b8e-b4a7-11e6-936d-02ee2ddab7fe"
  });

  pubnub.subscribe({
      channel: "Vote2",
      message: increment
  });

  function sendData(msg) {
      pubnub.publish({
          channel: "Vote2",
          message: msg
      });
  }

  /* Body插入svg g標籤*/
  var svg = d3.select("body .circle_area")
      .append("svg")
      .attr("id", "circleSvg")
      .append("g");
  /*設定長寬、圓半徑*/
  var width = 200,
      height = 200,
      radius = 100;
  /*D3內建layout Pie套件，並輸入資料。*/
  var pie = d3.layout.pie()
      .sort(null)
      .value(function(d) {
          return d.vote;
      });
  /*D3內建svg Arc套件，並輸入內外圓半徑*/
  var arc = d3.svg.arc()
      .outerRadius(radius * 1)
      .innerRadius(radius * 0.75);
  svg.append("g")
      .attr("class", "fans");
  svg.attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

  var key = function(d) {
      return d.name;
  };

  function draw(data) {
      var bars = d3.select(".circle_area")
          .selectAll(".bar-wrapper")
          .data(data);
      var barEnter = bars
          .enter()
          .append("div")
          .attr("class", "bar-wrapper")
      barEnter.append("div")
          .attr("id", function(d) {
              return d.name;
          })
          .attr("class", "")
          .on("click", function(d) {
              sendData(d.name);
              console.log(d.name + "SendVote");
          });
      bars.exit()
          .remove();
      var fan = svg.select(".fans").selectAll("path.fan")
          .data(pie(data));
      var fanEnter = fan.enter()
          .insert("path")
          .style("fill", function(d) {
              return d.data.color;
          })
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
  };

  function datareset(msg) {
      for (var i = 0; i < window.data.length; i++) {
          var el = window.data[i];
          if (el.vote !== 0 && el.name === msg) {
              el.vote -= 1;
              console.log(el.name + ":" + el.vote);
          }
      }
  }

  function resetvotes() {
      pubnub.history({
          channel: "Vote2",
          start: 0,
          callback: function(msg) {
              var vote_history = msg[0];
              for (var i = 0; i < vote_history.length; i++) {
                  datareset(vote_history[i]);
              }
          }
      });
  }
  draw(data);
  //resetvotes();

  function increment(msg) {
      for (var i = 0; i < window.data.length; i++) {
          var el = window.data[i];
          if (el.name == msg) {
              el.vote += 1;
          }
      }
      draw(data);
  }

  function init_votes() {
      pubnub.history({
          channel: "Vote2",
          start: 0,
          callback: function(msg) {
              var vote_history = msg[0];
              for (var i = 0; i < vote_history.length; i++) {
                  increment(vote_history[i]);
              }
          }
      });
  }
