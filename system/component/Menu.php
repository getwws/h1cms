<?php

namespace system\component;

use getw\DB;
use getw\Singleton;
use system\admin\Page;

/**
 * Class Menu
 * @package system\component
 */
class Menu
{
    public $table;
    public $language_table;
    public $group_table;
    public $primaryKey = 'menu_id';

    public function __construct($table = 'menu', $language_table = 'menu_language',$group_table='menu_group', $primaryKey = 'menu_id')
    {
        $this->table = $table;
        $this->language_table = $language_table;
        $this->group_table = $group_table;
        $this->primaryKey = $primaryKey;
    }


    public function getCategoryById($id)
    {

        $sql = "select * from {{$this->table}} WHERE {$this->primaryKey}=:id";
        $stm = db_query($sql, ['id' => $id]);
        return $stm->fetchObject();
    }

    public function getById($id, $language = H_DEFAULT_LANGUAGE)
    {

        $sql = "select * from {{$this->table}} c, {{$this->language_table}} cd  WHERE c.{$this->primaryKey}=:id and cd.language_id=:language";
        $stm = db_query($sql, ['id' => $id, 'language' => $language]);
        return $stm->fetchObject();
    }

    public function getCategoryLanguageById($id, $language = H_DEFAULT_LANGUAGE)
    {

        $sql = "select * from {{$this->language_table}} WHERE {$this->primaryKey}=:id and language_id=:language";
        $stm = db_query($sql, ['id' => $id, 'language' => $language]);
        return $stm->fetchObject();
    }

    /**
     * 仅删除当前分类
     * @param $id
     * @throws \Exception
     */
    public function remove($id)
    {
        db_delete($this->table, [$this->primaryKey => $id]);
        db_delete($this->language_table, [$this->primaryKey => $id]);
    }

    /**
     * 根据分组删除
     * @param $id
     * @throws \Exception
     */
    public function removeByGroupId($id)
    {
        $all_menu_ids = db_fetchCol("select menu_id from {{$this->table}} where group_id={$id}");
//        db_delete($this->table, ['group_id' => $id]);
//        db_delete($this->group_table, ['menu_group_id' => $id]);

        DB::table($this->language_table)->whereIn('menu_id',$all_menu_ids)->delete();
    }


    public function addCategory($category, $language)
    {
        $category['parent_id'] = intval($category['parent_id']);
        $category['sort_order'] = intval($category['sort_order']);
        $category['status'] = intval($category['status']) ? 1 : 0;
        $category['level'] = 0;
        $category['path'] = '';
        $category['created_at'] = time();
        $category['updated_at'] = time();
        $category_id = db_insert($this->table, $category);
        if ($category['parent_id'] === 0) {
            db_update($this->table, ['path' => $category_id], ['menu_id' => $category_id]);
        } else if ($category['parent_id'] !== 0) {
            $parent = db_fetch("select * from {{$this->table}} where {$this->primaryKey}=:menu_id", ['menu_id' => $category['parent_id']]);
            db_update($this->table, ['level' => $parent->level + 1, 'path' => "{$parent->path},{$category_id}"], ['menu_id' => $category_id]);
        }
        $language['menu_id'] = $category_id;
        $language['language_id'] = H_DEFAULT_LANGUAGE;
        db_insert($this->language_table, $language);
        return true;
    }

