// JavaScript code (app.js)

let listProductHTML = document.querySelector('.listProduct');
let listCartHTML = document.querySelector('.listCart');
let iconCart = document.querySelector('.icon-cart');
let iconCartSpan = document.querySelector('.icon-cart span');
let body = document.querySelector('body');
let closeCart = document.querySelector('.close');
let cart = [];

iconCart.addEventListener('click', () => {
    body.classList.toggle('showCart');
});
``
closeCart.addEventListener('click', () => {
    body.classList.toggle('showCart');
});

// Function to fetch product data from PHP endpoint

const fetchProductData = () => {
    fetch('Relget_products.php')
      .then(response => response.json())
      .then(products => {
        // Pass products data to addToCart function
        addToCart.products = products;
        // Clear existing content
        listProductHTML.innerHTML = '';
        // Loop through each product
        products.forEach(product => {
          // Create a new product item
          const productItem = document.createElement('div');
          productItem.classList.add('item');
          // Construct the HTML content for the product item
          productItem.innerHTML = `
            <h2>${product.name}</h2>
            <div class="price">$${parseFloat(product.price).toFixed(2)}</div>
            <img src="${product.image}" alt="${product.name}">
            <button class="addCart" data-id="${product.productID}">Add to Cart</button>
          `;
          // Append the product item to the list
          listProductHTML.appendChild(productItem);
        });
        
      })
      .catch(error => {
        console.error('Error fetching product data:', error);
      });
};


const addToCart = (product_id) => {
    // Access product data from addToCart function
    const products = addToCart.products;
    let positionThisProductInCart = cart.findIndex((value) => value.product_id == product_id);
    if (cart.length <= 0) {
        cart = [{
            product_id: product_id,
            quantity: 1
        }];
    } else if (positionThisProductInCart < 0) {
        cart.push({
            product_id: product_id,
            quantity: 1
        });
    } else {
        cart[positionThisProductInCart].quantity = cart[positionThisProductInCart].quantity + 1;
    }
    addCartToHTML(products); // Pass products data to addCartToHTML function
    addCartToMemory();

 // Prepare FormData object with product data
 const formData = new FormData();
 formData.append('product_id', product_id); // Ensure 'product_id' matches the key expected in the PHP script
 
 // Find the product with the matching ID
 const product = products.find(product => product.productID === product_id);
 if (product) {
     // Append product data to FormData
     formData.append('name', product.name);
     formData.append('price', product.price);
     formData.append('image', product.image);
     // Add any other product data fields as needed
 }


 // Send cart data to server
 fetch('add_to_cart.php', {
     method: 'POST',
     body: formData
 })
 .then(response => {
     if (response.ok) {
         return response.json();
     }
     throw new Error('Failed to add item to cart.');
 })
 .then(data => {
     // Handle successful response (if needed)
 })
 .catch(error => {
     console.error('Error adding item to cart:', error);
     // Display error message to user (if needed)
 });




};


// Function to add cart data to local storage
const addCartToMemory = () => {
    localStorage.setItem('cart', JSON.stringify(cart));
}

// Function to add cart data to HTML
const addCartToHTML = (products) => {
    listCartHTML.innerHTML = '';
    let totalQuantity = 0;
    if (cart.length > 0) {
        cart.forEach(item => {
            totalQuantity = totalQuantity + item.quantity;
            let newItem = document.createElement('div');
            newItem.classList.add('item');
            newItem.dataset.id = item.product_id;
            let positionProduct = products.findIndex((value) => value.productID == item.product_id);
            let info = products[positionProduct] || {}; // Add this line to handle undefined products

            listCartHTML.appendChild(newItem);
            newItem.innerHTML = `
              <div class="image">
                ${info.image ? `<img src="${info.image}">` : '<div class="no-image">No Image</div>'}
              </div>
              <div class="name">${info.name || 'Unknown Product'}</div>
              <div class="totalPrice">₹${(info.price || 0) * item.quantity}</div>
            <div class="quantity">
                <span class="minus"><</span>
                <span>${item.quantity}</span>
                <span class="plus">></span>
            </div>
            `;
        });
    }
    iconCartSpan.innerText = totalQuantity;
};

// Add event listener to handle clicks on the "Add to Cart" button
listProductHTML.addEventListener('click', (event) => {
    if (event.target.classList.contains('addCart')) {
        // Retrieve the product ID from the data-id attribute
        const productID = event.target.dataset.id;
        // Call the addToCart function with the product ID
        addToCart(productID);
    }
});

listCartHTML.addEventListener('click', (event) => {
    let positionClick = event.target;
    if(positionClick.classList.contains('minus') || positionClick.classList.contains('plus')){
        let product_id = positionClick.parentElement.parentElement.dataset.id;
        let type = 'minus';
        if(positionClick.classList.contains('plus')){
            type = 'plus';
        }
        changeQuantityCart(product_id, type);
    }
})

// Function to change quantity in cart
const changeQuantityCart = (product_id, type) => {
    let positionItemInCart = cart.findIndex((value) => value.product_id == product_id);
    if(positionItemInCart >= 0){
        let info = cart[positionItemInCart];
        switch (type) {
            case 'plus':
                cart[positionItemInCart].quantity = cart[positionItemInCart].quantity + 1;
                break;
        
            default:
                let changeQuantity = cart[positionItemInCart].quantity - 1;
                if (changeQuantity > 0) {
                    cart[positionItemInCart].quantity = changeQuantity;
                }else{
                    cart.splice(positionItemInCart, 1);
                }
                break;
        }
    }
    addCartToHTML(addToCart.products);
    addCartToMemory();
}
document.addEventListener("DOMContentLoaded", function() {
    const checkoutBtn = document.getElementById("checkout-btn");

    // Event listener for checkout button
    checkoutBtn.addEventListener("click", () => {
        // Redirect to the cart.html page
        window.location.href = 'cart.html';
    });
});

// Initial fetch of product data
fetchProductData();
