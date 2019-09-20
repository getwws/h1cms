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

namespace system\model;

use getw\db\sql\Select;
use getw\db\ActiveRecord;


/**
 * Class Product
 *
 */
class Product extends ActiveRecord
{

    //发布
    const NODE_STATUS_PUBLISH = 'publish';
    //审核中
    const NODE_STATUS_PENDING = 'pending';
    //草稿
    const NODE_STATUS_DRAFT = 'draft';
    //定时显示
    const NODE_STATUS_FUTURE = 'future';
    //登录可见 私有
    const NODE_STATUS_PRIVATE = 'private';
    //回收站
    const NODE_STATUS_TRASH = 'trash';

    public static function tableName()
    {
        return 'product';
    }

    public static function primaryKey()
    {
        return 'node_id';
    }


    /**
     * @param $id
     * @param int $language_id
     * @return mixed
     */
    public function getLanguageById($id, $language_id = H_DEFAULT_LANGUAGE)
    {
        return db_query('select * from {product_language} where node_id=:node_id and language_id=:language_id', ['node_id' => $id, 'language_id' => $language_id])->fetchObject();
    }

    /**
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function getLanguages($id)
    {
        return db_query('select * from {product_language} where node_id=:node_id', ['node_id' => $id])->fetchAll();
    }

    public function getRelationships($id, $fetchALL = false)
    {

        $stm = db_query('select * from {product_relationships} where node_id=:node_id', ['node_id' => $id]);
        if ($fetchALL) {
            $stm->fetchAll(FETCH_OBJ);
        }
        return $stm->fetchObject();
    }

    /**
     * 获取所有产品图片
     * @param $id
     * @return array
     * @throws \Exception
     */
    public function getProductImages($id)
    {
        return db_query('select * from {product_image} where product_id=:product_id', ['product_id' => $id])->fetchAll();
    }

    /**
     * 获取文章包括内容
     * @param $id
     * @param int $language_id
     * @return mixed
     */
    public function get($id, $language_id = H_DEFAULT_LANGUAGE)
    {
        return db_query('select * from {product} as n,{product_language} as nl where node_id=:node_id and language_id=:language_id', ['node_id' => $id, 'language_id' => $language_id])->fetchObject();
    }

    public function remove($id)
    {
        db_delete('product', ['node_id' => $id]);
        db_delete('product_language', ['node_id' => $id]);
        db_delete('product_meta', ['node_id' => $id]);
        db_delete('product_relationships', ['node_id' => $id]);
    }

    public function add($node, $languages, $parent)
    {
        $data_product_images = input_post('product_image', []);
        try {
            $image_sort_order = array_column($data_product_images,'sort_order');
            array_multisort($image_sort_order, SORT_ASC,$data_product_images);
            //设置主图
            if(isset($data_product_images[0]) && is_array($data_product_images[0])){
                $node['image'] = $data_product_images[0]['image'];
            }else{
                $node['image'] = '';
            }
            $node_id = db_insert('product', $node);
            foreach ($languages as $lang_id => $language) {
                $language['language_id'] = $lang_id;
                $language['node_id'] = $node_id;
                db_insert('product_language', $language);
            }
            if (!is_array($parent)) {
                $parent = [$parent];
            }else if($parent == 0){
                $parent = [];
            }
            foreach ($parent as $pid) {
                db_insert('product_relationships', ['node_id' => $node_id, 'category_id' => $pid]);
            }
            if(is_array($data_product_images)){
                foreach ($data_product_images as $image_row){
                    db_insert('product_image', ['product_id' => $node_id, 'image' => $image_row['image'],'sort_order'=>intval($image_row['sort_order'])]);
                }
            }
        } catch (\PDOException $exception) {
            db_delete('product', ['node_id' => $node_id]);
            db_delete('product_language', ['node_id' => $node_id]);
            db_delete('product_meta', ['node_id' => $node_id]);
            db_delete('product_relationships', ['node_id' => $node_id]);
            return false;
        }
        return $node_id;
    }

    public function update($node_id, $node, $languages, $parent)
    {
        $data_product_images = input_post('product_image', []);
        try {
            $image_sort_order = array_column($data_product_images,'sort_order');
            array_multisort($image_sort_order, SORT_ASC,$data_product_images);
            //设置主图
            if(isset($data_product_images[0]) && is_array($data_product_images[0])){
                $node['image'] = $data_product_images[0]['image'];
            }else{
                $node['image'] = '';
            }
            db_update('product', $node, ['node_id' => $node_id]);
            db_delete('product_language', ['node_id' => $node_id]);
            db_delete('product_relationships', ['node_id' => $node_id]);
            db_delete('product_image', ['product_id' => $node_id]);
            foreach ($languages as $lang_id => $language) {
                $language['language_id'] = $lang_id;
                $language['node_id'] = $node_id;
                db_insert('product_language', $language);
            }
            if (!is_array($parent)) {
                $parent = [$parent];
            }else if($parent == 0){
                $parent = [];
            }
            foreach ($parent as $pid) {
                db_insert('product_relationships', ['node_id' => $node_id, 'category_id' => $pid]);
            }
            if(is_array($data_product_images)){
                foreach ($data_product_images as $image_row){
                    db_insert('product_image', ['product_id' => $node_id, 'image' => $image_row['image'],'sort_order'=>intval($image_row['sort_order'])]);
                }
            }
        } catch (\PDOException $exception) {
            return false;
        }
        return $node_id;
    }

}
