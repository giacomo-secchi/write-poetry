/**
 * WordPress components that create the necessary UI elements for the block
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-components/
 */
import { Button, Dropdown, DropdownMenu, Panel, PanelBody, PanelRow, Placeholder, SelectControl, TextControl, Toolbar, ToolbarGroup, ToolbarDropdownMenu } from '@wordpress/components';

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { BlockControls, InnerBlocks, InspectorControls, useBlockProps,	__experimentalBlockVariationPicker as BlockVariationPicker } from '@wordpress/block-editor';

import { useState, Fragment } from '@wordpress/element';

import { paragraph, formatBold, formatItalic, link, table, cog } from '@wordpress/icons';


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * Internal dependencies
 */
import metadata from './block.json';

// import classnames from 'classnames';

import { Animation, Ball } from './MyIcon';

function AnimationPlaceholder( { setAttributes } ) {

	return (
		<BlockVariationPicker
			icon={ Animation }
			label={ __( 'Choose variation' ) }
			instructions={ __( 'Select a variation to start with.' ) }
			onSelect={ (variation) => setAttributes( {   } )}
			variations={[
				{
					name: "backInUp",
					description: "backInUp animation.",
					title: "backInUp",
					icon: Ball,
					attributes: { animationName: 'backInUp' }
				},
				{
					name: "bed",
					description: "An icon of a bed.",
					title: "Bed",
					icon: Ball
				},
				{
					name: "bed",
					description: "An icon of a bed.",
					title: "Bed",
					icon: Ball
				},
				{
					name: "bed",
					description: "An icon of a bed.",
					title: "Bed",
					icon: Ball
				},
				{
					name: "bed",
					description: "An icon of a bed.",
					title: "Bed",
					icon: Ball
				},
				{
					name: "bed",
					description: "An icon of a bed.",
					title: "Bed",
					icon: Ball
				}
			]}
		/>
	);
}


