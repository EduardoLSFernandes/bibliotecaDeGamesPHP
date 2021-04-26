<?php

namespace App\Db;

class Pagination
{
    //MAXIMO DE REGISTRO POR PAGINA
    private $limit;

    //QUANTIDADE TOTAL DE RESULTADOS DO BANCO
    private $results;

    //QUANTIDADE DE PAGINAS
    private $pages;

    //PAGINA ATUAL
    private $currentPage;

    //CONSTRUTOR DA CLASSE
    public function __construct($results, $currentPage = 1, $limit = 10)
    {
        $this->results      = $results;
        $this->limit        = $limit;
        $this->currentPage  = (is_numeric($currentPage) and $currentPage > 0) ? $currentPage : 1;
        $this->calculate();
    }


    //METODO PARA CALCULAR PAGINACAO  
    private function calculate()
    {
        //CALCULA O TOTAL DE PAGINAS
        $this->pages = $this->results > 0 ? ceil($this->results / $this->limit) : 1;

        //VERIFICA SE A PAGINA ATUAL NAO EXCEDE O NUMERO DE PAGINAS
        $this->currentPage = $this->currentPage <= $this->pages ? $this->currentPage : $this->pages;
    }

    //METODO PARA RETORNAR A CLAUSULA LIMIT
    public function getLimit()
    {
        $offset = ($this->limit * ($this->currentPage - 1));
        return $offset . ',' . $this->limit;
    }

    //METODO PARA RETORNAR OPCOES DE PAGINAS DISPONIVEIS
    public function getPages()
    {
        //NAO RETORNA PAGINAS
        if ($this->pages == 1) return [];

        //PAGINAS
        $paginas = [];
        for ($i = 1; $i <=  $this->pages; $i++) {
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->currentPage
            ];
        }

        return $paginas;
    }
}
