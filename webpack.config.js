// using the imports
const webpack = require("webpack");
const autoprefixer = require("autoprefixer");
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

// helpers
const helpers = function(args) {
  args = Array.prototype.slice.call(arguments, 0);
  return path.join.apply(path, [__dirname].concat("./", ...args));
};

// environment setups
const APP_DIR = helpers("./assets/src");
const BUILD_DIR = helpers("./assets/dist");
const NODE_ENV = process.env.NODE_ENV;
const isProd = NODE_ENV === "production";

// compilation proper
const config = {
  entry: {
    "css/weed-the-types": [APP_DIR + "/scss/weed-the-types.scss"],
    "js/weed-the-types": [APP_DIR + "/js/weed-the-types.js"]
  },
  output: {
    path: BUILD_DIR,
    filename: "[name].min.js"
  },
  module: {
    rules: [
      // JS react files
      {
        test: /\.(jsx|js)$/,
        include: APP_DIR,
        exclude: /node_modules/,
        loader: "babel-loader"
      },
      // SCSS files
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          isProd ? "style-loader" : MiniCssExtractPlugin.loader,
          {
            loader: "css-loader",
            options: {
              sourceMap: true,
              importLoaders: 1
            }
          },
          {
            loader: "postcss-loader",
            options: {
              plugins: () => [
                autoprefixer({
                  browsers: ["> 1%", "last 2 versions"]
                })
              ]
            }
          },
          "sass-loader"
        ]
      }
    ]
  },
  plugins: [
    new webpack.DefinePlugin({
      "process.env": {
        NODE_ENV: JSON.stringify(NODE_ENV)
      }
    }),
    new MiniCssExtractPlugin({
      filename: "[name].min.css",
      chunkFilename: "[id].[hash].min.css"
    })
  ]
};

module.exports = config;
