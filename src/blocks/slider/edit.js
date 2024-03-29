/* eslint-disable import/no-unresolved */

/**
 * External dependencies
 */

/**
 * Internal dependencies
 */
import Carousel from './Carousel';
import './editor.scss';

/**
 * WordPress dependencies
 */
import { Spinner } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { useBlockProps } from '@wordpress/block-editor';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */

export default function Edit( props ) {
	const blockProps = useBlockProps();
	const { attributes, setAttributes } = props;
	const { numberOfPosts } = attributes;

	const posts = useSelect( ( select ) => {
		return select( 'core' ).getEntityRecords( 'postType', 'post', {
			per_page: numberOfPosts,
		} );
	} );

	const isResolving = useSelect( ( select ) => {
		return select( 'core/data' ).isResolving( 'core', 'getEntityRecords', [
			'postType',
			'post',
			{ per_page: numberOfPosts },
		] );
	} );

	// const rootURL = 'https://wptavern.com/wp-json/';
	// const nonce = '15a72f5e0c';

	// apiFetch.use( apiFetch.createRootURLMiddleware( rootURL ) );
	// apiFetch.use( apiFetch.createNonceMiddleware( nonce ) );
	// GET
	// 	apiFetch( { url: 'https://eternedile.it/wp-json/wp/v2/posts',
	// 	mode: 'cors', // no-cors, *cors, same-origin
	// 	cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
	// 	credentials: 'omit', // include, *same-origin, omit
	// 	headers: {
	// 	  'Content-Type': 'application/json'
	// 	  // 'Content-Type': 'application/x-www-form-urlencoded',
	// 	},
	// 	redirect: 'follow', // manual, *follow, error
	// 	referrerPolicy: 'no-referrer',
	// } ).then( ( posts ) => {
	// 		console.log( posts );
	// 		this.setState({
	// 			list: posts,
	// 			isResolving: false
	// 		})
	// 	} );

	// this is an array of ReactNodes
	const reactNodeArray = [
		'',
		'',
		'Test',
		42,
		<span>I'm a span</span>,
		null,
		undefined,
		false,
		[
			<p key="2">This is a paragraph in an array.</p>,
			'Another string in an array',
		],
	];

	return (
		// create a  wrapper div with the block props
		<div { ...blockProps }>
			{
				/* here we use a conditional ternary operator to check  if the data is being fetched */
				isResolving ? (
					<Spinner />
				) : (
					/* print Carousel custom component with properties */
					<Carousel delay={ 1000 } elements={ reactNodeArray } />
				)
			}
		</div>
	);
}
