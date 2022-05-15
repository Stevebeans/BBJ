import React, { Component } from "react";
import Seasons from "./Seasons";
import PropTypes from "prop-types";
import axios from "axios";

export class Players extends Component {
  componentDidMount() {}

  render() {
    const { player } = this.props;
    const seasons = player.seasons;

    //[seasons].map(season => console.log(season));

    //console.log(seasons);

    //seasons.map(season => console.log(season));

    //console.log(player.seasons);
    //console.log(player);
    /// player.map(play => console.log(play.first_name));

    //onst seasonsPlayed = player.seasons.map(player => player.pick_seasons);

    return (
      <React.Fragment>
        <tr>
          <td>{player.first_name}</td>
          <td>{player.last_name}</td>
          <td>
            {[seasons].map(season => (
              <Seasons season={season} />
            ))}
          </td>
        </tr>
      </React.Fragment>
    );
  }
}

export default Players;
