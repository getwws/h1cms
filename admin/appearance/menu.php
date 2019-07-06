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

function indexAction()
{
    page()->setLeftMenuActive('appearance.menu');
    page()->setTitle('菜单');
    $c = new \system\component\Category('node_category', 'node_category_language', 'category_id');
    render('appearance.menu', ['categories' => $c->getAll()]);
//    render('node.category', ['categories' => $c->getList()]);

}

function addGet()
{
    page()->setLeftMenuActive('node.category');
    $c = new \system\component\Category('node_category', 'node_category_language', 'category_id');
    render('node.category_form', ['categories' => $c->getList()]);
}

function addPOST()
{
    $category = input_post('category');
    $language = input_post('language');
    $c = new \system\component\Category('node_category', 'node_category_language', 'category_id');
    $c->addCategory($category, $language);
    add_flash('分类添加成功', SESSION_SUCCESS);
    redirect(url_for('/node/category.php'));
}


function editGet()
{
    $category_id = intval(input_get('id'));
    page()->setLeftMenuActive('node.category');
    $c = new \system\component\Category('node_category', 'node_category_language', 'category_id');
    render('node.category_form', [
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
    $c = new \system\component\Category('node_category', 'node_category_language', 'category_id');
    $rs = $c->editCategory($category_id, $category, $language);
    ifRedirect(is_null($rs), url_for('/node/category.php'), '分类不存在', SESSION_SUCCESS);
    add_flash('分类修改成功', SESSION_SUCCESS);
    redirect(url_for('/node/category.php'));
}

function deleteAction()
{
    $category_id = intval(input_post('id'));
    if (\getw\Input::isAjax() && $category_id) {
        $c = new \system\component\Category('node_category', 'node_category_language', 'category_id');
        $c->removeCategory($category_id);
        echo json_encode(['type' => 'success', 'message' => '分类已删除']);
    }

}






