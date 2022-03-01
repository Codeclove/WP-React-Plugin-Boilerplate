const path = require('path');
const TerserJSPlugin = require('terser-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const config = require('./config');

module.exports = {
  optimization: {
    minimizer: [
      new TerserJSPlugin({
        terserOptions: {
          format: {
            comments: false,
          },
        },
        extractComments: false,
      }),
      new CssMinimizerPlugin(),
    ],
  },
  plugins: [
    //Nastavenie vystupu pre css
    new MiniCssExtractPlugin({
      filename: ({ chunk }) => {
        if (chunk.name === 'front') {
          return '../assets/css/front.css';
        } else {
          return `./css/${chunk.name.replace('/js/', '/css/')}.css`;
        }
      },
    }),
    new BrowserSyncPlugin({
      // browse to http://localhost:3000/ during development,
      // ./public directory is being served
      files: '**/*.php',
      proxy: config.proxyUrl,
    }),
  ],
  module: {
    rules: [
      {
        enforce: 'pre',
        test: /\.(js|ts|tsx)$/,
        exclude: /node_modules/,
        loader: 'eslint-loader',
        options: {
          fix: true,
          parser: 'babel-eslint',
          extends: ['airbnb', 'prettier'],
          plugins: ['prettier'],
          //Pravidla su v subore .prettierrc
          rules: {
            'no-console': 'warn',
            'prettier/prettier': ['error'],
          },
        },
      },
      //Nastavenie babel loadera
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              [
                '@babel/preset-env',
                {
                  targets: {
                    esmodules: true,
                  },
                },
              ],
              '@babel/preset-react',
            ],
            plugins: [['@babel/plugin-proposal-class-properties']],
          },
        },
      },
      //Nastavenie postcss pre autoprefixer
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: { url: false, sourceMap: true },
          },
          {
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  [
                    require('autoprefixer')({
                      overrideBrowserslist: ['last 2 version'],
                    }),
                    {
                      // Options
                    },
                  ],
                ],
              },
            },
          },
          {
            loader: 'sass-loader',
          },
        ],
      },
      {
        test: /\.tsx?$/,
        use: 'ts-loader',
        exclude: /node_modules/,
      },
    ],
  },
  externals: {
    jquery: 'jQuery',
  },

  resolve: {
    extensions: ['.tsx', '.ts', '.js'],
  },
  //Nastavenie hlavnych js vstupov
  entry: config.sourcePaths,

  mode: 'development',
  //Enable read code for debugging
  devtool: 'inline-source-map',
  output: {
    path: path.resolve(__dirname, 'assets'),
    filename: 'js/[name].js',
  },
};
