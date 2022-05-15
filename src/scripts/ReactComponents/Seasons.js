import React, { Component } from "react";

export class Seasons extends Component {
  render() {
    const { seasons } = this.props;

    console.log("seasons page  ");
    console.log(seasons);
    return <div>hi</div>;
  }
}

export default Seasons;
