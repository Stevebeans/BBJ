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
    console.log(this.searchLayerOpen);
    console.log(e.target);

    if (this.searchLayerOpen) {
      if (e.target.closest(this.searchBar)) {
        console.log("closest");
      }

      // if (e.target !== this.searchBar) {
      //   this.overLay.classList.remove("search-drop-active");
      //   this.searchLayerOpen = false;
      //   console.log("outside of search");
      // }
    }

    // console.log("clicsdfdsk");
    // this.overLay.classList.remove("search-drop-active");
    // this.searchLayerOpen = false;

    // if (this.searchLayerOpen) {
    //   //console.log("click");
    //   if (e.target.value != this.searchBar || e.target.value != this.overLay) {
    //     //this.overLay.classList.remove("search-drop-active");
    //     //console.log("clickck");
    //   }
    // }
    //this.searchLayerOpen = false;
  }
}

export default SearchBar;
