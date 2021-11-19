import { FC, useState } from "react";
import { Link } from "react-router-dom";
import { Form, Header } from "semantic-ui-react";
import { IViaCep } from "../utils/Endereco";

const FormVehicle: FC = () => {
  const maskBoard = (e: React.ChangeEvent<HTMLInputElement>) => {
    let value = e.target.value.toUpperCase().replace(/[^a-zA-Z0-9]*$/, "");
    e.target.value = value;
  };
  const maskPrice = (e: React.ChangeEvent<HTMLInputElement>) => {
    const value = parseInt(e.target.value.replace(/[^0-9]/g, ""));
    if (!isNaN(value)) {
      let tmp = value + "";
      tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
      if (tmp.length > 6)
        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
      return (e.target.value = "R$ " + tmp);
    }
    return (e.target.value = e.target.value.replace(/[^0-9]/g, ""));
  };
  return (
    <>
      <h4 className="ui dividing header">Veículo</h4>
      <Form.Group widths="equal">
        <Form.Field required>
          <label htmlFor="marca">Marca</label>
          <input type="text" name="marca" id="marca" required />
        </Form.Field>
        <Form.Field required>
          <label htmlFor="modelo">Modelo</label>
          <input type="text" name="modelo" id="modelo" required />
        </Form.Field>
        <Form.Field required>
          <label htmlFor="ano">Ano</label>
          <input
            type="number"
            min="1900"
            max={(new Date().getUTCFullYear() + 1).toString()}
            inputMode="numeric"
            name="ano"
            id="ano"
            defaultValue={new Date().getUTCFullYear().toString()}
            required
          />
        </Form.Field>
      </Form.Group>
      <Form.Group widths="equal">
        <Form.Field required>
          <label htmlFor="preco">Preço</label>
          <input
            type="text"
            inputMode="numeric"
            name="preco"
            id="preco"
            onInput={maskPrice}
            required
          />
        </Form.Field>
        <Form.Field required>
          <label htmlFor="placa">Placa</label>
          <input
            type="text"
            name="placa"
            id="placa"
            maxLength={7}
            onInput={maskBoard}
            required
          />
        </Form.Field>
      </Form.Group>
    </>
  );
};

const FormEndereco: FC = () => {
  const [isCep, setCep] = useState<boolean>(false);
  const [useEndereco, setEndereco] = useState<IViaCep | undefined>(undefined);
  const searchCEP = async (e: React.ChangeEvent<HTMLInputElement>) => {
    e.preventDefault();
    const value = e.target.value.replace(/[^0-9]/g, "");
    if (value.length === 8) {
      const data = await fetch(`https://viacep.com.br/ws/${value}/json/`);
      const json: IViaCep = await data.json();
      if (json.localidade) {
        setEndereco(json);
        setCep(true);
      } else {
        setEndereco(undefined);
        setCep(false);
      }
    } else {
      setCep(false);
      setEndereco(undefined);
    }
    e.target.value = value.replace(/(\d{5})(\d{3})/, "$1-$2");
  };
  return (
    <>
      <h4 className="ui dividing header">Endereço</h4>
      <Form.Field disabled className={`${isCep ? "" : "none"} fields-endereco`}>
        <input
          value={useEndereco?.logradouro}
          type="text"
          name="logradouro"
          id="logradouro"
          required
        />
      </Form.Field>
      <Form.Group widths="equal">
        <Form.Field
          required
          className={`${isCep ? "" : "none"} fields-endereco`}
        >
          <label htmlFor="numero">Número</label>
          <input
            type="text"
            inputMode="numeric"
            name="numero"
            id="numero"
            required
          />
        </Form.Field>
        <Form.Field required>
          <label htmlFor="cep">Seu CEP</label>
          <input
            onInput={searchCEP}
            type="text"
            inputMode="numeric"
            name="cep"
            id="cep"
            maxLength={9}
            required
          />
        </Form.Field>
      </Form.Group>
      <Form.Group
        widths="equal"
        className={`${isCep ? "" : "none"} fields-endereco`}
      >
        <Form.Field disabled required>
          <input
            type="text"
            name="bairro"
            value={useEndereco?.bairro}
            id="bairro"
            required
          />
        </Form.Field>
        <Form.Field disabled required>
          <input
            type="text"
            name="cidade"
            value={useEndereco?.localidade}
            id="cidade"
            required
          />
        </Form.Field>
        <Form.Field disabled required>
          <input
            type="text"
            name="estado"
            value={useEndereco?.uf}
            id="estado"
            required
          />
        </Form.Field>
      </Form.Group>
    </>
  );
};

