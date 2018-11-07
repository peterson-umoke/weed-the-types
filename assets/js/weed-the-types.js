const Axios = require("axios");

/*=============================================
=            Set the Default Headers for Axios            =
=============================================*/

// Axios.defaults.headers.common['X-WP-Nonce'] = config.wp_nounce;
// Axios.defaults.baseURL = config.wp_url + "wp/v2/";
/**
 * @todo Find a better work around for this hack
 */
Axios.defaults.transformRequest = [
  function(data, headers) {
    const serializedData = [];

    for (const k in data) {
      if (data[k]) {
        serializedData.push(`${k}=${encodeURIComponent(data[k])}`);
      }
    }

    return serializedData.join("&");
  }
];

// import the delete post type module
require("./components/DeletePostTypes.jsx");

// impor the delete product type module
require("./components/DeleteProductTypes.jsx");
