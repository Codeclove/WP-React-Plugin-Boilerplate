import React from 'react';
import ReactDOM from 'react-dom';

import SettingsApp from './react-admin/App';
import MetaboxApp from './react-cpt-metabox/App';
import ReactSimpleApp from './react-simple/App';

// eslint-disable-next-line no-unused-vars
import reactAdmin from './react-admin/scss/react-admin.scss';
// eslint-disable-next-line no-unused-vars
import reactCptMetabox from './react-cpt-metabox/scss/react-cpt-metabox.scss';

export default function reactAdminInit() {
  if (document.querySelector('#test-plugin-admin-simple')) {
    ReactDOM.render(
      <ReactSimpleApp />,
      document.querySelector('#test-plugin-admin-simple'),
    );
  }
  if (document.querySelector('#test-plugin-admin')) {
    ReactDOM.render(
      <SettingsApp />,
      document.querySelector('#test-plugin-admin'),
    );
  }
  if (document.querySelector('#test-plugin-cpt-metabox')) {
    ReactDOM.render(
      <MetaboxApp />,
      document.querySelector('#test-plugin-cpt-metabox'),
    );
  }
}
