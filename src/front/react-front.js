import React from 'react';
import ReactDOM from 'react-dom';
import ReactFront from './react-front/App';

// eslint-disable-next-line no-unused-vars
import reactFront from './react-front/scss/react-front.scss';

export default function reactFrontInit() {
  if (document.querySelector('#test-plugin-front')) {
    ReactDOM.render(
      <ReactFront />,
      document.querySelector('#test-plugin-front'),
    );
  }
}
