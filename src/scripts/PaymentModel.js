class PaymentModel {
  constructor() {
    this.paymentForm = document.getElementById("payment-options");

    this.events();
  }

  events() {
    const selectItems = this.paymentForm.querySelectorAll(".select-option");

    selectItems.forEach(item => {
      console.log(item);
      item.addEventListener("click", e => {
        console.log(e.target);
        this.chooseItem(e);
      });
    });
  }

  chooseItem(e) {
    // Get the clicked item and its data-plan-type value
    const selectedItem = e.target.closest(".select-option");
    const planType = selectedItem.getAttribute("data-plan-type");

    // Find the input fields with the IDs 'field_plan-type' and 'plan_stripe-plan-type', and update their values
    const inputFieldPlanType = this.paymentForm.querySelector("#field_plan-type");
    const inputStripePlanType = this.paymentForm.querySelector("#field_stripe-plan-type");

    inputFieldPlanType.value = planType;
    inputStripePlanType.value = planType;
  }
}

export default PaymentModel;
