const path = require('path');

module.exports = {
	mode: 'development',
	entry: {
		'./js/app': ['./resource/js/index.tsx'],
	},
	output: {
		path: path.resolve(__dirname, 'public/'),
		publicPath: '/',
	},
	module: {
		rules: [
			{
				test: /\.tsx?$/,
				use: 'ts-loader',
			},
		],
	},
	resolve: {
		extensions: [".ts", ".tsx", ".js", ".json"]
	},
	target: ["web", "es5"],
	plugins: [],
};