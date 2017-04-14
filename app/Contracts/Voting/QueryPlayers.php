<?php
namespace App\Contracts\Voting;


interface QueryPlayers
{
    /**
     * 设置活动ID
     *
     * @param int $id
     * @return $this
     */
    public function actid($id);

    /**
     * 设置当前分页
     *
     * @param int $page
     * @return $this
     */
    public function page($page);

    /**
     * 设置分页数量
     *
     * @param int $take
     * @return $this
     */
    public function take($take);


    /**
     * 录入查询条件
     *
     * @param array $query
     * @return $this
     */
    public function query($query);

    /**
     * 执行查询
     *
     * @param array $fields
     * @return $this
     */
    public function get(array $fields = []);

    /**
     * 获取查询记录统计数据
     *
     * @return int|array
     */
    public function getPage();

    /**
     * 获取查询数据列表
     *
     * @return array
     */
    public function getList();
}