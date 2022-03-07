import React from 'react';
import ReactDOM from 'react-dom';
import admin from './admin/scss/admin.scss';
import reactAdmin from './admin/react-admin/scss/react-admin.scss';
import reactCptMetabox from './admin/react-cpt-metabox/scss/react-cpt-metabox.scss';
import SettingsApp from './admin/react-admin/App';
import MetaboxApp from './admin/react-cpt-metabox/App';

document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('#react-admin')) {
    ReactDOM.render(
      <SettingsApp />,
      document.querySelector('#react-admin'),
    );
  }
  if (document.querySelector('#react-cpt-metabox')) {
    ReactDOM.render(
      <MetaboxApp />,
      document.querySelector('#react-cpt-metabox'),
    );
  }
});

console.log('Hello admin');