    public function editCategory($category_id, $category, $language)
    {
        $category_model = $this->getCategoryById($category_id);
        if ($category_id == 0 || !$category_model) {
            return NULL;
        }
        $category['parent_id'] = intval($category['parent_id']);
        $category['sort_order'] = intval($category['sort_order']);
        $category['status'] = intval($category['status']) ? 1 : 0;
        $category['level'] = 0;
        $category['path'] = "$category_id";
        //修改上级分类
        if ($category['parent_id'] != $category_model->parent_id) {
            $parent = db_fetch("select * from {{$this->table}} where menu_id=:menu_id", ['menu_id' => $category['parent_id']]);
            if (!$parent) {
                $category['level'] = 0;
                $category['path'] = $category_id;
            } else {
                $category['level'] = $parent->level + 1;
                $category['path'] = "{$parent->path},{$category_id}";
            }
            //修改分类下面的子类
            $subs_category = db_fetchAll("select * from {{$this->table}} where path like '{$category_model->path},%'");
            foreach ($subs_category as $cat) {
                db_update($this->table, ['path' => str_ireplace("{$category_model->path},", "{$category['path']},", $cat->path)], ['menu_id' => $cat->menu_id]);
            }
        }
        $category['updated_at'] = time();
        db_update($this->table, $category, ['menu_id' => $category_id]);
        $language['menu_id'] = $category_id;
        $language['language_id'] = H_DEFAULT_LANGUAGE;
        db_update($this->language_table, $language, ['menu_id' => $category_id, 'language_id' => H_DEFAULT_LANGUAGE]);
        return true;
    }

    /**
     * 删除该分类下面的子类
     * @param $category_id
     * @return null
     */
    public function removeMenu($category_id)
    {
        $category_model = $this->getCategoryById($category_id);
        if ($category_id == 0 || !$category_model) {
            return NULL;
        }
        db_delete($this->table, ['menu_id' => $category_id]);
        db_delete($this->language_table, ['menu_id' => $category_id]);
        //修改分类下面的子类
        $subs_category = db_fetchAll("select * from {{$this->table}} where path like '{$category_model->path},%'");
        foreach ($subs_category as $cat) {
            db_delete($this->table, ['menu_id' => $cat->category_id]);
            db_delete($this->language_table, ['menu_id' => $cat->category_id]);
        }

    }

    public function getAll($menu_group_id = 0)
    {
        $sql = "select c.*, cd.title,cd.description,cd.language_id
                         from {{$this->table}} c, {{$this->language_table}} cd 
                         WHERE status=1 and group_id={$menu_group_id} and c.menu_id = cd.menu_id 
                         and cd.language_id='" . H_DEFAULT_LANGUAGE . "' 
                         order by parent_id,sort_order asc";
        $query = db_fetchAll($sql);
        $refs = array();
        $list = array();
        foreach ($query as $row) {
            $refs[$row->{$this->primaryKey}] = $row;
            $ref = &$refs[$row->{$this->primaryKey}];
            if ($row->parent_id == 0) {
                $list[$row->{$this->primaryKey}] = &$ref;
            } else {
                $refs[$row->parent_id]->children[$row->{$this->primaryKey}] = &$ref;
            }
        }
        return $list;
    }

    public function getList($menu_group_id = 0)
    {
        $sql = "select c.*, cd.title,cd.description,cd.language_id
                         from {{$this->table}} c, {{$this->language_table}} cd 
                         WHERE status=1 and group_id={$menu_group_id} and c.menu_id = cd.menu_id 
                         and cd.language_id='" . H_DEFAULT_LANGUAGE . "' 
                         order by parent_id,sort_order asc";
        $query = db_fetchAll($sql);
        $stack = array();
        foreach ($query as $category) {
            if ($category->parent_id == 0)
                array_push($stack, array('category' => $category, 'level' => 0));
        }
        do {
            $top_category = array_shift($stack);
            for ($i = 0; $i < count($query); $i++) {
                if ($query[$i]->parent_id == $top_category['category']->menu_id) {
                    array_unshift($stack, array('category' => $query[$i], 'level' => $top_category['level'] + 1));
                }
            }
            $html[] = $top_category['category'];
        } while (count($stack) > 0);
        return $html;
    }

    /**
     * 获取菜单分组
     * @return array
     * @throws \Exception
     */
    public function getMenuGroup(){
        $sql = "select * from {{$this->group_table}}";
        return db_fetchAll($sql);
    }


}