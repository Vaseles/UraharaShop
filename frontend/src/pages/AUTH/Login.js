import React, {useState} from 'react'
import AuthUser from '../../components/AuthUser';

function Login() {
  const {http, getToken, setToken} = AuthUser();
  const [email, setEmail] = useState('');
  const [password, setPassword] =useState('');
  const [error, setError] = useState('');

  console.log('vaselesstolarov813@gmail.com')
  console.log('54444812Vaseles')

  const login = async(e) =>  {
    e.preventDefault();
    console.log(email, password); 

    http.post('auth/signin', {'email':email,'password': password})
      .then(e => {
        console.log(e.data);
        setToken(e.data.user, e.data.token)
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
        </form>
        {error? (
          <div className="error">
            {error}
          </div>
        ): (<></>)}
        <div className="page__buttons">
          <button className="btn" onClick={login}>Sign In</button>
          <a className="link" href='/signup'>Sign Up </a>
        </div>
      </div>
    </div>
  )
}

export default Login