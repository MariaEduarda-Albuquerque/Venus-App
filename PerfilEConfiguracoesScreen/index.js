import { Redirect } from 'expo-router';

export default function Index() {
  // Redireciona a tela inicial diretamente para a sua tela de Perfil
  return <Redirect href="/Screens/Perfil/perfil" />;
}