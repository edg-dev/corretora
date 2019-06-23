DROP SCHEMA IF EXISTS `Corretora`;

CREATE SCHEMA IF NOT EXISTS `Corretora` 
DEFAULT CHARACTER SET Latin1 
COLLATE latin1_swedish_ci;

use Corretora;

CREATE TABLE Imovel(
	idImovel int not null auto_increment,
    idTipoImovel smallint not null,
    areaUtil smallint not null,
    areaTotal smallint not null,
    precoImovel decimal(15,2),
    idEndereco int not null,
    pedido boolean,
    idTransacao int not null,
    descricaoImovel varchar(200) not null,
    quantQuarto int not null,
    quantSuite int not null,
    quantVagaGaragem int not null,
    quantBanheiro int not null,
    negociacao tinyint(1),
    primary key (idImovel)
) ENGINE=InnoDB;

CREATE TABLE Transacao(
	idTransacao int not null auto_increment,
	descricaoTransacao varchar(50) not null,
    primary key (idTransacao)
) ENGINE=InnoDB;

CREATE TABLE TipoImovel(
	idTipoImovel smallint not null auto_increment,
    descricaoTipoImovel varchar(50) not null,
    primary key (idTipoImovel)
) ENGINE=InnoDB;

CREATE TABLE ImagensImovel(
	idImagemImovel int not null auto_increment,
    idImovel int not null,
    imagemImovel varchar(500) not null,
    primary key (idImagemImovel)
) ENGINE=InnoDB;

CREATE TABLE Endereco(
	idEndereco int not null auto_increment,
    logradouro varchar(80) not null,
    numero smallint not null,
    complemento varchar(80),
    idCep int not null,
    idBairro int not null,
	idCidade int not null,
    idEstado smallint not null,
    primary key (idEndereco)
) ENGINE=InnoDB;

CREATE TABLE Bairro(
	idBairro int not null auto_increment,
    nomeBairro varchar(50) not null,
    primary key (idBairro)
) ENGINE=InnoDB;

CREATE TABLE Cidade(
	idCidade int not null auto_increment,
    nomeCidade varchar(80) not null,
    primary key (idCidade)
) ENGINE=InnoDB;

CREATE TABLE Estado(
	idEstado smallint not null auto_increment,
    siglaEstado char(2) not null,
    descricaoEstado varchar(50) not null,
    primary key (idEstado)
) ENGINE=InnoDB;

CREATE TABLE Cep(
	idCep int not null auto_increment,
    descricaoCep varchar(20) not null,
    primary key (idCep)
) ENGINE=InnoDB;

CREATE TABLE Pessoa(
	idPessoa int not null auto_increment,
    nome varchar(80) not null,
    idEndereco int not null,
    emailContato varchar(80) not null,
    primary key (idPessoa)
) ENGINE=InnoDB;

CREATE TABLE PessoaJuridica(
	idPessoa int not null,
    cnpj varchar(20) not null,
    razaoSocial varchar(30) not null,
    primary key (idPessoa)
) ENGINE=InnoDB;

CREATE TABLE PessoaFisica(
	idPessoa int not null,
    rg varchar(15) not null,
    cpf varchar(20) not null,
    codigoSexo char(1) not null,
    idEstadoCivil smallint not null,
    primary key (idPessoa)
) ENGINE=InnoDB;

CREATE TABLE PessoaProfissao(
	idPessoaProfissao int not null auto_increment,
    idPessoa int not null,
    idProfissao int not null,
    primary key(idPessoaProfissao)
) ENGINE=InnoDB;

CREATE TABLE Profissao(
	idProfissao int not null auto_increment,
    descricaoProfissao varchar(80) not null,
    primary key(idProfissao)
) ENGINE=InnoDB;

CREATE TABLE Telefone(
	sequenciaTelefone tinyint not null auto_increment,
	idPessoa int not null,
    telefone varchar(15),
    primary key (sequenciaTelefone, idPessoa)
) ENGINE=InnoDB;

CREATE TABLE Sexo(
	codigoSexo char(1) not null,
    descricaoSexo char(10) not null,
    primary key (codigoSexo)
) ENGINE=InnoDB;

CREATE TABLE EstadoCivil(
	idEstadoCivil smallint not null auto_increment,
    descricaoEstadoCivil varchar(20),
    primary key (idEstadoCivil)
) ENGINE=InnoDB;

CREATE TABLE Anuncio(
	idAnuncio int not null auto_increment,
    idImovel int not null,
    verificado boolean not null,
	idPrioridade smallint not null,
    idUsuario int not null,
    primary key (idAnuncio)
) ENGINE=InnoDB;

CREATE TABLE PrioridadeAnuncio(
	idPrioridade smallint not null auto_increment,
    descricaoPrioridade varchar(20) not null,
    primary key (idPrioridade)
) ENGINE=InnoDB;

