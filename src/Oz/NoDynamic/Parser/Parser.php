<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/2/14
 * Time: 16:24
 */

namespace Oz\NoDynamic\Parser;


/**
 * Class Parser
 * @package Oz\NoDynamic\Parser
 */
class Parser {

    const TOKEN_H1 = 'h1';
    const TOKEN_H2 = 'h2';
    const TOKEN_BLOCKQUOTE = 'blockquote';

    /**
     * format name, eg markdown
     * @var string
     */
    protected $name;
    /**
     * name of file extension that this parser supports or array of extensions
     * @var array|string
     */
    protected $ext;

    /**
     * Parse file and return parsed template with metadata
     * @param $path
     */

    /**
     * @var TokenFactoryInterface
     */
    protected $tokenFactory;

    /**
     * @return TokenFactoryInterface
     */
    public function getTokenFactory()
    {
        return $this->tokenFactory;
    }

    /**
     * @param TokenFactoryInterface $tokenFactory
     */
    public function setTokenFactory($tokenFactory)
    {
        $this->tokenFactory = $tokenFactory;
    }



    public function parseFile($path){

    }

    /**
     * Parse string and return twig template
     * @param $string
     */
    public function parseString($string){
        $result = $string;

        $result = $this->parseByToken(self::TOKEN_H1, $result, '<h1>', '</h1>');
        $result = $this->parseByToken(self::TOKEN_H2, $result, '<h2>', '</h2>');

        return $result;
    }

    protected function parseByToken($tokenName, $string, $replacementStart, $replacementEnd = ''){
        $token = $this->tokenFactory->getToken($tokenName);
        if(!$token){
            return $string;
        }

        return $token->parse($string, $replacementStart, $replacementEnd);
    }

    /**
     * Return true if parser support file in $path
     * @param $path string
     */
    public function supports($path){

    }

    protected function parseMeta($string){

    }

    protected function parseTemplate($string){

    }
} 