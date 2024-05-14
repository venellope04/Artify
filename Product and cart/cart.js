document.addEventListener("DOMContentLoaded", function() {
    const cartItems = document.querySelector(".cart-items");
    const totalPrice = document.getElementById("total-price");
    const checkoutBtn = document.getElementById("checkout-btn");

    // Function to fetch cart data from the server
    const fetchCartData = () => {
        fetch("cart_connect.php")
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Clear previous cart items
            cartItems.innerHTML = "";
            let total = 0;

            // Display cart items
            data.forEach(item => {
                const cartItem = document.createElement("div");
                cartItem.classList.add("cart-item");
                cartItem.innerHTML = `
                    <div class="item-info">
                        <h3>${item.name}</h3>
                        <p>Price: ₹${item.price}</p>
                        <p>Quantity: ${item.quantity}</p>
                        <img src="${item.image}" alt="${item.name}" /> <!-- Display image -->
                    </div>
                    <button class="remove-btn" data-id="${item.id}">Remove</button>
                `;
                cartItems.appendChild(cartItem);
                total += item.price * item.quantity;
            });

            // Update total price
            totalPrice.textContent = `₹${total.toFixed(2)}`;
        })
        .catch(error => {
            console.error("Error fetching cart data:", error);
        });
    };

    // Event listener for remove button
    cartItems.addEventListener("click", event => {
        if (event.target.classList.contains("remove-btn")) {
            const itemId = parseInt(event.target.dataset.id);
            removeItemFromCart(itemId);
        }
    });
// Function to remove item from cart
const removeItemFromCart = itemId => {
    // Prepare form data
    const formData = new FormData();
    formData.append('id', itemId);

    // Send request with form data
    fetch("remove_from_cart.php", {
        method: "POST",
        body: formData // Send form data in the request body
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        // Handle the response from the server
        if (data.success) {
            // Handle success response
        } else {
            // Handle error response
        }
    })
    .catch(error => {
        console.error("Error during request:", error);
        // Handle potential errors
    });
};
    // Initial display of cart items
    fetchCartData();

    // Event listener for checkout button
    checkoutBtn.addEventListener("click", () => {
        // Implement checkout functionality
        window.location.href = 'cart.html';
    });
});
