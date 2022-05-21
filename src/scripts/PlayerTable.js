import axios from "axios";

class PlayerTable {
  constructor() {
    this.mainTable = document.getElementById("player-table");
    this.spinner = document.getElementById("spinner");
    axios.defaults.headers.common["X-WP-Nonce"] = playerData.nonce;

    console.log(this.spinner);

    if (this.mainTable) {
      this.isLoaded = false;
      this.pageLoad();
      this.events();
    }
  }

  events() {}

  async pageLoad() {
    this.set_loading();
    const response = await axios
      .get(playerData.root_url + "/wp-json/bbj/v1/player_info/")
      .then(res => {
        this.close_load();

        this.build_table(res.data);
      })
      .catch(error => console.log(error));

    console.log(this.data);
  }

  build_table(data) {
    console.log(data);

    this.mainTable.innerHTML = `
    <div class="pt-player-card-contain">
      ${data
        .map(
          p => `
        <a href="${p.player_link}">
          <div class="pt-player-card">
          
          <div class="pt-player-card-img"><img src="${p.profile}" alt="${p.first_name} ${p.last_name} player card"></div>
          <div class="pt-player-card-info">

            <div class="pt-header"><h3>${p.first_name}</h3><h2>${p.last_name}</h2>
              <h4>${p.season}<span> (${p.finished} place)</span></h4>
            </div>
            <div class="pt-body">
              <div>Age</div>
              <div>${p.then_age}</div>
              <div>Age <span>(now)</span></div>
              <div>${p.current_age}</div>
              <div>Location</div>
              <div>${p.location}</div>

            </div>

            
          </div>
          <div class="pt-player-card-bottom">
            <div class="pt-stats">
              <div class="pt-stats-header">Season Stats</div>
              <div class="pt-stats-body">
                <div class="pt-stats-hd">HOH</div>   
                <div class="pt-stats-hd">POV</div>
                <div class="pt-stats-hd">NOM</div>
                <div class="pt-stats-hd">MISC</div>
                <div class="pt-stats-hd">SAVED</div>
                <div class="pt-stats-bd">${p.hoh_wins}</div>             
                <div class="pt-stats-bd">${p.pov_wins}</div>
                <div class="pt-stats-bd">${p.nom}</div>
                <div class="pt-stats-bd">${p.misc_wins}</div>
                <div class="pt-stats-bd">${p.saved}</div>
              </div>

            </div>
          </div>
        </div>

        </a>

      `
        )
        .join("")}
    </div>`;
  }

  set_loading() {
    this.spinner.style.display = "block";
  }

  close_load() {
    this.spinner.style.display = "none";
  }
}

export default PlayerTable;

// <div class="pt-player-card">
//         <div class="pt-player-card-img"><img src="http://bbj3.local/wp-content/uploads/2022/04/bb23_brandon_800x1000.jpg" alt=""></div>
//         <div class="pt-player-card-info">

//           <div class="pt-header"><h3>First Name</h3><h2>Last Name</h2>
//             <h4>Big Brother 21 <span>(6th place)</span></h4>
//           </div>
//           <div class="pt-body">
//             <div>Age</div>
//             <div>21</div>
//             <div>Age <span>(now)</span></div>
//             <div>21</div>
//             <div>Location</div>
//             <div>21</div>

//           </div>

//         </div>
//         <div class="pt-player-card-bottom">
//           <div class="pt-stats">
//             <div class="pt-stats-header">Season Stats</div>
//             <div class="pt-stats-body">
//               <div class="pt-stats-hd">HOH</div>
//               <div class="pt-stats-hd">POV</div>
//               <div class="pt-stats-hd">NOM</div>
//               <div class="pt-stats-hd">MISC</div>
//               <div class="pt-stats-hd">SAVED</div>
//               <div class="pt-stats-bd">2</div>
//               <div class="pt-stats-bd">2</div>
//               <div class="pt-stats-bd">2</div>
//               <div class="pt-stats-bd">0</div>
//               <div class="pt-stats-bd">3</div>
//             </div>

//           </div>
//         </div>
//       </div>
// <div class="pt-main">

//   <div class="pt-main-header"></div>
//   <div class="pt-main-header">First Name</div>
//   <div class="pt-main-header">Last Name</div>
//   <div class="pt-main-header">Nickname</div>

//   ${data
//     .map(
//       p => `
//   <div class="pt-inner profile-picture"><a href="${p.player_link}"><img src="${p.profile}"></a></div>
//   <div class="pt-inner">${p.first_name}</div>
//   <div class="pt-inner">${p.last_name}</div>
//   <div class="pt-inner">${p.first_name}</div>
//   `
//     )
//     .join("")}

// </div>
// `;
