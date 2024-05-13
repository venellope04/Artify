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
        // Prepare request data
    const requestData = { id: itemId };
        fetch("remove_from_cart.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(requestData) // Send item ID in the request body
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Display updated cart items
            fetchCartData();
        })
        .catch(error => {
            console.error("Error removing item from cart:", error);
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
