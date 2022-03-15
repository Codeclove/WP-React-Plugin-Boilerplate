const config = {
  //wordpress project dev url
  proxyUrl: 'http://plugins.local',
  sourcePaths: {
    front: ['@babel/polyfill', './src/front.js'],
    admin: ['@babel/polyfill', './src/admin.js'],

    // react: ["@babel/polyfill", "./src/react.tsx"],
  },
};

module.exports = config;
