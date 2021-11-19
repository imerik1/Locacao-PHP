import { Cliente } from "./Cliente";
import { Endereco } from "./Endereco";
import { Pagamento } from "./Pagamento";
import { Veiculo } from "./Veiculo";

export interface IData {
  id: Cliente["id"];
  nome: Cliente["nome"];
  /** Pattern: 000.000.000-00 */
  cpf: Cliente["cpf"];
  /** Pattern: (00) 0000-00009 */
  telefone: Cliente["telefone"];
  logradouro: Endereco["logradouro"];
  numero: Endereco["numero"];
  bairro: Endereco["bairro"];
  cidade: Endereco["cidade"];
  /** Pattern: AA */
  estado: Endereco["estado"];
  /** Pattern: 00000-000 */
  cep: Endereco["cep"];
  marca: Veiculo["marca"];
  modelo: Veiculo["modelo"];
  /** Pattern: R$ 0.000.000,00 */
  preco: Veiculo["preco"];
  /** Pattern: AAA 0A00 or AAA-0000 */
  placa: Veiculo["placa"];
  ano: Veiculo["ano"];
  /** Pattern: dd-MM-YYYY HH:mm:ss */
  data_pagamento: Pagamento["data_pagamento"];
}

export class Data {
  cliente: Cliente | undefined;
  endereco: Endereco | undefined;
  pagamento: Pagamento | undefined;
  veiculo: Veiculo | undefined;
  constructor(
    cliente?: Cliente,
    endereco?: Endereco,
    pagamento?: Pagamento,
    veiculo?: Veiculo
  ) {
    this.cliente = cliente;
    this.endereco = endereco;
    this.pagamento = pagamento;
    this.veiculo = veiculo;
  }
  /**
   * Receive Cliente, Pagamento, Veiculo and Endereco and store in the class.
   * @param data Cliente, Pagamento, Veiculo and Endereco
   */
  getData(data: IData) {
    this.cliente = new Cliente(data.id, data.nome, data.cpf, data.telefone);
    this.endereco = new Endereco(
      data.id,
      data.id,
      data.logradouro,
      data.numero,
      data.bairro,
      data.cidade,
      data.estado,
      data.cep
    );
    this.pagamento = new Pagamento(
      data.id,
      data.id,
      data.id,
      data.preco,
      data.data_pagamento
    );
    this.veiculo = new Veiculo(
      data.id,
      data.marca,
      data.modelo,
      data.ano,
      data.placa,
      data.preco
    );
  }
  /**
   * Convert to object this class.
   * @returns return a object.
   */
  convertToObject(): IData {
    return {
      id: this.cliente!.id,
      nome: this.cliente!.nome,
      cpf: this.cliente!.cpf,
      telefone: this.cliente!.telefone,
      logradouro: this.endereco!.logradouro,
      numero: this.endereco!.numero,
      bairro: this.endereco!.bairro,
      cidade: this.endereco!.cidade,
      estado: this.endereco!.estado,
      cep: this.endereco!.cep,
      marca: this.veiculo!.marca,
      modelo: this.veiculo!.modelo,
      preco: this.veiculo!.preco,
      placa: this.veiculo!.placa,
      ano: this.veiculo!.ano,
      data_pagamento: this.pagamento!.data_pagamento,
    };
  }
}
