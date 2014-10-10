exports.port = 8848;
exports.directoryIndexes = true;
exports.documentRoot = __dirname;

/**
 * 获取当前请求匹配的规则项，按规则定义的先后顺序匹配，先匹配到，先返回。没有匹配到，返回null。
 *
 * @param {Object} request 当前请求
 * @return {?Array}
 */
function getRouter(pathname) {
    var result;

    var rules = require('./router').rules;
    rules.forEach(function (item) {
        if (item.pattern.test(pathname)) {
            result = item;
        }
    });

    return result;
}

exports.getLocations = function () {
    return [
        {
            location: /\/$/,
            handler: home( 'index.html' )
        },
        {
            location: /^\/redirect-local/,
            handler: redirect('redirect-target', false)
        },
        {
            location: /^\/redirect-remote/,
            handler: redirect('http://www.baidu.com', false)
        },
        {
            location: /^\/redirect-target/,
            handler: content('redirectd!')
        },
        {
            location: '/empty',
            handler: empty()
        },
        {
            location: /\.css($|\?)/,
            handler: [
                autocss()
            ]
        },
        {
            location: /\.less($|\?)/,
            handler: [
                file(),
                less()
            ]
        },
        {
            location: /\.styl($|\?)/,
            handler: [
                file(),
                stylus()
            ]
        },
        {
            location: /^.*$/,
            handler: [
                file(),
                proxyNoneExists()
            ]
        }
    ];
};

exports.injectResource = function ( res ) {
    for ( var key in res ) {
        global[ key ] = res[ key ];
    }
};
