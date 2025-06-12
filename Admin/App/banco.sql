/*
create database db_app_pizza;
  use db_app_pizza;

  create table tb_usuarios(
    usuarioId int not null auto_increment,
    usuarioNome varchar(20),
    usuarioCpf varchar(20),
    usuarioEmail varchar(255),
    usuarioSenha varchar(255),
    primary key(usuarioId)
  );

  create table tb_produtos(
    produtoId int not null auto_increment,
    produtoNome varchar(20),
    produtoTipo varchar(20),
    produtoPreco varchar(20),
    produtoDescricao varchar(500),
    produtoFoto varchar(255),
    primary key(produtoId)
  );

  create table tb_clientes(
    clienteId int not null auto_increment,
    clienteNome varchar(100),
    clienteCelular varchar(20),
    clienteEndereco varchar(500),
    clienteSenha varchar(255),
    primary key(clienteId)
  );

  create table tb_pedidos(
    pedidoId int not null auto_increment,
    clienteCodigo int,
    enderecoEntrega varchar(500),
    formaPagamento varchar(20),
    total varchar(20),
    dataPedido varchar(20),
    foreign key(clienteCodigo) references tb_clientes(clienteId),
    primary key(pedidoId)
  );
      */
  create table tb_produtos_pedidos(
    produtoId_pedido int not null auto_increment,
    produto int,
    quantia varchar(20),
    subtotal varchar(20),
    pedidoCodigo int,
    foreign key(produto) references tb_produtos(produtoId),
    foreign key(pedidoCodigo) references tb_pedidos(pedidoId),
    primary key(produtoId_pedido)
  );
