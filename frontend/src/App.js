import {Routes, Route} from 'react-router-dom';
import Home from './pages/Home';
import Login from './pages/AUTH/Login';
import Header from './components/Header';
import Footer from './components/Footer';
import Registration from './pages/AUTH/Registration';


function App() {
  return (
    <div className="App">
      <Header/>
      <Routes>
        <Route path="/" element={<Home />} />

        <Route path="/signin" element={<Login />} />
        <Route path="/signup" element={<Registration />} />

      </Routes>
      <Footer/>
    </div>
  );
}

export default App;
