<?php
    function weather() {
        include_once "simple_html_dom.php";
        $html = file_get_html('https://www.yr.no/place/Czech_Republic/Prague/Prague/long.html');
        foreach($html->find('table.yr-table-longterm') as $value) {
            $value->setAttribute("style", "text-align: center;");
            foreach($value->find('thead tr th') as $t) {
                $t->setAttribute("style", "width: 3%;");
            }
            foreach($value->find('thead tr th span') as $s) {
                $s->setAttribute("style", "display:block; font-weight: 400;");
            }
            foreach($value->find('tr td img') as $a) {
                $xd = $a->src;
                $a->src = "https://yr.no".$xd;
            }
            foreach($value->find('caption') as $e) {
                $e->innertext = '';
            }

        echo $value->outertext;
        }
    }
?>