export interface ICliente {
  id: number;
  nome: string;
  /** Pattern: 000.000.000-00 */
  cpf: string;
  /** Pattern: (00) 0000-00009 */
  telefone: string;
}

export class Cliente implements ICliente {
  id: number;
  nome: string;
  cpf: string;
  telefone: string;

  constructor(id: number, nome: string, cpf: string, telefone: string) {
    this.id = id;
    this.nome = nome;
    this.cpf = cpf;
    this.telefone = telefone;
  }
}
