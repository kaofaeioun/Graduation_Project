var express = require('express'),
    http = require('http'),
    path = require('path'),

    // require php-express and config
    phpExpress = require('../')({
        binPath: '/usr/bin/php' // php bin path.
    });


// init express
var app = express();
app.set('port', process.env.PORT || 3000);
app.use(express.bodyParser());  // body parser is required!!


// set view engine to php-express
app.set('views', path.join(__dirname, 'views'));
app.engine('php', phpExpress.engine);
app.set('view engine', 'php');
app.use(app.router);
app.use(express.static(path.join(__dirname, 'public')));
app.get('/battle',function(req,res,next){
  res.sendfile('views/battle.html');
});
app.get('/channel',function(req,res,next){
  res.sendfile('views/channel.html');
});
app.get('/setting',function(req,res,next){
  res.sendfile('views/setting.html');
});

// routing all .php file to php-express
app.all(/.+\.php$/, phpExpress.router);


http.createServer(app).listen(app.get('port'), function(){
  console.log('Express server listening on port ' + app.get('port'));
});
