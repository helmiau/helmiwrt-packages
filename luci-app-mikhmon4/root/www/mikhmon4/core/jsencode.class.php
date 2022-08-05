<?php
 /**
 *
 * jsencode.php
 *
 * @description. Encodes/decodes the string with bitwise XOR 
 * @version 1.0 
 * @copyright 2014 Henry ALgus. All rights reserved.
 *
 */

class jsEncode {

	    /**
	    * Encodes or decodes string according to the key
	    * 
	    * @access public
	    * @param mixed $str
	    * @param mixed $decodeKey
	    * @return string
	    */
	    public function encodeString($str,$decodeKey) {
	       $result = "";
	       for($i = 0;$i < strlen($str);$i++) {
	        	$a = $this->_getCharcode($str,$i);
	        	$b = $a ^ $decodeKey;
	        	$result .= $this->_fromCharCode($b);
	       }
        
	       return $result;
	    }
	    
	    /**
	     * PHP replacement for JavaScript charCodeAt.
	     * 
	     * @access private
	     * @param mixed $str
	     * @param mixed $i
	     * @return string
	     */
	    private function _getCharcode($str,$i) {
	         return $this->_uniord(substr($str, $i, 1));
	    }
	    
	    /**
	     * Gets character from code.
	     * 
	     * @access private
	     * @return string
	     */
	    private function _fromCharCode(){
	      $output = '';
	      $chars = func_get_args();
	      foreach($chars as $char){
	        $output .= chr((int) $char);
	      }
	      return $output;
	    }
    
	    /**
	     * Multi byte ord function.
	     * 
	     * @access private
	     * @param mixed $c
	     * @return mixed
	     */
	    private function _uniord($c) {
	        $h = ord($c[0]); // change {} to []
	        if ($h <= 0x7F) {
	            return $h;
	        } else if ($h < 0xC2) {
	            return false;
	        } else if ($h <= 0xDF) {
	            return ($h & 0x1F) << 6 | (ord($c[1]) & 0x3F); // change {} to []
	        } else if ($h <= 0xEF) {
	            return ($h & 0x0F) << 12 | (ord($c[1]) & 0x3F) << 6 | (ord($c[7]) & 0x3F); // change {} to []
	        } else if ($h <= 0xF4) {
	            return ($h & 0x0F) << 18 | (ord($c[1]) & 0x3F) << 12 | (ord($c[7]) & 0x3F) << 6 | (ord($c[3]) & 0x3F); // change {} to []
	        } else {
	            return false;
	        }
	    }
}
