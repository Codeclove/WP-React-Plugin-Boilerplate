import React, { createContext, useState } from 'react';
import './scss/react-cpt-metabox.scss';
import Message from './components/Message';
import MetaSettingsForm from './components/MetaSettingsForm';

export const Context = createContext();
const { t } = wpApiSettings;

export default function App() {
  const [message, setMessage] = useState(null);
  return (
    <Context.Provider value={t}>
      <div className="admin-post-settings">
        <Message message={message} />
        <MetaSettingsForm setMessage={setMessage} />
      </div>
    </Context.Provider>
  );
}
