class SpoilerBar {
  constructor() {
    this.toggleButton = document.getElementById("toggleSpoiler");
    this.spoilerBar = jQuery(".spoilerBar");
    this.playerDiv = jQuery(".playerDiv");
    this.body = jQuery(".bodyContainer");
    //this.spoilerSet = window.localStorage;
    //this.showBar = window.localStorage("spoilerbar");

    //console.log(this.showBar);

    this.events();
  }

  events() {
    this.toggleButton.addEventListener("click", () => this.spoilerToggle());
  }

  spoilerToggle() {
    this.toggleButton.classList.toggle("fa-toggle-off");
    this.toggleButton.classList.toggle("fa-toggle-on");
    this.playerDiv.slideToggle();

    // Do an if statement and add padding if it's expanded
    //this.body.css("padding-top: 50px");
  }
}

export default SpoilerBar;
