/**
 * WordPress dependencies
 */
import { Icon } from '@wordpress/components';

function IconWrapper( { className, icon } ) {
	return (
		<div className={ className }>
			<Icon icon={ icon } />
		</div>
	);
}

/**
 * Define a custom SVG icon for the block. This icon will appear in
 * the Inserter and when the user selects the block in the Editor.
 * @param root0
 * @param root0.className
 */
export const calendarIcon = ( { className } ) => {
	return IconWrapper( {
		className,
		icon: () => (
			<svg
				viewBox="0 0 24 24"
				xmlns="http://www.w3.org/2000/svg"
				aria-hidden="true"
				focusable="false"
			>
				<path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm.5 16c0 .3-.2.5-.5.5H5c-.3 0-.5-.2-.5-.5V7h15v12zM9 10H7v2h2v-2zm0 4H7v2h2v-2zm4-4h-2v2h2v-2zm4 0h-2v2h2v-2zm-4 4h-2v2h2v-2zm4 0h-2v2h2v-2z"></path>
			</svg>
		),
	} );
};

export const ballIcon = ( { className } ) => {
	return IconWrapper( {
		className,
		icon: () => (
			<svg
				width="24"
				height="24"
				viewBox="0 0 24 24"
				fill="none"
				xmlns="http://www.w3.org/2000/svg"
			>
				<path
					d="M24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12Z"
					fill="#FA6900"
				/>
			</svg>
		),
	} );
};

export const animationIcon = () => (
	<Icon
		icon={ () => (
			<svg
				width="24"
				height="24"
				viewBox="0 0 24 24"
				fill="none"
				xmlns="http://www.w3.org/2000/svg"
			>
				<path
					d="M23.5 19C23.5 21.4853 21.4853 23.5 19 23.5C16.5147 23.5 14.5 21.4853 14.5 19C14.5 16.5147 16.5147 14.5 19 14.5C21.4853 14.5 23.5 16.5147 23.5 19Z"
					fill="#FFDEC7"
					stroke="white"
				/>
				<path
					d="M21.5 15C21.5 18.5899 18.5899 21.5 15 21.5C11.4101 21.5 8.5 18.5899 8.5 15C8.5 11.4101 11.4101 8.5 15 8.5C18.5899 8.5 21.5 11.4101 21.5 15Z"
					fill="#FFA361"
					stroke="white"
				/>
				<path
					d="M19.5 10C19.5 15.2467 15.2467 19.5 10 19.5C4.75329 19.5 0.5 15.2467 0.5 10C0.5 4.75329 4.75329 0.5 10 0.5C15.2467 0.5 19.5 4.75329 19.5 10Z"
					fill="#FA6900"
					stroke="white"
				/>
			</svg>
		) }
	/>
);

export const copyrightIcon = () => (
	<Icon
		icon={ () => (
			<svg
				width="24"
				height="24"
				viewBox="0 0 24 24"
				fill="none"
				xmlns="http://www.w3.org/2000/svg"
			>
				<path
					d="M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
					fill="white"
					stroke="#FA6900"
					strokeWidth="2"
				/>
				<path
					d="M18 12C18 15.3137 15.3137 18 12 18C8.68629 18 6 15.3137 6 12C6 8.68629 8.68629 6 12 6C15.3137 6 18 8.68629 18 12Z"
					fill="#FA6900"
				/>
				<path
					d="M18 12C18 15.3137 15.3137 18 12 18C8.68629 18 6 15.3137 6 12C6 8.68629 8.68629 6 12 6C15.3137 6 18 8.68629 18 12Z"
					fill="#FA6900"
				/>
				<path
					d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
					fill="white"
				/>
				<path
					d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
					fill="white"
				/>
				<rect x="15" y="10" width="4" height="4" fill="white" />
			</svg>
		) }
	/>
);

export const slidesIcon = () => (
	<Icon
		icon={ () => (
			<svg
				width="24"
				height="24"
				viewBox="0 0 24 24"
				fill="none"
				xmlns="http://www.w3.org/2000/svg"
			>
				<path
					d="M19 6.5H20C20.8284 6.5 21.5 7.17157 21.5 8V16C21.5 16.8284 20.8284 17.5 20 17.5H19C18.7239 17.5 18.5 17.2761 18.5 17V7C18.5 6.72386 18.7239 6.5 19 6.5Z"
					fill="#FFA361"
					stroke="white"
				/>
				<path
					d="M22 8.5H23C23.8284 8.5 24.5 9.17157 24.5 10V16C24.5 16.8284 23.8284 17.5 23 17.5H22C21.7239 17.5 21.5 17.2761 21.5 17V9C21.5 8.72386 21.7239 8.5 22 8.5Z"
					fill="#FFDEC7"
					stroke="white"
				/>
				<path
					d="M1 8.5H2.5V17.5H1C0.171573 17.5 -0.5 16.8284 -0.5 16V10C-0.5 9.17157 0.171573 8.5 1 8.5Z"
					fill="#FFDEC7"
					stroke="white"
				/>
				<path
					d="M4 6.5H5.5V17.5H4C3.17157 17.5 2.5 16.8284 2.5 16V8C2.5 7.17157 3.17157 6.5 4 6.5Z"
					fill="#FFA361"
					stroke="white"
				/>
				<rect
					x="5.5"
					y="5.5"
					width="13"
					height="12"
					rx="1.5"
					fill="#FA6900"
					stroke="white"
				/>
			</svg>
		) }
	/>
);
