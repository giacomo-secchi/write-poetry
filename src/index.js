
import { registerPlugin } from '@wordpress/plugins';
import { PluginSidebar, PluginSidebarMoreMenuItem, PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { Button, DateTimePicker, Dropdown, PanelBody, TextControl, __experimentalNumberControl as NumberControl } from '@wordpress/components';
import { select, useSelect, withSelect, withDispatch } from '@wordpress/data';
import { useEntityProp } from '@wordpress/core-data';
import includes from 'lodash/includes';
import { useState } from '@wordpress/element';

import { date } from '@wordpress/date';
import { __ } from '@wordpress/i18n';


let PluginMetaFields = ( props ) => {

	const postType = useSelect(
		( select ) => select( 'core/editor' ).getCurrentPostType(),
		[]
	);

	const [ meta, setMeta ] = useEntityProp( 'postType', postType, 'meta' );

	const yearValue = meta['_mcf_project_year'];
	const clientValue = meta['_mcf_project_client'];

	const updateMetaValue = ( key, newValue ) => {
		setMeta( { ...meta, [key]: newValue } );
	};

	return (
	  <>
			<NumberControl
				label={ __( 'Year', 'textdomain' ) }
				onChange={ (value) => updateMetaValue( '_mcf_project_year', value ) }
				shiftStep={ 10 }
				value={ yearValue }
		  	/>
			<TextControl
				label={ __( 'Client', 'textdomain' ) }
				value={ clientValue }
				onChange={ (value) => updateMetaValue( '_mcf_project_client', value ) }
			/>
			<TextControl
				label={ __( 'Client', 'textdomain' ) }
				value={ clientValue }
				onChange={ (value) => updateMetaValue( '_mcf_project_client', value ) }
			/>
	  </>
	)
}


// PluginMetaFields = withSelect(
//     (select) => {
//         return {
//             project_year_metafield: select( 'core/editor' ).getEditedPostAttribute( 'meta' )['_mcf_project_year'],
//         }
//     }
// )(PluginMetaFields);

// PluginMetaFields = withDispatch(
//     (dispatch) => {
//         return {
//             onMetaFieldChange: ( value ) => {
//                 dispatch( 'core/editor' ).editPost( { meta: { _mcf_project_year: value } })
//             }
//         }
//     }
// )( PluginMetaFields );



const MyDocumentSetting = (  { postType } ) => {
	if ( 'jetpack-portfolio' !== postType ) {
		return null;
	}

	return(
		<PluginDocumentSettingPanel
			name="project-custom-fields"
			title="Project Informations"
		>
			<PluginMetaFields />
		</PluginDocumentSettingPanel>
	);
}


const MyDocumentSettingwithSelect = withSelect( select => {
	return {
		postType: select( 'core/editor' ).getCurrentPostType(),
	};
} )( MyDocumentSetting );


registerPlugin( 'document-setting-test', { render: MyDocumentSettingwithSelect } );


