/**
 * Internal dependencies
 */
import * as config from '../../packages/config';

/**
 * WordPress dependencies
 */
import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import {
	DateTimePicker,
	__experimentalNumberControl as NumberControl,
	TextControl,
} from '@wordpress/components';
import { useSelect, withSelect } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import { __ } from '@wordpress/i18n';

// import includes from 'lodash/includes';

const PluginMetaFields = ( props ) => {
	const postType = useSelect(
		( select ) => select( 'core/editor' ).getCurrentPostType(),
		[]
	);

	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );

	const updateMetaValue = ( key, newValue ) => {
		setMeta( { ...meta, [ key ]: newValue } );
	};
	const data = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'postType', postType );
	} );

	return (
		<>
			{ Object.entries( meta ).map( ( [ key, value ] ) => {
				if ( ! key.startsWith( `${ config.PLUGIN_NAME }_project` ) ) {
					return null;
				}

				if ( key === `${ config.PLUGIN_NAME }_project_year` ) {
					return (
						<NumberControl
							label={ __( key, 'write-poetry' ) }
							onChange={ ( newValue ) =>
								updateMetaValue( key, newValue )
							}
							value={ value }
							required={ true }
							min={ 1900 }
							max={ new Date().getFullYear() }
						/>
					);
				}

				return (
					<TextControl
						key={ key }
						label={ __( key, 'write-poetry' ) }
						value={ value }
						onChange={ ( newValue ) =>
							updateMetaValue( key, newValue )
						}
					/>
				);
			} ) }
		</>
	);
};

// PluginMetaFields = withSelect(
//     (select) => {
//         return {
//             project_year_metafield: select( 'core/editor' ).getEditedPostAttribute( 'meta' )['writepoetry_project_year'],
//         }
//     }
// )(PluginMetaFields);

// PluginMetaFields = withDispatch(
//     (dispatch) => {
//         return {
//             onMetaFieldChange: ( value ) => {
//                 dispatch( 'core/editor' ).editPost( { meta: { writepoetry_project_year: value } })
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
