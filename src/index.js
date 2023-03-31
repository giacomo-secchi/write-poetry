
import { registerPlugin } from "@wordpress/plugins";
import { PluginSidebar, PluginSidebarMoreMenuItem, PluginDocumentSettingPanel } from "@wordpress/edit-post";
import { Button, DateTimePicker, Dropdown, PanelBody, TextControl } from "@wordpress/components";
import { select, withSelect, withDispatch } from "@wordpress/data";
import includes from "lodash/includes";
import { useState } from '@wordpress/element';


import { date } from '@wordpress/date';


import { __ } from "@wordpress/i18n";






let PluginMetaFields = ( props ) => {

	return (
	  <>
		  <TextControl
			value={ props.text_metafield }
			label={  __( "Text Meta", "textdomain ") }
			onChange={(value) => props.onMetaFieldChange(value)}
		  />
	  </>
	)
  }

  PluginMetaFields = withSelect(
    (select) => {
        return {
            text_metafield: select('core/editor').getEditedPostAttribute('meta')['_mcf_text_metafield']
        }
    }
)(PluginMetaFields);

PluginMetaFields = withDispatch(
    (dispatch) => {
        return {
            onMetaFieldChange: (value) => {
                dispatch('core/editor').editPost({meta: {_mcf_text_metafield: value}})
            }
        }
    }
)(PluginMetaFields);



const MyDocumentSetting = (  { postType } ) => {
	if ( 'jetpack-portfolio' !== postType ) {
		return null;
	}
	return(
		<PluginDocumentSettingPanel
			className="my-document-setting-plugin"
			title="My Panel"
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


