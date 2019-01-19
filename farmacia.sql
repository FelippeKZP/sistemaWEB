-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `tipo_pessoa` varchar
(
  20
) COLLATE utf8_bin NOT NULL,
  `nome` varchar
(
  80
) COLLATE utf8_bin NOT NULL,
  `cpfCnpj` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `rgIe` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `telefone` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `email` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `data_cadastro` date NOT NULL,
  `data_aniversario` date NOT NULL,
  `cep` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `bairro` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `rua` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `numero` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `estado` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `cidade` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `pais` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=3;

--


-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE IF NOT EXISTS `compra`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_fornecedor` int
(
  11
) NOT NULL,
  `id_usuario` int
(
  11
) NOT NULL,
  `data_compra` date NOT NULL,
  `total_compra` float NOT NULL,
  `numero_nota` int
(
  11
) NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_fornecedor_fk1001`
(
  `id_fornecedor`
),
  KEY `id_usuario_fk1002`
(
  `id_usuario`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=6;

--
-- Extraindo dados da tabela `compra`
--
-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_pagar`
--

CREATE TABLE IF NOT EXISTS `contas_pagar`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `tipo` int
(
  11
) NOT NULL,
  `descricao` varchar
(
  150
) COLLATE utf8_bin NOT NULL,
  `data_conta` date NOT NULL,
  `data_vencimento` date NOT NULL,
  `data_pagamento` date NOT NULL,
  `total` float NOT NULL,
  `status` tinyint
(
  1
) NOT NULL,
  `id_usuario` int
(
  11
) NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_usuario_fk1785`
(
  `id_usuario`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=9;

--
-- Extraindo dados da tabela `contas_pagar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_receber`
--

CREATE TABLE IF NOT EXISTS `contas_receber`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_venda` int
(
  11
) NOT NULL,
  `id_usuario` int
(
  11
) DEFAULT NULL,
  `parcela` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  `dinheiro` float NOT NULL,
  `troco` float NOT NULL,
  `data_vencimento` date NOT NULL,
  `data_recebimento` date NOT NULL,
  `valor` float NOT NULL,
  `status` tinyint
(
  1
) NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_venda_fk1315`
(
  `id_venda`
),
  KEY `id_usuario_fk1320`
(
  `id_usuario`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=50;


--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE IF NOT EXISTS `fornecedor`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `razao_social` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `nome_fantasia` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `cnpj` int
(
  60
) NOT NULL,
  `ie` int
(
  60
) NOT NULL,
  `telefone` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `data_cadastro` date NOT NULL,
  `cep` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `bairro` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `rua` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `numero` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `estado` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `cidade` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `pais` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=2;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao_funcionario`
--

CREATE TABLE IF NOT EXISTS `funcao_funcionario`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `nome` varchar
(
  150
) COLLATE utf8_bin NOT NULL,
  `descricao` varchar
(
  200
) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=7;


-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_funcao` int
(
  11
) NOT NULL,
  `nome` varchar
(
  150
) COLLATE utf8_bin NOT NULL,
  `cpf` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  `telefone` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  `data_aniversario` date NOT NULL,
  `cep` varchar
(
  100
) COLLATE utf8_bin NOT NULL,
  `rg` varchar
(
  100
) COLLATE utf8_bin NOT NULL,
  `bairro` varchar
(
  150
) COLLATE utf8_bin NOT NULL,
  `rua` varchar
(
  150
) COLLATE utf8_bin NOT NULL,
  `numero` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  `carteira` varchar
(
  100
) COLLATE utf8_bin NOT NULL,
  `data_admissao` date NOT NULL,
  `salario` float NOT NULL,
  `estado` varchar
(
  100
) COLLATE utf8_bin NOT NULL,
  `cidade` varchar
(
  100
) COLLATE utf8_bin NOT NULL,
  `pais` varchar
(
  100
) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_funcao_fk1457`
(
  `id_funcao`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=2;

--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_permissao`
--

CREATE TABLE IF NOT EXISTS `grupo_permissao`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_permissao` varchar
(
  80
) COLLATE utf8_bin NOT NULL,
  `nome` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=3;

--

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo_produto`
--

CREATE TABLE IF NOT EXISTS `grupo_produto`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `nome` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=5;

--

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico_estoque`
--

CREATE TABLE IF NOT EXISTS `historico_estoque`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_produto` int
(
  11
) NOT NULL,
  `id_usuario` int
(
  11
) NOT NULL,
  `acao` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  `data_acao` date NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_produto_fk1007`
(
  `id_produto`
),
  KEY `id_usuario_fk1008`
(
  `id_usuario`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=90;

--

-- Estrutura da tabela `item_compra`
--

CREATE TABLE IF NOT EXISTS `item_compra`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_lote_produto` int
(
  11
) NOT NULL,
  `quantidade` int
(
  11
) NOT NULL,
  `total` float NOT NULL,
  `id_compra` int
(
  11
) NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_lote_produto_fk1009`
(
  `id_lote_produto`
),
  KEY `id_compra_fk1100`
(
  `id_compra`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=10;

--
-- --------------------------------------------------------

--
-- Estrutura da tabela `item_perda`
--

CREATE TABLE IF NOT EXISTS `item_perda`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_perda` int
(
  11
) NOT NULL,
  `id_lote_produto` int
(
  11
) NOT NULL,
  `quantidade` int
(
  11
) NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY
(
  `id`
),
  UNIQUE KEY `id_lote_produto_fk1120`
(
  `id_lote_produto`
),
  KEY `id_perda_fk1110`
(
  `id_perda`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_venda`
--

CREATE TABLE IF NOT EXISTS `item_venda`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_venda` int
(
  11
) NOT NULL,
  `id_lote_produto` int
(
  11
) NOT NULL,
  `quantidade` int
(
  11
) NOT NULL,
  `total` float NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_venda_fk1130`
(
  `id_venda`
),
  KEY `id_lote_produto_fk1140`
(
  `id_lote_produto`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=32;

--
-- Extraindo dados da tabela `item_venda`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `lote_produto`
--

CREATE TABLE IF NOT EXISTS `lote_produto`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_fornecedor` int
(
  11
) NOT NULL,
  `id_produto` int
(
  11
) NOT NULL,
  `numero_lote` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `data_fabricacao` date NOT NULL,
  `data_vencimento` date NOT NULL,
  `quantidade` int
(
  11
) NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_fornecedor_fk1150`
(
  `id_fornecedor`
),
  KEY `id_produto_fk1160`
(
  `id_produto`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=4;

--
-- Extraindo dados da tabela `lote_produto`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `notificacao`
--

CREATE TABLE IF NOT EXISTS `notificacao`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_usuario` int
(
  100
) NOT NULL,
  `id_usuarioEnviar` int
(
  11
) NOT NULL,
  `data_notificacao` date NOT NULL,
  `tipo_notificacao` varchar
(
  100
) COLLATE utf8_bin NOT NULL,
  `propriedades` text COLLATE utf8_bin NOT NULL,
  `status` tinyint
(
  1
) NOT NULL,
  PRIMARY KEY
(
  `id`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=4;

--
-- Extraindo dados da tabela `notificacao`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `perda`
--

CREATE TABLE IF NOT EXISTS `perda`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_usuario` int
(
  11
) NOT NULL,
  `data_perda` int
(
  11
) NOT NULL,
  `total_perda` int
(
  11
) NOT NULL,
  `motivo` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_usuario_fk1170`
(
  `id_usuario`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissao`
--

CREATE TABLE IF NOT EXISTS `permissao`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `nome` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  `descricao` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=6;

--
-- Extraindo dados da tabela `permissao`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `nome` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `cod_barras` varchar
(
  60
) COLLATE utf8_bin NOT NULL,
  `quantidade` int
(
  11
) NOT NULL,
  `quantidade_min` int
(
  11
) NOT NULL,
  `preco` float NOT NULL,
  `preco_compra` float NOT NULL,
  `lucro_venda` float NOT NULL,
  `margem_bruta` float NOT NULL,
  `status` tinyint
(
  1
) NOT NULL,
  `id_grupo_produto` int
(
  11
) NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_grupo_produto_fk1299`
(
  `id_grupo_produto`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=27;

--
-- Extraindo dados da tabela `produto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_imagem`
--

CREATE TABLE IF NOT EXISTS `produto_imagem`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_produto` int
(
  11
) NOT NULL,
  `url` varchar
(
  100
) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_produto_fk1227`
(
  `id_produto`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=25;

--
-- Extraindo dados da tabela `produto_imagem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_grupo_permissao` int
(
  11
) NOT NULL,
  `nome` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  `email` varchar
(
  50
) COLLATE utf8_bin NOT NULL,
  `senha` varchar
(
  32
) COLLATE utf8_bin NOT NULL,
  `status` tinyint
(
  1
) NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_grupo_permissao_fk1180`
(
  `id_grupo_permissao`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=21;

--
-- Extraindo dados da tabela `usuario`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_imagem`
--

CREATE TABLE IF NOT EXISTS `usuario_imagem`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_usuario` int
(
  11
) NOT NULL,
  `url` varchar
(
  100
) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_usuario_fk2221`
(
  `id_usuario`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=9;

--
-- 
-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_token`
--

CREATE TABLE IF NOT EXISTS `usuario_token`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_usuario` int
(
  11
) NOT NULL,
  `hash` varchar
(
  32
) COLLATE utf8_bin NOT NULL,
  `status` tinyint
(
  1
) NOT NULL,
  `data` datetime NOT NULL,
  PRIMARY KEY
(
  `id`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE IF NOT EXISTS `venda`
(
  `id` int
(
  11
) NOT NULL AUTO_INCREMENT,
  `id_cliente` int
(
  11
) NOT NULL,
  `id_usuario` int
(
  11
) NOT NULL,
  `id_funcionario` int
(
  11
) NOT NULL,
  `data_venda` date NOT NULL,
  `total_venda` float NOT NULL,
  `tipo_pag` int
(
  11
) NOT NULL,
  `desconto` float NOT NULL,
  PRIMARY KEY
(
  `id`
),
  KEY `id_cliente_fk1190`
(
  `id_cliente`
),
  KEY `id_usuario_fk1200`
(
  `id_usuario`
),
  KEY `id_funcionario_fk1972`
(
  `id_funcionario`
)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE =utf8_bin AUTO_INCREMENT=31;

--
-- Extraindo dados da tabela `venda`
--


--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `id_fornecedor_fk1001` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_usuario_fk1002` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON
DELETE
NO
ACTION
ON
UPDATE
NO
ACTION;

--
-- Limitadores para a tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  ADD CONSTRAINT `id_usuario_fk1785` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  ADD CONSTRAINT `id_venda_fk1315` FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_venda_fk1320` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON
DELETE
NO
ACTION
ON
UPDATE
NO
ACTION;

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `id_funcao_fk1457` FOREIGN KEY (`id_funcao`) REFERENCES `funcao_funcionario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `historico_estoque`
--
ALTER TABLE `historico_estoque`
  ADD CONSTRAINT `id_produto_fk1007` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_usuario_fk1008` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON
DELETE
NO
ACTION
ON
UPDATE
NO
ACTION;

--
-- Limitadores para a tabela `item_compra`
--
ALTER TABLE `item_compra`
  ADD CONSTRAINT `id_compra_fk1100` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_lote_produto_fk1009` FOREIGN KEY (`id_lote_produto`) REFERENCES `lote_produto` (`id`) ON
DELETE
NO
ACTION
ON
UPDATE
NO
ACTION;

--
-- Limitadores para a tabela `item_perda`
--
ALTER TABLE `item_perda`
  ADD CONSTRAINT `id_lote_produto_fk1120` FOREIGN KEY (`id_lote_produto`) REFERENCES `lote_produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_perda_fk1110` FOREIGN KEY (`id_perda`) REFERENCES `perda` (`id`) ON
DELETE
NO
ACTION
ON
UPDATE
NO
ACTION;

--
-- Limitadores para a tabela `item_venda`
--
ALTER TABLE `item_venda`
  ADD CONSTRAINT `id_lote_produto_fk1140` FOREIGN KEY (`id_lote_produto`) REFERENCES `lote_produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_venda_fk1130` FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id`) ON
DELETE
NO
ACTION
ON
UPDATE
NO
ACTION;

--
-- Limitadores para a tabela `lote_produto`
--
ALTER TABLE `lote_produto`
  ADD CONSTRAINT `id_fornecedor_fk1150` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_produto_fk1160` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`) ON
DELETE
NO
ACTION
ON
UPDATE
NO
ACTION;

--
-- Limitadores para a tabela `perda`
--
ALTER TABLE `perda`
  ADD CONSTRAINT `id_usuario_fk1170` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `id_grupo_produto_fk1299` FOREIGN KEY (`id_grupo_produto`) REFERENCES `grupo_produto` (`id`) ON DELETE NO ACTION;

--
-- Limitadores para a tabela `produto_imagem`
--
ALTER TABLE `produto_imagem`
  ADD CONSTRAINT `id_produto_fk1227` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `id_grupo_permissao_fk1180` FOREIGN KEY (`id_grupo_permissao`) REFERENCES `grupo_permissao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario_imagem`
--
ALTER TABLE `usuario_imagem`
  ADD CONSTRAINT `id_usuario_fk2221` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `id_cliente_fk1190` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_funcionario_fk1972` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`) ON
DELETE
NO
ACTION
ON
UPDATE
NO
ACTION,
ADD
CONSTRAINT
`id_usuario_fk1200`
FOREIGN
KEY
(
`id_usuario`
)
REFERENCES
`usuario`
(
`id`
)
ON
DELETE
NO
ACTION
ON
UPDATE
NO
ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
