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
use system\component\Menu;


function indexAction()
{
    page()->setLeftMenuActive('appearance.menu');
    page()->setTitle('菜单管理');
    $menu = intval(input_get('menu',0));
    $c = new Menu();
    $menu_group = $c->getMenuGroup();

    $default_group = new stdClass();
    $default_group->menu_group_id = 0;
    $default_group->menu_group_name = '默认菜单';
    $default_group->sort_order = 0;
    $default_group->created_at = 0;
    array_unshift($menu_group,$default_group);
    render('appearance.menu', ['menu_group'=>$menu_group,'menu'=>$menu]);
    //render('appearance.menu', ['categories' => $c->getAll($menu),'menu_categories'=>$c->getList($menu),'menu_group'=>$menu_group,'menu'=>$menu]);

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
    $menu_id = intval(input('mid'));
    if (\getw\Input::isAjax()){
        $m = new Menu();
        render('appearance.menu_form', ['menu' => $m->getById($menu_id),'modal'=>input('modal')]);
    }
}

function editPOST()
{
    $mid = intval(input_post('mid'));
    $menu_title = input_post('menu_title');
    $menu_url = input_post('menu_url');
    $menu_sort_order = input_post('menu_sort_order');
    db_update('menu',['sort_order'=>$menu_sort_order,'url'=>$menu_url],['menu_id'=>$mid]);
    db_update('menu_language',['title'=>$menu_title],['menu_id'=>$mid]);
    echo '菜单修改成功';
}

function deleteAction()
{
    $category_id = intval(input_post('id'));
    if (\getw\Input::isAjax() && $category_id) {
        $c = new Menu();
        $c->removeMenu($category_id);
        echo json_encode(['type' => 'success', 'message' => '分类已删除']);
    }
}

function addgroupAction(){
    $group_name = input_post('group_name');
    $sort_order = intval(input_post('sort_order'));
    if (\getw\Input::isAjax() && $group_name) {
        $row_id = db_insert('menu_group',['menu_group_name'=>$group_name,'sort_order'=>$sort_order,'created_at'=>time()]);
        echo json_encode(['status' => 'success', 'message' => '分组添加成功','group_id'=>$row_id,'group_name'=>$group_name]);
    }
}

function removeGroupAction(){
    $menu = intval(input_get('menu'));
    if($menu!=0){
        $c = new Menu();
        $c->removeByGroupId($menu);
        //echo json_encode(['status' => 'success', 'message' => '分类已删除']);
        add_flash('菜单组已删除',SESSION_SUCCESS);
    }else{
        //echo json_encode(['status' => 'error', 'message' => '默认菜单组无法删除']);
        add_flash('默认菜单组无法删除',SESSION_ERROR);
    }
    redirect(url_for('/appearance/menu.php'));
}

/**
 * 添加菜单
 */
function addmenuAction(){
    $url_link = input_post('url_link');
    $url_text = input_post('url_text');
    $parent_id = input_post('parent_id');
    $sort_order = intval(input_post('sort_order'));
    $group_id = intval(input_post('group_id'));
    if (\getw\Input::isAjax() && $url_link) {
        $c = new Menu();
        $menu = ['parent_id'=>$parent_id,'sort_order'=>$sort_order,'status'=>1,'group_id'=>$group_id];
        $language = ['title'=>$url_text];
        $c->addCategory($menu,$language);
        json_response(['status' => 'success', 'message' => '添加成功']);

    }
}

function menulistAction(){
    $menu = intval(input_get('menu',0));
    $c = new Menu();
    render('appearance.menu_list', ['categories' => $c->getAll($menu),'menu_categories'=>$c->getList($menu),'menu'=>$menu]);
}





