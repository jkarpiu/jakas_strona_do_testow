const mix = require('laravel-mix');

mix
  .js("resources/js/app.js", "public/js")
  .sass("resources/sass/app.scss", "public/css")
  .webpackConfig({
    module: {
      rules: [
        {
          test: /\.tsx?$/,
          options: { appendTsSuffixTo: [/\.vue$/] },
          loader: "ts-loader",
          exclude: /node_modules/
        }
      ]
    },
    resolve: {
      extensions: ["*", ".js", ".jsx", ".vue", ".ts", ".tsx"]
    }
  });