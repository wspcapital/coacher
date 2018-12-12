var request = require('request'),
    setting = require('./setting'),
    Settings = setting.Settings;
var io = require('socket.io')(6001, {
     //   origins: Settings.socket.origins  //// поменять
    }),

    Redis = require('ioredis'),
    redis = new Redis({
        port: Settings.redis.port,          // Redis port
        host: Settings.redis.host,   // Redis host
        family: Settings.redis.family,           // 4 (IPv4) or 6 (IPv6)
        password: Settings.redis.password,
        db: Settings.redis.db
    });
io.use(function (socket, next) {

    request.get({
        url: Settings.auth.url,
        headers: {cookie: socket.request.headers.cookie},
        json: true
    }, function (error, response, json) {
        console.log(json);
        return json.auth ? next() : next(new Error('Auth error'));
    });
});

redis.psubscribe('*', function (error, count) {
});

redis.on('pmessage', function (pattern, channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data.message);
    console.log(channel, message);
});