/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( props ) {
	// const {
	// 	attributes: { animationName, animationSpeed, animationRepeat, animationDelay },
	// 	setAttributes,
	// 	isSelected
	// } = props;


	// const baseClassName = 'animate__';


	// const classes = classnames( `${baseClassName}animated`, {
	// 	[`animate__${animationName}`]: true,
	// 	[`animate__${animationSpeed}`]: true,
	// 	[`${baseClassName}__delay-${animationDelay}s`]: true,
	// 	[`animate__${animationRepeat}`]: true,
    // } );



	// const blockProps = useBlockProps( {
	// 	className: classes,
	// } );




	// const onChangeAnimationName = ( newAnimation ) => {
	// 	setAttributes( {
	// 		animationName: newAnimation === undefined ? 'none' : newAnimation,
	// 	} );
	// };

	// const onChangeAnimationDelay = ( newAnimation ) => {
	// 	setAttributes( {
	// 		animationDelay: newAnimation === undefined ? 'none' : newAnimation,
	// 	} );
	// };

	// const onChangeAnimationSpeed = ( newAnimation ) => {
	// 	setAttributes( {
	// 		animationSpeed: newAnimation === undefined ? 'none' : newAnimation,
	// 	} );
	// };

	// const onChangeAnimationRepeat = ( newAnimation ) => {
	// 	setAttributes( {
	// 		animationRepeat: newAnimation === undefined ? 'none' : newAnimation,
	// 	} );
	// };

	// return (
	// 	<Fragment>

	// 		<InspectorControls>
	// 			<Panel>
	// 				<PanelBody title={ __( 'Animation' ) } initialOpen={ true }>
	// 					<PanelRow>
	// 						<SelectControl
	// 							label={ __( 'Animation name', 'write-poetry-animation-block' ) }
	// 							// value={ item }
	// 							// onChange={ ( selection ) => { setItem( selection ) } }
	// 							value={ animationName }
	// 							onChange={ onChangeAnimationName }
	// 							// __nextHasNoMarginBottom
	// 						>
	// 							<optgroup label="Attention seekers">
	// 								<option value="bounce">bounce</option>
	// 								<option value="flash">flash</option>
	// 								<option value="pulse">pulse</option>
	// 								<option value="rubberBand">rubberBand</option>
	// 								<option value="shakeX">shakeX</option>
	// 								<option value="shakeY">shakeY</option>
	// 								<option value="headShake">headShake</option>
	// 								<option value="swing">swing</option>
	// 								<option value="tada">tada</option>
	// 								<option value="wobble">wobble</option>
	// 								<option value="jello">jello</option>
	// 								<option value="jello">heartBeat</option>
	// 							</optgroup>
	// 							<optgroup label="Back entrances">
	// 								<option value="backInDown">backInDown</option>
	// 								<option value="backInLeft">backInLeft</option>
	// 								<option value="backInRight">backInRight</option>
	// 								<option value="backInUp">backInUp</option>
	// 							</optgroup>
	// 							<optgroup label="Back exits">
	// 								<option value="backOutDown">backOutDown</option>
	// 								<option value="backOutLeft">backOutLeft</option>
	// 								<option value="backOutRight">backOutRight</option>
	// 								<option value="backOutUp">backOutUp</option>
	// 							</optgroup>
	// 							<optgroup label="Bouncing entrances">
	// 								<option value="bounceIn">bounceIn</option>
	// 								<option value="bounceInDown">bounceInDown</option>
	// 								<option value="bounceInLeft">bounceInLeft</option>
	// 								<option value="bounceInRight">bounceInRight</option>
	// 								<option value="bounceInUp">bounceInUp</option>
	// 							</optgroup>
	// 							<optgroup label="Bouncing exits">
	// 								<option value="bounceOut">bounceOut</option>
	// 								<option value="bounceOutDown">bounceOutDown</option>
	// 								<option value="bounceOutLeft">bounceOutLeft</option>
	// 								<option value="bounceOutRight">bounceOutRight</option>
	// 								<option value="bounceOutUp">bounceOutUp</option>
	// 							</optgroup>
	// 							<optgroup label="Fading entrances">
	// 								<option value="fadeIn">fadeIn</option>
	// 								<option value="fadeInDown">fadeInDown</option>
	// 								<option value="fadeInDownBig">fadeInDownBig</option>
	// 								<option value="fadeInLeft">fadeInLeft</option>
	// 								<option value="fadeInLeftBig">fadeInLeftBig</option>
	// 								<option value="fadeInRight">fadeInRight</option>
	// 								<option value="fadeInRightBig">fadeInRightBig</option>
	// 								<option value="fadeInUp">fadeInUpBig</option>
	// 								<option value="fadeInUpBig">fadeInUpBig</option>
	// 								<option value="fadeInTopLeft">fadeInTopLeft</option>
	// 								<option value="fadeInTopRight">fadeInTopRight</option>
	// 								<option value="fadeInBottomLeft">fadeInTopRight</option>
	// 								<option value="fadeInBottomRight">fadeInTopRight</option>
	// 							</optgroup>
	// 							<optgroup label="Fading exits">
	// 								<option value="fadeOut">fadeOut</option>
	// 								<option value="fadeOutDown">fadeOutDown</option>
	// 								<option value="fadeOutDownBig">fadeOutDownBig</option>
	// 								<option value="fadeOutLeft">fadeOutLeft</option>
	// 								<option value="fadeOutLeftBig">fadeOutLeftBig</option>
	// 								<option value="fadeOutRight">fadeOutRight</option>
	// 								<option value="fadeOutRightBig">fadeOutRightBig</option>
	// 								<option value="fadeOutUp">fadeOutUp</option>
	// 								<option value="fadeOutUpBig">fadeOutUpBig</option>
	// 								<option value="fadeOutTopLeft">fadeOutTopLeft</option>
	// 								<option value="fadeOutTopRight">fadeOutTopRight</option>
	// 								<option value="fadeOutBottomRight">fadeOutBottomRight</option>
	// 								<option value="fadeOutBottomLeft">fadeOutBottomLeft</option>
	// 							</optgroup>
	// 							<optgroup label="Flippers">
	// 								<option value="flip">flip</option>
	// 								<option value="flipInX">flipInX</option>
	// 								<option value="flipInY">flipInY</option>
	// 								<option value="flipOutX">flipOutX</option>
	// 								<option value="flipOutY">flipOutY</option>
	// 							</optgroup>
	// 							<optgroup label="Lightspeed">
	// 								<option value="lightSpeedInRight">lightSpeedInRight</option>
	// 								<option value="lightSpeedInLeft">lightSpeedInLeft</option>
	// 								<option value="lightSpeedOutRight">lightSpeedOutRight</option>
	// 								<option value="lightSpeedOutLeft">lightSpeedOutLeft</option>
	// 							</optgroup>
	// 							<optgroup label="Rotating entrances">
	// 								<option value="rotateIn">rotateIn</option>
	// 								<option value="rotateInDownLeft">rotateInDownLeft</option>
	// 								<option value="rotateInDownRight">rotateInDownRight</option>
	// 								<option value="rotateInUpLeft">rotateInUpLeft</option>
	// 								<option value="rotateInUpLeft">rotateInUpRight</option>
	// 							</optgroup>
	// 							<optgroup label="Rotating exits">
	// 								<option value="rotateOut">rotateOut</option>
	// 								<option value="rotateOutDownLeft">rotateOutDownLeft</option>
	// 								<option value="rotateOutDownRight">rotateOutDownRight</option>
	// 								<option value="rotateOutUpLeft">rotateOutUpLeft</option>
	// 								<option value="rotateOutUpRight">rotateOutUpLeft</option>
	// 							</optgroup>
	// 							<optgroup label="Specials">
	// 								<option value="hinge">hinge</option>
	// 								<option value="jackInTheBox">jackInTheBox</option>
	// 								<option value="rollIn">rollIn</option>
	// 								<option value="rollOut">rollOut</option>
	// 							</optgroup>
	// 							<optgroup label="Zooming entrances">
	// 								<option value="zoomIn">zoomIn</option>
	// 								<option value="zoomInDown">zoomInDown</option>
	// 								<option value="zoomInLeft">zoomInLeft</option>
	// 								<option value="zoomInRight">zoomInRight</option>
	// 								<option value="zoomInUp">zoomInUp</option>
	// 							</optgroup>
	// 							<optgroup label="Zooming exits">
	// 								<option value="zoomOut">zoomOut</option>
	// 								<option value="zoomOutDown">zoomOutDown</option>
	// 								<option value="zoomOutLeft">zoomOutLeft</option>
	// 								<option value="zoomOutRight">zoomOutRight</option>
	// 								<option value="zoomOutUp">zoomOutUp</option>
	// 							</optgroup>
	// 							<optgroup label="Sliding entrances">
	// 								<option value="slideInDown">slideInDown</option>
	// 								<option value="slideInLeft">slideInLeft</option>
	// 								<option value="slideInRight">slideInRight</option>
	// 								<option value="slideInUp">slideInUp</option>
	// 							</optgroup>
	// 							<optgroup label="Sliding exits">
	// 								<option value="slideOutDown">slideOutDown</option>
	// 								<option value="slideOutLeft">slideOutLeft</option>
	// 								<option value="slideOutRight">slideOutRight</option>
	// 								<option value="slideOutUp">slideOutUp</option>
	// 							</optgroup>
	// 						</SelectControl>
	// 					</PanelRow>
	// 					<PanelRow>
	// 						<SelectControl
	// 							label={ __( 'Delay', 'write-poetry-animation-block' ) }
	// 							value={ animationDelay }
	// 							options={ [
	// 								{ value: '', label: 'Select a Delay', disabled: true },
	// 								{ value: '2', label: '2s' },
	// 								{ value: '3', label: '3s' },
	// 								{ value: '4', label: '4s' },
	// 								{ value: '5', label: '5s' },
	// 							] }
	// 							onChange={ onChangeAnimationDelay }
	// 							// __nextHasNoMarginBottom
	// 						>
	// 						</SelectControl>
	// 					</PanelRow>
	// 					<PanelRow>
	// 						<SelectControl
	// 							label={ __( 'Speed', 'write-poetry-animation-block' ) }
	// 							value={ animationSpeed }
	// 							options={ [
	// 								{ value: '', label: 'Select the speed of the animation:', disabled: true },
	// 								{ value: 'slow', label: 'slow' },
	// 								{ value: 'slower', label: 'slower' },
	// 								{ value: 'fast', label: 'fast' },
	// 								{ value: 'faster', label: 'faster' },
	// 							] }
	// 							onChange={ onChangeAnimationSpeed }
	// 							// __nextHasNoMarginBottom
	// 						>
	// 						</SelectControl>
	// 					</PanelRow>
	// 					<PanelRow>
	// 						<SelectControl
	// 							label={ __( 'Repeat', 'write-poetry-animation-block' ) }
	// 							value={ animationRepeat }
	// 							options={ [
	// 								{ value: '', label: 'Select the iteration count of the animation:', disabled: true },
	// 								{ value: 'repeat-1', label: '1' },
	// 								{ value: 'repeat-2', label: '2' },
	// 								{ value: 'repeat-3', label: '3' },
	// 								{ value: 'infinite', label: 'infinite' },
	// 							] }
	// 							onChange={ onChangeAnimationRepeat }
	// 							// __nextHasNoMarginBottom
	// 						>
	// 						</SelectControl>
	// 					</PanelRow>
	// 				</PanelBody>
	// 			</Panel>
	// 		</InspectorControls>
	// 		<div { ...blockProps }>
	// 			{ animationName  && ! isSelected ? (
	// 				<InnerBlocks />
	// 			) : (
	// 				AnimationPlaceholder()
	// 			) }
	// 		</div>
	// 	</Fragment>
	// );
}