const FormCliente: FC = () => {
  const maskCpf = (e: React.ChangeEvent<HTMLInputElement>) => {
    e.preventDefault();
    const value = e.target.value.replace(/[^0-9]/g, "");
    e.target.value = value.replace(
      /(\d{3})(\d{3})(\d{3})(\d{2})/,
      "$1.$2.$3-$4"
    );
  };
  const maskTelephone = (e: React.ChangeEvent<HTMLInputElement>) => {
    e.preventDefault();
    const value = e.target.value.replace(/[^0-9]/g, "");
    if (value.length === 10) {
      return (e.target.value = value.replace(
        /(\d{2})(\d{4})(\d{4})/,
        "($1) $2-$3"
      ));
    } else if (value.length === 11) {
      return (e.target.value = value.replace(
        /(\d{2})(\d{5})(\d{4})/,
        "($1) $2-$3"
      ));
    }
    return (e.target.value = value);
  };
  return (
    <>
      <h4 className="ui dividing header">Cliente</h4>
      <Form.Field required>
        <label htmlFor="nome-completo">Nome completo</label>
        <input type="text" name="nome" id="nome-completo" required />
      </Form.Field>
      <Form.Group widths="equal">
        <Form.Field required>
          <label htmlFor="nome-completo">Seu CPF</label>
          <input
            onInput={maskCpf}
            type="text"
            inputMode="numeric"
            name="cpf"
            id="cpf"
            maxLength={14}
            required
          />
        </Form.Field>
        <Form.Field required>
          <label htmlFor="nome-completo">Seu telefone</label>
          <input
            type="text"
            inputMode="numeric"
            name="telefone"
            id="telefone"
            onInput={maskTelephone}
            required
          />
        </Form.Field>
      </Form.Group>
    </>
  );
};

const NewVehicles: FC = () => {
  const submitForm = async (e: React.MouseEvent<HTMLElement>) => {
    const body = {
      nome: (document.getElementById("nome-completo") as HTMLInputElement)
        .value,
      cpf: (document.getElementById("cpf") as HTMLInputElement).value,
      telefone: (document.getElementById("telefone") as HTMLInputElement).value,
      logradouro: (document.getElementById("logradouro") as HTMLInputElement)
        .value,
      numero: (document.getElementById("numero") as HTMLInputElement).value,
      bairro: (document.getElementById("bairro") as HTMLInputElement).value,
      cidade: (document.getElementById("cidade") as HTMLInputElement).value,
      estado: (document.getElementById("estado") as HTMLInputElement).value,
      cep: (document.getElementById("cep") as HTMLInputElement).value,
      marca: (document.getElementById("marca") as HTMLInputElement).value,
      modelo: (document.getElementById("modelo") as HTMLInputElement).value,
      preco: (document.getElementById("preco") as HTMLInputElement).value,
      placa: (document.getElementById("placa") as HTMLInputElement).value,
      ano: (document.getElementById("ano") as HTMLInputElement).value,
    };
    const headers = new Headers();
    headers.set("Content-Type", "application/json");
    headers.set("Access-Control-Allow-Origin", "*");
    await fetch("http://localhost:3000/Views/Api/carros-create.php", {
      method: "POST",
      body: JSON.stringify(body),
      headers: headers,
      mode: "no-cors",
    });
  };
  return (
    <main>
      <Header as="h1">Tabela de veículos alugados</Header>
      <Form as="form">
        <FormCliente />
        <FormEndereco />
        <FormVehicle />
        <Link className="link-submit" to="/table-vehicles">
          <input
            onClick={submitForm}
            type="submit"
            className="ui submit button"
            value="Enviar"
          />
        </Link>
      </Form>
    </main>
  );
};

export default NewVehicles;
