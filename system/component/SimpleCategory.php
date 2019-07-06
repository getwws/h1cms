<?php

namespace system\component;

/**
 * Class SimpleCategory
 * 单语言分类
 * @package system\component
 */
class SimpleCategory
{
    public $table;
    public $primaryKey;

    public function __construct($table = 'category', $primaryKey = 'id')
    {
        $this->table = $table;
        $this->primaryKey = $primaryKey;
    }


    public function getCategoryById($id)
    {

        $sql = "select * from {{$this->table}}  WHERE {$this->primaryKey}=:id";
        $stm = db_query($sql, ['id' => $id]);
        return $stm->fetchObject();
    }

    public function remove($id)
    {
        return db_delete($this->table, ['id' => $id]);
    }

    public function getAll()
    {
        $sql = "select * from  {{$this->table}} WHERE status=1 order by sort_order asc";
        $query = db_fetchAll($sql);
        $refs = array();
        $list = array();
        foreach ($query as $row) {
            $ref = &$refs[$row->{$this->primaryKey}];
            $ref['parent_id'] = $row->parent_id;
            $ref['title'] = $row->title;
            $ref['path'] = $row->path;

            if ($row->parent_id == 0) {
                $list[$row->{$this->primaryKey}] = &$ref;
            } else {
                $refs[$row->parent_id]['children'][$row->{$this->primaryKey}] = &$ref;
            }
        }
        return $list;
    }

}