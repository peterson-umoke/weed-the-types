import React, { Component } from "react";

export class FormButton extends Component {
  static defaultProps = {
    more_button: "get more button",
    title: "Title is needed here",
    description: "description is here",
    resulttypes: [],
    submit_button: "submit button"
  };

  constructor(props) {
    super(props);
  }

  render() {
    const listVal = this.props.resulttypes.map(res => (
      <option value={res.slug} key={res.slug.toString()}>
        {res.name}
      </option>
    ));

    return (
      <div>
        <h1>{this.props.title}</h1>
        <h4> {this.props.description}</h4>

        <hr />

        <form onSubmit={this.props.onSubmit}>
          <div className="dropdown-select-p-text wtt-text-wrapper" />
          <div className="wtt-wrapper">
            <input
              type="text"
              name="wtt_product_types"
              id="wtt-product-types"
              value={this.props.wtt_product_types}
              onChange={this.props.onChange}
              autoComplete="off"
            />
            {/* <select
              name="wtt_product_types"
              id="wtt-product-types"
              value={this.props.wtt_product_types}
              onChange={this.props.onChange}
            >
              <option value="">---</option>
              {listVal}
            </select> */}
          </div>
          <div className="wtt-wrapper">
            {/* <button
              type="button"
              onClick={this.props.onClick}
              className="wtt-btn"
            >
              {this.props.more_button}
            </button> */}
            {/* <button type="submit" className="wtt-btn"> */}
            <button type="submit" className="button btn-lg-wt">
              {this.props.submit_button}
            </button>
          </div>
        </form>
      </div>
    );
  }
}

export default FormButton;
