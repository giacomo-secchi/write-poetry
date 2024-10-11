import { store, getContext } from '@wordpress/interactivity';

const { state } = store( 'myPlugin', {
	state: {
		likes: 0,
		getDoubleLikes() {
			return 2 * state.likes;
		},
	},
	actions: {
		toggle: () => {
			const context = getContext();
			context.isOpen = ! context.isOpen;
		},
	},
	callbacks: {
		logIsOpen: () => {
			const context = getContext();
			// Log the value of `isOpen` each time it changes.
			console.log( `Is open: ${ context.isOpen }` );
		},
	},
} );
