import { Image, ImageBackground, ScrollView, Text, TouchableOpacity, View } from 'react-native';
import { useRouter } from 'expo-router';

import iconAdicionarConta from '@/assets/icons/adicionarconta.png';
import iconDesconectar from '@/assets/icons/desconectar.png';
import iconEditarPerfil from '@/assets/icons/editarperfil.png';
import iconEmail from '@/assets/icons/email.png';
import iconExcluir from '@/assets/icons/excluir.png';
import fundoSuperiorTelas from '@/assets/icons/fundosuperiortelas.png';
import perfilTopo from '@/assets/icons/perfiltopo.png';
import { styles } from './style';

export default function ConfiConta() {
  const router = useRouter();

  const opcoes = [
    { id: '1', titulo: 'Endereço de email', icon: iconEmail },
    { id: '2', titulo: 'Editar Perfil', icon: iconEditarPerfil, route: '/Screens/EditarPerfil/editarperfil' },
    { id: '3', titulo: 'Adicionar Conta', icon: iconAdicionarConta },
    { id: '4', titulo: 'Excluir conta', icon: iconExcluir },
    { id: '5', titulo: 'Desconectar', icon: iconDesconectar },
  ];

  return (
    <ScrollView style={styles.container}>
      <ImageBackground source={fundoSuperiorTelas} style={styles.header} resizeMode="cover">
        <View style={styles.topRow}>
          <TouchableOpacity style={styles.backButton} onPress={() => router.back()}>
            <Text style={styles.backArrow}>←</Text>
          </TouchableOpacity>
          <Image source={perfilTopo} style={styles.topImage} />
        </View>
        <Text style={styles.title}>Conta</Text>
      </ImageBackground>

      <View style={styles.menuList}>
        {opcoes.map((item) => (
          <TouchableOpacity
            key={item.id}
            style={styles.menuItem}
            onPress={() => item.route && router.push(item.route)}
          >
            <Image source={item.icon} style={styles.menuIcon} />
            <Text style={styles.menuTitle}>{item.titulo}</Text>
          </TouchableOpacity>
        ))}
      </View>
    </ScrollView>
  );
}