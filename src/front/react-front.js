import React from 'react';
import { createRoot } from 'react-dom/client';
import ReactFront from './react-front/App';

// eslint-disable-next-line no-unused-vars
import reactFront from './react-front/scss/react-front.scss';

export default function reactFrontInit() {
  if (document.querySelector('#test-plugin-front')) {
    const rootElement = document.getElementById('test-plugin-front');
    const root = createRoot(rootElement);
    root.render(<ReactFront />);
  }
}
