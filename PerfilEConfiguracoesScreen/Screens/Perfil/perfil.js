import { Image, ImageBackground, ScrollView, Text, TouchableOpacity, View } from 'react-native';
import { useRouter } from 'expo-router';

import iconCadeado from '@/assets/icons/cadeadoperfil.png';
import iconConfig from '@/assets/icons/config.png';
import iconCoracao from '@/assets/icons/coracaoperfil.png';
import iconEditPerfil from '@/assets/icons/editperfil.png';
import iconFolha from '@/assets/icons/folhaperfil.png';
import fundoPerfilSuperior from '@/assets/icons/fundoperfilsuperior.png';
import iconSetas from '@/assets/icons/setasperfil.png';
import iconXadrez from '@/assets/icons/xadrezperfil.png';

import iconAprender from '@/assets/icons/aprenderperfil.png';
import iconHome from '@/assets/icons/homeperfil.png';
import iconMapaSUS from '@/assets/icons/mapasus.png';
import iconMensagens from '@/assets/icons/mensagensperfil.png';
import iconPerfilNav from '@/assets/icons/perfil.png';

import { styles } from './style';

export default function Perfil() {
  const router = useRouter();

  return (
    <View style={styles.mainContainer}>
      <ScrollView style={styles.container}>
        <ImageBackground source={fundoPerfilSuperior} style={styles.header} resizeMode="cover">
          <TouchableOpacity
            style={styles.configButton}
            onPress={() => router.push('/Screens/Configuracoes/configuracoes')}
          >
            <Image source={iconConfig} style={styles.configIcon} />
          </TouchableOpacity>

          {/* Avatar já vem desenhado no fundo, só o botão de editar fica por cima */}
          <View style={styles.avatarWrapper}>
            <TouchableOpacity
              style={styles.editBadge}
              onPress={() => router.push('/Screens/EditarPerfil/editarperfil')}
            >
              <Image source={iconEditPerfil} style={{ width: '100%', height: '100%', resizeMode: 'contain' }} />
            </TouchableOpacity>
          </View>

          {/* Nome/handle/bio ficam ao lado do avatar, não embaixo */}
          <View style={styles.textsBlock}>
            <Text style={styles.userName}>Marina Silva</Text>
            <Text style={styles.userHandle}>@marinaslv</Text>
            <Text style={styles.userBio}>
              “Tentando aprender como entender mais sobre a minha saúde”
            </Text>
          </View>

          <View style={styles.statsRow}>
            <View style={[styles.statItem, { flex: 232 }]}>
              <Text style={styles.statNumber}>0</Text>
              <Text style={styles.statLabel}> Posts</Text>
            </View>
            <View style={[styles.statItem, { flex: 404 }]}>
              <Text style={styles.statNumber}>23</Text>
              <Text style={styles.statLabel}> Seguidores</Text>
            </View>
            <View style={[styles.statItem, { flex: 364 }]}>
              <Text style={styles.statNumber}>10</Text>
              <Text style={styles.statLabel}> Seguindo</Text>
            </View>

            <View style={styles.dividerOne} />
            <View style={styles.dividerTwo} />
          </View>
        </ImageBackground>

        <View style={styles.feedTabs}>
          <TouchableOpacity style={styles.tabItemActive}>
            <Image source={iconXadrez} style={styles.tabIcon} />
          </TouchableOpacity>
          <TouchableOpacity><Image source={iconCadeado} style={styles.tabIcon} /></TouchableOpacity>
          <TouchableOpacity><Image source={iconFolha} style={styles.tabIcon} /></TouchableOpacity>
          <TouchableOpacity><Image source={iconSetas} style={styles.tabIcon} /></TouchableOpacity>
          <TouchableOpacity><Image source={iconCoracao} style={styles.tabIcon} /></TouchableOpacity>
        </View>

        <View style={styles.postsGrid}>
          <Image source={{ uri: 'https://picsum.photos/200/200' }} style={styles.postThumb} />
          <Image source={{ uri: 'https://picsum.photos/200/201' }} style={styles.postThumb} />
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
        <TouchableOpacity style={styles.navItem}>
          <Image source={iconPerfilNav} style={styles.navIcon} />
          <Text style={styles.navLabelActive}>Perfil</Text>
        </TouchableOpacity>
      </View>
    </View>
  );
}