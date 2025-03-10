import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    let page = 2;
    const loadMoreBtn = document.getElementById("loadMoreBtn");
    const productContainer = document.getElementById("product-container");

    const toggleBtn = document.getElementById("toggleCategories");
    const hiddenCategories = document.querySelectorAll(".category-item.hidden");
    let isExpanded = false;

    document.addEventListener("DOMContentLoaded", function () {
        const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");

        addToCartButtons.forEach((button) => {
            button.addEventListener("click", function () {
                const productId = this.getAttribute("data-product-id");
                let cart = JSON.parse(localStorage.getItem("cartItems")) || [];

                const existingItem = cart.find(
                    (item) => item.product_id == productId
                );

                if (existingItem) {
                    existingItem.quantity += 1; // Increase quantity if item exists
                } else {
                    cart.push({ product_id: productId, quantity: 1 });
                }

                localStorage.setItem("cartItems", JSON.stringify(cart));

                // Redirect to login if user is not authenticated
                window.location.href = "/login";
            });
        });
    });

    toggleBtn.addEventListener("click", function () {
        if (!isExpanded) {
            hiddenCategories.forEach((category) =>
                category.classList.remove("hidden")
            );
            toggleBtn.textContent = "Show Less";
        } else {
            hiddenCategories.forEach((category) =>
                category.classList.add("hidden")
            );
            toggleBtn.textContent = "Show More";
        }
        isExpanded = !isExpanded;
    });

    async function loadProducts() {
        try {
            // Fetch current page and next page at the same time
            const [currentResponse, nextResponse] = await Promise.all([
                fetch(`/products/load-more?page=${page}`).then((res) =>
                    res.json()
                ),
                fetch(`/products/load-more?page=${page + 1}`).then((res) =>
                    res.json()
                ),
            ]);

            console.log("Fetched Page", page, ":", currentResponse);
            console.log("Fetched Page", page + 1, ":", nextResponse);

            // Append current page data if it has content
            if (currentResponse.html && currentResponse.html.trim() !== "") {
                productContainer.insertAdjacentHTML(
                    "beforeend",
                    currentResponse.html
                );
                page++;
            }

            // Check next page's content
            if (!nextResponse.hasMore || !nextResponse.html.trim()) {
                console.log("No more products in next page. Hiding button.");
                loadMoreBtn.remove(); // Remove button if next page is empty
            }
        } catch (error) {
            console.error("Error loading more products:", error);
        }
    }

    loadMoreBtn.addEventListener("click", loadProducts);
});
