import React, {useState} from 'react'
import AuthUser from '../../components/AuthUser';

function Registration() {
  const {http, getToken, setToken} = AuthUser();
  const [name, setName] = useState('');
  const [email, setEmail] = useState('');
  const [password, setPassword] =useState('');
  const [passwordConfirmation, setPasswordConfirmation] =useState('');
  const [error, setError] = useState('');

  const login = async(e) =>  {
    e.preventDefault();
    console.log(email, password); 

    http.post('auth/signup', {'name': name,'email': email, 'password': password, 'password_confirmation': passwordConfirmation})
      .then(e => {
        if (e.data.user) {
            if (e.data.token) {
            //   setToken(e.data.user, e.data.token)
            } 
        }
      })
      .catch(e => {
        console.log(e);
        setError(e.response.data.message);
      })
  }

  return (
    <div className="page">
      <div className="page__item page__f">
        <h1>Sign In</h1>
        <form action="" className="page__form">
            <span className='input__form'>
                <span className='input__text'>name</span>
                <input 
                    type="text"  
                    value={name}
                    onChange={e => setName(e.target.value)}
                />
            </span>
            <span className='input__form'>
                <span className='input__text'>email</span>
                <input 
                type="text"  
                value={email}
                onChange={e => setEmail(e.target.value)}
                />
            </span>
          <span className='input__form'>
            <span className='input__text'>password</span>
            <input 
              type="password" 
              value={password}
              onChange={e => setPassword(e.target.value)}
            />
          </span>
          <span className='input__form'>
            <span className='input__text'>password confirmation</span>
            <input 
              type="password" 
              value={passwordConfirmation}
              onChange={e => setPasswordConfirmation(e.target.value)}
            />
          </span>
        </form>
        {error? (
          <div className="error">
            {error}
          </div>
        ): (<></>)}
        <div className="page__buttons">
          <button className="btn" onClick={login}>Sign Up</button>
          <a className="link" href='/signin'>Sign In </a>
        </div>
      </div>
    </div>
  )
}

export default Registration