class SpoilerBar {
  constructor() {
    this.toggleButton = document.getElementById("toggleSpoiler");
    this.spoilerBar = jQuery(".spoilerBar");
    this.playerDiv = jQuery(".playerDiv");
    this.body = jQuery(".bodyContainer");
    this.showBar = true;

    //this.spoilerSet = window.localStorage;
    //this.showBar = window.localStorage("spoilerbar");

    //console.log(this.showBar);

    this.initial_state();
    this.events();

    const buttonCheck = localStorage.getItem("showbar");
    console.log("button check1");
    console.log(buttonCheck);
  }

  events() {
    this.toggleButton.addEventListener("click", () => this.spoilerToggle());
  }

  initial_state() {
    if (localStorage.getItem("showbar") === null) {
      localStorage.setItem("showbar", this.showBar);
    } else {
      console.log("there is a setting");
    }
  }

  spoilerToggle() {
    const buttonCheck = localStorage.getItem("showbar");

    console.log("button check2");
    console.log(buttonCheck);

    if (buttonCheck === true) {
      this.toggleButton.classList.hide("fa-toggle-off");
      this.toggleButton.classList.show("fa-toggle-on");
      localStorage.setItem("showbar", false);
      this.playerDiv.hide();
      console.log("hide");

      console.log("button check3");
      console.log(buttonCheck);
    } else {
      console.log("whatever");

      this.toggleButton.classList.show("fa-toggle-off");
      this.toggleButton.classList.hide("fa-toggle-on");
    }
    // if (buttonCheck == false) {
    //   this.toggleButton.classList.toggle("fa-toggle-off");
    //   this.toggleButton.classList.toggle("fa-toggle-on");
    //   localStorage.setItem("showbar", true);
    //   this.playerDiv.show();
    //   console.log("show");
    //   console.log("button check3");
    //   console.log(buttonCheck);
    // }

    //this.playerDiv.slideToggle();

    // Do an if statement and add padding if it's expanded
    //this.body.css("padding-top: 50px");
  }
}

export default SpoilerBar;
