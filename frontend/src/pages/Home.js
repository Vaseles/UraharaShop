import React, {useState, useEffect} from 'react'
import Intro from '../components/HomePage/Intro';
import AboutHome from '../components/HomePage/AboutHome';
import AuthUser from '../components/AuthUser';

function Home() {
  const {http, getToken, username} = AuthUser();
  const [products, setProducts] = useState([]);

  useEffect(() => {
    getProducts();
  }, []);

  const getProducts = async() => {
    http.get('products')
      .then(res => {
        console.log(res.data);
        setProducts(res.data.products);
      })
  }
  
  return (
    <div className="page">
        <Intro/>
        <AboutHome/>
        {products? (
          <div className="products">
            {products.map(product =>  
              <div className="product" key={product.id}>
                <img src={`http://127.0.0.1:8000${product.image}`} alt={product.title} />
                <div className="product__info">
                  <a href={`products`} className='link'>{product.title}</a>
                  <h2>{product.price}</h2>
                </div>
              </div >
            )}
          </div>
        ):(<></>)}
        <a href="/catalog" className="btn">Catalog</a>
    </div>
  )
}

export default Home