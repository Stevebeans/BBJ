import axios from "axios";

class PlayerTable {
  constructor() {
    this.mainTable = document.getElementById("player-table");
    axios.defaults.headers.common["X-WP-Nonce"] = playerData.nonce;

    if (this.mainTable) {
      this.isLoaded = false;
      this.pageLoad();
      console.log(this.data);
      this.events();
    }
  }

  events() {}

  async pageLoad() {
    const response = await axios.get(playerData.root_url + "/wp-json/bbj/v1/player_info/").catch(error => console.log(error));

    this.data = response.data;

    console.log(this.data);
  }
}

export default PlayerTable;
