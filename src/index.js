import "./assets/css/main.scss";

//import ExampleReactComponent from "./scripts/ExampleReactComponent";
import MobileDrop from "./scripts/MobileDrop";
//import React from "react";
//import ReactDOM from "react-dom";
import SpoilerBar from "./scripts/SpoilerBar";
import PlayerArchive from "./scripts/PlayerArchive";
import React from "react";
import ReactDOM from "react-dom";

const mobileDrop = new MobileDrop();
const spoilerBar = new SpoilerBar();

ReactDOM.render(<PlayerArchive />, document.querySelector("#player-table"));
