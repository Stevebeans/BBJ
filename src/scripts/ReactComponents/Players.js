import React, { Component } from "react";
import PropTypes from "prop-types";
import axios from "axios";

export class Players extends Component {
  static propTypes = {
    player: PropTypes.object.isRequired
  };

  componentDidMount() {
    const { player } = this.props;

    console.log(player);

    const getSeason = axios.get(`/wp-json/wp/v2/bigbrother-seasons/`);
  }

  render() {
    const { player } = this.props;

    const seasonsPlayed = player.seasons.map(player => player.pick_seasons);

    return (
      <React.Fragment>
        <tr>
          <td>{player.first_name}</td>
          <td>{player.last_name}</td>
          <td>{seasonsPlayed}</td>
        </tr>
      </React.Fragment>
    );
  }
}

export default Players;
