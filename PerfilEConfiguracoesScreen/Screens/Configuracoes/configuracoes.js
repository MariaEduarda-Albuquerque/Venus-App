import { Image, ImageBackground, ScrollView, Text, TouchableOpacity, View } from 'react-native';
import { useRouter } from 'expo-router';

import fundoSuperiorTelas from '@/assets/icons/fundosuperiortelas.png';
import perfilTopo from '@/assets/icons/perfiltopo.png';
import { styles } from './style';

import iconAcessibilidade from '@/assets/icons/acessibilidade.png';
import iconAjuda from '@/assets/icons/ajuda.png';
import iconAparencia from '@/assets/icons/aparencia.png';
import iconConta from '@/assets/icons/conta.png';
import iconConversas from '@/assets/icons/conversas.png';
import iconNotificacoes from '@/assets/icons/notificacoes.png';

export default function Configuracoes() {
  const router = useRouter();

  const opcoes = [
    { id: '1', titulo: 'Conta', sub: 'Senha, dados pessoais, preferências', icon: iconConta, route: '/Screens/ConfiConta/configconta' },
    { id: '2', titulo: 'Conversas', sub: 'Histórico de conversas', icon: iconConversas, route: '/Screens/ConfiConversas/configconversas' },
    { id: '3', titulo: 'Aparência', sub: 'Tema do app', icon: iconAparencia, route: null },
    { id: '4', titulo: 'Notificações', sub: 'Mensagens, notícias, etc', icon: iconNotificacoes, route: '/Screens/ConfiNotificacao/confignotificacao' },
    { id: '5', titulo: 'Acessibilidade', sub: 'Fonte, contraste', icon: iconAcessibilidade, route: null },
    { id: '6', titulo: 'Ajuda', sub: '', icon: iconAjuda, route: '/Screens/ConfiAjuda/configajuda' },
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
        <Text style={styles.title}>Configurações</Text>
      </ImageBackground>

      <View style={styles.menuList}>
        {opcoes.map((item) => (
          <TouchableOpacity
            key={item.id}
            style={styles.menuItem}
            onPress={() => item.route && router.push(item.route)}
          >
            <Image source={item.icon} style={styles.menuIcon} />
            <View style={styles.menuTextContainer}>
              <Text style={styles.menuTitle}>{item.titulo}</Text>
              {item.sub ? <Text style={styles.menuSubtitle}>{item.sub}</Text> : null}
            </View>
          </TouchableOpacity>
        ))}

        <View style={styles.footer}>
          <Text style={styles.footerText}>Central de ajuda, fale conosco,</Text>
          <Text style={styles.footerText}>Política de privacidade</Text>
        </View>
      </View>
    </ScrollView>
  );
}