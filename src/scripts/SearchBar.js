class SearchBar {
  constructor() {
    this.searchBar = document.querySelector("#bbj_search");
    this.overLay = document.querySelector(".search-dropdown");
    this.searchLayerOpen = false;
    this.events();
  }

  events() {
    this.searchBar.addEventListener("click", e => this.open_overlay(e));
    window.addEventListener("click", e => this.close_overlay(e));
    window.addEventListener("keydown", e => this.close_overlay(e));
  }

  // Open the search overlay
  open_overlay(e) {
    if (this.searchLayerOpen == false) {
      this.overLay.classList.add("search-drop-active");
      this.searchLayerOpen = true;
      console.log("open");
    }
  }

  close_overlay(e) {
    var isEscape = false;
    if ("key" in e) {
      isEscape = e.key === "Escape" || e.key === "Esc";
    } else {
      isEscape = e.keyCode === 27;
    }

    if (this.searchLayerOpen) {
      if ((e.target !== this.searchBar && e.target !== this.overLay) || isEscape) {
        this.overLay.classList.remove("search-drop-active");
        this.searchLayerOpen = false;
      }
    }
  }
}

export default SearchBar;
