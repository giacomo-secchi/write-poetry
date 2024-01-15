/**
 * External dependencies
 */
// import React from 'react';
// import Swiper JS
import { Swiper, SwiperSlide } from 'swiper/react';
import { Autoplay, Virtual } from 'swiper/modules';

// import Swiper styles
import 'swiper/css';

const Carousel = ( { delay, children } ) => {
	debugger;
	return (
		<Swiper
			className="mySwiper"
			spaceBetween={ 50 }
			slidesPerView={ 1 }
			autoplay={ {
				delay,
				disableOnInteraction: false,
			} }
			onSlideChange={ () => console.log( 'slide change' ) }
			onSwiper={ ( swiper ) => console.log( swiper ) }
			modules={ [ Autoplay ] }
		>
			<SwiperSlide>Slide 1</SwiperSlide>
			<SwiperSlide>Slide 2</SwiperSlide>
			<SwiperSlide>Slide 3</SwiperSlide>
			<SwiperSlide>Slide 4</SwiperSlide>

			{
				/* loop through the children array and create a slide for each child */
				children.map( ( slideContent, index ) => (
					// You can do something with each child here
					// For example, clone the child and add a key prop:
					<SwiperSlide key={ slideContent } virtualIndex={ index }>
						{ slideContent }
					</SwiperSlide>
				) )
			}
		</Swiper>
	);
};

export default Carousel;
