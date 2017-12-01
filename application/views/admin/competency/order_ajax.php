<?php
//echo "<pre>";
//print_r($competencies);
//echo "</pre>";
echo get_ol($competencies);

function get_ol($array, $child = false) {
    $str = '';
    if (count($array)) {
        $str .= $child == FALSE ? '<ol class="sortable">' : '<ol>';

        foreach ($array as $item) {
            $str .= '<li id="list_' . $item['ID'] . '">';
            $str .= '<div>' . $item['NAME'] . '</div>';
            // if have children
            if (isset($item['CHILDREN']) && count($item['CHILDREN'])) {
                $str .= get_ol($item['CHILDREN'], TRUE);
            }
            $str .= '</li>' . PHP_EOL;
        }
        $str .= '</ol>' . PHP_EOL;
    }
    return $str;
}
?>
<script>
    $(document).ready(function () {

        $('.sortable').nestedSortable({
            handle: 'div',
            items: 'li',
            toleranceElement: '> div',
            maxLevels: 2,
        });

    });
</script>