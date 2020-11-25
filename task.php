<?php

function testHierarchy(array $array): array
{
    $result = [];
    $links = [];

    usort($array, static function($a, $b) {
        if (!isset($a['parent_id'])) {
            $a['parent_id'] = 0;
        }
        if (!isset($b['parent_id'])) {
            $b['parent_id'] = 0;
        }
        return $a['parent_id'] <=> $b['parent_id'];
    });

    foreach ($array as $item) {
        if (!isset($item['parent_id'])) {
            $result[] = $item;
            $links[$item['id']] = &$result[array_key_last($result)];
        } else {
            $parent_id = $item['parent_id'];
            unset($item['parent_id']);

            $parent = &$links[$parent_id];
            if (!isset($parent['children'])) {
                $parent['children'] = [];
            }

            $parent['children'][] = $item;
            $links[$item['id']] = &$parent['children'][array_key_last($parent['children'])];
        }
    }

    return $result;
}
