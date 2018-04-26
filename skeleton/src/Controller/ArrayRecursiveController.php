<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArrayRecursiveController extends Controller
{
    public $array = [
        [
          "name"    => "John",
          "skills"  => [
              'PHP',
              'JAVA'
          ]
        ],
        [
            "name" => "Petras",
            "skills" => [
                'JavaScript',
                'HTML5'
            ]
        ]
    ];

    public $skill = 'JAVA';

    /**
     * @Route("/array", name="array_recursive")
     * @param $needle
     * @param $haystack
     * @return bool
     */
    public function index($needle, $haystack)
    {
        if(in_array($needle, $haystack)){
            return true;
        }

        foreach($haystack as $item){
            if(in_array($item)){
                $result = $this->index($needle,$item);
                if($result){
                    return true;
                }
            }
        }
    }
}
