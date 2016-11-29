$(document).on("click", "#reset",function() {
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
});
