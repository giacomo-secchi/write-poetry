/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * All files containing `style` keyword are bundled together. The code used
 * gets applied both to the front of your site and to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './style.scss';
import 'animate.css';

/**
 * Internal dependencies
 */
import Edit from './edit';
import save from './save';
import metadata from './block.json';
import options from './options';
import variations from './variations';
import { animationIcon } from '../../packages/icons';

export const settings = {
	options,
	variations,
};

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType( metadata.name, {
	icon: animationIcon,
	/**
	 * Sets animation.
	 *
	 * @param  props
	 * @param  attributes
	 * @return {{'data-animationName': *}}
	 */
	getEditWrapperProps( attributes ) {
		// const { animationName } = attributes;
		// if ( undefined != animationName ) {
		// 	return { 'data-animationName': animationName };
		// }
	},
	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./save.js
	 */
	save,
} );
