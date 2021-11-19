export interface IVeiculo {
  id: number;
  marca: string;
  modelo: string;
  ano: number;
  /** Pattern: AAA 0A00 or AAA-0000 */
  placa: string;
  /** Pattern: R$ 0.000.000,00 */
  preco: string;
}

export class Veiculo implements IVeiculo {
  id: number;
  marca: string;
  modelo: string;
  ano: number;
  placa: string;
  preco: string;
  constructor(
    id: number,
    marca: string,
    modelo: string,
    ano: number,
    placa: string,
    preco: string
  ) {
    this.id = id;
    this.marca = marca;
    this.modelo = modelo;
    this.ano = ano;
    this.placa = placa;
    this.preco = preco;
  }
}
