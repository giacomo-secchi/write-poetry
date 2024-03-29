/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Internal dependencies
 */
import { ballIcon } from '../../packages/icons';

/** @typedef {import('@wordpress/blocks').WPBlockVariation} WPBlockVariation */

/**
 * The embed provider services.
 *
 * @type {WPBlockVariation[]}
 */
const variations = [
	{
		name: 'backInUp',
		title: 'backInUp',
		icon: ballIcon( {
			className: 'animate__animated animate__backInUp animate__infinite',
		} ),
		keywords: [ 'tweet', __( 'social' ) ],
		description: __( 'backInUp animation.' ),
		innerBlocks: [
			[
				'core/heading',
				{
					level: 3,
					placeholder: 'Heading',
				},
			],
			[
				'core/paragraph',
				{
					placeholder: 'Enter content here...',
				},
			],
		],
		patterns: [ /^https?:\/\/(www\.)?twitter\.com\/.+/i ],
		attributes: {
			animationName: 'backInUp',
			responsive: true,
			clasName: 'animate__animated animate__backInUp',
		},
		isActive: ( blockAttributes, variationAttributes ) =>
			blockAttributes.className === variationAttributes.className,
	},
	{
		name: 'youtube',
		title: 'YouTube',
		icon: ballIcon( {
			className: 'animate__animated animate__shakeX animate__infinite',
		} ),
		keywords: [ __( 'music' ), __( 'video' ) ],
		description: __( 'Embed a YouTube video.' ),
		patterns: [
			/^https?:\/\/((m|www)\.)?youtube\.com\/.+/i,
			/^https?:\/\/youtu\.be\/.+/i,
		],
		attributes: { providerNameSlug: 'youtube', responsive: true },
	},
];

/**
 * Add `isActive` function to all `embed` variations, if not defined.
 * `isActive` function is used to find a variation match from a created
 *  Block by providing its attributes.
 */
variations.forEach( ( variation ) => {
	if ( variation.isActive ) return;
	variation.isActive = ( blockAttributes, variationAttributes ) =>
		blockAttributes.providerNameSlug ===
		variationAttributes.providerNameSlug;
} );

export default variations;
