<?php
/**
 * @file
 * @package profile
 * @version $Id$
 */

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

require_once XOOPS_TRUST_PATH. "/core/XCube_PageNavigator.class.php";

class Profile_AbstractListAction extends Profile_AbstractAction
{
    public $mObjects = array();
    public $mFilter = null;

    /**
     * @protected
     */
    public function &_getHandler()
    {
    }

    /**
     * @protected
     */
    public function &_getFilterForm()
    {
    }

    /**
     * @protected
     */
    public function &_getBaseUrl()
    {
    }

    /**
     * @protected
     */
    public function &_getPageNavi()
    {
        $navi =new XCube_PageNavigator($this->_getBaseUrl(), XCUBE_PAGENAVI_START);
        return $navi;
    }

    /**
     * @public
     */
    public function getDefaultView()
    {
        $this->mFilter =& $this->_getFilterForm();
        $this->mFilter->fetch();
    
        $handler =& $this->_getHandler();
        $this->mObjects =& $handler->getObjects($this->mFilter->getCriteria());
    
        return PROFILE_FRAME_VIEW_INDEX;
    }
}
