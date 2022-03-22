const config = {
  //wordpress project dev url
  proxyUrl: 'http://plugins.local',
  sourcePaths: {
    front: ['./src/front.js'],
    admin: ['./src/admin.js'],

    // react: ["@babel/polyfill", "./src/react.tsx"],
  },
};

module.exports = config;
