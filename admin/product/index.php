<?php

// +----------------------------------------------------------------------
// | H1CMS © OpenSource CMS
// +----------------------------------------------------------------------
// | Copyright (c) 2014-2016 http://www.h1cms.com All rights reserved.
// | Copyright (c) 2014-2016 嘉兴领格信息技术有限公司，并保留所有权利。
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Allen <allen@getw.com>
// +----------------------------------------------------------------------

require '../autoload.php';

use system\Auth;
use system\model\Product;
use getw\DB;
use system\component\Paginator;

function indexAction()
{
    page()->setTitle('产品管理');
    page()->setLeftMenuActive('product.index');

    $st = input_get('st', 'title');
    $s = input_get('s', '');
    $query = DB::select('product AS n,product_language as nl');
    $query->where('nl.node_id=n.node_id')
        ->where('nl.language_id',H_DEFAULT_LANGUAGE)
        ->where('n.node_type=\'node\'');
    if ($st == 'title' && $s) {
        $query->where(['nl.title','like',"%{$s}%"]);
    } else if ($st == 'id' && $s) {
        $query->where('n.node_id=:node_id',['node_id'=>intval($s)]);
    }
    $pagehelper = Paginator::make(input_get('page', 1), 20, $_GET);
    $pagehelper->setTotal(Product::count($query));
    $query->limit($pagehelper->getLimit(),$pagehelper->getOffset());
    $nodes = Product::getAll($query);
    render('product.index', ['nodes' => $nodes, 'pagehelper' => $pagehelper]);
}

function addGET()
{
    page()->setLeftMenuActive('product.index');
    page()->setTitle('产品管理');
    $c = new \system\component\Category('product_category', 'product_category_language', 'category_id');

    render('product.product_form', ['categories' => $c->getList()]);
}

function addPOST()
{
    $data_languages = input_post('language', []);
    $data_node = input_post('node', []);
    $data_node['node_date'] = strtotime($data_node['node_date']);
    //auth  or
    $data_node['author'] = Auth::user()->id;
    $data_node['node_type'] = 'node';
    $data_node['content_type'] = 'html';
    $data_node['created_at'] = time();
    $data_node['updated_at'] = time();
    $parent_id = intval(input_post('parent_id', 0));
    $model = new Product();
    $node_id = $model->add($data_node, $data_languages, $parent_id);
    if ($node_id) {
        add_flash('产品添加成功', SESSION_SUCCESS);
        redirect(url_for('/product/index.php'));
    } else {
        add_flash('产品添加失败', SESSION_ERROR);
        redirect(url_for('/product/index.php'));
    }
}

function editGET()
{
    $node_id = intval(input_get('id'));
    page()->setLeftMenuActive('product.index');
    page()->setTitle('产品管理');
    $c = new \system\component\Category('product_category', 'product_category_language', 'category_id');

    $node = Product::findById($node_id);
    $language = $node->getLanguageById($node_id);
    $relationships = $node->getRelationships($node_id);
    render('product.product_form', ['categories' => $c->getList(), 'node' => $node, 'language' => $language, 'relationships' => $relationships]);
}

function editPOST()
{
    $node_id = intval(input_get('id'));
    $data_languages = input_post('language', []);
    $data_node = input_post('node', []);
    $data_node['node_date'] = strtotime($data_node['node_date']);
    $data_node['updated_at'] = time();
    $parent_id = intval(input_post('parent_id', 0));
    $model = new Product();
    $result = $model->update($node_id, $data_node, $data_languages, $parent_id);
    if ($result) {
        add_flash('产品修改成功', SESSION_SUCCESS);
        redirect(url_for('/product/index.php'));
    } else {
        add_flash('产品修改失败', SESSION_ERROR);
        redirect(url_for('/product/index.php'));
    }
}