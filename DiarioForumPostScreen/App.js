import React, { useState } from 'react';
import DiarioScreen from './Diario/DiarioScreen';
import ForumScreen from './Forum/ForumScreen';
import PostarScreen from './Postar/PostarScreen';
import PostScreen from './Post/PostScreen';

export default function App() {
  const [tela, setTela] = useState('Diario');

  if (tela === 'Forum') {
    return <ForumScreen navegar={setTela} />;
  }

  if (tela === 'Postar') {
    return <PostarScreen navegar={setTela} />;
  }

  if (tela === 'Post') {
    return <PostScreen navegar={setTela} />;
  }

  return <DiarioScreen navegar={setTela} />;
}
