/**
 * External dependencies
 */
// import React from 'react';
// import Swiper JS
// import Swiper core and required modules
import {
	Autoplay,
	Navigation,
	Pagination,
	Scrollbar,
	A11y,
} from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/react';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';

const Carousel = ( { delay, elements } ) => {
	// debugger;
	// filter out not valid values like null, undefined, false, 0, empty string
	const slides = elements.filter( ( child ) => !! child );

	return (
		/* here we use a conditional ternary operator to check  if the slides are more than one */
		slides.length === 1 ? (
			elements
		) : (
			/* print Carousel custom component with properties */
			<Swiper
				className="mySwiper"
				spaceBetween={ 50 }
				slidesPerView={ 1 }
				navigation={ {
					enabled: true,
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				} }
				pagination={ { clickable: true } }
				scrollbar={ { draggable: true } }
				autoplay={ {
					delay,
					disableOnInteraction: false,
				} }
				onSlideChange={ () => console.log( 'slide change' ) }
				onSwiper={ ( swiper ) => console.log( swiper ) }
				modules={ [
					Autoplay,
					Navigation,
					Pagination,
					Scrollbar,
					A11y,
				] }
			>
				{
					/* loop through the children array and create a slide for each child */
					slides.map( ( slideContent, index ) => (
						// You can do something with each child here
						// For example, clone the child and add a key prop:
						<SwiperSlide
							key={ slideContent }
							virtualIndex={ index }
						>
							{ slideContent }
						</SwiperSlide>
					) )
				}
			</Swiper>
		)
	);
};

export default Carousel;
