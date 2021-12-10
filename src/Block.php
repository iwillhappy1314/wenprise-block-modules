<?php

namespace WenpriseBlocksModules;

/**
 * 主题中的自定义数据盒子
 *
 * @package WenPrise
 */
class Block
{

    /**
     * @var array 查询参数
     */
    public $query_args = [];


    /**
     * @var object 模块查询
     */
    public $wp_query;


    /**
     * @var array 模块附加数据
     */
    public $options = [];


    /**
     * @var string 循环模版
     */
    public $template = '';


    /**
     * 初始化
     *
     * @param array  $query_args
     * @param array  $options
     * @param string $template
     */
    public function __construct(array $query_args = [], array $options = [], string $template = '')
    {
        $this->set_query($query_args);
        $this->set_options($options);
        $this->set_template($template);
    }


    /**
     * 设置查询参数及对象
     *
     * @param array $query_args
     *
     * @return $this
     */
    public function set_query(array $query_args): Block
    {
        $this->query_args = $query_args;
        $this->wp_query   = new \WP_Query($this->query_args);

        return $this;
    }


    /**
     * 设置附加选项
     *
     * @param array $options
     *
     * @return $this
     */
    public function set_options(array $options): Block
    {
        $this->options = $options;

        return $this;
    }


    /**
     * 设置循环模版
     *
     * @param $template
     *
     * @return $this
     */
    public function set_template($template): Block
    {
        $this->template = $template;

        return $this;
    }


    /**
     * 获取 WP_Query 查询
     *
     * @return object \WP_Query
     */
    public function get_query(): object
    {
        return $this->wp_query;
    }


    /**
     * 生成样式
     */
    public function generate_style()
    {

    }


    /**
     * 生成 Js
     */
    public function generate_script()
    {

    }


    /**
     * 渲染模块
     */
    public function render(): string
    {
        $index = 0;
        $html  = '';
        while ($this->wp_query->have_posts()) : $this->wp_query->the_post();

            $args = [
                'options' => $this->options,
                'index'   => $index,
            ];

            $html .= wprs_render_template('templates/loop/content', $this->template, $args, '', false);
            $index++;

        endwhile;

        wp_reset_query();
        wp_reset_postdata();

        return $html;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

}