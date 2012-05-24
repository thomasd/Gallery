<?php
/**
 * Gallery
 *
 * Copyright 2010-2012 by Shaun McCormick <shaun@modx.com>
 *
 * Gallery is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Gallery is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Gallery; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package gallery
 */
/**
 * Handles adding Gallery to Extension Packages
 *
 * @var xPDOObject $object
 * @var array $options
 * @package gallery
 * @subpackage build
 */
if ($object->xpdo) {
    switch ($options[xPDOTransport::PACKAGE_ACTION]) {
        case xPDOTransport::ACTION_INSTALL:
        case xPDOTransport::ACTION_UPGRADE:
            /** @var modX $modx */
            $modx =& $object->xpdo;
            $modelPath = $modx->getOption('gallery.core_path');
            if (empty($modelPath)) {
                $modelPath = '[[++core_path]]components/gallery/';
            }
            $modelPath = rtrim($modelPath,'/').'/model/';
            if ($modx instanceof modX) {
                $modx->addExtensionPackage('gallery',$modelPath);
            }
            break;
        case xPDOTransport::ACTION_UNINSTALL:
            $modx =& $object->xpdo;
            if ($modx instanceof modX) {
                $modx->removeExtensionPackage('gallery');
            }
            break;
    }
}
return true;