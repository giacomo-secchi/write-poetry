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
import { useBlockProps } from '@wordpress/block-editor';

/**
 * WordPress components that create the necessary UI elements for the block
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-components/
 */
 import { Spinner } from '@wordpress/components';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * Custom imports
 */
 import apiFetch from '@wordpress/api-fetch';
 import { useState, Component } from '@wordpress/element';

// import Swiper JS
import Swiper from 'swiper';
// import Swiper styles
import 'swiper/css';

const rootURL = 'https://wptavern.com/wp-json/';
const nonce = '15a72f5e0c';

apiFetch.use( apiFetch.createRootURLMiddleware( rootURL ) );
apiFetch.use( apiFetch.createNonceMiddleware( nonce ) );


/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */

class BlockEdit extends Component {
	constructor(props) {
		super(props);
		this.state = {
			list: [],
			loading: true
		}

	}


	componentDidMount() {


		// GET
		apiFetch( { url: 'https://eternedile.it/wp-json/wp/v2/posts',
		mode: 'cors', // no-cors, *cors, same-origin
		cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
		credentials: 'omit', // include, *same-origin, omit
		headers: {
		  'Content-Type': 'application/json'
		  // 'Content-Type': 'application/x-www-form-urlencoded',
		},
		redirect: 'follow', // manual, *follow, error
		referrerPolicy: 'no-referrer',
	} ).then( ( posts ) => {
			console.log( posts );
			this.setState({
				list: posts,
				loading: false
			})
			// debugger;
		} );
	}

	render() {

		const swiper = new Swiper('.swiper');

		const posts = this.state.list;
		const slides = [];

		posts.forEach((data) => {
			//debugger;
			{data.title}
			slides.push(<div className='swiper-slide'>{data.title.rendered}</div>)
		})


		return (

			<div>
				{ this.state.loading ? (
					<Spinner />
				) : (
					<div className="swiper">
					  <div className="swiper-wrapper">
						{slides}
					  </div>
					  <div class="swiper-pagination"></div>

					  <div class="swiper-button-prev"></div>
					  <div class="swiper-button-next"></div>

					  <div class="swiper-scrollbar"></div>
					</div>
				) }
			</div>
		);
	}

}

export default BlockEdit;

