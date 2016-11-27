$(function() {
  window.data = [{name: "Dislike", vote: 0, color:"#ED1B2E"},
                {name: "Like", vote: 0, color:"#376FFF"}];

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

  function draw(data) {
    var bars = d3.select(".container")
      .selectAll(".bar-wrapper")
      .data(data);
    var barEnter = bars
      .enter()
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
      .remove();
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
      channel: "Vote2",
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
