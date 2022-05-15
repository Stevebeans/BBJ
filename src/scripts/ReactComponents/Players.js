import React, { Component } from "react";
import PropTypes from "prop-types";
import axios from "axios";

export class Players extends Component {
  static propTypes = {
    player: PropTypes.object.isRequired
  };

  componentDidMount() {
    const { player } = this.props;
  }

  render() {
    const { player } = this.props;
    console.log(player);

    //onst seasonsPlayed = player.seasons.map(player => player.pick_seasons);

    return (
      <React.Fragment>
        <tr></tr>
      </React.Fragment>
    );
  }
}

export default Players;
