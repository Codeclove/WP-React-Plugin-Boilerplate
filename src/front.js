import React from 'react';
import ReactDOM from 'react-dom';
// import css from './front/scss/front.scss';
import reactFront from './front/react-front/scss/react-front.scss';
import ReactFront from './front/react-front/App';

document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('#react-front')) {
    ReactDOM.render(
      <ReactFront />,
      document.querySelector('#react-front'),
    );
  }
});
console.log('Hello front');
