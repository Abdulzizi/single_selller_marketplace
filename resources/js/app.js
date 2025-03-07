import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    let page = 2;
    const loadMoreBtn = document.getElementById("loadMoreBtn");
    const productContainer = document.getElementById("product-container");

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
