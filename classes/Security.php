<?php
/**
 * Classe que contem os métodos que iram
 * filtrar as entradas enviadas via GET e POST
 *
 * @filesource
 * @author      Pedro Elsner <pedro.elsner at gmail.com>
 * @modified    Vinicius Yoshiura
 * @license     http://creativecommons.org/licenses/by/3.0/br/ Creative Commons 3.0
 * @abstract
 * @version     1.0
 */
abstract class Security {
 
/**
 * Filter
 * 
 * @param  mixed $value
 * @param  array $modes
 * @return mixed
 * @static
 * @since  1.0
 */
    static public function filter($value, $modes = array('sql', 'html')) {
        
        /*
         * Caso o parâmetro de entrada $modes não seja um array,
         * então faça $modes ser array.
         */
        if (!is_array($modes)) {
            $modes = array($modes);
        }

        /*
         * Se o parâmetro $value for uma string, chama-se o método
         * doFilter para utilizar o filtro no paraâmetro $valor
         * para os dois tipos de mode (sql e html).
         */
        if (is_string($value)) {
            foreach ($modes as $type) {
              $value = self::doFilter($value, $type);
            }
            return $value;
        }
         
        foreach ($value as $key => $toSanatize) {
            if (is_array($toSanatize)) {
                $value[$key]= self::filter($toSanatize, $modes);
            } else {
                foreach ($modes as $type) {

                  $value[$key] = self::doFilter($toSanatize, $type);
                  
                }
            }
        }
       
        return $value;
    }
 
/**
 * DoFilter
 * 
 * @param  mixed $value
 * @param  array $modes
 * @return mixed
 * @static
 * @since  1.0
 */
    static protected function doFilter($value, $mode) {
        /*
         * Se a variável mode for html, trata tags html
         * Se a variável mode for sql, trata comando sql
         */
        switch ($mode) {
            case 'html':
                /* Retira as tags HTML e PHP de uma string */
                $value = strip_tags($value); 
                /* adiciona '\' quando houver caracteres pre-definidos que são '(quote), ''(doublee quote) e \(backslash) */
                $value = addslashes($value); 
                /* htmlspecialchars() converte alguns caracteres predefinidos para entidades HTML.
                 * Exemplo: & (ampersand) becomes &amp;
                            " (double quote) becomes &quot;
                            ' (single quote) becomes &#039;
                            < (less than) becomes &lt;
                            > (greater than) becomes &gt; */
                $value = htmlspecialchars($value, ENT_COMPAT,'ISO-8859-1', true);
                break;
        
            case 'sql':
                /* 
                 * preg_replace(padrao, replaces, string):
                 *  Realiza uma pesquisa em 'string' por uma expressa 'padrao'
                 *  e a substitui por 'replaces' .
                 * sql_regcase: cria expressões regulares insensíveis a maiúsculas e minúsculas
                 */
                
                
                $sqlregcase = "/([Ff][Rr][Oo][Mm]|[Ss][Ee][Ll][Ee][Cc][Tt]|[Cc][Oo][Uu][Nn][Tt]|[Tt][Rr][Uu][Nn][Cc][Aa][Tt][Ee]|[Ee][Xx][Pp][Ll][Aa][Ii][Nn]|[Ii][Nn][Ss][Ee][Rr][Tt]|[Dd][Ee][Ll][Ee][Tt][Ee]|[Ww][Hh][Ee][Rr][Ee]|[Uu][Pp][Dd][Aa][Tt][Ee]|[Ee][Mm][Pp][Tt][Yy]|[Dd][Rr][Oo][Pp] [Tt][Aa][Bb][Ll][Ee]|[Ll][Ii][Mm][Ii][Tt]|[Ss][Hh][Oo][Ww] [Tt][Aa][Bb][Ll][Ee][Ss]|[Oo][Rr]|[Oo][Rr][Dd][Ee][Rr] [Bb][Yy]|#|\*|--|\\\)/";
                $value = preg_replace($sqlregcase,'',$value);
                /* trim : Retira espaço no ínicio e final de uma string */
                $value = trim($value);
                

                
                break;
        }
        //echo $value;
        return $value;
    }
 
}
?>
