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

require '../autoload.php';

use system\Auth;
use system\model\Node;
use getw\DB;

function indexAction()
{
    page()->setTitle('文章管理');
    page()->setLeftMenuActive('node.index');

    $st = input_get('st', 'title');
    $s = input_get('s', '');
    $query = DB::select('node AS n,node_language as nl');
    $query->where('nl.node_id=n.node_id')
        ->where('nl.language_id',H_DEFAULT_LANGUAGE)
        ->where('n.node_type=\'node\'');
    if ($st == 'title' && $s) {
        $query->where(['nl.title','like',"%{$s}%"]);
    } else if ($st == 'id' && $s) {
        $query->where('n.node_id=:node_id',['node_id'=>intval($s)]);
    }
    $pagehelper = \system\component\Paginator::make(input_get('page', 1), 20, $_GET);
    $pagehelper->setTotal(Node::count($query));
    $query->limit($pagehelper->getLimit(),$pagehelper->getOffset());
    $nodes = Node::getAll($query);
    render('node.index', ['nodes' => $nodes, 'pagehelper' => $pagehelper]);
}

function addGET()
{
    page()->setLeftMenuActive('node.index');
    page()->setTitle('文章管理');
    $c = new \system\component\Category('node_category', 'node_category_language', 'category_id');

    render('node.node_form', ['categories' => $c->getList()]);
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
    $model = new Node();
    $node_id = $model->addNode($data_node, $data_languages, $parent_id);
    if ($node_id) {
        add_flash('文章添加成功', SESSION_SUCCESS);
        redirect(url_for('/node/index.php'));
    } else {
        add_flash('文章添加失败', SESSION_ERROR);
        redirect(url_for('/node/index.php'));
    }
}

function editGET()
{
    $node_id = intval(input_get('id'));
    page()->setLeftMenuActive('node.index');
    page()->setTitle('文章管理');
    $c = new \system\component\Category('node_category', 'node_category_language', 'category_id');

    $node = Node::findById($node_id);
    $language = $node->getLanguageById($node_id);
    $relationships = $node->getRelationships($node_id);
    render('node.node_form', ['categories' => $c->getList(), 'node' => $node, 'language' => $language, 'relationships' => $relationships]);
}

function editPOST()
{
    $node_id = intval(input_get('id'));
    $data_languages = input_post('language', []);
    $data_node = input_post('node', []);
    $data_node['node_date'] = strtotime($data_node['node_date']);
    $data_node['updated_at'] = time();
    $parent_id = intval(input_post('parent_id', 0));
    $model = new Node();
    $result = $model->updateNode($node_id, $data_node, $data_languages, $parent_id);
    if ($result) {
        add_flash('文章添加成功', SESSION_SUCCESS);
        redirect(url_for('/node/index.php'));
    } else {
        add_flash('文章添加失败', SESSION_ERROR);
        redirect(url_for('/node/index.php'));
    }
}