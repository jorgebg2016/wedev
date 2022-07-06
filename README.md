### Projeto Laravel & Vue

#### - Execute ./start no terminal

##### 1 - Executa o comando 'docker-compose up -d --build' para a construção dos containers de aplicação e de banco de dados.

##### 2 - Quando o container das aplicações é levantado, então é executado o script 'docker-server-entrypoint.sh'(cujos logs são visualizados atravez do comando 'docker logs -f applications') para instalação dos pacotes adicionais, dos pacotes de dependência das aplicações, execução das migrations, das seeds e inicio das aplicações no container de aplicação.


