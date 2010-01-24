<?php
/**
 * @file
 * @package lecat
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
    exit;
}

/**
 * Lecat_Utils
**/
class Lecat_Utils
{
    /**
     * &getXoopsHandler
     * 
     * @param   string  $name
     * @param   bool  $optional
     * 
     * @return  XoopsObjectHandler
    **/
    public static function &getXoopsHandler(/*** string ***/ $name,/*** bool ***/ $optional = false)
    {
        // TODO will be emulated xoops_gethandler
        return xoops_gethandler($name,$optional);
    }

    /**
     * &getModuleHandler
     * 
     * @param   string  $name
     * @param   string  $dirname
     * 
     * @return  XoopsObjectHandleer
    **/
    public static function &getModuleHandler(/*** string ***/ $name,/*** string ***/ $dirname)
    {
        // TODO will be emulated xoops_getmodulehandler
        return xoops_getmodulehandler($name,$dirname);
    }

    /**
     * &getLecatHandler
     * 
     * @param   string  $name
     * @param   string  $dirname
     * 
     * @return  XoopsObjectHandleer
    **/
    public static function &getLecatHandler(/*** string ***/ $name,/*** string ***/ $dirname)
    {
        // TODO will be emulated xoops_getmodulehandler
        //return xoops_getmodulehandler($name,$dirname);
		$asset = null;
		XCube_DelegateUtils::call(
		    'Module.lecat.Global.Event.GetAssetManager',
		    new XCube_Ref($asset),
		    $dirname
		);
		if(is_object($asset) && is_a($asset, 'Lecat_AssetManager'))
		{
		    return $asset->getObject('handler',$name);
		}
    }

    /**
     * getEnv
     * 
     * @param   string  $key
     * 
     * @return  string
    **/
    public static function getEnv(/*** string ***/ $key)
    {
        return getenv($key);
    }

    /**
     * getModuleConfig
     * 
     * @param   string	$key
     * 
     * @return  mix
    **/
    public static function getModuleConfig($type, $dirname)
    {
		$handler = self::getXoopsHandler('config');
		$configArr = $handler->getConfigsByDirname($dirname);
		return $configArr[$type];
    }

    /**
     * getInheritPermission
     * 
     * @param   string  $dirname
     * @param   int[]  $catPath
     * @param   int  $groupid
     * 
     * @return  string
    **/
	public function getInheritPermission(/*** string ***/ $dirname, /*** int[] ***/$catPath, /*** int ***/ $groupId=0)
	{
		$handler = self::getLecatHandler('permit', $dirname);
		//check if the category has permission in order
		foreach(array_keys($catPath) as $key){
			$criteria = new CriteriaCompo();
			$criteria->add(new Criteria('cat_id', $catPath[$key]));
			if(intval($groupId)>0){
				$criteria->add(new Criteria('groupid', $groupId));
			}
			$objs = $handler->getObjects($criteria);
			if(count($objs)>0) return $objs;
		}
	}
}

?>
