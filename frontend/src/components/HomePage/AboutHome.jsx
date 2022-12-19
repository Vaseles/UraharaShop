import React from 'react';
import ChritsmasEveDIYMiniatureHouseKit from '../../assets/images/ChritsmasEveDIYMiniatureHouseKit.jpg';
import SpringHoursJapaneseStyleDIY3DDollhouseKit from '../../assets/images/SpringHoursJapaneseStyleDIY3DDollhouseKit.jpg';
import HappyTogetherDIYMiniatureDollhouseKit9de9ed68774b4cd3838e79092e6359c1k from '../../assets/images/HappyTogetherDIYMiniatureDollhouseKit9de9ed68774b4cd3838e79092e6359c1k.jpg';
import BookStoreDIYDollhouse3DMiniatureBookshopEnglishInstruction from '../../assets/images/BookStoreDIYDollhouse3DMiniatureBookshopEnglishInstruction.jpg';


function AboutHome() {
  return (
    <div className="about">
        <div className="about__left">
            <img src={ChritsmasEveDIYMiniatureHouseKit} alt="" />
            <div className="about__left__info">
                <a className='link' href='/'>Miniature House</a>
            </div>
        </div>
        <div className="about__right">
            <div className="about__top">
                <div className="about__top__right">
                    <img src={HappyTogetherDIYMiniatureDollhouseKit9de9ed68774b4cd3838e79092e6359c1k} alt="" />
                    <div className="about__left__info">
                        <a className='link' href='/'>Miniature Logt</a>
                    </div>
                </div>
                <div className="about__top__left">
                    <img src={BookStoreDIYDollhouse3DMiniatureBookshopEnglishInstruction} alt="" />
                    <div className="about__left__info">
                        <a className='link' href='/'>Miniature Shop</a>
                    </div>
                </div>
            </div>
            <div className="about__bottom">
                <img src={SpringHoursJapaneseStyleDIY3DDollhouseKit} alt="" />
                <div className="about__left__info">
                    <a className='link' href='/'>Miniature Japanese Houses</a>
                </div>
            </div>
        </div>
    </div>
  )
}

export default AboutHome