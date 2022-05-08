import React, { Component } from "react";
import PropTypes from "prop-types";
import axios from "axios";

export class Players extends Component {
  static propTypes = {
    player: PropTypes.object.isRequired
  };

  componentDidMount() {
    const { meta_box } = this.props.player;

    const getSeason = axios.get(`/wp-json/wp/v2/bigbrother-seasons/`);
  }

  render() {
    const { meta_box } = this.props.player;

    console.log(this.props.player);

    return (
      <React.Fragment>
        <tr>
          <td>{meta_box.first_name}</td>
          <td>{meta_box.last_name}</td>
        </tr>
      </React.Fragment>
    );
  }
}

export default Players;
