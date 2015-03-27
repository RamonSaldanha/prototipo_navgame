RELEASE
============

Esse protótipo é uma ferramenta pra posteriores criações mais complexas.
O desenvolvimento não envolve nenhum capital e nenhum investimento corporativo.

Install
-------------

Na pasta de instalação você vai encontrar o arquivo de extensão SQL, importe para
seu banco de dados mysql.

no arquivo na pasta engine chamado pdo_mysql.php, você vai encontrar onde mudar
as configurações de conexão com o mysql.

Demo
-------------
O exemplo não é atualizado a cada commit, então, esse exemplo pode ser uma versão ainda antiga. site: http://ramonsaldanha.wc.lt/entrar.php Usuário: Teste Senha: 123456

Next commits
-------------
- Aldeias produzindo materias primas diferentes, exemplo, você pode produzir mais pedras e bem menos madeira, assim você poderá vender por moedas no mercado o recurso que você tiver mais abundante.
- Fazenda: Criação de porco, gado e ovelha.
- Água: necessário um sistema de produção de água por hora, através de um edifício poço, a população, também irá consumir água, e ela também será usada pra apagar incêndios.
- Data de pesquisa: Torre de pesquisa, uma árvore de habilidades em uma construção;
- Receita de impostos: os impostos serão arrecadados pelo comércio de comida, ou seja, a população vai comer sua comida, e você vai receber por isso, outras formas deverão ser implantadas pra arrecadar impostos, algum sistema de "Pão e Circo" um tipo de entreterimento que arrecade ouro, como uma festa, uma praça etc;
- construções com níveis, você irá evolui-las apartir do tower center, que é onde vai gerenciar também as movimentações, tudo que desrespeita a aldeia;
- Simplificar sistema de login, de forma que utilize apenas um select, com tabelas relacionadas;
- corrigir sistema de multialdeias, que estão com um bug, você pode mudar pra aldeia que quiser manipulando o metodo get; //correção
- <strike>Data de unidades: Tratar população óciosa como uma unidade com força,defesa e etc... toda unidade deverá consumir comida, e pagar impostos</strike>;
- <strike>Nos conjuntos habitacionais, você irá receber população com o decorrer do tempo, cabe a você recebelas ou não;</strike>
- <strike>Calcular perda que você terá se demorar a receber a fazer a colheita;</strike>
- <strike>Ao terminar o processo de colheita, você irá receber os recursos que plantou.</strike>
- <strike>Recolher recursos de Pedra no processo de construção.</strike>
