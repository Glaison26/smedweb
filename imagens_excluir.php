<?php
  $caminho_arquivo = 'caminho/do/arquivo.txt';

  if (file_exists($caminho_arquivo)) {
    if (unlink($caminho_arquivo)) {
      echo "O arquivo foi excluído com sucesso.";
    } else {
      echo "Falha ao excluir o arquivo.";
    }
  } else {
    echo "O arquivo não existe.";
  }
?>         