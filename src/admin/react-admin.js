import React from 'react';
import { createRoot } from 'react-dom/client';

import SettingsApp from './react-admin/App';
import MetaboxApp from './react-cpt-metabox/App';
import ReactSimpleApp from './react-simple/App';

// eslint-disable-next-line no-unused-vars
import reactAdmin from './react-admin/scss/react-admin.scss';
// eslint-disable-next-line no-unused-vars
import reactCptMetabox from './react-cpt-metabox/scss/react-cpt-metabox.scss';

export default function reactAdminInit() {
  if (document.querySelector('#test-plugin-admin-simple')) {
    const rootElement = document.getElementById(
      'test-plugin-admin-simple',
    );
    const root = createRoot(rootElement);
    root.render(<ReactSimpleApp />);
  }
  if (document.querySelector('#test-plugin-admin')) {
    const rootElement = document.getElementById('test-plugin-admin');
    const root = createRoot(rootElement);
    root.render(<SettingsApp />);
  }
  if (document.querySelector('#test-plugin-cpt-metabox')) {
    const rootElement = document.getElementById(
      'test-plugin-cpt-metabox',
    );
    const root = createRoot(rootElement);
    root.render(<MetaboxApp />);
  }
}
