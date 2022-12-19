import React from 'react';
import {Swiper,SwiperSlide} from 'swiper/react';
import 'swiper/css';
import 'swiper/css/navigation';
import {Navigation, EffectFade} from 'swiper';
import 'swiper/css/effect-fade';

//TODO: IMAGES
import ChineseCottageDIYMiniatureHouseKit from '../../assets/images/ChineseCottageDIYMiniatureHouseKit.jpg';
import SpringHoursJapaneseStyleDIY3DDollhouseKit from '../../assets/images/SpringHoursJapaneseStyleDIY3DDollhouseKit.jpg';
import SeptemberForestDIYMiniatureHouseKitDollhouseTB17mj1XuP2gK0jSZFoq6yuIVXaP from '../../assets/images/SeptemberForestDIYMiniatureHouseKitDollhouseTB17mj1XuP2gK0jSZFoq6yuIVXaP.jpg';
import HappyTogetherDIYMiniatureDollhouseKit9de9ed68774b4cd3838e79092e6359c1k from '../../assets/images/HappyTogetherDIYMiniatureDollhouseKit9de9ed68774b4cd3838e79092e6359c1k.jpg';
import BookStoreDIYDollhouse3DMiniatureBookshopEnglishInstruction from '../../assets/images/BookStoreDIYDollhouse3DMiniatureBookshopEnglishInstruction.jpg';
import ChritsmasEveDIYMiniatureHouseKit from '../../assets/images/ChritsmasEveDIYMiniatureHouseKit.jpg';


function Intro() {
  return (
        <Swiper
            modules={[Navigation, EffectFade]}
            navigation
            effect 
            speed={800}
            slidesPerView={1}
            // spaceBetween={0}
            loop
            className = 'slider'
        >
            <SwiperSlide className='slide'>
                <img src={ChineseCottageDIYMiniatureHouseKit} alt="Chinese Cottage" className='left__image' />
                <img src={SpringHoursJapaneseStyleDIY3DDollhouseKit} alt="Chinese Cottage" className='right__image' />
                <div className="slide__item">
                    <h2>Japanese Style </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>
            </SwiperSlide>
            <SwiperSlide className='slide'>
                <img src={HappyTogetherDIYMiniatureDollhouseKit9de9ed68774b4cd3838e79092e6359c1k} alt="Chinese Cottage" className='left__image' />
                <img src={SeptemberForestDIYMiniatureHouseKitDollhouseTB17mj1XuP2gK0jSZFoq6yuIVXaP} alt="Chinese Cottage" className='right__image' />
                <div className="slide__item">
                    <h2>Miniature Loft </h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>
            </SwiperSlide>
            <SwiperSlide className='slide'>
                <img src={BookStoreDIYDollhouse3DMiniatureBookshopEnglishInstruction} alt="Chinese Cottage" className='left__image' />
                <img src={ChritsmasEveDIYMiniatureHouseKit} alt="Chinese Cottage" className='right__image' />
                <div className="slide__item">
                    <h2>Miniature Houses</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                </div>
            </SwiperSlide>

        </Swiper>
  )
}

export default Intro;