import "./assets/css/main.scss";
import "flowbite";

import SearchBar from "./scripts/SearchBar";

//import ExampleReactComponent from "./scripts/ExampleReactComponent";
import MobileDrop from "./scripts/MobileDrop";
//import React from "react";
//import ReactDOM from "react-dom";
import SpoilerBar from "./scripts/SpoilerBar";
import SpoilerBarNew from "./scripts/SpoilerBarNew";
//import PlayerArchive from "./scripts/PlayerArchive";
import PlayerTable from "./scripts/PlayerTable";
import { permission_check } from "./scripts/Permissions";
import { feed_update_slider } from "./scripts/FeedUpdateBar";

import React from "react";
import ReactDOM from "react-dom";

//const searchBar = new SearchBar(); back burner for now
const mobileDrop = new MobileDrop();
const spoilerBar = new SpoilerBarNew();
const playerTable = new PlayerTable();
permission_check();
feed_update_slider();

console.log("js-loaded");

//ReactDOM.render(<PlayerArchive />, document.querySelector("#player-table"));
