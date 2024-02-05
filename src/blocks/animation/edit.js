/**
 * WordPress components that create the necessary UI elements for the block
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-components/
 */
import {
	Panel,
	PanelBody,
	PanelRow,
	SelectControl,
} from '@wordpress/components';

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
import {
	InnerBlocks,
	InspectorControls,
	useBlockProps,
	__experimentalBlockVariationPicker as BlockVariationPicker,
} from '@wordpress/block-editor';

import { Fragment } from '@wordpress/element';

import classnames from 'classnames';

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
import { settings } from './index';
import { animationIcon } from '../../packages/icons';

function AnimationPlaceholder( { setAttributes } ) {
	return (
		<BlockVariationPicker
			icon={ animationIcon }
			label={ __( 'Choose variation' ) }
			instructions={ __( 'Select a variation to start with.' ) }
			onSelect={ ( variation ) =>
				setAttributes( {
					animationName: variation.attributes.animationName,
				} )
			}
			variations={ settings.variations }
		/>
	);
}

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object} props The properties passed to the function.
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( props ) {
	const { attributes, setAttributes, isSelected } = props;

	const { animationName, animationSpeed, animationRepeat, animationDelay } =
		attributes;

	const baseClassName = 'animate__';

	const classes = classnames( `${ baseClassName }animated`, {
		[ `animate__${ animationName }` ]: true,
		[ `animate__${ animationSpeed }` ]: true,
		[ `${ baseClassName }__delay-${ animationDelay }s` ]: true,
		[ `animate__${ animationRepeat }` ]: true,
	} );

	const blockProps = useBlockProps( {
		className: classes,
	} );

	const controls = [
		{
			label: __( 'Name', 'write-poetry-animation-block' ),
			value: animationName,
			options: settings.options.name,
			key: 'animationName',
		},
		{
			label: __( 'Delay', 'write-poetry-animation-block' ),
			value: animationDelay,
			options: settings.options.delay,
			key: 'animationDelay',
		},
		{
			label: __( 'Speed', 'write-poetry-animation-block' ),
			value: animationSpeed,
			options: settings.options.speed,
			key: 'animationSpeed',
		},
		{
			label: __( 'Repeat', 'write-poetry-animation-block' ),
			value: animationRepeat,
			options: settings.options.repeat,
			key: 'animationRepeat',
		},
	];

	return (
		<Fragment>
			<InspectorControls>
				<Panel>
					<PanelBody title={ __( 'Animation' ) } initialOpen={ true }>
						<PanelRow>
							<SelectControl
								label={ __(
									'Animation name',
									'write-poetry-animation-block'
								) }
								value={ animationName }
								onChange={ ( selection ) =>
									setAttributes( {
										animationName:
											selection === undefined
												? 'none'
												: selection,
									} )
								}
								// __nextHasNoMarginBottom
							>
								{ Object.entries( settings.options.name ).map(
									( [ group, values ] ) => (
										<optgroup label={ group } key={ group }>
											{ values.map( ( value ) => (
												<option
													value={ value }
													key={ value }
												>
													{ value }
												</option>
											) ) }
										</optgroup>
									)
								) }
							</SelectControl>
						</PanelRow>
						{ controls.map( ( { label, value, options, key } ) => (
							<PanelRow key={ key }>
								<SelectControl
									label={ label }
									value={ value }
									options={ options }
									onChange={ ( selection ) =>
										setAttributes( {
											[ key ]:
												selection === undefined
													? 'none'
													: selection,
										} )
									}
									// __nextHasNoMarginBottom
								></SelectControl>
							</PanelRow>
						) ) }
					</PanelBody>
				</Panel>
			</InspectorControls>
			<div { ...blockProps }>
				{ animationName && ! isSelected ? (
					<InnerBlocks />
				) : (
					AnimationPlaceholder( { setAttributes } )
				) }
			</div>
		</Fragment>
	);
}
