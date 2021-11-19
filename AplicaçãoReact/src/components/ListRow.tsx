/* eslint-disable no-restricted-globals */
import { FC } from "react";
import { Link } from "react-router-dom";
import { Table } from "semantic-ui-react";
import { IData } from "../utils/Data";

type Props = {
  d: IData;
};

const ListRow: FC<Props> = ({ d }) => {
  const excluir = async (id: number) => {
    const headers = new Headers();
    headers.set("Content-Type", "application/json");
    headers.set("Access-Control-Allow-Origin", "*");
    await fetch(`http://localhost:3000/Views/Api/carros-delete.php?id=${id}`, {
      method: "GET",
      headers: headers,
      mode: "no-cors",
    });
    location.reload();
  };
  return (
    <Table.Row key={d.id}>
      <Table.Cell>{d.nome}</Table.Cell>
      <Table.Cell>{d.placa}</Table.Cell>
      <Table.Cell>
        {d.marca} {d.modelo}
      </Table.Cell>
      <Table.Cell>{d.ano}</Table.Cell>
      <Table.Cell>{d.preco}</Table.Cell>
      <Table.Cell>{d.data_pagamento}</Table.Cell>
      <Table.Cell className="tools-table">
        <Link
          to="/table-vehicles"
          title="Excluir"
          onClick={(e) => excluir(d.id)}
        >
          <img
            src="https://img.icons8.com/ios-glyphs/22/000000/delete-sign.png"
            alt="Excluir"
          />
        </Link>
      </Table.Cell>
    </Table.Row>
  );
};

export default ListRow;
