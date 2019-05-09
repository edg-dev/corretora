<?php
/*
 * https://www.todoespacoonline.com/w/2014/10/redimensionar-imagens-com-php/
 */
class RedimensionaImagem
{

    /*-------------------------------------------------------------------------*
     * Público
    /*------------------------------------------------------------------------*/
    
    /* Configurações públicas referentes à imagem */
    public $imagem, 
           $imagem_destino, 
           $largura, 
           $altura, 
           $qualidade = 75; // Max. 100
    
    // Nosso erro
    public $erro;
    
    /* Extensões permitidas */
    public $extensoes = array ( 'jpg', 'png', 'gif' );

    /*-------------------------------------------------------------------------*
     * Privado
    /*------------------------------------------------------------------------*/

    /* Extensão da imagem enviada */
    private $extensao;
    
    /* Configurações privadas referentes à nova imagem */
    private $r_imagem, 
            $nova_altura, 
            $nova_largura, 
            $largura_original, 
            $altura_original;

    /*-------------------------------------------------------------------------*
     * Métodos Públicos
    /*------------------------------------------------------------------------*/
    
    /**
     * Executa o redimensionamento da imagem
     *
     * @return string|bool O endereço da imagem ou false
     */
    public function executa() { 
        
        /* Captura a extensão da imagem enviada */
        $extensao = strrchr( $this->imagem, '.' );
        
        /* Garante que a extensão terá apenas letras minúsculas */
        $extensao = strtolower( $extensao );
        
        /* Remove o ponto da extensão */
        $extensao = str_replace('.', '', $extensao);
        
        /* 
        Se a extensão enviada não estiver entre as extensões permitidas, 
        preenche o erro e retorna falso
        */
        if ( ! in_array( $extensao, $this->extensoes ) ) {
            $this->erro = 'Arquivo não permitido.';
            return;
        }
        
        /* 
        Se a imagem não existir, preenche o erro e retorna falso
        */
        if ( ! file_exists( $this->imagem ) ) {
            $this->erro = 'Arquivo inexistente.';
            return;
        }
        
        /* Se a extensão for jpg */
        if ( 'jpg' === $extensao ) {
            
            /* Cria uma imagem jpg a partir da imagem enviada */
            $this->r_imagem = imagecreatefromjpeg($this->imagem);
            
            /* Cria a nova imagem com o tamanho correto */
            $imagem_redimensionada = $this->redimensiona();
            
            /* Se a nova imagem não for criada, preenche o erro e retorna */
            if ( ! $imagem_redimensionada ) {
                $this->erro = 'Erro ao redimensionar imagem.';
                return;
            }
            
            /* Copia a nova imagem da imagem antiga com o tamanho correto */
            imagecopyresampled(
                $imagem_redimensionada, 
                $this->r_imagem, 
                0, 
                0, 
                0, 
                0, 
                $this->nova_largura, 
                $this->nova_altura,
                $this->largura_original, 
                $this->altura_original
            
            );
            
            /* 
            Se a imagem de destino não for configurada, vamos exibir a nova 
            imagem na tela 
            */
            if ( ! $this->imagem_destino ) {
                header('Content-type: image/jpg');
            }        
            
            /* Cria a imagem ou exibe na tela */
            imagejpeg ( 
                $imagem_redimensionada, 
                $this->imagem_destino, 
                $this->qualidade 
            );
            
        } /* jpg */
        
        /* Se a extensão for png */
        elseif ( 'png' === $extensao ) {
        
            /* Cria uma imagem png a partir da imagem enviada */
            $this->r_imagem = imagecreatefrompng($this->imagem);
            
            /* Cria a nova imagem com o tamanho correto */
            $imagem_redimensionada = $this->redimensiona();
            
            /* Se a nova imagem não for criada, preenche o erro e retorna */
            if ( ! $imagem_redimensionada ) {
                $this->erro = 'Erro ao redimensionar imagem.';
                return;
            }
            
            /* 
            Se a imagem de destino não for configurada, vamos exibir a nova 
            imagem na tela 
            */
            if ( ! $this->imagem_destino ) {
                header('Content-type: image/png');
            }        
            
            /* Copia a nova imagem da imagem antiga com o tamanho correto */
            imagecopyresampled(
                $imagem_redimensionada, 
                $this->r_imagem, 
                0, 
                0, 
                0, 
                0, 
                $this->nova_largura, 
                $this->nova_altura, 
                $this->largura_original, 
                $this->altura_original
            
            );
            
            /* Para o formato png, a qualidade vai de 0 a 9 */
            $this->qualidade = $this->qualidade / 10;
            $this->qualidade = $this->qualidade > 9 ? 
                               9 : 
                               floor( $this->qualidade );
            
            /* Cria a imagem ou exibe na tela */
            imagepng ( 
                $imagem_redimensionada, 
                $this->imagem_destino, 
                $this->qualidade 
            );
            
        } /* png */
        
        /* Se a extensão for gif */
        elseif ( 'gif' === $extensao ) {
        
            /* Cria uma imagem gif a partir da imagem enviada */
            $this->r_imagem = imagecreatefromgif($this->imagem);
            
            /* Cria a nova imagem com o tamanho correto */
            $imagem_redimensionada = $this->redimensiona();

            /* Se a nova imagem não for criada, preenche o erro e retorna */
            if ( ! $imagem_redimensionada ) {
                $this->erro = 'Erro ao redimensionar imagem.';
                return;
            }
            
            /* 
            Se a imagem de destino não for configurada, vamos exibir a nova 
            imagem na tela 
            */
            if ( ! $this->imagem_destino ) {
                header('Content-type: image/png');
            }        
            
            /* Copia a nova imagem da imagem antiga com o tamanho correto */
            imagecopyresampled(
                $imagem_redimensionada, 
                $this->r_imagem, 
                0, 
                0, 
                0, 
                0, 
                $this->nova_largura, 
                $this->nova_altura, 
                $this->largura_original, 
                $this->altura_original
            
            );
            
            /* Cria a imagem ou exibe na tela */
            imagegif( $imagem_redimensionada, $this->imagem_destino );
            
        } /* gif */
        
        /* Destroy as imagens geradas */
        if ( $imagem_redimensionada ) {
            imagedestroy( $imagem_redimensionada );
        }
        
        if ( $this->r_imagem ) {
            imagedestroy( $this->r_imagem );
        } 
        
        /* Retorna o endereço da imagem */
        return $this->imagem_destino;
        
    } /* executa() */
    
    /*-------------------------------------------------------------------------*
     * Métodos Privados
    /*------------------------------------------------------------------------*/

    /* Cria a nova imagem redimensionada */
    final private function redimensiona() {
    
        /* Se não for resource, termina aqui */
        if( ! is_resource( $this->r_imagem ) ) return;
        
        /* Obtém a largura e altura da imagem */
        list($largura, $altura) = getimagesize( $this->imagem );
        
        /* Configura as propriedades */
        $this->largura_original = $largura;
        $this->altura_original = $altura;
        
        /* Configura a nova largura */
        $this->nova_largura = 
        $this->largura ? $this->largura : 
        floor ( ( $this->largura_original / $this->altura_original ) * 
        $this->altura );
        
        /* Configura a nova altura */
        $this->nova_altura = 
        $this->altura ? $this->altura : 
        floor( ( $this->altura_original / $this->largura_original ) * 
        $this->largura );
        
        /* Retorna a nova imagem criada */
        return imagecreatetruecolor( $this->nova_largura, $this->nova_altura );
        
    } /* redimensiona() */
    
    
} /* TutsupRedimensionaImagem */