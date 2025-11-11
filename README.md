# Projeto_ConversorTexto
Projeto: Text-to-Speech PHP com Google Cloud Descrição: Este projeto é um reprodutor de texto para áudio usando PHP e a API Google Cloud Text-to-Speech. Permite que o usuário digite um texto, gere um áudio em português do Brasil com voz feminina e toque diretamente no navegador. Inclui um botão Limpar para apagar o texto e o áudio instantaneamente.
Requisitos • XAMPP (ou outro servidor PHP local) • PHP 8.x • Composer • Conta no Google Cloud com API Text-to-Speech ativada • Arquivo de chave JSON de conta de serviço do Google Cloud
Estrutura do projeto Projeto_ConversorTexto/ │ ├─ controller/ │ └─ index.php # Código principal ├─ vendor/ # Bibliotecas do Composer ├─ chave.json # Chave da conta de serviço Google Cloud ├─ style.css # Design do Projeto └─ README.md # Este arquivo
Como foi configurado o projeto:
•	compositor
1.	Baixe o Composer: https://getcomposer.org/download/
2.	Instale e marque a opção de adicionar ao PATH.
3.	Verifique nenhum terminal: compositor -V
•	Google Cloud TTS
1.	Crie uma conta de serviço no Google Cloud.
2.	Ative uma API de texto para fala.
3.	Gere o arquivo JSON da conta de serviço.
4.	Coloque esse arquivo na pasta do projeto e renomeie para chave.json.
•	Instalar dependências via Composer
1.	No terminal, dentro da pasta do projeto: compositor requer google/cloud-text-to-speech
2.	Isso cria um vendedor de macarrão/ com todas as bibliotecas permitidas.
•	Configurar o código index.php
1.	Caminho do JSON no código: putenv('GOOGLE_APPLICATION_CREDENTIALS=' . DIR . '/chave.json'); O formulário HTML permite:
2.	Texto digital
3.	Gerar áudio
4.	Limpar formulário e áudio via JS
5.	Função JS para limpar

