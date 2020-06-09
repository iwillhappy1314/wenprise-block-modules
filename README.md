# wenprise/block-modules

Give an array of WP_Query args, a template name and render to a HTML string.

## Usage

````php
$block = new \WenpriseBlocksModules\Block();

$block->set_query([
    'post_type' => 'post',
]);

$block->set_template('post');

echo $block;
````