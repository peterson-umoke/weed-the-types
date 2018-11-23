import * as Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";
import * as toastr from "toastr";
import FormButton from "./FormButton.jsx";

export default class DeletePostTypes extends Component {
  constructor(props) {
    super(props);

    // set states
    this.state = { resulttypes: [] };

    // bind actions
    this.getMoreTypes = this.getMoreTypes.bind(this);
    this.submitForm = this.submitForm.bind(this);
    this.handleInputChange = this.handleInputChange.bind(this);

    // configurations
    toastr.options.positionClass = "toast-bottom-right";
  }

  componentDidMount() {
    this.getMoreTypes();
  }

  handleInputChange(event) {
    const target = event.target;
    const value = target.type === "checkbox" ? target.checked : target.value;
    const name = target.name;

    this.setState({
      [name]: value
    });
  }

  submitForm(e) {
    // doing action
    toastr.info("Deleting Post Types...");

    Axios({
      url: wtt_values.ajax_url,
      data: {
        security: wtt_values.wtt_key_value,
        action: "delete_post_types",
        submit_data: this.state.wtt_product_types
      },
      method: "POST"
    })
      .then(res => {
        console.log(res.data);
        toastr.success(res.data.response);
        this.setState({
          results: res.data.output
        });
      })
      .catch(error => {
        console.log(error);
        toastr.error(error);
      });

    e.preventDefault();
  }

  getMoreTypes() {
    // Axios({
    //   url: wtt_values.ajax_url,
    //   data: {
    //     security: wtt_values.wtt_key_value,
    //     action: "get_post_types"
    //   },
    //   method: "POST"
    // })
    //   .then(res => {
    //     this.setState({ resulttypes: res.data });
    //   })
    //   .catch(error => console.log(error));
  }

  render() {
    // const listVal = this.state.resulttypes;
    // const listVal2 =
    //   this.state.outputs_two !== ""
    //     ? this.state.log.map(res => <li key={res.toString()}>{res.name}</li>)
    //     : "";

    return (
      <>
        <FormButton
          more_button="Get More Post Types"
          submit_button="Delete Post Type"
          title="Weed Post Types"
          description="Use the Form Below to delete all Post types you dont like"
          {/* resulttypes={listVal} */}
          onClick={this.getMoreTypes}
          onSubmit={this.submitForm}
          onChange={this.handleInputChange}
        />
        {this.state.results}
      </>
    );
  }
}

if (document.getElementById("delete-post-types-app")) {
  ReactDOM.render(
    <DeletePostTypes />,
    document.getElementById("delete-post-types-app")
  );
}