CREATE TABLE TipoAnuncio(
	idTipoAnuncio smallint not null auto_increment,
    descricaoTipoAnuncio varchar(20) not null,
    primary key (idTipoAnuncio)
) ENGINE=InnoDB;

CREATE TABLE Usuario(
	idUsuario int not null auto_increment,
    admin smallint not null,
    usuario varchar(80) not null,
    senha varchar(255) not null,
    primary key (idUsuario)
) ENGINE=InnoDB;

CREATE TABLE UsuarioPerfil(
	idUsuarioPerfil int not null auto_increment,
    idPerfil smallint not null,
    idUsuario int not null,
    cresci varchar(20),
    primary key (idUsuarioPerfil)
) ENGINE=InnoDB;

CREATE TABLE Perfis(
	idPerfil smallint not null auto_increment,
    descricaoPerfil varchar(50) not null,
    primary key (idPerfil)
) ENGINE=InnoDB;

CREATE TABLE Banners(
	idBanner smallint not null auto_increment,
    descricaoBanner varchar(500) not null,
    link varchar(2048) not null,
    imagemBanner varchar(500) not null,
    primary key (idBanner)
) ENGINE=InnoDB;

CREATE TABLE Pedidos(
	idPedido int not null auto_increment,
    idUsuario int not null,
    idTipoImovel smallint not null,
    idTransacao int not null,
    idCidade int not null,
    idBairro int not null,
    idEstado smallint not null,
	quantQuarto int not null,
    quantSuite int not null,
    quantVagaGaragem int not null,
    quantBanheiro int not null,
    precoMin decimal(7,2) not null,
    precoMax decimal(7,2) not null,
    primary key (idPedido)
)ENGINE=InnoDB;

ALTER TABLE PessoaFisica
	ADD CONSTRAINT FK_PessoaFisicaSexo 
		FOREIGN KEY (CodigoSexo) REFERENCES Sexo(CodigoSexo),
	ADD CONSTRAINT FK_PessoaFisicaEstadoCivil
		FOREIGN KEY (idEstadoCivil) REFERENCES EstadoCivil(idEstadoCivil),
	ADD CONSTRAINT FK_PessoaFisicaPessoa
		FOREIGN KEY (idPessoa) REFERENCES Pessoa(idPessoa);

ALTER TABLE Telefone
	ADD CONSTRAINT FK_TelefonePessoa
		FOREIGN KEY (idPessoa) REFERENCES Pessoa(idPessoa);

ALTER TABLE PessoaJuridica
	ADD CONSTRAINT FK_PessoaJuridicaPessoa
		FOREIGN KEY (idPessoa) REFERENCES Pessoa(idPessoa);

ALTER TABLE PessoaProfissao
	ADD CONSTRAINT FK_PessoaProfissao
		FOREIGN KEY (idProfissao) REFERENCES Profissao(idProfissao),
	ADD CONSTRAINT FK_PessoaProfissaoFisica
		FOREIGN KEY (idPessoa) REFERENCES PessoaFisica(idPessoa);

ALTER TABLE Pessoa
	ADD CONSTRAINT FK_PessoaEndereco
		FOREIGN KEY (idEndereco) REFERENCES Endereco(idEndereco);
     
ALTER TABLE Endereco
	ADD CONSTRAINT FK_EnderecoCEP
		FOREIGN KEY (idcep) REFERENCES CEP(idcep),
	ADD CONSTRAINT FK_EnderecoCidade 
		FOREIGN KEY (idCidade) REFERENCES Cidade(idCidade),
	ADD CONSTRAINT FK_EnderecoBairro
		FOREIGN KEY (idBairro) REFERENCES Bairro(idBairro),
	ADD CONSTRAINT FK_EnderecoEstado
		FOREIGN KEY (idEstado) REFERENCES Estado(idEstado);
        
ALTER TABLE Usuario
	ADD CONSTRAINT FK_UsuarioPessoa
		FOREIGN KEY (idUsuario) REFERENCES Pessoa(idPessoa);

ALTER TABLE UsuarioPerfil
	ADD CONSTRAINT FK_UsuarioPerfilUsuario
		FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario),
	ADD CONSTRAINT FK_UsuarioPerfilPerfis
		FOREIGN KEY (idPerfil) REFERENCES Perfis(idPerfil);
        
ALTER TABLE ImagensImovel
	ADD CONSTRAINT FK_ImagemImovel
		FOREIGN KEY (idImovel) REFERENCES Imovel(idImovel);

 ALTER TABLE Imovel
	ADD CONSTRAINT FK_ImovelEndereco
		FOREIGN KEY (idEndereco) REFERENCES Endereco(idEndereco),
	ADD CONSTRAINT FK_ImovelTipoImovel
		FOREIGN KEY (idTipoImovel) REFERENCES TipoImovel(idTipoImovel),
	ADD CONSTRAINT FK_ImovelTransacao
		FOREIGN KEY (idTransacao) REFERENCES Transacao(idTransacao);

