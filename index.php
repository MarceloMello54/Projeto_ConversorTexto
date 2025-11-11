<?php
require __DIR__ . '/vendor/autoload.php';

use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/chave.json');

$audioData = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['texto'])) {
    $text = $_POST['texto'];

    try {
        $client = new TextToSpeechClient();

        // Configura o texto
        $input = new SynthesisInput();
        $input->setText($text);

        // Seleção da voz
        $voice = new VoiceSelectionParams();
        $voice->setLanguageCode('pt-BR');
        $voice->setSsmlGender(SsmlVoiceGender::FEMALE);

        // Configuração de áudio
        $audioConfig = new AudioConfig();
        $audioConfig->setAudioEncoding(AudioEncoding::MP3);

        // Gera o áudio
        $response = $client->synthesizeSpeech($input, $voice, $audioConfig);
        $audioData = base64_encode($response->getAudioContent());

        $client->close();
    } catch (Exception $e) {
        $error = "❌ Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Text-to-Speech PHP</title>
    <link rel="stylesheet" href="style.css ?v=<?php echo time(); ?>">
</head>

<body>

    <form method="post" id="formulario">
        <h1>Conversor de Texto para Áudio</h1>
        <textarea name="texto" placeholder="Digite o texto aqui..."><?php echo htmlspecialchars($_POST['texto'] ?? ''); ?></textarea>
        <br><br>
        <div class="info">
            <strong>Instruções:</strong>
            <ul>
                <li>Digite o texto que deseja converter em áudio no campo acima.</li>
                <li>Clique em "Gerar Áudio" para ouvir a reprodução do texto.</li>
                <li>Clique para "Limpar" para recomeçar novamente </li>
            </ul>
        </div>
        <div class="button">
          <button type="submit" class="btn">Gerar Áudio</button>  
          <button type="button" class="btn" onclick="limparFormulario()">Limpar</button> 
        </div>
       

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($audioData): ?>
            <audio controls autoplay>
                <source src="data:audio/mpeg;base64,<?php echo $audioData; ?>" type="audio/mpeg">
                Seu navegador não suporta áudio.
            </audio>    
        <?php endif; ?>
    </form>
</body>

<script>
function limparFormulario() {
      document.querySelector('textarea[name="texto"]').value = '';
    
    const audio = document.querySelector('audio');
    if(audio) {
        audio.remove();
    }
}
</script>


</html>