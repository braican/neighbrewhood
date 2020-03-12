module.exports = {
  pwa: {
    iconPaths: {
      favicon32: 'img/icons/icon-72x72.png',
      favicon16: 'img/icons/icon-72x72.png',
      appleTouchIcon: 'img/icons/icon-152x152.png',
      maskIcon: 'img/icons/icon.svg',
      msTileImage: 'img/icons/icon-144x144.png',
    },
  },
  devServer: {
    proxy: {
      '^/.netlify/functions': {
        target: 'http://localhost:34567',
      },
    },
  },
  chainWebpack: config => {
    const svgRule = config.module.rule('svg');

    svgRule.uses.clear();

    svgRule
      .use('babel-loader')
      .loader('babel-loader')
      .end()
      .use('vue-svg-loader')
      .loader('vue-svg-loader');
  },
};
