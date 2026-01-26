<div id="dropin-container"></div>

<script src="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/5.0.0/adyen.js"></script>
<link rel="stylesheet" href="https://checkoutshopper-test.adyen.com/checkoutshopper/sdk/5.0.0/adyen.css"/>

<script>
fetch("create-session.php")
.then(res => res.json())
.then(session => {
    const checkout = new AdyenCheckout({
        environment: "test",
        clientKey: "test_B5UABBAMURG2NBLNT6S2JVF6NUK4EHTJ", // Client Key de test
        session: {
            id: session.id,
            sessionData: session.sessionData
        }
    });

    checkout.create("dropin").mount("#dropin-container");
});
</script>
