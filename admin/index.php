<?php
// $Id: index.php,v 1.15 2003/03/28 14:54:24 w4z004 Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
include '../../../include/cp_header.php';
require XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

$op = 'default';
if (isset($_POST)) {
    foreach ($_POST as $k => $v) {
        ${$k} = $v;
    }
}
if (isset($_GET['op'])) {
    $op = $_GET['op'];
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$myts = MyTextSanitizer::getInstance();

switch ($op) {
    case 'ajout':

        xoops_cp_header();
        $form = new XoopsThemeForm(_AM_AJOUTCAT, 'form', 'index.php');
        $form->addElement(new XoopsFormText(_AM_TITRECAT, 'titre', 20, 30), true);
        $form->addElement(new XoopsFormText(_AM_NOMTABLE, 'count_table', 20, 30), true);
        $form->addElement(new XoopsFormText(_AM_NOMCHAMP, 'champ_time', 20, 30), true);
        $form->addElement(new XoopsFormHidden('op', 'enreg'), true);
        $form->addElement(new XoopsFormHidden('mode', 'ajout'), true);
        $form->addElement(new XoopsFormButton('', 'submit', _AM_ENREG, 'submit'), true);
        $form->display();
        xoops_cp_footer();

        break;
    case 'supression':

        $query = 'delete from ' . $xoopsDB->prefix('stats') . " where id='$id';";
        $xoopsDB->queryF($query);
        redirect_header('index.php', 1, _AM_ENREGOK);

        break;
    case 'liste':

        xoops_cp_header();
        $query = 'select * from ' . $xoopsDB->prefix('stats') . '';
        $result = $xoopsDB->queryF($query);
        echo "<form method=\"post\" action=\"index.php\">\n";
        echo '<input type="submit" value="Enregistrer">';
        echo "<input type='hidden' name='op' value='enreg'>";
        echo "<input type='hidden' name='mode' value='liste'>";
        echo '<table width="100%" border="1"><tr align="center"><td><b>Titre</b></td><td><b>' . _AM_TABLE . '</b></td><td><b>' . _AM_CHAMP . '</b></td><td><b>' . _AM_SUP . '</b></td></tr>';
        $i = 1;
        while (list($id, $titre, $table, $champ) = $xoopsDB->fetchRow($result)) {
            echo "<tr align=\"center\"><td><input type='text' name='titre[$i]' size='20' maxlength='30' value='$titre'>
			</td><td><input type='text' name='count_table[$i]' size='20' maxlength='30' value='$table'>
			</td><td><input type='text' name='champ_time[$i]' size='20' maxlength='30' value='$champ'></td>
			<td><a href=\"index.php?op=supression&amp;id=$id\">" . _AM_SUPTHIS . '</a></td></tr>';

            echo "<input type='hidden' name='id[$i]' value='$id'>";

            $i++;
        }
        echo '</table>';
        echo '</form>';

        xoops_cp_footer();

        break;
    case 'enreg':

        switch ($mode) {
            case 'ajout':

                $titre = $myts->previewTarea($titre, 0, 0, 0, 0, 0);
                $count_table = $myts->previewTarea($count_table, 0, 0, 0, 0, 0);
                $champ_time = $myts->previewTarea($champ_time, 0, 0, 0, 0, 0);

                $query = 'INSERT INTO `' . $xoopsDB->prefix('stats') . "` ( `id` , `titre` , `count_table` , `champ_time` ) VALUES ('', '$titre', '$count_table', '$champ_time');";
                if ($xoopsDB->queryF($query)) {
                    redirect_header('index.php', 1, _AM_ENREGOK);
                } else {
                    redirect_header('index.php', 1, _AM_ENREGNOK);
                }

                break;
            case 'liste':

                for ($i = 1, $iMax = count($id); $i <= $iMax; $i++) {
                    $titre[$i] = $myts->previewTarea($titre[$i], 0, 0, 0, 0, 0);

                    $count_table[$i] = $myts->previewTarea($count_table[$i], 0, 0, 0, 0, 0);

                    $champ_time[$i] = $myts->previewTarea($champ_time[$i], 0, 0, 0, 0, 0);

                    $query = 'update ' . $xoopsDB->prefix('stats') . " set titre = '$titre[$i]', 
					count_table = '$count_table[$i]', champ_time = '$champ_time[$i]' where id = '$id[$i]'";

                    if (!$xoopsDB->queryF($query)) {
                        redirect_header('index.php', 1, _AM_ENREGNOK);
                    }
                }
                redirect_header('index.php', 1, _AM_ENREGOK);

                break;
        }

        break;
    // Affichage du menu par default
    case 'default':
    default:

        xoops_cp_header();
        echo '<h4>' . _AM_GESTSTATS . '</h4>';
        echo "<table width='100%' border='0' cellspacing='1' class='outer'><tr><td class=\"odd\">";
        echo " - <b><a href='index.php?op=liste'>" . _AM_ADMENU2 . '</a></b>';
        echo "<br><br>\n";
        echo " - <b><a href='index.php?op=ajout'>" . _AM_ADMENU3 . "</a></b>\n";
        echo '</td></tr></table>';
        xoops_cp_footer();

        break;
}