ALTER TABLE Anuncio
	ADD CONSTRAINT FK_AnuncioImovel
		FOREIGN KEY (idImovel) REFERENCES Imovel(idImovel),
	ADD CONSTRAINT FK_AnuncioUsuario
		FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario);

ALTER TABLE Pedidos
	ADD CONSTRAINT FK_PedidoImovel
		FOREIGN KEY (idTipoImovel) REFERENCES TipoImovel(idTipoImovel),
	ADD CONSTRAINT FK_PedidoTransacao
		FOREIGN KEY (idTransacao) REFERENCES Transacao(idTransacao),
	ADD CONSTRAINT FK_PedidoCidade
		FOREIGN KEY (idCidade) REFERENCES Cidade(idCidade),
	ADD CONSTRAINT FK_PedidoBairro
		FOREIGN KEY (idBairro) REFERENCES Bairro(idBairro),
	ADD CONSTRAINT FK_PedidoEstado
		FOREIGN KEY (idEstado) REFERENCES Estado(idEstado),
	ADD CONSTRAINT FK_PedidoUsuario
		FOREIGN KEY (idUsuario) REFERENCES Usuario(idUsuario);
	
INSERT INTO Estado(descricaoEstado, siglaEstado) values
('Acre', 'AC'),
('Alagoas', 'AL'),
('Amapá', 'AP'),
('Amazonas', 'AM'),
('Bahia', 'BA'),
('Ceará', 'CE'),
('Distrito Federal', 'DF'),
('Espírito Santo', 'ES'),
('Goiás', 'GO'),
('Maranhão', 'MA'),
('Mato Grosso', 'MT'),
('Mato Grosso do Sul', 'MS'),
('Minas Gerais', 'MG'),
('Pará', 'PA') ,
('Paraíba','PB'),
('Paraná', 'PR'),
('Pernambuco', 'PE'),
('Piauí','PI'),
('Rio de Janeiro', 'RJ'),
('Rio Grande do Norte', 'RN'),
('Rio Grande do Sul', 'RS'),
('Rondônia', 'RO'),
('Roraima','RR'),
('Santa Catarina',  'SC'),
('São Paulo', 'SP'),
('Sergipe', 'SE'),
('Tocantins', 'TO');

INSERT INTO EstadoCivil(descricaoEstadoCivil) values
('Solteiro(a)'),
('Casado(a)'),
('Separado(a)'),
('Divorciado(a)'),
('Viúvo(a)');

INSERT INTO Sexo(codigoSexo, descricaoSexo) values
('M','Masculino'),
('F','Feminino'),
('O','Outros');

INSERT INTO TipoImovel(descricaoTipoImovel) values 
('Apartamento Padrão'),
('Kitchenette/Conjugados'),
('Loft'),
('Casa Padrão'),
('Terreno Padrão'),
('Box/Garagem'), 
('Casa Comercial'),  
('Casa de Condomínio'), 
('Casa de Vila'),  
('Chácara'),   
('Conjunto Comercial/Sala'),  
('Fazenda'),   
('Flat'),  
('Galpão/Deposito/Armazém'),  
('Haras'),  
('Hotel'),
('Indústria'), 
('Loja Shopping/Ct Comercial'),  
('Loja/Salão'),  
('Loteamento/Condomínio'),  
('Motel'), 
('Pousada/Chalé'),   
('Prédio Interno'),  
('Sítio'), 
('Studio'); 

INSERT INTO transacao(descricaoTransacao) values 
('Alugar'), 
('Vender'),
('Permutar'); 
    
INSERT INTO Perfis(descricaoPerfil) values
('Usuario'),
('Corretor'),
('Administrador');

INSERT INTO Prioridadeanuncio(descricaoPrioridade) values
('Alta'),
('Média'),
('Baixa');

#Inserção usuário ADM
INSERT INTO cep(`descricaoCep`) VALUES ('00000-000');
INSERT INTO bairro(`nomeBairro`) VALUES ('adm');
INSERT INTO cidade(`nomeCidade`) VALUES ('adm');
INSERT INTO endereco(`logradouro`, `numero`, `idCep`, `idBairro`, `idCidade`, `idEstado`) VALUES ('adm', '1', '1', '1', '1', '13');
INSERT INTO pessoa(`nome`, `idEndereco`, `emailContato`) VALUES ('Administrador', '1', 'adm@corretora.com');
INSERT INTO pessoafisica(`idPessoa`, `rg`, `cpf`, `codigoSexo`, `idEstadoCivil`) VALUES ('1', 'adm', '123', 'M', '1');
INSERT INTO usuario(`idUsuario`, `admin`, `usuario`, `senha`) VALUES ('1', '1', 'adm@corretora.com', '3d81329daae93459894e6b56f277e08d49fee8dd');
