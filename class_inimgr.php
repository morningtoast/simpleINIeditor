<?
	/*
		INI Editor
		Read/write INI files
	
		8/2012
		Brian Vaughn
		https://github.com/morningtoast
	*/
	class iniManager {
		function iniManager($iniPath=false) {
			if (!$iniPath) {
				$this->iniPath = "./settings.ini"; // Set default path to INI file
			} else {
				$this->iniPath = $iniPath;
			}
			
			// First time, create INI with timestamp
			if (!file_exists($this->iniPath)) {
				$this->write("; Created ".date("r"));
			}
		}
		
		// Writes new INI. Overwrites.
		function write($s) {
			$fr = fopen($this->iniPath, "w");
			$success = fwrite($fr, $s);
			fclose($fr);
			
			return($success);
		}
		
		// Parses INI into JSON response
		function load() {
			$raw  = parse_ini_file($this->iniPath, true);
			$json = json_encode($raw);
			
			$this->json = $json;
			
			return($json);
		}
	
		// Saves POST data to INI file. Skips empty groups and keys.
		function save($action=false) {
			if (isset($_POST["inimgr"])) {
				$newIni = "; Created ".date("r")."\n";
				
				foreach ($_POST["inimgr"] as $k => $a_set) {
					if ($a_set["group"]) {
						$newIni .= "\n[".$a_set["group"]."]\n";
						
						foreach ($a_set["key"] as $p => $key) {
							$value = $a_set["value"][$p];
							
							if ($key) {
								$newIni .= $key." = ".$value."\n";
							}
						}
					}
				}
				
				if ($this->write($newIni)) {
					return(true);
				} else {
					return(false);
				}
			}
		}
	}
?>
