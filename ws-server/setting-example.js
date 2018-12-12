exports.Settings = {
    redis: {
        port: 6379,          // Redis port
        host: '127.0.0.1',   // Redis host
        family: 4,           // 4 (IPv4) or 6 (IPv6)
        password: 'pinper',
        db: 0
    },
    auth: {
        url: 'http://localhost:8000/chat/check-auth'
    },
    socket: {
        origins: 'localhost:*'
    }
};
