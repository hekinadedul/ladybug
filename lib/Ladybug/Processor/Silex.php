<?php
/*
 * Ladybug: Simple and Extensible PHP Dumper
 * 
 * Processor / Silex
 *
 * (c) Raúl Fraile Beneyto <raulfraile@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ladybug\Processor;

class Silex {
    
    private $silex_prefix = 'http://silex.sensiolabs.org/api/index.html?q=';
    
    public function process($str) {
        $matches = array();
        $result = $str;
        
        if (preg_match_all('/\(Silex[\\\\A-Za-z]+\)/', $str, $matches)) {
            $matches = array_unique($matches[0]);
            
            foreach ($matches as $m) {
                $class = str_replace('(', '',str_replace(')', '', $m));
                $class_url = strtolower($class) . '.html';
                
                $result = str_replace($m, '(<a href="' . $this->silex_prefix . $class_url . '" class="external silex" target="_blank" title="'.$class.'"></a>'.$class.')', $result);
            }
            
        }
    
        return $result;
    }

}