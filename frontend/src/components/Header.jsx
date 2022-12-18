import React from 'react';
import UraharaShop from '../assets/images/UraharaShop.png';
import AuthUser from './AuthUser';

function Header() {
  const {getToken, username, token, logout} = AuthUser();
  console.log(username, token)
  return (
    <header>
      <a className="header__logo" href='/'>
        <img className='icon' src={UraharaShop} alt='Urahara Shop' />
        <span>Urahara Shop</span>
      </a>
      {!getToken()? (
        <div className="header__menu">
          <a href="/signin" className="link">Sign In</a>
          <a href="/signup" className="btn">Sign Up</a>
        </div>
        ): (
          <div className="header__menu">
            <a href={`/user/${username.name}`} className="link">{username.name}</a>
            <button onClick={logout} className="btn">Sign Out</button>
          </div>
        )}
    </header>
  )
}

export default Header