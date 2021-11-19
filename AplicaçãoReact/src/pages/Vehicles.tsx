import { FC, useEffect, useState } from "react";
import { Link } from "react-router-dom";
import {
  Button,
  Divider,
  Dropdown,
  Header,
  Loader,
  Pagination,
} from "semantic-ui-react";
import ListVehicles from "../components/ListVehicles";
import { IData } from "../utils/Data";

const Vehicles: FC = () => {
  const [useSuccess, setSuccess] = useState<IData | IData[] | undefined>(
    undefined
  );
  const [useError, setError] = useState<boolean>(false);
  const [useLoading, setLoading] = useState<boolean>(true);
  const [useLimit, setLimit] = useState<number>(10);
  const [usePage, setPage] = useState<number>(1);
  const [useTotalPage, setTotalPage] = useState<number>(1);
  useEffect(() => {
    fetch(
      `http://localhost:3000/Views/Api/carros-read.php?page=${usePage}&limit=${useLimit}`
    ).then(async (res) => {
      const json = await res.json();
      if (res.status >= 200 && res.status <= 299) {
        setTotalPage(json[json.length - 1]["total_pages"]);
        json.length = json.length - 1;
        setSuccess(json);
      } else {
        setError(true);
      }
      setLoading(false);
    });
  }, [useLimit, usePage]);
  if (useLoading)
    return (
      <main>
        <Loader active={useLoading} />
      </main>
    );
  if (useError) {
    return (
      <main>
        <Header as="h1">Ocorreu um erro ao carregar a tabela.</Header>
      </main>
    );
  }
  return (
    <main>
      <Header as="h1">Tabela de veículos alugados</Header>
      <Divider />
      <section
        style={{
          display: "flex",
          width: "100%",
          justifyContent: "space-between",
          alignItems: "center",
        }}
      >
        <span>
          Qtd. de veículosㅤ
          <Dropdown inline text={useLimit.toString()}>
            <Dropdown.Menu>
              <Dropdown.Item text="1" onClick={(e) => setLimit(1)} />
              <Dropdown.Item text="10" onClick={(e) => setLimit(10)} />
              <Dropdown.Item text="15" onClick={(e) => setLimit(15)} />
              <Dropdown.Item text="20" onClick={(e) => setLimit(20)} />
            </Dropdown.Menu>
          </Dropdown>
        </span>
        <Link to="/new-vehicle">
          <Button content="Novo aluguel" />
        </Link>
      </section>
      <ListVehicles
        key={JSON.stringify(useSuccess)}
        vehicles={useSuccess as IData[]}
      />
      {useTotalPage > 0 && (
        <Pagination
          activePage={usePage}
          totalPages={useTotalPage}
          onPageChange={(e) =>
            setPage(parseInt(e.currentTarget.getAttribute("value")!))
          }
        />
      )}
    </main>
  );
};

export default Vehicles;
