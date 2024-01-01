<?php

function postHead($post)
{
    $postHeadString = '';
    $postHeads[] = '<meta name="author" content="'.$post->author.'" />';
    $postHeads[] = '<meta name="description" content="'.$post->description.'" />';
    $postHeads[] = '<meta name="keywords" content="'.$post->keywords.'" />';
    $postHeads[] = '<title>'.$post->title.'</title>';

    foreach ($postHeads as $postHead) {
        $postHeadString .= "$postHead\n";
    }
    
    return $postHeadString;
}
