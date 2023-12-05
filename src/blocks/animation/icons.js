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
