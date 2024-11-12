const products = [
  {
    productName: "Sandia",
    price: 15,
    img: "https://res.cloudinary.com/pabcode/image/upload/v1699869750/e-commerce/ksmw5s3xg7eeakpva5xd.png",
    category: 'frutas'
  },
  {
    productName: "Bananita",
    price: 30,
    img: "https://res.cloudinary.com/pabcode/image/upload/v1699871193/e-commerce/mopgcvdiepr8axkazmcp.png",
    category: 'frutas'
  },
  {
    productName: "CPU",
    price: 80,
    img: "https://res.cloudinary.com/pabcode/image/upload/v1710612297/e-commerce/cpu_awimlt.png",
    category: 'compus'
  },
  {
    productName: "Compu",
    price: 40,
    img: "https://res.cloudinary.com/pabcode/image/upload/v1700045911/e-commerce/compu_unvcoi.png",
    category: 'compus'
  },
  {
    productName: "Huevito",
    price: 50,
    img: "https://res.cloudinary.com/pabcode/image/upload/v1710611492/e-commerce/huevo_uau0bz.png",
    category: 'frutas'
  },
  {
    productName: "Mate",
    price: 60,
    img: "https://res.cloudinary.com/pabcode/image/upload/v1710611821/e-commerce/ksmw5s3xg7eeakpva5xd_r9ood6.png",
    category: 'bebidas'
  },
  {
    productName: "Cafecito",
    price: 70,
    img: "https://res.cloudinary.com/pabcode/image/upload/v1710612106/e-commerce/cafesitoo_oewcna.png",
    category: 'bebidas'
  },
  {
    productName: "Cervecita",
    price: 20,
    img: "https://res.cloudinary.com/pabcode/image/upload/v1699869747/e-commerce/xhlekqrockwxzjskzppw.png",
    category: 'bebidas'
  },
]

const displayProducts = (productsToShow) => {
  const shopContent = document.getElementById("shopContent")

  shopContent.innerHTML = ""
  productsToShow.forEach(product => {
    const div = document.createElement("div")
    div.className = 'card-products'
    div.innerHTML = `
      <img src="${product.img}" alt="algun-alt">
      <h3>${product.productName}</h3>
      <p class="price"> $ ${product.price}</p>
      <button>Agregar al carrito</button>
    `
    shopContent.append(div)
  })
}

const filterProducts = (category) => {
  const productsToShow = products.filter(product => product.category === category)
  displayProducts(productsToShow)
}

const frutasBtn = document.getElementById('frutasBtn');
const bebidasBtn = document.getElementById('cervezasBtn');
const compusBtn = document.getElementById('compusBtn');
const todosBtn = document.getElementById('todosBtn');

frutasBtn.addEventListener('click', () => {
  filterProducts('frutas');
});

cervezasBtn.addEventListener('click', () => {
  filterProducts('bebidas');
});

compusBtn.addEventListener('click', () => {
  filterProducts('compus');
});

todosBtn.addEventListener('click', () => {
  displayProducts(products)
});

displayProducts(products)