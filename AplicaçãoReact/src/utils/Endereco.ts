export interface IViaCep {
  cep: string;
  logradouro: string;
  complemento: string;
  bairro: string;
  localidade: string;
  uf: string;
  ibge: string;
  gia: string;
  ddd: string;
  siafi: string;
}

export interface IEndereco {
  id: number;
  id_cliente: number;
  logradouro: string;
  numero: number;
  bairro: string;
  cidade: string;
  /** Pattern: AA */
  estado: string;
  /** Pattern: 00000-000 */
  cep: string;
}

export class Endereco implements IEndereco {
  id: number;
  id_cliente: number;
  logradouro: string;
  numero: number;
  bairro: string;
  cidade: string;
  estado: string;
  cep: string;
  constructor(
    id: number,
    id_cliente: number,
    logradouro: string,
    numero: number,
    bairro: string,
    cidade: string,
    estado: string,
    cep: string
  ) {
    this.id = id;
    this.id_cliente = id_cliente;
    this.logradouro = logradouro;
    this.numero = numero;
    this.bairro = bairro;
    this.cidade = cidade;
    this.estado = estado;
    this.cep = cep;
  }
}
