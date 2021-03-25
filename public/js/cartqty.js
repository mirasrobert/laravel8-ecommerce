// Get All the Product Qty
const className = document.querySelectorAll(".product_qty");

// Make a Array and convert node list.
Array.from(className).forEach(element => {
    element.addEventListener("change", () => {
        // data-id attribute
        const id = element.getAttribute("data-id");

        // Input product_qty value
        const qty = element.value;

        // Async Axios Patch
        const sendPatchRequest = async () => {
            try {
                const response = await axios.put(`/mycart/${id}/qty/${qty}`, {
                    quantity: qty
                });

                return response;
            } catch (err) {
                // Handle Error Here
                console.error(err);
            }
        };

        // Do Something to the data.
        sendPatchRequest().then(res => {
            // redirect and refresh
            window.location.href = `/mycart`;
        });
    });
});
