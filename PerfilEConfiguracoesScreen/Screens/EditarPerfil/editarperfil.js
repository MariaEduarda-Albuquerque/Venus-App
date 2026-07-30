import { Image, ImageBackground, ScrollView, Text, TouchableOpacity, View } from 'react-native';
import { useRouter } from 'expo-router';

import iconCameraPerfil from '@/assets/icons/cameraperfil.png';
import iconConfig from '@/assets/icons/configeditarperfil.png';
import fundoEditarPerfil from '@/assets/icons/fundoeditarperfil.png';

import iconAprender from '@/assets/icons/aprenderperfil.png';
import iconHome from '@/assets/icons/homeperfil.png';
import iconMapaSUS from '@/assets/icons/mapasus.png';
import iconMensagens from '@/assets/icons/mensagensperfil.png';
import iconPerfilNav from '@/assets/icons/perfil.png';

import { styles } from './style';

export default function EditarPerfil() {
  const router = useRouter();

  const campos = [
    'Editar Nome',
    'Editar Nome de usuário',
    'Editar Biografia',
    'Adicionar Link',
    'Adicionar Pronomes',
  ];

  const handleBack = () => {
    if (router.canGoBack()) {
      router.back();
    } else {
      router.push('/Screens/Perfil/perfil');
    }
  };

  return (
    <View style={styles.mainContainer}>
      <ScrollView style={styles.container}>
        <ImageBackground source={fundoEditarPerfil} style={styles.headerImage} resizeMode="cover">
          <TouchableOpacity style={styles.backButton} onPress={handleBack}>
            <Text style={styles.backArrow}>←</Text>
          </TouchableOpacity>

          <TouchableOpacity
            style={styles.configButton}
            onPress={() => router.push('/Screens/Configuracoes/configuracoes')}
          >
            <Image source={iconConfig} style={styles.configIcon} />
          </TouchableOpacity>

          <TouchableOpacity style={styles.cameraBadge}>
            <Image source={iconCameraPerfil} style={{ width: 16, height: 16, resizeMode: 'contain' }} />
          </TouchableOpacity>
        </ImageBackground>

        <View style={styles.textsContainer}>
          <Text style={styles.userName}>Marina Silva</Text>
          <Text style={styles.userHandle}>@marinaslv</Text>
        </View>

        <View style={styles.formPanel}>
          {campos.map((item, index) => (
            <TouchableOpacity key={index} style={styles.inputCard}>
              <Text style={styles.inputText}>{item}</Text>
            </TouchableOpacity>
          ))}
        </View>
      </ScrollView>

      <View style={styles.bottomNav}>
        <TouchableOpacity style={styles.navItem}>
          <Image source={iconHome} style={styles.navIcon} />
          <Text style={styles.navLabel}>Home</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.navItem}>
          <Image source={iconAprender} style={styles.navIcon} />
          <Text style={styles.navLabel}>Aprender</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.navItem}>
          <Image source={iconMapaSUS} style={styles.navIcon} />
          <Text style={styles.navLabel}>Mapa SUS</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.navItem}>
          <Image source={iconMensagens} style={styles.navIcon} />
          <Text style={styles.navLabel}>Mensagens</Text>
        </TouchableOpacity>
        <TouchableOpacity style={styles.navItem} onPress={() => router.push('/Screens/Perfil/perfil')}>
          <Image source={iconPerfilNav} style={styles.navIcon} />
          <Text style={styles.navLabelActive}>Perfil</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
}