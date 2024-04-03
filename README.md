# Tema Api de produtos

## Descrição

Esta é uma api simples e objetiva que permite consultar dados de clientes e produtos em versão local ou em versão remota (Api externa).

## Requisitos

1. Composer, o gerenciador de dependencias do php.
3. PHP 8.0+ instalado e rodando na máquina.
4. Servidor Apache (XAMPP).

## Requisitos do teste

1. Todas as rotas da rest api provida são consumidas, como pedido. 
2. Apesar de ser opcional, também foi feita uma versão local dessa api para uso (CRUD).
3. Os arquivos referentes as rotas que chamam a api externa estão dentro da pasta api. As outras pastas dentro de http são referentes aos arquivos que se 
comunicam com as rotas locais.
4. Tanto a foto do modelo relacional como o código podem ser encontrados neste repositório, com os nomes db.jpg e db.sql

## Instalação

1. Faça o download do tema dentro de sua pasta HTDOCS via github, usando o comando:
`git clone https://github.com/GuilhermePereiraRibeirodaSilva/php-rest-api.git`
2. Após criado e instalado o projeto, acesse a pasta raiz dele com o comando `cd ./php-rest-api`.
3. Execute o comando `composer install`.
4. Por ser um projeto bastante simples, apenas uma biblioteca será instalada, sendo ela a Klain, responsável pelo gerenciamento de rotas.
5. Trocar o nome configExample.php para config.php e preencher com as informações necessárias.
6. Importar o banco de dados disponível no arquivo db.sql.

## Estrutura de Pastas

```
├───src
│   ├───Http
│   │   ├───Api
│   │   │   ├───Controllers
│   │   │   ├───Resources
│   │   │   └───Services
│   │   ├───Controllers
│   │   ├───Models
│   │   ├───Resources
│   │   ├───Services
│   │   └───Traits
│   └───Routes
└───vendor
└───logs
```

### Descrição da Estrutura de Pastas

- `src/`: Esta pasta contém todos os arquivos raízes do projeto, responsáveis pelo seu funcionamento.
    - `api/`: Pasta responsável por guardar os arquivos responsáveis pela comunição com os endpoints.
    - `Controllers/`: Nesta pasta ficam os controladores do projeto, responsáveis pela validação dos dados vindos do usuário assim como pelo encaminhamento destes aos services.
    - `Models/`: Nesta pasta ficam os Models do projeto, responsáveis por armazenar os dados das entidades participantes.
    - `Services/`: Nesta pasta ficam os Services do projeto, responsáveis por Gerenciar a lógica do projeto e fazer a comunição com os models.
    - `Resources/`: Nesta pasta ficam os Resources do projeto, responsáveis por sanitizar os dados vindos do banco de dados via models.
    - `Routes/`: Nesta pasta ficam as Rotas do projeto.
- `logs/`: Nesta pasta ficam os logs de possíveis erros que possam acontecer durante a execução do código.

### Descrição da Api

A api fornece dois módulos para consulta: O local e o externo. No módulo local, o banco de dados em ambiente local será chamado, já no módulo externo a api inserida no arquivo config.php será chamada. 
Todos os prefixos da api local terão a palavra *api*. De tal forma, caso eu queira fazer uma chamada de listagem de clientes, posso chamar /api/clientes.
Todos os prefixos da api external terão a palavra *external*. De tal forma, caso eu queira fazer uma chamada de listagem de clientes, posso chamar /external/clientes.
Para mais informações consultar o arquivo Routes.php onde poderão ser encontradas todas as rotas.

## Suporte

Se você tiver alguma dúvida, problema ou sugestão relacionada ao tema, sinta-se à vontade para entrar em contato comigo através de meu email(guinovembro43@gmail.com).

## SQL e mapa do banco de dados

Para visualizar o mapa do banco de dados assim como importa-lo em sua máquina caso desejar, procure os arquivos db.sql e db.jpg

## Licença

O tema é licenciado sob a Licença MIT. Consulte o arquivo `LICENSE` para obter mais informações.

---