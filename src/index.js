import "./assets/css/main.scss";
import "flowbite";
import React from "react";
import ReactDOM from "react-dom";
import PlayerTableReact from "./scripts/PlayerTableReact";
import CommentSystem from "./scripts/ReactComments";
import BBJSearch from "./scripts/SearchBar";

import SearchBar from "./scripts/SearchBar";

//import ExampleReactComponent from "./scripts/ExampleReactComponent";
//import MobileDrop from "./scripts/MobileDrop";
//import React from "react";
//import ReactDOM from "react-dom";
import SpoilerBar from "./scripts/SpoilerBar";
import SpoilerBarNew from "./scripts/SpoilerBarNew";
//import PlayerArchive from "./scripts/PlayerArchive";
import PlayerTable from "./scripts/PlayerTable";
import { permission_check } from "./scripts/Permissions";
import { feed_update_slider } from "./scripts/FeedUpdateBar";
import DarkMode from "./scripts/DarkMode";
import FeedUpdates from "./scripts/FeedUpdates";
import PaymentModel from "./scripts/PaymentModel";

const playerTableEl = document.getElementById("player-directory-table");
const commentEl = document.getElementById("bbj-comment-system");
const searchBar = document.getElementById("bbj-search");
const feedUpdates = document.getElementById("new-feed-updates");
const paymentForm = document.getElementById("payment-options");
const mainBody = document.querySelector("#main-body");
const updateBox = document.querySelector("#update-box");

if (paymentForm) {
  let paymentModel = new PaymentModel();
}

if (feedUpdates) {
  ReactDOM.render(<FeedUpdates />, feedUpdates);
}

if (updateBox) {
  feed_update_slider();
}

if (searchBar) {
  let searchBar = new BBJSearch();
}

if (playerTableEl) {
  ReactDOM.render(<PlayerTableReact />, playerTableEl);
}

if (commentEl) {
  //ReactDOM.render(<CommentSystem />, commentEl);
}

//const searchBar = new SearchBar(); back burner for now
//const mobileDrop = new MobileDrop();
const spoilerBar = new SpoilerBarNew();
const playerTable = new PlayerTable();

const darkMode = new DarkMode();
permission_check();

console.log("js-loaded");

//ReactDOM.render(<PlayerArchive />, document.querySelector("#player-table"));
