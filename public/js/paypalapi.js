let amount = document.querySelector("#total").value;

// HTTP REQ
// Async Axios Patch
const sendPostRequest = async (url, data) => {
    const response = await axios.post(`${url}`, {
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
        },
        paypal: data,
        msg: "payment-success"
    });

    return response;
};

const paypalButton = () => {
    paypal
        .Buttons({
            // Setup your paypal button styling
            style: {
                shape: "rect",
                color: "blue",
                layout: "vertical",
                label: "pay"
            },

            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    // Configure environment
                    env: "sandbox",

                    // Set up your locale
                    locale: "en_PH",

                    purchase_units: [
                        {
                            amount: {
                                value: amount,
                                currency: "PHP"
                            },
                            shipping: {
                                options: [
                                    {
                                        id: "SHIP_123",
                                        label: "Free Shipping",
                                        type: "SHIPPING",
                                        selected: true,
                                        amount: {
                                            value: "0.00",
                                            currency_code: "USD"
                                        }
                                    },
                                    {
                                        id: "SHIP_456",
                                        label: "Pick up in Store",
                                        type: "PICKUP",
                                        selected: false,
                                        amount: {
                                            value: "0.00",
                                            currency_code: "USD"
                                        }
                                    }
                                ]
                            }
                        }
                    ]
                });
            },

            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    if (details.status == "COMPLETED") {
                        // Do Something to the data that passed from the server side.
                        sendPostRequest("/checkout", details).then(res => {
                            // redirect and refresh
                            //console.log(res);
                            if (res.data.msg == "payment-success") {
                                window.location.href = "/thankyou";
                            }
                        });
                    } else {
                        console.error(
                            "Something went wrong with payment. Please try again later"
                        );
                    }
                });

                //console.log(actions);
            }
        })
        .render("#paypal-button-container");
    //This function displays Smart Payment Buttons on your web page.
};

paypalButton();
