<?php

if (!defined('XOOPS_ROOT_PATH')) {
    exit();
}

require_once XOOPS_TRUST_PATH. "/core/XCube_ActionForm.class.php";

/**
 * This class is generated by makeActionForm tool.
 * @auchor makeActionForm
 */
class Legacy_SmilesListForm extends XCube_ActionForm
{
    /**
     * If the request is GET, never return token name.
     * By this logic, a action can have three page in one action.
     */
    public function getTokenName()
    {
        //
        //
        if (xoops_getenv('REQUEST_METHOD') == 'POST') {
            return "module.legacy.SmilesSettingsForm.TOKEN";
        } else {
            return null;
        }
    }
    
    /**
     * For displaying the confirm-page, don't show CSRF error.
     * Always return null.
     */
    public function getTokenErrorMessage()
    {
        return null;
    }
    
    public function prepare()
    {
        // set properties
        $this->mFormProperties['code']=new XCube_StringArrayProperty('code');
        $this->mFormProperties['emotion']=new XCube_StringArrayProperty('emotion');
        $this->mFormProperties['display']=new XCube_BoolArrayProperty('display');
        $this->mFormProperties['delete']=new XCube_BoolArrayProperty('delete');
        //to display error-msg at confirm-page
        $this->mFormProperties['confirm'] =new XCube_BoolProperty('confirm');
        // set fields
        $this->mFieldProperties['code']=new XCube_FieldProperty($this);
        $this->mFieldProperties['code']->setDependsByArray(array('required', 'maxlength'));
        $this->mFieldProperties['code']->addMessage("required", _MD_LEGACY_ERROR_REQUIRED, _MD_LEGACY_LANG_CODE, "50");
        $this->mFieldProperties['code']->addMessage("maxlength", _MD_LEGACY_ERROR_MAXLENGTH, _MD_LEGACY_LANG_CODE, "50");
        $this->mFieldProperties['code']->addVar("maxlength", 50);

        $this->mFieldProperties['emotion']=new XCube_FieldProperty($this);
        $this->mFieldProperties['emotion']->setDependsByArray(array('required', 'maxlength'));
        $this->mFieldProperties['emotion']->addMessage("required", _MD_LEGACY_ERROR_REQUIRED, _MD_LEGACY_LANG_EMOTION, "75");
        $this->mFieldProperties['emotion']->addMessage("maxlength", _MD_LEGACY_ERROR_MAXLENGTH, _MD_LEGACY_LANG_EMOTION, "75");
        $this->mFieldProperties['emotion']->addVar("maxlength", 75);
    }
}
