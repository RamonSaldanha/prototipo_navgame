RELEASE
============

Proposta de criação independente de um jogo de browser inteiramente programado por php sem nenhum auxílio de framework.


Install
-------------

Na pasta de instalação você vai encontrar o arquivo de extensão SQL, importe para
seu banco de dados mysql.

no arquivo na pasta engine chamado pdo_mysql.php, você vai encontrar onde mudar
as configurações de conexão com o mysql.

Demo
-------------
login: Ramon
senha: 123456
http://lojaviele.com.br/prototipo_navgame/entrar.php

Nova ordem (Principios fundamentais na mecanica)
---------------------------
- 3 construções fundamentais: Mina, Cabana(madeireiro) e Fazenda.
- 3 Recursos fundamentais: Comida,Pedra e Madeira
- Mina: produzirá ferro,pedra e ouro. Cabana: Produzirá madeira e Fazenda: Produzira comida em geral, pode se ver a possibilidade de criação de animais também.
- população chegará de acordo com o tempo e só as que estiverem trabalhando contribuirão com aliquota de impostos. cada construção vai comportar uma quantidade de população, quando esse limite total for atingido os civis que estiverem sem trabalho, não contribuirão com impostos mas consumirão comida.
- Construção Albergue: será onde os cidadãos vão dormir, é também onde definimos qual alimentação da população

Next commits
-------------
- Transformação de matéria prima. exemplo: você produz trigo e transforma em pão, assim a população ira pagar mais tributos a prefeitura. na construção responsável por essa 
- Aldeias produzindo materias primas diferentes, exemplo, você pode produzir mais pedras e bem menos madeira, assim você poderá vender por moedas no mercado o recurso que você tiver mais abundante.
- Fazenda: Criação de porco, gado e ovelha.
- Data de pesquisa: Torre de pesquisa, uma árvore de habilidades em uma construção;
- Receita de impostos: os impostos serão arrecadados pelo comércio de comida, ou seja, a população vai comer sua comida, e você vai receber por isso, outras formas deverão ser implantadas pra arrecadar impostos, algum sistema de "Pão e Circo" um tipo de entreterimento que arrecade ouro, como uma festa, uma praça etc;
- A evolução das construções funcionará através técnicas (tipo o do age of empires), cada construção terá sua técnica individual;
- Simplificar sistema de login, de forma que utilize apenas um select, com tabelas relacionadas;
- corrigir sistema de multialdeias, que estão com um bug, você pode mudar pra aldeia que quiser manipulando o metodo get; //correção
- <strike>Água: necessário um sistema de produção de água por hora, através de um edifício poço, a população, também irá consumir água, e ela também será usada pra apagar incêndios.</strike>
- <strike>Data de unidades: Tratar população óciosa como uma unidade com força,defesa e etc... toda unidade deverá consumir comida, e pagar impostos</strike>;
- <strike>Nos conjuntos habitacionais, você irá receber população com o decorrer do tempo, cabe a você recebelas ou não;</strike>
- <strike>Calcular perda que você terá se demorar a receber a fazer a colheita;</strike>
- <strike>Ao terminar o processo de colheita, você irá receber os recursos que plantou.</strike>
- <strike>Recolher recursos de Pedra no processo de construção.</strike>

Game Art
-------------
- Construções:
- Quartel;
- Prefeitura;
- <strike>Moinho (onde desenvolve-se todas as ferramentas de colheita)</strike>; http://i.imgur.com/jlYU8l9.png
- <strike>Conjunto Habitacional (Dormitório Coletivo)</strike>; http://i.imgur.com/APpbQrI.png
- <strike>Mineiro (catador de pedra)</strike>; http://i.imgur.com/FmQNWoU.png
- Lenhador (catador de madeira);
- <strike>Plantação</strike> (<strike>Milho</strike>, Trigo, Cenoura, Abobora);
- <strike>Criadouro de Animais</strike> (Vaca, Porco, Galinha); http://i.imgur.com/WyjgMk8.png

https://app.buddy.works/ramonsaldanhaa/prototipo-navgame
