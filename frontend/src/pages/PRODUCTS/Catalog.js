import React, {useEffect, useState} from 'react'
import AuthUser from '../../components/AuthUser'

function Catalog() {
    const {http, getToken, username} = AuthUser();
    const [products, setProducts] =useState([]);
    const [catalog, setCatalog] = useState([]);

    useEffect(() => {
        getCatalog();
    }, []);

    const getCatalog = async () => {
        http.get('/products')
            .then(res => {
                setCatalog(res.data);
                setProducts(res.data.products);
            })
    }

  return (
    <div className='page'>
        <div className="page__filters">
            <h2><span>{catalog.productsCount}</span> Elements</h2>
        </div>
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
        ):(<h1>Loading...</h1>)}
    </div>
  )
}

export default Catalog