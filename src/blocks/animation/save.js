/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { InnerBlocks, useBlockProps } from '@wordpress/block-editor';

import classnames from 'classnames';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @param  props
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save( props ) {
	const {
		attributes: {
			animationName,
			animationSpeed,
			animationDelay,
			animationRepeat,
		},
	} = props;

	const classes = classnames( 'animate__animated', {
		[ `animate__${ animationName }` ]: true,
		[ `animate__${ animationSpeed }` ]: true,
		[ `animate__delay-${ animationDelay }s` ]: true,
		[ `animate__${ animationRepeat }` ]: true,
	} );

	// debugger;
	const blockProps = useBlockProps.save( { className: classes } );
	return (
		<div { ...blockProps }>
			<InnerBlocks.Content />
		</div>
	);
}
