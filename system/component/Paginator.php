<?php

// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@lg4.cn>
// +----------------------------------------------------------------------

namespace system\component;

/**
 * $page = new \system\component\Paginator();
 * $page->setPageSize(1);
 * echo $page->getTotalPage();
 */
class Paginator
{

    public $limit;
    public $page;
    public $total;
    public $data;
    public $prevLink = 'javascript:void(0);';
    public $nextLink = 'javascript:void(0);';

    public function __construct($page = 1, $limit = 20, $data = array())
    {
        $this->page = $page ? $page : 1;
        $this->limit = $limit;
        $this->data = $data;
    }

    public static function make($page = 1, $limit = 20, $data = array())
    {
        return new Paginator($page, $limit, $data);
    }

    public function setTotal($total)
    {
        $this->total = $total;
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function getOffset()
    {
        return ceil(($this->page - 1) * $this->limit);
    }

    public function render($linkNum = 7, $list_class = 'pagination pagination-sm', $item_class = 'page-item')
    {
        if ($this->limit == 'all' || $this->limit == 0) {
            return '';
        }

        $last = ceil($this->total / $this->limit);
        $last = $last == 0 ? 1 : $last;
        $start = (($this->page - $linkNum) > 0) ? $this->page - $linkNum : 1;
        $end = (($this->page + $linkNum) < $last) ? $this->page + $linkNum : $last;

        $html = '<ul class="' . $list_class . '">';

        if ($this->page == 1) {
            $class = $item_class;
            $html .= '<li class="' . $class . '"><a class="page-link"  href="javascript:void(0);">&laquo;</a></li>';
        }

        if ($start > 1) {
            $html .= '<li class="page-item"><a class="page-link"  href="?' . $this->buildQuery(array('limit' => $this->limit, 'page' => 1)) . '">1</a></li>';
            $html .= '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)">...</a></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ($this->page == $i) ? "page-item active" : "";
            $html .= '<li class="' . $class . '"><a class="page-link"  href="?' . $this->buildQuery(array('limit' => $this->limit, 'page' => $i)) . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html .= '<li class="disabled"><span>...</span></li>';
            $html .= '<li><a class="page-link"  href="?' . $this->buildQuery(array('limit' => $this->limit, 'page' => $last)) . '">' . $last . '</a></li>';
        }

        if ($this->page == $last) {
            $html .= '<li class="' . $item_class . '"><a class="page-link"  href="javascript:void(0);">&raquo;</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }

    protected function buildQuery($data)
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }
        return http_build_query($this->data);
    }

    public function getPrevLink()
    {
        if ($this->page - 1) {
            $this->prevLink = '?' . $this->buildQuery(array('limit' => $this->limit, 'page' => $this->page - 1));
        }
        return $this->prevLink;
    }

    public function getNextLink()
    {
        $last = ceil($this->total / $this->limit);
        $last = $last == 0 ? 1 : $last;
        if ($this->page < $last) {
            $this->nextLink = '?' . $this->buildQuery(array('limit' => $this->limit, 'page' => $this->page + 1));
        }
        return $this->nextLink;
    }

}
