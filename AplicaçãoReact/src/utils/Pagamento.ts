export interface IPagamento {
  id: number;
  id_cliente: number;
  id_veiculo: number;
  /** Pattern: R$ 0.000.000,00 */
  preco: string;
  /** Pattern: dd-MM-YYYY HH:mm:ss */
  data_pagamento: string;
}

export class Pagamento implements IPagamento {
  id: number;
  id_cliente: number;
  id_veiculo: number;
  preco: string;
  data_pagamento: string;
  constructor(
    id: number,
    id_cliente: number,
    id_veiculo: number,
    preco: string,
    data_pagamento: string
  ) {
    this.id = id;
    this.id_cliente = id_cliente;
    this.id_veiculo = id_veiculo;
    this.preco = preco;
    this.data_pagamento = data_pagamento;
  }
}
