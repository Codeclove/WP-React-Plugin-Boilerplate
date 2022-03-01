import React from 'react';
import ReactDOM from 'react-dom';
// import admin from './admin/scss/admin.scss';
import App from './admin/react-admin/App';

document.addEventListener('DOMContentLoaded', () => {
  ReactDOM.render(<App />, document.querySelector('#react-admin'));
});

console.log('Hello admin');
