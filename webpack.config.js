const path = require('path');

module.exports = {
	entry: {
		'./js/app': ['./resource/js/index.js'],
	},
	output: {
		path: path.resolve(__dirname, 'public/'),
		publicPath: '/',
	},
	module: {
		rules: [
			{
				test: /\.(js|jsx)$/,
				exclude: /node_modules/,
				loader: 'babel-loader',
				options: {
					presets: ['@babel/preset-env', '@babel/preset-react'],
					plugins: ['@babel/plugin-transform-runtime'],
				},
			},
		],
	},
	plugins: [],
};