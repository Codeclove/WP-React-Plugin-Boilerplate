import React, { useState } from 'react';
import AdminSettingsForm from './AdminSettingsForm';
import Message from './Message';

export default function SettingsPage() {
  const [message, setMessage] = useState(null);
  return (
    <div className="admin-post-settings">
      <Message message={message} />
      <AdminSettingsForm setMessage={setMessage} />
    </div>
  );
}
