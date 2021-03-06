import fs                 from 'fs';
import path               from 'path';
import CopyWebpackPlugin  from 'copy-webpack-plugin';
import BrowserSyncPlugin  from 'browser-sync-webpack-plugin';
import ZipPlugin          from 'zip-webpack-plugin';
import webpack            from 'webpack';

const isProd = process.env.NODE_ENV === 'production';

//////////////////////// FILEPATH ///////////////////////
/////////////////////////////////////////////////////////

const buildFolder  = 'dist',
      sourceFolder = 'src',
      PATHS = {
        build        : path.resolve(__dirname, buildFolder),
        src          : path.resolve(__dirname, sourceFolder),
        node_modules : path.resolve(__dirname, 'node_modules'),
        index        : path.resolve(__dirname, `${sourceFolder}/js/login.js`),
        zipped       : path.join(__dirname, buildFolder),

      };

//////////////////////// PLUGINS ////////////////////////
/////////////////////////////////////////////////////////

const  globalsPlugin = new webpack.DefinePlugin({
  __DEV__: JSON.stringify(JSON.parse(process.env.BUILD_DEV || 'true')),
  'process.env': { 'NODE_ENV': JSON.stringify('development') }
});

const CopyWebpackPluginOptions = ([
  // {from: path.resolve(__dirname, 'src/php') + '/**',
  //    to: buildFolder},
  {from: path.resolve(__dirname, 'src/wp-uport.php'),
     to: buildFolder},
   ],
   {copyUnmodified: true}
);

const ZipPluginOptions = {
  filename: 'wp-uport.zip',
  pathPrefix: 'relative/path',
  zipOptions: {forceZip64Format: false}
};

const devServerOptions = {
  contentBase: PATHS.build,
  compress: true,
  port: 8080,
  stats: 'errors-only',
  open: true,
  hot: false,
  openPage: ''
};

const pluginsDev = [
  new webpack.HotModuleReplacementPlugin(),
  new CopyWebpackPlugin([CopyWebpackPluginOptions]),
  new ZipPlugin(ZipPluginOptions)
];

const pluginsProd = [
  new CopyWebpackPlugin([CopyWebpackPluginOptions]),
  new ZipPlugin(ZipPluginOptions)
];

var pluginsList = isProd ? pluginsProd : pluginsDev;

//////////////////////// LOADERS ////////////////////////
/////////////////////////////////////////////////////////

const javascript = [
  {
    test: /\.(js|jsx)$/,
    exclude: PATHS.node_modules,
    loader: 'babel-loader'
  },
  // {
  //   test: /\.json$/,
  //   loader: 'json-loader'
  // },
];


//////////////////////// WEBPACK ////////////////////////
/////////////////////////////////////////////////////////

let libraryName = 'wp-uport'

const webpackConfig = {
  mode: 'development',
  entry: PATHS.index,
  output:  {
    library: libraryName,
    libraryTarget: 'umd',
    umdNamedDefine: true,
    path: PATHS.zipped,
    filename: 'wp_uport.js' //this will change
  },
  module: {
    rules: javascript
  },
  resolve: {
    modules: [PATHS.src, 'node_modules'],
    // extensions: ['.js', '.json']
  },
  node: {
    console: false,
    fs: 'empty',
    net: 'empty',
    tls: 'empty'
  },
  devtool: 'source-map',
  devServer: devServerOptions,
  plugins: pluginsList
};

export default webpackConfig;
