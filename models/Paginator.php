<?php

namespace Model;

use stdClass;

require_once __DIR__ . '/../includes/config/db.php';

class Paginator
{

    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;


    public function __construct($query)
    {

        $this->_conn = connectDB();
        $this->_query = $query;

        $rs = $this->_conn->query($this->_query);

        if (!$rs) {
            debug("Errormessage: %s\n", $this->_conn->error);
        }
        $this->_total = $rs->num_rows;
    }



    /**
     * @param int $limit
     * @param int $page
     * 
     * @return [object]
     */
    public function getData($limit = 10, $page = 1)
    {

        $this->_limit   = $limit;
        $this->_page    = $page;
        $results[] = null;
        if ($this->_limit == 'all') {
            $query      = $this->_query;
        } else {
            $query      = $this->_query . " LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";
        }
        $rs             = $this->_conn->query($query);

        while ($row = $rs->fetch_assoc()) {
            $results[]  = $row;
        }

        $result         = new stdClass();

        $result->page   = $this->_page;
        $result->limit  = $this->_limit;
        $result->total  = $this->_total;
        $result->data   = $results;

        return $result;
    }


    /**
     * @param mixed $url
     * 
     * @return [type]
     */
    public function buildLinks($url)
    {
        $previus = ($this->_page - 1);
        $next = ($this->_page + 1);
        $current = ($this->_page);

        $html = '
        <nav aria-label="...">
            <ul class="pagination d-flex justify-content-center">';
        if ($this->_page == 1) {
            $html .= '
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>';
            if ($_SERVER['PATH_INFO'] == '/proyecto') {
                $html .= '<li class="page-item active"><a class="page-link" href="' . $url . '&limit=10&page=1">1</a></li>';
            } else {
                $html .= '<li class="page-item active"><a class="page-link" href="' . $url . '?limit=10&page=1">1</a></li>';
            }
        } else {

            if ($_SERVER['PATH_INFO'] == '/proyecto') {
                $html .= '
                <li class="page-item ">
                    <a class="page-link" href="' . $url . '&limit=10&page=' . $previus . '"' . ' tabindex="-1">Anterior</a>
                </li>';
                $html .= '<li class="page-item"><a class="page-link" href="' . $url . '&limit=10&page=1">1</a></li>';
            } else {
                $html .= '
                <li class="page-item ">
                    <a class="page-link" href="' . $url . '?limit=10&page=' . $previus . '"' . ' tabindex="-1">Anterior</a>
                </li>';
                $html .= '<li class="page-item"><a class="page-link" href="' . $url . '?limit=10&page=1">1</a></li>';
            }
        }



        //current

        if ($this->_page > 1) {

            if ($_SERVER['PATH_INFO'] == '/proyecto') {

                $html .= '
                    <li class="page-item active">
                        <a class="page-link" href=" ' . $url . '&limit=10&page=' . $current . '">' . $current . '</a>  <span class="sr-only">(current)</span></a>
                    </li>
                    ';
            } else {

                $html .= '
                    <li class="page-item active">
                        <a class="page-link" href=" ' . $url . '?limit=10&page=' . $current . '">' . $current . '</a>  <span class="sr-only">(current)</span></a>
                    </li>
                    ';
            }
        }





        //next
        if ($this->_page < ceil($this->_total / 10)) {


            if ($_SERVER['PATH_INFO'] == '/proyecto') {
                //Siguiente
                $html .= '
                    <li class="page-item  ">
                        <a class="page-link" href="' . $url . '&limit=10&page=' . $next . '"' . ' tabindex="-1"> ' . $next . '</a>
                    </li>';


                if ($next < ceil($this->_total / 10)) {
                    //ultimo
                    $html .= '
                        <li class="page-item  ">
                            <a class="page-link" href="' . $url . '&limit=10&page=' . ceil($this->_total / 10) . '"' . ' tabindex="-1"> ' . ceil($this->_total / 10) . '</a>
                        </li>';
                }


                $html .= '
                <li class="page-item  ">
                    <a class="page-link" href="' . $url . '&limit=10&page=' . $next . '"' . ' tabindex="-1">Siguiente</a>
                </li>
                </ul>
                </nav>
                ';
            } else {
                //Siguiente
                $html .= '
                <li class="page-item  ">
                    <a class="page-link" href="' . $url . '?limit=10&page=' . $next . '"' . ' tabindex="-1"> ' . $next . '</a>
                </li>';


                if ($next < ceil($this->_total / 10)) {
                    //ultimo
                    $html .= '
                <li class="page-item  ">
                    <a class="page-link" href="' . $url . '?limit=10&page=' . ceil($this->_total / 10) . '"' . ' tabindex="-1"> ' . ceil($this->_total / 10) . '</a>
                </li>';
                }

                $html .= '
                <li class="page-item  ">
                    <a class="page-link" href="' . $url . '?limit=10&page=' . $next . '"' . ' tabindex="-1">Siguiente</a>
                </li>
                </ul>
                </nav>
                ';
            }
        }

        return $html;
    }
}
