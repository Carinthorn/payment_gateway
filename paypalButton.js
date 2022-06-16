paypal.Button.render({
    env: "sandbox",
    style: {
      size: "small",
      color: "gold",
      shape: "pill",
    },
  
    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [
          {
            amount: {
              total: "50",
              currency: "USD",
              //value: "50",
            },
          },
        ],
      });
    },
  
    onApprove: function (data, actions) {
      return actions.order.capture().then(function (details) {
        console.log(details);
        var transaction = orderData.purchase_units[0].payments.captures[0];
        alert(
          "Transaction" +
            transaction.status +
            ":" +
            transaction.id +
            "\n\nSee console for all available details"
        );
        window.location.replace("http://localhost:8888/payment_gateway");
      });
    },
  
    onCancel: function (data) {
      window.location.replace("http://localhost:8888/payment_gateway");
    },
  });
  //.render("body");
  
  