import admin from './admin/scss/admin.scss';

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import App from './admin/react-admin/App';

document.addEventListener('DOMContentLoaded', function (event) {
  ReactDOM.render(<App />, document.querySelector('#react-admin'));
});

console.log('Hello admin');
