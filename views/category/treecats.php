<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<button type="button" class="close" onclick="history.back();">&times;</button>

<h3>TreeCats</h3>
<br>

<?php

function build_tree($cats,$parent_id,$only_parent = false){
    if(is_array($cats) and isset($cats[$parent_id])){
        $tree = '<ul>';
        if($only_parent==false){
            foreach($cats[$parent_id] as $cat){
                $st = Url::toRoute(['category/update', 'id' => $cat['id']]);
                $tree .= '<li><a href="'.$st.'">'.$cat['title'];
                /*$tree .= '<li><a href="'.$cat['id'].'" class="trees">'.$cat['title'];*/
                $tree .=  build_tree($cats,$cat['id']);
                $tree .= '</a></li>';
            }
        }elseif(is_numeric($only_parent)){
            $cat = $cats[$parent_id][$only_parent];
            $st = Url::toRoute(['category/update', 'id' => $cat['id']]);
            $tree .= '<li><a href="'.$st.'">'.$cat['title'];
            /*$tree .= '<li><a href="'.$cat['id'].'" class="trees">'.$cat['title'];*/
            $tree .=  build_tree($cats,$cat['id']);
            $tree .= '</a></li>';
        }
        $tree .= '</ul>';
    }
    else return null;
    return $tree;
}
?>
<div class="bigtree"><?php echo build_tree($cats,0); ?></div>

<br>

