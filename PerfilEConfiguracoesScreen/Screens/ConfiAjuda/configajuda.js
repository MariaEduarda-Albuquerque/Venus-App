import { Image, ImageBackground, ScrollView, Text, TouchableOpacity, View } from 'react-native';
import { useRouter } from 'expo-router';

import iconCentralAjuda from '@/assets/icons/ajuda.png'; // ajuste o caminho se necessário
import iconDenuncias from '@/assets/icons/denuncias.png';
import iconEnviarFeedback from '@/assets/icons/enviarfeedback.png';
import fundoSuperiorTelas from '@/assets/icons/fundosuperiortelas.png';
import perfilTopo from '@/assets/icons/perfiltopo.png';
import iconPoliticaPrivacidade from '@/assets/icons/cadeadoperfil.png'; // ajuste o caminho se necessário
import { styles } from './style';

export default function ConfiAjuda() {
  const router = useRouter();

  const opcoes = [
    { id: '1', titulo: 'Central de ajuda', sub: 'Obtenha ajuda, fale conosco', icon: iconCentralAjuda },
    { id: '2', titulo: 'Enviar feedback', sub: 'Relatar problemas técnicos', icon: iconEnviarFeedback },
    { id: '3', titulo: 'Denúncias', sub: '', icon: iconDenuncias },
    { id: '4', titulo: 'Política de privacidade', sub: '', icon: iconPoliticaPrivacidade },
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
        <Text style={styles.title}>Ajuda</Text>
      </ImageBackground>

      <View style={styles.menuList}>
        {opcoes.map((item) => (
          <TouchableOpacity key={item.id} style={styles.menuItem}>
            <Image source={item.icon} style={styles.menuIcon} />
            <View style={styles.menuTextContainer}>
              <Text style={styles.menuTitle}>{item.titulo}</Text>
              {item.sub ? <Text style={styles.menuSubtitle}>{item.sub}</Text> : null}
            </View>
          </TouchableOpacity>
        ))}
      </View>
    </ScrollView>
  );
}