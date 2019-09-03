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

use system\component\Category;

function indexAction()
{
    page()->setTitle('分类管理');
    page()->setLeftMenuActive('product.category');
    $c = new Category('product_category', 'product_category_language', 'category_id');
    render('product.category', ['categories' => $c->getAll()]);
//    render('node.category', ['categories' => $c->getList()]);

}

function addGet()
{
    page()->setTitle('分类管理');
    page()->setLeftMenuActive('product.category');
    $c = new Category('product_category', 'product_category_language', 'category_id');
    render('product.category_form', ['categories' => $c->getList()]);
}

function addPOST()
{
    $category = input_post('category');
    $language = input_post('language');
    $c = new Category('product_category', 'product_category_language', 'category_id');
    $c->addCategory($category, $language);
    add_flash('分类添加成功', SESSION_SUCCESS);
    redirect(url_for('/product/category.php'));
}


function editGet()
{
    page()->setTitle('分类管理');
    $category_id = intval(input_get('id'));
    page()->setLeftMenuActive('product.category');
    $c = new Category('product_category', 'product_category_language', 'category_id');
    render('product.category_form', [
        'categories' => $c->getList(),
        'category' => $c->getCategoryById($category_id),
        'language' => $c->getCategoryLanguageById($category_id)
    ]);
}

function editPOST()
{
    $category_id = intval(input_get('id'));
    $category = input_post('category');
    $language = input_post('language');
    $c = new Category('product_category', 'product_category_language', 'category_id');
    $rs = $c->editCategory($category_id, $category, $language);
    ifRedirect(is_null($rs), url_for('/product/category.php'), '分类不存在', SESSION_SUCCESS);
    add_flash('分类修改成功', SESSION_SUCCESS);
    redirect(url_for('/product/category.php'));
}

function deleteAction()
{
    $category_id = intval(input_post('id'));
    if (\getw\Input::isAjax() && $category_id) {
        $c = new Category('product_category', 'product_category_language', 'category_id');
        $c->removeCategory($category_id);
        echo json_encode(['type' => 'success', 'message' => '分类已删除']);
    }

}



