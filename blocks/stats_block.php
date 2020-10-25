<?php

function stats_show()
{
    global $xoopsDB;

    $block = [];

    $stats = [];

    $time = time();

    $jour = $time - 86400;

    $semaine = $time - 604800;

    $query = 'select titre, count_table, champ_time from ' . $xoopsDB->prefix('stats') . '';

    $result = $xoopsDB->query($query);

    while (false !== ($cat_count = $xoopsDB->fetchArray($result))) {
        $nb_j = 0;

        $nb_s = 0;

        $nb_t = 0;

        $jour = date('w');

        $semaine = date('W');

        $annee = date('Y');

        $table = $xoopsDB->prefix($cat_count['count_table']);

        $query2 = 'select ' . $cat_count['champ_time'] . " from $table";

        $result2 = $xoopsDB->query($query2);

        while (list($time) = $xoopsDB->fetchRow($result2)) {
            if (date('w', $time) == $jour & date('W', $time) == $semaine & date('Y', $time) == $annee) {
                $nb_j++;

                $nb_s++;

                $nb_t++;
            } elseif (date('W', $time) == $semaine & date('Y', $time) == $annee) {
                $nb_s++;

                $nb_t++;
            } else {
                $nb_t++;
            }
        }

        $infos = [];

        $infos['titre'] = $cat_count['titre'];

        $infos['nb_j'] = $nb_j;

        $infos['nb_s'] = $nb_s;

        $infos['nb_t'] = $nb_t;

        $block['stats'][] = $infos;
    }

    return $block;
}
