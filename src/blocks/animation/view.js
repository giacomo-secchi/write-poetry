import domReady from '@wordpress/dom-ready';
import 'animate.css';

const animateCSS = ( element, animation, prefix = 'animate__' ) =>
	// We create a Promise and return it
	new Promise( ( resolve, reject ) => {
		const animationName = `${ prefix }${ animation }`;
		// const node = document.querySelector(element);
		const node = element.target;

		node.classList.add( `${ prefix }animated`, animationName );

		// When the animation ends, we clean the classes and resolve the Promise
		function handleAnimationEnd( event ) {
			event.stopPropagation();
			node.classList.remove( `${ prefix }animated`, animationName );
			resolve( 'Animation ended' );
		}

		node.addEventListener( 'animationend', handleAnimationEnd, {
			once: true,
		} );
	} );

/**
 * Builds a list of thresholds for the Intersection Observer API.
 *
 * The Intersection Observer API uses a list of thresholds to determine when
 * to trigger the callback based on the visibility of the target element.
 * This function generates a list of thresholds in increments of 5% (0.05).
 *
 * @see {@link https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API}
 *
 * @return {number[]} An array of thresholds.
 */
function buildThresholdList() {
	const thresholds = [];
	const numSteps = 20;

	for ( let i = 1.0; i <= numSteps; i++ ) {
		const ratio = i / numSteps;
		thresholds.push( ratio );
	}

	thresholds.push( 0 );
	return thresholds;
}

domReady( function () {
	const observer = new IntersectionObserver(
		function ( entries, observer ) {
			for ( const entry of entries ) {
				let message = '';
				if ( entry.isIntersecting ) {
					if ( entry.intersectionRatio === 1 ) {
						message = 'Target is fully visible in the screen';
					} else if ( entry.intersectionRatio > 0.5 ) {
						message =
							'More than 50% of target is visible in the screen';
					} else {
						message =
							'Less than 50% of target is visible in the screen';
					}

					animateCSS( entry, entry.target.dataset.animation );
					// observer.unobserve( entry.target );
				} else {
					message = 'Target is not visible in the screen';
				}

				console.log( message );
			}
		},
		{ threshold: buildThresholdList() }
	);

	document
		.querySelectorAll( '.animate__animated' )
		.forEach( function ( container ) {
			observer.observe( container );
		} );
} );
