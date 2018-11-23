import * as Axios from "axios";
import React, { Component } from "react";
import ReactDOM from "react-dom";
import * as toastr from "toastr";
import FormButton from "./FormButton.jsx";

export default class DeleteProductTypes extends Component {
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
    toastr.info("Deleting Product Types...");

    Axios({
      url: wtt_values.ajax_url,
      data: {
        security: wtt_values.wtt_key_value,
        action: "delete_product_types",
        submit_data: this.state.wtt_product_types
      },
      method: "POST"
    })
      .then(res => {
        console.log(res.data);
        toastr.success(res.data.response);
        this.setState({ results: res.data.output });
      })
      .catch(error => {
        console.log(error);
        toastr.error(error);
      });

    e.preventDefault();
  }

  getMoreTypes() {
    // tell the user what is going on
    // toastr.info("Fetching new Product Types...");
    // Axios({
    //   url: wtt_values.ajax_url,
    //   data: {
    //     security: wtt_values.wtt_key_value,
    //     action: "get_product_types"
    //   },
    //   method: "POST"
    // })
    //   .then(res => {
    //     // console.log(res.data);
    //     toastr.success("Product Types Fetched Successfully");
    //     this.setState({ resulttypes: res.data });
    //   })
    //   .catch(error => console.log(error));
  }

  render() {
    // const listVal = this.state.resulttypes;

    return (
      <>
        <FormButton
          more_button="Get More Product Types"
          submit_button="Delete Product Type"
          title="Weed Product Types"
          description="Use the Form Below to delete all product types you dont like"
          {/* resulttypes={listVal} */}
          onClick={this.getMoreTypes}
          onSubmit={this.submitForm}
          onChange={this.handleInputChange}
        />
        {/* {this.state.output} */}
      </>
    );
  }
}

if (document.getElementById("delete-product-types-app")) {
  ReactDOM.render(
    <DeleteProductTypes />,
    document.getElementById("delete-product-types-app")
  );
}
