<?php

class Util
{
    public function getShortCode($language)
    {
        switch ($language) {
            case 'german' : return 'de_de';
            case 'dutch'  : return 'nl_nl';
            case 'french' : return 'fr_fr';
            case 'italian': return 'it_it';
            case 'polish' : return 'pl_pl';
            case 'english':
            default       : return 'en_gb';
        }
    }
    
}
