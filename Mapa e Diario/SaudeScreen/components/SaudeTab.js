
import React, { useState } from 'react';
import {
  View,
  Text,
  TouchableOpacity,
  Modal,
  TextInput,
} from 'react-native';
import estilos from '../styles';


const MESES_PT = {
  jan: 0, fev: 1, mar: 2, abr: 3, mai: 4, jun: 5,
  jul: 6, ago: 7, set: 8, out: 9, nov: 10, dez: 11,
};

function parseDataVacina(texto) {
  if (!texto) return null;
  const partes = texto.trim().toLowerCase().split('/');
  if (partes.length !== 2) return null;
  const mes = MESES_PT[partes[0].slice(0, 3)];
  const ano = parseInt(partes[1], 10);
  if (mes === undefined || isNaN(ano)) return null;
  return new Date(ano, mes, 1);
}

export default function SaudeTab() {
  // Exames
  const [exames, setExames] = useState(['Hemograma completo', 'Ultrassom pélvico', 'Papanicolau']);
  const [modalExameVisivel, setModalExameVisivel] = useState(false);
  const [novoExame, setNovoExame] = useState('');

  // Vacinas 
  const [vacinas, setVacinas] = useState([{ id: 'v1', nome: 'HPV', data: 'set/2026' }]);
  const [modalVacinaVisivel, setModalVacinaVisivel] = useState(false);
  const [novaVacinaNome, setNovaVacinaNome] = useState('');
  const [novaVacinaData, setNovaVacinaData] = useState('');

  // Medicamentos 
  const [medicamentos, setMedicamentos] = useState([
    { id: '1', nome: 'Pílula anticoncepcional', horario: 'Todo dia às 21h', ativo: true },
    { id: '2', nome: 'Vitamina D', horario: 'Domingo dia às 9h', ativo: false },
  ]);
  const [adicionandoMed, setAdicionandoMed] = useState(false);
  const [novoMedNome, setNovoMedNome] = useState('');
  const [novoMedHorario, setNovoMedHorario] = useState('');
  const [medModalId, setMedModalId] = useState(null);

  //  Funções 
  const abrirModalExame = () => setModalExameVisivel(true);
  const confirmarExame = () => {
    const valor = novoExame.trim();
    if (valor.length > 0) {
      setExames((atual) => [...atual, valor]);
    }
    setNovoExame('');
    setModalExameVisivel(false);
  };
  const cancelarExame = () => {
    setNovoExame('');
    setModalExameVisivel(false);
  };

  const abrirModalVacina = () => setModalVacinaVisivel(true);
  const confirmarVacina = () => {
    const nome = novaVacinaNome.trim();
    if (nome.length > 0) {
      setVacinas((atual) => [...atual, { id: `${Date.now()}`, nome, data: novaVacinaData.trim() }]);
    }
    setNovaVacinaNome('');
    setNovaVacinaData('');
    setModalVacinaVisivel(false);
  };
  const cancelarVacina = () => {
    setNovaVacinaNome('');
    setNovaVacinaData('');
    setModalVacinaVisivel(false);
  };

  const proximaVacina = vacinas.reduce((maisProxima, atual) => {
    if (!maisProxima) return atual;
    const dataAtualVacina = parseDataVacina(atual.data);
    const dataMaisProxima = parseDataVacina(maisProxima.data);
    if (dataAtualVacina && dataMaisProxima) {
      return dataAtualVacina < dataMaisProxima ? atual : maisProxima;
    }
    if (dataAtualVacina && !dataMaisProxima) return atual;
    return maisProxima;
  }, null);

  const alternarMedicamento = (id) => {
    setMedicamentos((atual) =>
      atual.map((item) => (item.id === id ? { ...item, ativo: !item.ativo } : item))
    );
  };

  const abrirModalMedicamento = (id) => setMedModalId(id);
  const fecharModalMedicamento = () => setMedModalId(null);
  const removerMedicamento = () => {
    setMedicamentos((atual) => atual.filter((item) => item.id !== medModalId));
    setMedModalId(null);
  };
  const medicamentoSelecionado = medicamentos.find((item) => item.id === medModalId) || null;

  const confirmarMedicamento = () => {
    const nome = novoMedNome.trim();
    if (nome.length > 0) {
      setMedicamentos((atual) => [
        ...atual,
        {
          id: `${Date.now()}`,
          nome,
          horario: novoMedHorario.trim() || 'Horário não definido',
          ativo: true,
        },
      ]);
    }
    setNovoMedNome('');
    setNovoMedHorario('');
    setAdicionandoMed(false);
  };
  const cancelarMedicamento = () => {
    setNovoMedNome('');
    setNovoMedHorario('');
    setAdicionandoMed(false);
  };

  return (
    <View style={estilos.containerSaude}>
      {/* Meus Exames + Vacinas */}
      <View style={estilos.rowSaude}>
        {/* Card Meus Exames */}
        <View style={[estilos.cardSaude, estilos.halfCard]}>
          <View style={{ flex: 1, justifyContent: 'space-between' }}>
            <View>
              <Text style={estilos.cardTitle}>Meus Exames</Text>
              <Text style={estilos.cardSubtitle}>
                {exames.length === 1 ? '1 laudo salvo' : `${exames.length} laudos salvos`}
              </Text>
            </View>
            <TouchableOpacity style={estilos.pillButton} onPress={abrirModalExame}>
              <Text style={estilos.pillButtonText}>Adicionar</Text>
            </TouchableOpacity>
          </View>
        </View>

        {/* Card Vacinas */}
        <View style={[estilos.cardSaude, estilos.halfCard]}>
          <View style={{ flex: 1, justifyContent: 'space-between' }}>
            <View>
              <Text style={estilos.cardTitle}>Vacinas</Text>
              {proximaVacina ? (
                <Text style={estilos.vaccineSubtitle} numberOfLines={1}>
                  {proximaVacina.nome}
                  {proximaVacina.data ? ` — ${proximaVacina.data}` : ''}
                </Text>
              ) : (
                <Text style={estilos.vaccineSubtitle}>Nenhuma vacina registrada</Text>
              )}
            </View>
            <TouchableOpacity style={estilos.pillButton} onPress={abrirModalVacina}>
              <Text style={estilos.pillButtonText}>Adicionar</Text>
            </TouchableOpacity>
          </View>
        </View>
      </View>

      {/* Modais Exame e Vacina */}
      <Modal visible={modalExameVisivel} transparent animationType="fade" onRequestClose={cancelarExame}>
        <View style={estilos.fundoModal}>
          <View style={estilos.caixaModal}>
            <Text style={estilos.tituloModal}>Adicionar exame</Text>
            <TextInput
              style={estilos.inputInline}
              placeholder="Nome do exame"
              placeholderTextColor="#B98D95"
              value={novoExame}
              onChangeText={setNovoExame}
              autoFocus
              onSubmitEditing={confirmarExame}
              returnKeyType="done"
            />
            <View style={estilos.linhaBotoesInline}>
              <TouchableOpacity style={estilos.botaoConfirmar} onPress={confirmarExame}>
                <Text style={estilos.textoBotaoConfirmar}>Salvar</Text>
              </TouchableOpacity>
              <TouchableOpacity style={estilos.botaoCancelar} onPress={cancelarExame}>
                <Text style={estilos.textoBotaoCancelar}>Cancelar</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </Modal>

      <Modal visible={modalVacinaVisivel} transparent animationType="fade" onRequestClose={cancelarVacina}>
        <View style={estilos.fundoModal}>
          <View style={estilos.caixaModal}>
            <Text style={estilos.tituloModal}>Adicionar vacina</Text>
            <TextInput
              style={estilos.inputInline}
              placeholder="Nome da vacina"
              placeholderTextColor="#B98D95"
              value={novaVacinaNome}
              onChangeText={setNovaVacinaNome}
              autoFocus
              returnKeyType="next"
            />
            <TextInput
              style={[estilos.inputInline, { marginTop: 8 }]}
              placeholder="Data (ex: out/2026)"
              placeholderTextColor="#B98D95"
              value={novaVacinaData}
              onChangeText={setNovaVacinaData}
              onSubmitEditing={confirmarVacina}
              returnKeyType="done"
            />
            <View style={estilos.linhaBotoesInline}>
              <TouchableOpacity style={estilos.botaoConfirmar} onPress={confirmarVacina}>
                <Text style={estilos.textoBotaoConfirmar}>Salvar</Text>
              </TouchableOpacity>
              <TouchableOpacity style={estilos.botaoCancelar} onPress={cancelarVacina}>
                <Text style={estilos.textoBotaoCancelar}>Cancelar</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </Modal>

      {/* Meus Medicamentos */}
      <View style={[estilos.cardSaude, estilos.fullCard]}>
        <Text style={estilos.sectionTitle}>Meus Medicamentos</Text>

        {medicamentos.map((med, index) => (
          <React.Fragment key={med.id}>
            <View style={estilos.medRow}>
              <TouchableOpacity
                style={estilos.medTextWrap}
                onPress={() => abrirModalMedicamento(med.id)}
              >
                <Text style={estilos.medName}>{med.nome}</Text>
                <Text style={estilos.medTime}>{med.horario}</Text>
              </TouchableOpacity>
              <Toggle value={med.ativo} onValueChange={() => alternarMedicamento(med.id)} />
            </View>
            {index < medicamentos.length - 1 && <View style={estilos.divider} />}
          </React.Fragment>
        ))}

        {adicionandoMed ? (
          <View style={[estilos.blocoInline, { marginTop: 12 }]}>
            <TextInput
              style={estilos.inputInline}
              placeholder="Nome do medicamento"
              placeholderTextColor="#B98D95"
              value={novoMedNome}
              onChangeText={setNovoMedNome}
              autoFocus
              returnKeyType="next"
            />
            <TextInput
              style={[estilos.inputInline, { marginTop: 6 }]}
              placeholder="Horário (ex: Todo dia às 8h)"
              placeholderTextColor="#B98D95"
              value={novoMedHorario}
              onChangeText={setNovoMedHorario}
              onSubmitEditing={confirmarMedicamento}
              returnKeyType="done"
            />
            <View style={estilos.linhaBotoesInline}>
              <TouchableOpacity style={estilos.botaoConfirmar} onPress={confirmarMedicamento}>
                <Text style={estilos.textoBotaoConfirmar}>Salvar</Text>
              </TouchableOpacity>
              <TouchableOpacity style={estilos.botaoCancelar} onPress={cancelarMedicamento}>
                <Text style={estilos.textoBotaoCancelar}>Cancelar</Text>
              </TouchableOpacity>
            </View>
          </View>
        ) : (
          <TouchableOpacity style={estilos.smallPillButton} onPress={() => setAdicionandoMed(true)}>
            <Text style={estilos.smallPillButtonText}>Adicionar</Text>
          </TouchableOpacity>
        )}
      </View>

      {/* Histórico de Consultas */}
      <View style={[estilos.cardSaude, estilos.fullCard]}>
        <Text style={estilos.sectionTitleBold}>Histórico de Consultas</Text>
        <Text style={estilos.historyItem}>Ginecologia · Dra. Marina · Jul 2026</Text>
        <View style={estilos.divider} />
        <Text style={estilos.historyItem}>UBS Jardim Ipê · Jun 2026 · Pré-natal</Text>
      </View>

      {/* Modal remover medicamento */}
      <Modal visible={medModalId !== null} transparent animationType="fade" onRequestClose={fecharModalMedicamento}>
        <View style={estilos.fundoModal}>
          <View style={estilos.caixaModal}>
            <Text style={estilos.tituloModal}>{medicamentoSelecionado?.nome}</Text>
            <Text style={estilos.textoModal}>{medicamentoSelecionado?.horario}</Text>
            <View style={estilos.linhaBotoesInline}>
              <TouchableOpacity style={estilos.botaoRemoverModal} onPress={removerMedicamento}>
                <Text style={estilos.textoBotaoConfirmar}>Remover</Text>
              </TouchableOpacity>
              <TouchableOpacity style={estilos.botaoCancelar} onPress={fecharModalMedicamento}>
                <Text style={estilos.textoBotaoCancelar}>Cancelar</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </Modal>
    </View>
  );
}


function Toggle({ value, onValueChange }) {
  return (
    <TouchableOpacity
      style={[estilos.toggleTrack, value && estilos.toggleTrackActive]}
      onPress={() => onValueChange(!value)}
      activeOpacity={0.8}
    >
      <View style={[estilos.toggleThumb, value && estilos.toggleThumbActive]} />
    </TouchableOpacity>
  );
}