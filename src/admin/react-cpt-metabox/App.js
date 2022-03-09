import React, { createContext } from 'react';
import './scss/react-cpt-metabox.scss';
import MetaboxPage from './components/MetaboxPage';

export const Context = createContext();
const { t } = wpApiSettings;

export default function App() {
  return (
    <Context.Provider value={t}>
      <MetaboxPage />
    </Context.Provider>
  );
}
