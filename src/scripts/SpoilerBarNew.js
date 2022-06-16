class SpoilerBarNew {
  constructor() {
    this.toggleButton = document.getElementById("toggleSpoiler");
    this.playerDiv = document.querySelector(".playerDiv");

    console.log("loaded");

    this.initial_state();
    this.events();
  }

  events() {
    this.toggleButton.addEventListener("click", e => this.spoiler_toggle(e));
  }

  spoiler_toggle(e) {
    console.log("click");
    const toggleCheck = localStorage.getItem("showbar");
    if (toggleCheck === "true") {
      console.log("toggletrue");
      this.toggleButton.classList.add("fa-toggle-off");
      this.toggleButton.classList.remove("fa-toggle-on");
      this.playerDiv.classList.add("player-div-hide");
      localStorage.setItem("showbar", false);
    } else if (toggleCheck === "false") {
      console.log("togglefalse");
      this.toggleButton.classList.remove("fa-toggle-off");
      this.toggleButton.classList.add("fa-toggle-on");

      this.playerDiv.classList.remove("player-div-hide");
      localStorage.setItem("showbar", true);
    }
  }

  // This sets initial value to true when viewers first visit
  initial_state() {
    const bar = localStorage.getItem("showbar");
    if (bar === null || bar === "undefined") {
      console.log("undefinefdsfd");
      localStorage.setItem("showbar", true);
    }

    const toggleCheck = localStorage.getItem("showbar");
    if (toggleCheck === "true") {
      console.log("opening true");
      this.toggleButton.classList.add("fa-toggle-on");
      this.toggleButton.classList.remove("fa-toggle-off");
      this.playerDiv.classList.remove("player-div-hide");
    } else if (toggleCheck === "false") {
      console.log("opening false");
      this.toggleButton.classList.remove("fa-toggle-on");
      this.toggleButton.classList.add("fa-toggle-off");
      this.playerDiv.classList.add("player-div-hide");
    }
  }
}

export default SpoilerBarNew;
