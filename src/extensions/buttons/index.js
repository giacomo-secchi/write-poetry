import { registerBlockExtension } from '@10up/block-components';
import { InspectorControls } from '@wordpress/block-editor';
import {
	FocalPointPicker,
	PanelBody,
	ToggleControl,
} from '@wordpress/components';

const newAttributes = {
	isLightbox: {
		type: 'boolean',
		default: false,
	},
	focalPoint: {
		type: 'object',
		default: {
			x: 0.5,
			y: 0.5,
		},
	},
};

function generateClassName( attributes ) {
	const { isLightbox } = attributes;
	let className = '';
	if ( isLightbox ) {
		className = 'is-lightbox';
	}
	return className;
}

function generateInlineStyle( attributes ) {
	const { focalPoint } = attributes;
	let style = { objectPosition: '50% 50%' };
	if ( focalPoint ) {
		style = {
			objectPosition: `${ focalPoint.x * 100 }% ${ focalPoint.y * 100 }%`,
		};
	}
	return style;
}

function LightboxBlockEdit( props ) {
	const { attributes, setAttributes } = props;
	const { isLightbox, focalPoint, url } = attributes;

	return (
		<InspectorControls>
			<PanelBody title="Lightbox Options">
				<ToggleControl
					label="Enable Lightbox"
					checked={ isLightbox }
					onChange={ ( value ) =>
						setAttributes( { isLightbox: value } )
					}
				/>
				<FocalPointPicker
					label="Focal Point"
					value={ focalPoint }
					onChange={ ( value ) =>
						setAttributes( { focalPoint: value } )
					}
					url={ url }
				/>
			</PanelBody>
		</InspectorControls>
	);
}

registerBlockExtension( `core/gallery`, {
	extensionName: 'lightbox',
	attributes: newAttributes,
	classNameGenerator: generateClassName,
	inlineStyleGenerator: generateInlineStyle,
	Edit: LightboxBlockEdit,
} );
