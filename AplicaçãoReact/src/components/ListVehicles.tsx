import { FC, useReducer } from "react";
import { Table } from "semantic-ui-react";
import { IData } from "../utils/Data";
import Reducer, { State } from "../utils/Reducer";
import ListRow from "./ListRow";
import ListHeader from "./ListHeader";

const titleTable = [
  {
    title: "Cliente",
    object: "nome",
  },
  {
    title: "Placa",
    object: "placa",
  },
  {
    title: "Carro",
    object: "marca_modelo",
  },
  {
    title: "Ano",
    object: "ano",
  },
  {
    title: "Valor",
    object: "preco",
  },
  {
    title: "Data de Pagamento",
    object: "data_de_pagamento",
  },
];

type Props = {
  vehicles: IData[];
};

const ListVehicles: FC<Props> = ({ vehicles }) => {
  const [state, dispatch] = useReducer(Reducer, {
    column: null,
    data: vehicles,
    direction: null,
  });
  const { column, data, direction }: State = state;
  return (
    <Table sortable celled fixed>
      <Table.Header>
        <Table.Row>
          {titleTable.map((title, index) => (
            <ListHeader
              key={index}
              dispatch={dispatch}
              column={column}
              direction={direction}
              title={title}
            />
          ))}
          <Table.HeaderCell className="tools-table"></Table.HeaderCell>
        </Table.Row>
      </Table.Header>
      <Table.Body>
        {data.map((d, index) => (
          <ListRow d={d} key={index} />
        ))}
      </Table.Body>
    </Table>
  );
};

export default ListVehicles;
