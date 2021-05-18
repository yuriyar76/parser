<?php


namespace Query\phpQuery\Zend\Validate\File;

use Query\phpQuery\Zend\Validate\File\Zend_Validate_File_Exists;


/**
 * Validator which checks if the destination file does not exist
 *
 * @category  Zend
 * @package   Zend_Validate
 * @copyright Copyright (c) 2005-2008 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Validate_File_NotExists extends Zend_Validate_File_Exists
{
    /**
     * @const string Error constants
     */
    const DOES_EXIST = 'fileNotExistsDoesExist';

    /**
     * @var array Error message templates
     */
    protected $_messageTemplates = array(
        self::DOES_EXIST => "The file '%value%' does exist"
    );

    /**
     * Defined by Zend_Validate_Interface
     *
     * Returns true if and only if the file does not exist in the set destinations
     *
     * @param  string  $value Real file to check for
     * @param  array   $file  File data from Zend_File_Transfer
     * @return boolean
     */
    public function isValid($value, $file = null)
    {
        $directories = $this->getDirectory(true);
        if (($file !== null) and (!empty($file['destination']))) {
            $directories[] = $file['destination'];
        } else if (!isset($file['name'])) {
            $file['name'] = $value;
        }

        foreach ($directories as $directory) {
            if (empty($directory)) {
                continue;
            }

            $check = true;
            if (file_exists($directory . DIRECTORY_SEPARATOR . $file['name'])) {
                $this->_throw($file, self::DOES_EXIST);
                return false;
            }
        }

        if (!isset($check)) {
            $this->_throw($file, self::DOES_EXIST);
            return false;
        }

        return true;
    }
}
