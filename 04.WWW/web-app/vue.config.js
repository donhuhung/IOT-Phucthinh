const dotenv = require('dotenv')
dotenv.config()
module.exports = {
  publicPath: process.env.NODE_ENV === 'production'
    ? '/phucthinh/'
    : '/',
  filenameHashing: true,
  runtimeCompiler: true,
  configureWebpack: {
    devtool: 'source-map',
    output: {
      filename: () => 'js/[name].[hash:16].js',
      chunkFilename: 'js/[name].[hash:16].js',
    },
    resolve: {
      extensions: ['.js', '.vue', '.json'],
    },
    plugins: [
      // new VuetifyLoaderPlugin(),
    ],
  },
  transpileDependencies: [
    'vuetify'
  ]
}
