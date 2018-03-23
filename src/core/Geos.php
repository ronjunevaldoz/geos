<?php 


/*
The main 'geoname' table has the following fields :
---------------------------------------------------
geonameid         : integer id of record in geonames database
name              : name of geographical point (utf8) varchar(200)
asciiname         : name of geographical point in plain ascii characters, varchar(200)
alternatenames    : alternatenames, comma separated, ascii names automatically transliterated, convenience attribute from alternatename table, varchar(10000)
latitude          : latitude in decimal degrees (wgs84)
longitude         : longitude in decimal degrees (wgs84)
feature class     : see http://www.geonames.org/export/codes.html, char(1)
feature code      : see http://www.geonames.org/export/codes.html, varchar(10)
country code      : ISO-3166 2-letter country code, 2 characters
cc2               : alternate country codes, comma separated, ISO-3166 2-letter country code, 200 characters
admin1 code       : fipscode (subject to change to iso code), see exceptions below, see file admin1Codes.txt for display names of this code; varchar(20)
admin2 code       : code for the second administrative division, a county in the US, see file admin2Codes.txt; varchar(80) 
admin3 code       : code for third level administrative division, varchar(20)
admin4 code       : code for fourth level administrative division, varchar(20)
population        : bigint (8 byte int) 
elevation         : in meters, integer
dem               : digital elevation model, srtm3 or gtopo30, average elevation of 3''x3'' (ca 90mx90m) or 30''x30'' (ca 900mx900m) area in meters, integer. srtm processed by cgiar/ciat.
timezone          : the iana timezone id (see file timeZone.txt) varchar(40)
modification date : date of last modification in yyyy-MM-dd format

feature classes:
A: country, state, region,...
H: stream, lake, ...
L: parks,area, ...
P: city, village,...
R: road, railroad 
S: spot, building, farm
T: mountain,hill,rock,... 
U: undersea
V: forest,heath,...
*/

namespace Ronscript\Geos\Core;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class Geos {

	private $byCountryCode = 'PH';
	private $byFeatureClass = "A";

	public function __construct() {
		ini_set('memory_limit','512M');
	}

    public function region()
    {
    	$filtered = [];
    	foreach ($this->read() as $key => $value) {
    		// var_dump($value);
    		if(isset($value[6]) && $value[6] == 'A' && isset($value[7]) && $value[7] == "ADM1") {
    			$filtered[] = $value;
    		}
    	}
    	return $filtered;
    }

    public function states()
    {
    	$filtered = [];
    	foreach ($this->read() as $key => $value) {
    		// var_dump($value);
    		if(isset($value[6]) && $value[6] == 'A' && isset($value[7]) && $value[7] == "ADM2") {
    			$filtered[] = $value;
    		}
    	}
    	return $filtered;
    }

    public function town() {
    	$filtered = [];
    	foreach ($this->read() as $key => $value) {
    		// var_dump($value);
    		if(isset($value[6]) && $value[6] == 'P' && isset($value[7]) && $value[7] == "PPL") {
    			$filtered[] = $value;
    		}
    	}
    	return $filtered;
    }

    public function read() {
	    $country = [];
	    $path = "public\geos\/" . $this->byCountryCode . ".txt";
	    $content = Storage::disk('local')->get($path);
	    $details = explode("\n", $content);
	    foreach ($details as $key => $value) {
	        $country[] = explode("\t", $value);
	    }

	    return $country;
    }
}