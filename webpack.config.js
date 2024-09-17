// Set from https://www.npmjs.com/package/@wordpress/scripts
// Add package.json with the @wordpress/scripts dependency.
// Add a root file called webpack.config.js

// Import the original config from the @wordpress/scripts package.
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

// Import the helper to find and generate the entry points in the src directory
const { getWordPressSrcDirectory } = require( '@wordpress/scripts/utils' );

module.exports = {
	...defaultConfig,
	entry: {
		...defaultConfig.entry(),
		'plugin-jetpack': `./${ getWordPressSrcDirectory() }/plugins/jetpack`,
	},
};
