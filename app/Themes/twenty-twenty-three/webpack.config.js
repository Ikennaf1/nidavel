
const path = require('path');

module.exports = {
    mode: "production",
    entry: [
        './src/js/index.js',
        './src/js/nav.js',
    ],
    output: {
        filename: 'script.js',
        path: path.resolve(__dirname, 'assets/js'),
    },
};
