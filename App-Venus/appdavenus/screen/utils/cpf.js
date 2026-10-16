export const apenasDigitos = (valor = "") => String(valor).replace(/\D/g, "");

export const formatarCpf = (valor = "") => {
  const d = apenasDigitos(valor).slice(0, 11);

  if (d.length <= 3) return d;
  if (d.length <= 6) return `${d.slice(0, 3)}.${d.slice(3)}`;
  if (d.length <= 9) return `${d.slice(0, 3)}.${d.slice(3, 6)}.${d.slice(6)}`;
  return `${d.slice(0, 3)}.${d.slice(3, 6)}.${d.slice(6, 9)}-${d.slice(9)}`;
};


export const validarCpf = (valor = "") => {
  const cpf = apenasDigitos(valor);

  if (cpf.length !== 11) return false;
  if (/^(\d)\1{10}$/.test(cpf)) return false;

  const calcularDigito = (qtdDigitos) => {
    let soma = 0;
    for (let i = 0; i < qtdDigitos; i++) {
      soma += Number(cpf[i]) * (qtdDigitos + 1 - i);
    }
    const resto = (soma * 10) % 11;
    return resto === 10 ? 0 : resto;
  };

  return (
    calcularDigito(9) === Number(cpf[9]) &&
    calcularDigito(10) === Number(cpf[10])
  );
};
