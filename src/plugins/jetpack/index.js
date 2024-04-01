/**
 * Internal dependencies
 */
import * as config from '../../packages/config';

/**
 * WordPress dependencies
 */
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { TimePicker, TextControl } from '@wordpress/components';
import { useSelect, withSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

// import includes from 'lodash/includes';

const PluginMetaFields = ( props ) => {
	const postType = useSelect(
		( select ) => select( 'core/editor' ).getCurrentPostType(),
		[]
	);

	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );

	const fromDateValue = meta._writepoetry_project_from_date;
	const newToValue = meta._writepoetry_project_to_date;
	const clientValue = meta._writepoetry_project_client;

	const [ date, setDate ] = useState( new Date() );

	const updateMetaValue = ( key, newValue ) => {
		setMeta( { ...meta, [ key ]: newValue } );
	};

	return (
		<>
			<label htmlFor="datePicker">
				{ __( 'From date', 'write-poetry' ) }
				<TimePicker
					currentTime={ meta._writepoetry_project_date_from }
					onChange={ ( newFromDate ) =>
						updateMetaValue(
							'_writepoetry_project_date_from',
							newFromDate
						)
					}
				/>
			</label>

			<div>
				<label htmlFor="datePicker">
					{ __( 'To date', 'write-poetry' ) }
					<TimePicker
						currentTime={ newToValue }
						onChange={ ( newToDate ) =>
							updateMetaValue(
								'_writepoetry_project_to_date',
								newToDate
							)
						}
					/>
				</label>
			</div>

			<TextControl
				label={ __( 'Client', 'write-poetry' ) }
				value={ clientValue }
				onChange={ ( value ) =>
					updateMetaValue( '_writepoetry_project_client', value )
				}
			/>
		</>
	);
};

// PluginMetaFields = withSelect(
//     (select) => {
//         return {
//             project_year_metafield: select( 'core/editor' ).getEditedPostAttribute( 'meta' )['_writepoetry_project_year'],
//         }
//     }
// )(PluginMetaFields);

// PluginMetaFields = withDispatch(
//     (dispatch) => {
//         return {
//             onMetaFieldChange: ( value ) => {
//                 dispatch( 'core/editor' ).editPost( { meta: { _writepoetry_project_year: value } })
//             }
//         }
//     }
// )( PluginMetaFields );

const MyDocumentSetting = ( { postType } ) => {
	if ( 'jetpack-portfolio' !== postType ) {
		return null;
	}

	return (
		<PluginDocumentSettingPanel
			name="project-custom-fields"
			title="Project Informations"
		>
			<PluginMetaFields />
		</PluginDocumentSettingPanel>
	);
};

const MyDocumentSettingwithSelect = withSelect( ( select ) => {
	return {
		postType: select( 'core/editor' ).getCurrentPostType(),
	};
} )( MyDocumentSetting );

const PluginSettings = {
	render: MyDocumentSettingwithSelect,
};

registerPlugin( config.PLUGIN_NAME, PluginSettings );
