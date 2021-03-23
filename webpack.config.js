const path = require('path');

module.exports = {
	entry: {
		'./js/app': ['./resource/js/app.js'],
	},
	output: {
		path: path.resolve(__dirname, 'public/'),
		publicPath: '/',
	},
	module: {
		rules: [
			{
				test: /\.(js|jsx)$/,
				use: ['babel-loader'],
				exclude: /node_modules/,
			},
		],
	},
	plugins: [],
};