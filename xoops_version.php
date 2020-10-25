<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
//  ------------------------------------------------------------------------ //
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

$modversion['name'] = _MI_STATS_NAME;
$modversion['version'] = 0.9;
$modversion['description'] = _MI_STATS_DESC;
$modversion['credits'] = 'www.cregybad.org';
$modversion['author'] = 'zoullou [zoullou77@hotmail.com]';
$modversion['help'] = '';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'stats_slogo.png';
$modversion['dirname'] = 'stats';

//Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// SQL
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'][0] = 'stats';

// Menu
$modversion['hasMain'] = 0;

// Blocks + block templates
$modversion['blocks'][1]['file'] = 'stats_block.php';
$modversion['blocks'][1]['name'] = _MI_STATS_BNAME1;
$modversion['blocks'][1]['description'] = "Affichage du nombre d'acticles, de commentaires... du jour, de la semaine et total";
$modversion['blocks'][1]['show_func'] = 'stats_show';
$modversion['blocks'][1]['template'] = 'stats_block.html';
